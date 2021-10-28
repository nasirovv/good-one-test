<template>
    <h2>{{ product.product_name }}: {{ product.product_quantity }}</h2>
    <table>
        <tr>
            <th>Warehouse id</th>
            <th>Material name</th>
            <th>Quantity</th>
            <th>Price</th>
        </tr>
            <material-item v-for="(material, index) in product.product_materials"
                           :key="index"
                           :material="material"
            ></material-item>
    </table>
</template>

<script>
import MaterialItem from "./MaterialItem";
export default {
    props: ['product'],
    data(){
        return {

        }
    },
    components: {
        MaterialItem
    }
}
</script>
