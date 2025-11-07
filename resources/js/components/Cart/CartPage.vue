<template>
  <div class="container py-4">
  <div v-if="successMessage" class="alert alert-success alert-dismissible fade show" role="alert">
      {{ successMessage }}
      <button type="button" class="btn-close" @click="successMessage = ''"></button>
    </div>
    <h3>Your Cart</h3>
    <div v-if="cart && cart.items.length">
      <table class="table">
        <thead>
          <tr>
            <th>Product</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Total</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="item in cart.items" :key="item.id">
            <td>{{ item.product.name }}</td>
            <td>₹{{ item.product.price }}</td>
            <td>
              <input type="number" class="form-control" v-model.number="item.quantity" min="1" />
            </td>
            <td>₹{{ item.product.price * item.quantity }}</td>
            <td>
                <div class="d-flex gap-2">
                <button class="btn btn-sm btn-primary" @click="updateQuantity(item)">Update</button>
                <button class="btn btn-sm btn-primary" @click="RemoveItem(item)">Remove</button>
                </div>
              
            </td>
          </tr>
        </tbody>
      </table>

      <div class="text-end fw-bold">
        Total: ₹{{ total }}
      </div>
      <button class="btn btn-sm btn-primary" @click="PlaceOrder">Place Order</button>
    </div>

    <div v-else>
      <p>Your cart is empty</p>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      cart: null,
      successMessage: '',
    };
  },
  computed: {
    total() {
      if (!this.cart) return 0;
      return this.cart.items.reduce((sum, item) => sum + item.product.price * item.quantity, 0);
    }
  },
  methods: {
    async fetchCart() {
      try {
        const response = await axios.get('/api/cart');
        this.cart = response.data;
      } catch (error) {
        console.error(error);
      }
    },
    async updateQuantity(item) {
      try {
        const token = localStorage.getItem('api_token');
        const response = await axios.post('/api/cart/update', {
          cart_item_id: item.id,
          quantity: item.quantity
        },
        {
            headers: {
            Authorization: `Bearer ${token}`
            }
        });
        if(response.data.success){
        
          this.successMessage = `${response.data.message}!`;

                  // Optional: auto-hide after 3 seconds
                  setTimeout(() => {
                    this.successMessage = '';
                  }, 3000);
        }
      } catch (err) {
        alert(err.response?.data?.message || 'Failed to update');
      }
    },
    async RemoveItem(item){
        try {
        const token = localStorage.getItem('api_token'); 
        const response = await axios.post('/api/cart/remove', {
        cart_item_id: item.id,
        }, {
            headers: {
            Authorization: `Bearer ${token}`
            }
        });
        if(response.data.success){
            this.cart = response.data.cart;
            this.successMessage = `${response.data.message}!`;
                setTimeout(() => {
                this.successMessage = '';
                }, 3000);
        }
      } catch (err) {
        alert(err.response?.data?.message || 'Failed to update');
      }
    },
    async PlaceOrder() {
      try {
        const token = localStorage.getItem('api_token'); 
        const response = await axios.post('/api/orders', {}, { 
        headers: {
            Authorization: `Bearer ${token}` 
            } 
        });
        if(response.data.success) {
          window.location.href = '/';
           this.successMessage = `${response.data.message}!`;
                setTimeout(() => {
                this.successMessage = '';
                }, 3000);
        }
      } catch (err) {
        alert(err.response?.data?.message || 'Failed to place order');
      }
    }
  },
  mounted() {
    this.fetchCart();
  }
};
</script>
