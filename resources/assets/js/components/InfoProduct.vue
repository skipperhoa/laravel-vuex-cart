<template>  
    <div class="box-info">
        <div class="content-info" v-if="product.length>0">
            <div class="img-product">
                <img v-bind:src="product[0].image"/>
            </div>
            <div class="info-product">
                <h1>{{product[0].name}}</h1>
                <span>Price:{{product[0]['price']}}</span>
                <input type="number" name="txt_soluong" min="1" max="50" v-model="soluong"/>
                <button class="dathang" v-on:click="addProduct(product[0].id)">MUA</button>
                <router-link :to="{name:'CartProducts'}">Gio hang</router-link>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        data(){ 
            return{
                title:"Thông tin Product",
                idProduct:this.$route.params.id,
                product:[],
                soluong:1,
                check_token:false
            }
        },
        mounted(){
            this.show_product();
            var token = this.$auth.token();
            if(token!=null){
                this.check_token=true;
            }
        },
        methods:{
            show_product:function(){
                if(this.$route.params.id>0){
                    this.axios.get('http://127.0.0.1:8000/api/product/'+this.$route.params.id).then((response)=>{
                        //console.log(response);
                         this.product= response.data.product
                    });
                }
            },
            addProduct(){
                var product = {
                        "id":this.product[0].id,
                        "name":this.product[0].name,
                        "price":this.product[0].price,
                        "image":this.product[0].image,
                        "soluong":this.soluong
                }
                this.$store.dispatch('addGiohang', product)
                if(!this.check_token){
                   this.$router.push('/login');
                }
                
            }
        }
    }

</script>