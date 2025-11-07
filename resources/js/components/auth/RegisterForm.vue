<template>
  <div class="container d-flex justify-content-center align-items-center min-vh-100 flex-column">
    <!-- Register Form -->
    <form @submit.prevent="register" class="p-4 border rounded-3 shadow-lg bg-white mb-3" style="width: 350px;">
      <h3 class="text-center mb-4">Register</h3>

      <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control" v-model="name" id="name">
        <span v-if="errors.name" class="text-danger">{{ errors.name[0] }}</span>
      </div>

      <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" v-model="email" id="email">
        <span v-if="errors.email" class="text-danger">{{ errors.email[0] }}</span>
      </div>

      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" v-model="password" id="password">
        <span v-if="errors.password" class="text-danger">{{ errors.password[0] }}</span>
      </div>

      <div class="mb-3">
        <label for="password_confirmation" class="form-label">Confirm Password</label>
        <input type="password" class="form-control" v-model="password_confirmation" id="password_confirmation">
        <span v-if="errors.password_confirmation" class="text-danger">{{ errors.password_confirmation[0] }}</span>
      </div>

      <button type="submit" class="btn btn-primary w-100">Register</button>

      <div v-if="errors.general" class="text-danger mt-2 text-center">{{ errors.general }}</div>
    </form>

    <!-- "Already have account?" link below form -->
    <div class="text-center">
      <span>Already have an account? </span>
      <a href="/login" class="text-primary fw-bold">Login here</a>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      name: '',
      email: '',
      password: '',
      password_confirmation: '',
      errors: {}
    }
  },
  methods: {
    async register() {
      this.errors = {}; // reset errors
      try {
        const response = await axios.post('/api/user/register', {
          name: this.name,
          email: this.email,
          password: this.password,
          password_confirmation: this.password_confirmation
        }, { withCredentials: true });

        if (response.data.success) {
          // optionally redirect to home or login
          window.location.href = '/';
        }
      } catch (err) {
        if (err.response?.status === 422) {
          // validation errors from backend
          this.errors = err.response.data.errors;
        } else {
          this.errors.general = err.response?.data?.message || 'Something went wrong!';
        }
      }
    }
  }
}
</script>

<style scoped>
body {
  background-color: lightgray;
}
</style>
