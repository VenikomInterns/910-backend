<template>
    <form @click.prevent="submit">
        <label for="name">name</label>
        <br>
        <input type="text" id="price" v-model="form.price">
        <label for="name">price</label>
        <br>
        <input type="text" id="description" v-model="form.description">
        <label for="name">description</label>
        <br>
        <input type="text" id="name" v-model="form.name">

        <button type="submit">
            Save
        </button>
    </form>
</template>

<script>
export default {
    name: 'edit',
    props: {
        product: Object
    },
    data() {
        return {
            form: this.$inertia.form({
                name: this.product.name,
                price:this.product.price,
                description: this.product.description
            })
        }
    },
    methods: {
        submit() {
            this.$inertia.put(route('products.update', this.product), this.form);
        }
    }
}
</script>
