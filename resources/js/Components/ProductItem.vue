<template>
    <div class="flex flexWidth">
        <div class="flex" style="width: 150px">
            <span style="margin-right: 5px;">{{ product.name }}</span>
            <input type="number" :disabled="isCompleted" v-model="inputNumber">
        </div>
        <button class="btn" @click="completed" :disabled="isCompleted">Completed</button>
    </div>
</template>

<script>
export default {
    props: ['product'],
    data() {
        return {
            isCompleted: false,
            inputNumber: null
        }
    },
    methods: {
        getAmount(){
            if (this.isCompleted && this.inputNumber){
                this.$emit("newProduct", this.product.id, this.inputNumber)
            }
        },
        completed() {
            this.isCompleted = true
            this.getAmount()
        }
    }
}
</script>

<style>

</style>
