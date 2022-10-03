<template>
    <div>
        <table class="table border-4 text-center">
            <tr class="table-row text-center">
                <th class=" border-4 columns-3">
                    Name
                </th>


            </tr>
            <tr v-for="category in categories" :key="category.id" class="table-row">

                <td class="table-cell border-4">
                    {{ category.name }}
                </td>


                <td class="table-cell border-4">
                    <Link :href="route('categories.edit', category)"
                          class="text-sm text-gray-700 dark:text-gray-500 underline">
                        Edit
                    </Link>

                </td>
                <td>
                    <Link method="DELETE" type="button" as="button" :href="route('categories.destroy', category)">
                        Delete
                    </Link>
                </td>
            </tr>
        </table>
    </div>
</template>

<script>
export default {
    name: 'index',
    props: {
        categories: Array
    }
}
</script>
