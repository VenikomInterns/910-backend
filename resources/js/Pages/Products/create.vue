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
    name: 'create',
    data() {
        return {
            form: this.$inertia.form({
                name: "",
                price:"",
                description: ""
            })
        }
    },
    methods: {
        submit() {
            this.$inertia.post(route('products.store'),this.form)
        }
    }
}
</script>
