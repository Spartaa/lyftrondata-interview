<template>
    <div>
        <h3 class="text-center">Edit Product</h3>
        <div class="row">
            <div class="col-md-6">
                <form @submit.prevent="updateProduct">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" v-model="product.title">
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <input type="text" class="form-control" v-model="product.description">
                    </div>
                    <div class="form-group">
                        <label>Price</label>
                        <input type="number" step="0.01" @input="validateUpto2Decimal" class="form-control"
                               v-model="product.price">
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "EditProduct",
    data() {
        return {
            product: {
                name: '',
                description: '',
                price: '',
            }
        }
    },
    created() {
        this.axios
            .get(`https://lyftrondata-interview.test/api/products/${this.$route.params.id}`)
            .then((res) => {
                this.product = res.data;
            });
    },
    methods: {
        updateProduct() {
            this.axios
                .patch(`https://lyftrondata-interview.test/api/products/${this.$route.params.id}`, this.product)
                .then((res) => {
                    this.$router.push('/');

                }).catch(function (error){
                alert(error.response.data.message);
            });
        },
        validateUpto2Decimal() {
            if (this.product.price.includes('.')) {
                return this.product.price.split('.')[0] + '.' + this.product.price.split('.')[1].slice(0, 2)
            }
        }
    }
}
</script>

<style scoped>

</style>
