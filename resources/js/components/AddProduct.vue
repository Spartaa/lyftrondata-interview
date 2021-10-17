<template>
    <div>
        <h3 class="text-center">Create Product</h3>
        <div class="row">
            <div class="col-md-6">
                <form @submit.prevent="addProduct">
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" class="form-control" v-model="product.title">
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <input type="text" class="form-control" v-model="product.description">
                    </div>
                    <div class="form-group">
                        <label>Price</label>
                        <input type="number" step="0.01" class="form-control" v-model="product.price">
                    </div>
                    <button type="submit" class="btn btn-primary">Create</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "AddProduct",
    data() {
        return {
            product: {
                'title': '',
                'description': '',
                'price': '',
            }
        }
    },
    methods: {
        addProduct() {
            this.axios
                .post('https://lyftrondata-interview.test/api/products', this.product)
                .then(response => (
                    this.$router.push({name: 'home'})
                ))
                .catch(function (error) {
                    alert(error.response.data.message);
                });
        }
    }
}
</script>

<style scoped>

</style>
