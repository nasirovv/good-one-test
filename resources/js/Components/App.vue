<template>
    <div class="container pt-5">
        <div class="card center">
            <h2>Calculating products</h2>
                <product-item v-for="product in products"
                              :key="product.id"
                              :product="product"
                ></product-item>
            <button class="btn primary mt-3">Send</button>
        </div>
    </div>
</template>

<script>
import ProductItem from "./ProductItem";
export default {
    data(){
        return {
            products: [],
        }
    },
    components: {
        ProductItem
    },
    methods: {
        getProducts(){
            this.axios.get('api/products')
            .then(response => this.products = response.data)
            .catch(error => console.log(error))
        }
    },
    created() {
        this.getProducts()
    }
}
</script>

<style>

</style>
