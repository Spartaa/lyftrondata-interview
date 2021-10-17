<template>
    <div>
        <h2 class="text-center">Products List</h2>
        <button class="btn btn-outline-primary float-right" @click="exportProducts">Export</button>

        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Detail</th>
                <th>Price</th>
                <!-- <th>Actions</th> -->
            </tr>
            </thead>
            <tbody v-if="dataReady">
            <tr v-for="product in products" :key="product.id">
                <td>{{ product.id }}</td>
                <td>{{ product.title }}</td>
                <td>{{ product.description }}</td>
                <td>{{ product.price }}</td>
                <td>
                    <div class="btn-group" role="group">
                        <router-link :to="{name: 'edit', params: { id: product.id }}" class="btn btn-success">Edit</router-link>
                        <button class="btn btn-danger" @click="deleteProduct(product.id)">Delete</button>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
export default {
    name: "ProductList",
    data() {
        return {
            products: [],
            dataReady : false,
        }
    },
    created() {
        this.axios
            .get('https://lyftrondata-interview.test/api/products')
            .then(response => {
                this.products = response.data.products;
                if(this.products.length > 0){
                    this.dataReady = true;
                }
            }).catch(function (error){
            alert(error.response.data.message);
        });
    },
    methods: {
        deleteProduct(id) {
            this.axios
                .delete(`https://lyftrondata-interview.test/api/products/${id}`)
                .then(response => {
                    alert(response.data.message);
                }).catch(function (error){
                alert(error.response.data.message);
            });
        },
        exportProducts() {
            this.axios
                .get(`https://lyftrondata-interview.test/api/export/products`)
                .then(response => {
                  alert('Exported')
                });
        }
    }
}
</script>
