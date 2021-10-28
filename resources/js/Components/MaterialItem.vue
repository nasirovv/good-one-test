<template>
    <tr>
        <td>{{ material.warehouse_id }}</td>
        <td>{{ material.material_name }}</td>
        <td>{{ material.quantity }}</td>
        <td>{{ material.price }}</td>
    </tr>
</template>

<script>
export default {
    props: ['material'],
    data(){
        return {

        }
    }
}
</script>
