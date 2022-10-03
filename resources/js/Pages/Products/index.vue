<template>
<div>
<table class="table border-4 text-center">
    <tr class="table-row text-center">
        <th class=" border-4 columns-3">
            Name
        </th>
        <th class=" border-4 columns-3">
            Price
        </th>
        <th class=" border-4 columns-3">
            Description
        </th>


    </tr>
    <tr v-for="product in products" :key="product.id" class="table-row">

        <td class="table-cell border-4">
            {{ product.name }}
        </td>
        <td class="table-cell border-4">
            {{ product.price }}
        </td>

        <td class="table-cell border-4">
            {{ product.description }}
        </td>


        <td class="table-cell border-4">
            <Link :href="route('products.edit', product.id)"
                  class="text-sm text-gray-700 dark:text-gray-500 underline">
                Edit
            </Link>
            <Link method="DELETE" type="button" as="button" :href="route('products.destroy', product.id)">
                Delete
            </Link>
        </td>

    </tr>
</table>
</div>
</template>

<script>
export default {
    name:'index',
    props: {
        products:Array
    }
}
</script>
