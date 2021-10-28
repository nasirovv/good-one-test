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

            <h2>Result</h2>
                <result-item v-for="(product, index) in result"
                             :key="index"
                             :product="product"
                ></result-item>
        </div>
    </div>
</template>

<script>
import ProductItem from "./ProductItem";
import ResultItem from "./ResultItem";
export default {
    data(){
        return {
            products: [],
            data: [],
            result: []
        }
    },
    components: {
        ProductItem,
        ResultItem
    },
    methods: {
        getProducts(){
            this.axios.get('api/products')
            .then(response => this.products = response.data)
            .catch(error => console.log(error))
        },
        send(){
            console.log(this.data)
            this.axios.post('api/calculate', {"products": this.data})
            .then(response => this.result = response.data.result)
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
