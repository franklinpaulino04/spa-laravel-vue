<template>
    <div>
        <h3 class="text-center">Edit Product / {{ product.name }}</h3>
        <div class="row">
            <div class="col-md-6">
                <form @submit.prevent="update">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" v-model="product.name">
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <input type="text" class="form-control" v-model="product.description">
                    </div>
                    <div class="form-group">
                        <label>Price</label>
                        <input type="text" class="form-control" v-model="product.price">
                    </div>
                    <div class="form-group">
                        <label>Quantity</label>
                        <input type="text" class="form-control" v-model="product.quantity">
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                product: {
                    name: '',
                    description: '',
                    price: '0.00',
                    quantity: '0.00',
                }
            }
        },
        created: function() {
            this.edit();
        },
        methods: {
            update() {
                this.axios
                    .patch(`/api/products/${this.$route.params.id}`, this.product)
                    .then((response) => {
                        const {result, data} = response.data;
                        console.log(response);
                        if(result == 1){
                            this.$router.push({ name: 'home' })
                        }
                    }).catch( (error) => {
                    console.log(error);
                });
            },
            async edit() {
                await this.axios
                    .get(`/api/products/${this.$route.params.id}`)
                    .then((response) => {
                        const {result, data}            = response.data;

                        if(result == 1){
                            this.product.name           = data.name;
                            this.product.description    = data.description;
                            this.product.price          = data.price;
                            this.product.quantity       = data.quantity;
                        }
                    }).catch( (error) => {
                        console.log(error);
                    });
            }
        }
    }
</script>
