<template>
    <div class="w-25 mx-auto text-center py-5">
        <h1 class="mb-5">Add Image</h1>
        <form @submit.prevent="submit" class="row text-end" enctype="multipart/form-data">
            <label for="image" class="col-3">image</label>
            <input type="file" @change="previewImage" @input="form.image = $event.target.files[0]" name="image" id="image" class="col-9 mb-3" />

            <img
                v-if="src"
                :src="src"
            />

            <label for="product_id" class="col-3">product</label>
            <select
                class="col-9"
                name="product_id"
                id="product_id"
                type="text"
                v-model="form.product_id">
                <option v-for="product in products" :key="product.id" :value="product.id">
                    {{product.name}}
                </option>
            </select>

            <div className="d-flex align-items-end flex-column w-100">
                <button type="submit" className="btn bg-primary text-white w-25 my-2">
                    Save
                </button>
            </div>
            <p>{{message}}</p>
        </form>
    </div>
</template>

<script>
export default {
    name: 'Create',
    props : {
        products: Array,
    },
    data(){
        return{
            form: this.$inertia.form({
                image: "",
                product_id: ""
            }),
            message: '',
            src: null,
        }
    },
    methods: {
        submit(){
            this.$inertia.post(route('images.store'),this.form,{
                onSuccess: () => {
                    this.form.reset();
                    this.message = 'success'
                },
            })
        },
        previewImage(e) {
            const file = e.target.files[0];
            this.src = URL.createObjectURL(file);
        },
    }
}
</script>
