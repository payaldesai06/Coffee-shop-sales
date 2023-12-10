<template>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>New Sales</h4>
                </div>
                <div class="card-body">
                    <form @submit.prevent="create">
                        <p v-if="errors.length">
                            <b>Please correct the following error(s):</b>
                            <ul>
                                <li v-for="(item,key) in errors" :key="key">{{ item }}</li>
                            </ul>
                        </p>
                        <div class="row">
                          <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Product (Optional)</label>
                                    <select class="form-control" v-model="product" :placeholder="Select">
                                      <option
                                          v-for="(item,key) in products" :key="key"
                                          v-bind:value="{ id: item.id, profit_margin: item.profit_margin }"
                                        >
                                          {{ item.name }}
                                        </option>
                                      </select>
                                </div>
                            </div>
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Quantity*</label>
                                    <input type="text" class="form-control" v-model="quantity" v-validate="'required'" data-vv-validate-on="blur">
                                </div>
                            </div>
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Unit Cost*</label>
                                    <input type="text" class="form-control" v-model="unitCost" v-validate="'required'" data-vv-validate-on="blur">
                                </div>
                            </div>
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Selling Price</label>
                                    <input type="text" readonly class="form-control" v-model="sellingPrice">
                                </div>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Record Sale</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Previous Sales</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                  <th>Product</th>
                                  <th>Quantity</th>
                                  <th>Unit Cost</th>
                                  <th>Shipping Cost</th>
                                  <th>Profit margin</th>
                                  <th>Selling Price</th>
                                  <th>Sold At</th>
                                  <th>Created By</th>
                                </tr>
                            </thead>
                            <tbody v-if="sales.length > 0">
                                <tr v-for="(sale,key) in sales" :key="key">
                                    <td>{{ sale.product }}</td>
                                    <td>{{ sale.quantity }}</td>
                                    <td>{{ sale.unitCost }}</td>
                                    <td>{{ sale.productShippingCost }}</td>
                                    <td>{{ sale.productProfitMargin }}</td>
                                    <td>{{ sale.sellingPrice }}</td>
                                    <td>{{ sale.createdAt }}</td>
                                </tr>
                            </tbody>
                            <tbody v-else>
                                <tr>
                                    <td colspan="7" align="center">No Sales Found.</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import axios from 'axios';
export default {
    name:"sales",
    data(){
        return {
            errors: [],
            sales:[],
            products:[],
            quantity:'',
            unitCost:'',
            sellingPrice:'',
            product:'',
            shippingCost:'',
        }
    },
    mounted(){
        this.getsales();
    },
    methods:{
        async getsales(){
          await axios.get('/api/sale').then(response=>{
              this.sales = response.data.payload.sales ?? [];
              this.products = response.data.payload.products ?? [];
              this.shippingCost = response.data.payload.shippingCost;
          }).catch(error=>{
              console.log(error)
          })
        },
        create(){
            this.checkForm();
            let profitMarginPersentage = 25; // margin default value 25
            if (this.product != null && this.product.profit_margin) {
                profitMarginPersentage = this.product.profit_margin;
            }
            let profitMargin = profitMarginPersentage / 100;
            this.calculateSellingPrice(profitMargin);
            let payload = {
                product: this.product != null ? this.product.id : null,
                quantity: this.quantity,
                unitCost: this.unitCost,
                sellingPrice: this.sellingPrice,
                profitMargin: profitMargin,
                shippingCost: this.shippingCost
            };
            axios.post('/api/sale/create',payload).then(response=>{
                this.getsales();
                this.product = '';
                this.quantity = '';
                this.unitCost= '';
                this.sellingPrice = '';
                this.errors = [];
            }).catch(error=>{
                this.errors = [];
                this.errors.push(error.response.data.message);
            })
        },
        calculateSellingPrice(profitMargin){
          let cost = (this.unitCost * this.quantity);
          this.sellingPrice = ((cost / (1 - profitMargin)) + parseInt(this.shippingCost)).toFixed(2);
        },
        checkForm(){
            if (!this.quantity) {
                this.errors.push('Quantity is required.');
                e.preventDefault();
            }
            if (!this.unitCost) {
                this.errors.push('Unit cost is required.');
                e.preventDefault();
            }
        }
    }
}
</script>
