<template>
    <div>
    <div v-if="successMessage" class="alert alert-success alert-dismissible fade show" role="alert">
      {{ successMessage }}
      <button type="button" class="btn-close" @click="successMessage = ''"></button>
    </div>
        <div class="row g-3">
            <div v-for="product in products" :key="product.id" class="col-md-4">
                <product-card
                    :product="product"
                    :is-auth="isAuth"
                    @add-to-cart="handleAddToCart"
                ></product-card>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
import ProductCard from "./ProductCard.vue";

export default {
    props: {
        initialProducts: Array,
        filters: Object,
        isAuth: { type: Boolean, required: true },
    },
    components: { ProductCard },
    data() {
        return {
            products: this.initialProducts,
            successMessage: '',
        };
    },
    watch: {
        filters: {
            deep: true,
            immediate: true, // fetch products on mount too
            handler(newFilters) {
                this.fetchProducts(newFilters);
            },
        },
    },

    methods: {
        async fetchProducts(filters = {}) {
            try {
                const response = await axios.get("/products/filter", {
                    params: filters,
                });
                this.products = response.data;
            } catch (error) {
                console.error(error);
            }
        },
        async handleAddToCart(product) {
            if (!this.isAuth) {
                window.location.href = "/login";
                return;
            }
            try {
                const token = localStorage.getItem('api_token');
                const response = await axios.post("api/cart/add", {
                    product_id: product.id,
                    quantity: 1,
                },
                {
                    headers: {
                    Authorization: `Bearer ${token}`
                        }
                });
                if(response.data.success){
                  this.successMessage = `${product.name} added to cart!`;

                  // Optional: auto-hide after 3 seconds
                  setTimeout(() => {
                    this.successMessage = '';
                  }, 3000);
                }
            } catch (error) {
                console.error(error);
                alert("Failed to add product.");
            }
        },
    },
};
</script>
