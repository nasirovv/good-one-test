<template>
    <div class="container pt-5">
        <div class="card center">
            <h2>Calculating products</h2>
                <product-item v-for="product in products"
                              :key="product.id"
                              :product="product"
                              @newProduct="setProduct"
                ></product-item>
            <button class="btn primary mt-3" @click="send">Send</button>
        </div>
    </div>
</template>

<script>
import ProductItem from "./ProductItem";
export default {
    data(){
        return {
            products: [],
            data: []
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
        },
        send(){
            this.axios.post('api/calculate', {"products": this.data})
            .then(response => console.log(response.data))
            .catch(error => console.log(error))
        },
        setProduct(id, amount){
            this.data.push({"product_id": id, "amount": amount})
        }
    },
    created() {
        this.getProducts()
    }
}
</script>

<style>

</style>
