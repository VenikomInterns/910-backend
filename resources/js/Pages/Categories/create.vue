<template>
    <form @submit.prevent="submit">
        <label for="name">name</label>
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
    data(){
        return{
            form: this.$inertia.form({
                name: ""
            })
        }
    },
    methods: {
        submit(){
            this.$inertia.post(route('categories.store'),this.form)
        }
    }
}
</script>
