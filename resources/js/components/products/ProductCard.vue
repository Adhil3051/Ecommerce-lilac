<template>
  <div class="card shadow-sm">
    <div class="card-body">
      <h5 class="card-title">{{ product.name }}</h5>
      <p class="card-text">{{ product.description }}</p>
      <p class="fw-bold text-primary">₹{{ product.price }}</p>
            <button class="btn btn-success w-100" @click="handleAddToCart">Add to Cart</button>

    </div>
  </div>
</template>

<script>
export default {
  name: 'ProductCard',
  props: {
    product: { type: Object, required: true },
    isAuth: {type: Boolean, default: false }
  },
  methods: {
  handleAddToCart(){
    if(!this.isAuth){
        window.location.href = '/login'; 
        return;
    }
    this.$emit('add-to-cart', this.product);
  }
  }
}
</script>
