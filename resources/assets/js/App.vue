<template>
    <div class="panel panel-default">
        <div class="top-header-1">
            <div class="box-header-1">
                <nav>
                    <ul class="list-inline">
                        <li>
                            <router-link :to="{ name: 'Products' }">Home</router-link>
                        </li>
                        <li v-if="!$auth.check()" class="pull-right">
                            <router-link :to="{ name: 'login' }">Login</router-link>
                        </li>
                        <li v-if="!$auth.check()" class="pull-right">
                            <router-link :to="{ name: 'register' }">Register</router-link>
                        </li>
                       
                    </ul>
                </nav>
                <nav>
                    <ul v-if="$auth.check()">
                        <li><p>{{ $auth.user().name }}</p>
                            <ul>
                                <li><router-link :to="{name:'ListsDonhang'}">Đơn hàng</router-link></li>
                                <li v-if="$auth.check()" class="pull-right">
                                    <a href="#" @click.prevent="$auth.logout()">Đăng xuất</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        <div class="panel-body">
            <router-view></router-view>
        </div>
    </div>
</template>
<script>
    export default {
        data(){
            return{
                title:"",
                InfoUser:this.$store.getters.InfoUser
            }
        },
        mounted(){
             this.all_prouducts();
        },
        methods:{
            all_prouducts:function(){
                this.axios.get('http://127.0.0.1:8000/api/product').then((response)=>{
                    this.$store.dispatch('getAllProducts',response.data.products)
                  //  console.log(response);
                })
            },
          
            
            
        }
    }

</script>