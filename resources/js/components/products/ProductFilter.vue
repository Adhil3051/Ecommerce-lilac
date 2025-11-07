<template>
  <div class="card p-3">
    <h5>Filter by Price</h5>
    <div class="mb-2">
      <label>Min Price</label>
      <input type="number" v-model="minPrice" class="form-control" />
    </div>
    <div class="mb-2">
      <label>Max Price</label>
      <input type="number" v-model="maxPrice" class="form-control" />
    </div>
    <button class="btn btn-primary w-100 mt-2" @click="applyFilter">Apply</button>
  </div>
</template>

<script>
export default {
  data() {
    return {
      minPrice: '',
      maxPrice: ''
    };
  },
  methods: {
    applyFilter() {
      this.$emit('filter-changed', {
        min_price: this.minPrice,
        max_price: this.maxPrice
      });
    }
  }
};
</script>
