import './bootstrap';
// import { createApp, reactive } from 'vue';
// import ProductCard from './components/products/ProductCard.vue';
// import ProductFilter from './components/products/ProductFilter.vue';
// import ProductList from './components/products/ProductList.vue';

// const app = createApp({
//     data() {
//         return {
//             filters: reactive({
//                 min_price: '',
//                 max_price: ''
//             })
//         };
//     },
//     methods: {
//         updateFilters(newFilters) {
//             this.filters.min_price = newFilters.min_price;
//             this.filters.max_price = newFilters.max_price;
//         }
//     }
// });

// app.component('product-card', ProductCard);
// app.component('product-filter', ProductFilter);
// app.component('product-list', ProductList);

// app.mount('#app');

import { createApp } from 'vue';
import ProductFilter from './components/products/ProductFilter.vue';
import ProductList from './components/products/ProductList.vue';
import LoginForm from './components/auth/LoginForm.vue';
import CartPage from './components/Cart/CartPage.vue';
import RegisterForm from './components/auth/RegisterForm.vue';
import OrderView from './components/order/Order.vue';




const app = createApp({
    data() {
        return {
            filters: {}
        }
    },
    methods: {
        updateFilters(newFilters) {
            this.filters = { ...newFilters }; // reactive
        }
    }
});

app.component('product-list', ProductList);
app.component('product-filter', ProductFilter);
app.component('user-login-form', LoginForm);
app.component('cart-view', CartPage);
app.component('register-view', RegisterForm);
app.component('order-view', OrderView);




app.mount('#app');
