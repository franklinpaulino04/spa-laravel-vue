<template>
    <div>
        <h2 class="text-center">Products List</h2>

        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Detail</th>
                <!-- <th>Actions</th> -->
            </tr>
            </thead>
            <tbody>
            <tr v-for="(product, index, i) in products" :key="product.id">
                <td>{{ i+1 }}</td>
                <td>{{ product.name }}</td>
                <td>{{ product.description }}</td>
                <td>{{ product.price }}</td>
                <td>{{ product.quantity }}</td>
                <td>
                    <div class="btn-group" role="group">
                        <router-link :to="{name: 'edit', params: { id: product.productId }}" class="btn btn-success">Edit</router-link>
                        <button class="btn btn-danger" @click="deleteProduct(product.productId)">Delete</button>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                products: [],
                count: 0,
            }
        },
        created: function() {
           this.datatable();
        },
        methods: {
            async deleteProduct(productId) {
                this.$confirm('Eliminar este producto?', 'Warning', {
                    confirmButtonText: 'OK',
                    cancelButtonText: 'Cancel',
                    type: 'warning'
                }).then(() => {
                    this.delete(productId);
                }).catch(() => {});
            },
            async datatable() {
                await this.axios
                    .get('/api/products')
                    .then(response => {
                        this.products = response.data.data;
                    });
            },

            async delete(productId) {
                await this.axios
                    .delete(`/api/products/${productId}`)
                    .then(response => {
                        this.datatable();
                    });
            }
        }
    }
</script>
