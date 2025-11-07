<template>
  <div class="container d-flex justify-content-center align-items-center min-vh-100 flex-column">
  <!-- Login Form -->
  <form @submit.prevent="login" class="p-4 border rounded-3 shadow-lg bg-white mb-3" style="width: 350px;">
    <h3 class="text-center mb-4">Login</h3>

    <div class="mb-3">
      <label for="name" class="form-label">Name</label>
      <input type="text" class="form-control" v-model="name" id="name">
      <span v-if="errors.name" class="text-danger">{{ errors.name[0] }}</span>
    </div>

    <div class="mb-3">
      <label for="password" class="form-label">Password</label>
      <input type="password" class="form-control" v-model="password" id="password">
      <span v-if="errors.password" class="text-danger">{{ errors.password[0] }}</span>
    </div>

    <button type="submit" class="btn btn-primary w-100">Login</button>

    <div v-if="errors.general" class="text-danger mt-2 text-center">{{ errors.general }}</div>
  </form>

  <!-- "Not a user?" link below form -->
  <div class="text-center">
    <span>Not a user? </span>
    <a href="/register" class="text-primary fw-bold">Register here</a>
  </div>
</div>

</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      name: '',
      password: '',
      errors: {}
    }
  },
  methods: {
    async login() {
      this.errors = {}; // reset errors
      try {
        const response = await axios.post('/api/user/login', {
          name: this.name,
          password: this.password
        }); 
        if(response.data.success){
                  
            const token = response.data.token;
            localStorage.setItem('api_token', token);
            window.location.href = '/';
        }
      } catch (err) {
        if (err.response?.status === 422) {
          // validation errors from backend
          this.errors = err.response.data.errors;
        } else if (err.response?.status === 401) {
          // invalid credentials
          this.errors.general = err.response.data.message || 'Invalid credentials';
        } else {
          this.errors.general = 'Something went wrong!';
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
