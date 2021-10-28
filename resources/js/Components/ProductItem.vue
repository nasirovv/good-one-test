<template>
    <div class="flex">
            <span style="margin-right: 5px;">{{ product.name }}</span>
            <input type="number" :disabled="isCompleted" v-model="inputNumber" @focusout="completed">
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
