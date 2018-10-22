<template>
   <div class="box-products">
       <nav>
           <ul>
               <li v-for="(item,key) in products" :key="key">
                   <router-link :to="{ name: 'InfoProduct',params:{id:item.id} }"><img v-bind:src="item.image"/></router-link>
                   <router-link :to="{ name: 'InfoProduct',params:{id:item.id} }">  <span class="name_sp">{{item.name}}</span></router-link>
                   <label>Price:{{item.price}} </label>
               </li>
           </ul>
       </nav>
   </div>
</template>
<script>
    export default {
        data(){
            return{
                title:"", 
                InfoUser:[]
            }
        },
        computed:{
            products(){
                return this.$store.getters.products
            }
           
        },
        mounted(){
             this.getInfoUser();
        },
        methods:{
            getInfoUser(){
                var token = this.$auth.token();
                if(token!=null){
                    this.axios.get('http://127.0.0.1:8000/api/auth/user',{token:token})
                    .then((response)=>{
                       // console.log(response);
                        this.$store.dispatch('getThongtin', response.data.data);
                        this.InfoUser = this.$store.getters.InfoUser;
                    })
                    .catch((error)=>{
                        console.log(error);
                    })
                }
            }
        }
    }

</script>