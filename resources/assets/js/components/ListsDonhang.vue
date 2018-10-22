<template>
    <div class="listsdonghang">
        <div class="box-donhang">
            <h3>{{title}}</h3>
            
            <table>
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Madonhang</th>
                        <th>Tên KH</th>
                        <th>Số điện thoại</th>
                        <th>Địa chỉ</th>
                        <th>Ngày đặt hàng</th>
                        <th>Xem chi tiết</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(item,index) of donhangs" :key="index">
                        <td>{{index+1}}</td>
                        <td>{{item.madonhang}}</td>
                        <td>{{item.tenkh}}</td>
                        <td>{{item.sodienthoai}}</td>
                        <td>{{item.diachi}}</td>
                        <td>{{item.created_at}}</td>
                        <td><router-link :to="{name:'InfoDonhang',params:{madonhang:item.id}}">Xem</router-link></td>
                    </tr>
                </tbody>
            </table>

        </div>
    </div>
</template>
<script>
export default {
    data(){
        return{
            title:"Danh sách đơn hàng của bạn!",
            InfoUser:this.$store.getters.InfoUser,
            donhangs:[]
        }
    },
    mounted(){
        this.getAllDonhang();
    },
    methods:{
        getAllDonhang:function(){
             var token = this.$auth.token();
             if(token!=null){
                this.axios.get('http://127.0.0.1:8000/api/auth/user',{token:token})
                 .then((response)=>{
                     console.log(response);
                     this.$store.dispatch('getThongtin', response.data.data);
                     this.InfoUser = this.$store.getters.InfoUser;
                     this.axios.post("http://127.0.0.1:8000/api/donhang/listsdonhang",{userId:this.InfoUser.id})
                     .then((response)=>{
                         this.donhangs=response.data;
                     })
                     .catch((e)=>{console.log(e)})
                 })
                 .catch((error)=>{
                     console.log(error);
                 })
             }
        }
    }
}
</script>
