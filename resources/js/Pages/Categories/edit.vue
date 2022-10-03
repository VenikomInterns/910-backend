<template>
    <form @click.prevent="submit">
        <label For="name">title</label>
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
        category: Object
    },
    data() {
        return {
            form: this.$inertia.form({
                name: this.category.name
            })
        }
    },
    methods: {
        submit() {
            this.$inertia.put(route('categories.update', this.category), this.form);
        }
    }
}
</script>
