<template>
  <div class="container py-4">
    <h3>My Orders</h3>

    <div v-if="orders.length">
      <table class="table">
        <thead>
          <tr>
          <th>Sl.No</th>
            <th>Order ID</th>
            <th>Products</th>
            <th>Total</th>
           
            <th>Placed At</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(order, index) in orders" :key="order.id">
          <td>{{ index + 1 }}</td>
            <td>{{ order.id }}</td>
            <td>
              <ul class="list-unstyled mb-0">
                <li v-for="item in order.items" :key="item.id">
                  {{ item.product.name }} x {{ item.quantity }}
                </li>
              </ul>
            </td>
            <td>₹{{ order.items.reduce((sum, i) => sum + i.product.price * i.quantity, 0) }}</td>
            
            <td>{{ new Date(order.created_at).toLocaleString() }}</td>
          </tr>
        </tbody>
      </table>
    </div>

    <div v-else>
      <p>You have no orders yet.</p>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      orders: [],
    };
  },
  methods: {
    async fetchOrders() {
      try {
        const response = await axios.get('/api/orders/get', { withCredentials: true });
        this.orders = response.data.orders || [];
      } catch (err) {
        console.error('Failed to fetch orders', err);
      }
    }
  },
  mounted() {
    this.fetchOrders();
  }
};
</script>
