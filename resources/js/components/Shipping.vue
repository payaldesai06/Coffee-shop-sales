<template>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>New Shipping Cost</h4>
                </div>
                <div class="card-body">
                    <form @submit.prevent="create">
                        <div class="row">
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Shipping Cost*</label>
                                    <input type="text" class="form-control" v-model="shippingCost" required>
                                </div>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Save</button>
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
                    <h4>Previous Shipping Costs</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                  <th>Shipment Cost</th>
                                  <th>Status</th>
                                  <th>Created at</th>
                                </tr>
                            </thead>
                            <tbody v-if="shippings.length > 0">
                                <tr v-for="(shipping,key) in shippings" :key="key">
                                    <td>{{ shipping.shippingCost }}</td>
                                    <td>{{ shipping.status }}</td>
                                    <td>{{ shipping.createdAt }}</td>
                                </tr>
                            </tbody>
                            <tbody v-else>
                                <tr>
                                    <td colspan="3" align="center">No Costs Found.</td>
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
    name:"shippings",
    data(){
        return {
            shippings:[],
            shippingCost:'',
        }
    },
    mounted(){
        this.getshippings();
    },
    methods:{
        async getshippings(){
          await axios.get('/api/shipping').then(response=>{
              this.shippings = response.data.payload ?? [];
          }).catch(error=>{
              console.log(error)
          })
        },
        async create(){
          let payload = {
            shippingCost: this.shippingCost
          };
          await axios.post('/api/shipping/create',payload).then(response=>{
             this.getshippings();
             this.shippingCost = '';
          }).catch(error=>{
              console.log(error)
          })
        },
    }
}
</script>
