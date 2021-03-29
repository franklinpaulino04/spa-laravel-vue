<template>
    <div>
        <h3 class="text-center">Create Product - {{ product.name }}</h3>
        <div class="row">

            <div class="col-md-6">
                <div class="col-md-12" style="padding-left: 0px; padding-right: 0px;" v-if="hasError">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <h4 class="alert-heading">Error!</h4>
                        <button type="button" class="close" data-dismiss="alert" @click="close()" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <ul v-for="(v, k) in errors" :key="k">
                            <li v-for="(s, t) in v">
                                <ul v-for="error in s" :key="t">
                                    {{ error }}
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
                <form @submit.prevent="addProduct">
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
                    <button type="submit" class="btn btn-primary">Create</button>
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
                    name : '',
                    description : '',
                    price : '0.00',
                    quantity : '0.00',
                },
                errors: [],
                hasError: false,
            }
        },
        methods: {
            addProduct() {
                this.axios
                    .post('/api/products', this.product)
                    .then(response => {
                        console.log(response);
                        if(response.data.result == 1){
                            this.$router.push({ name: 'home' });
                        }else{
                            this.hasError = true;
                            this.errors = [];
                            this.errors.push(response.data.errors);
                        }
                    });
            },
            close() {
                this.hasError = false;
            }
        }
    }
</script>
