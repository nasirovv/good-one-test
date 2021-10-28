<template>
    <div class="flex flexWidth">
        <div class="flex">
            <input type="checkbox" v-model="checkbox">
            <span style="margin-left: 5px;">{{ product.name }}</span>
        </div>
        <input type="number" :disabled="!checkbox" v-model="inputNumber">
    </div>
</template>

<script>
export default {
    props: ['product'],
    data() {
        return {
            checkbox: false,
            inputNumber: null
        }
    }
}
</script>

<style>

</style>
