<template>
    <div class="chitietdonhang" >
         <span>Chi tiết đơn đặt hàng</span>
         <h3>Hoten:{{donhang.tenkh}}</h3>
         <p>Số điện thoại:{{donhang.sodienthoai}}</p>
         <p>Địa chỉ:{{donhang.diachi}}</p>
         <table>
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Tên SP</th>
                    <th>Hình</th>
                    <th>Giá</th>
                    <th>Số lượng</th>
                    <th>Thành tiền</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for = "(item,index) of chitietdonhang" :key="index">
                    <td>{{index+1}}</td>
                    <td>{{item.tensp}}</td>
                    <td><img :src="item.hinh" height="80" width="80"></td>
                    <td>{{formatPrice(item.giasp)}}</td>
                    <td>{{item.soluong}}</td>
                    <td>{{formatPrice(item.tongtien)}}</td>
                </tr>
            </tbody>
         </table>
         <span>Đã áp dụng mã giảm giá:{{magiamgia.magiamgia}}:{{magiamgia.phantram}}%</span>
         <h2>Tổng tiền:{{formatPrice(tonggia)}}</h2>
    </div>
</template>
<script>
    export default {
        data(){
            return{
                madonhang:this.$route.params.madonhang,
                donhang:[],
                thongtin:[],
                chitietdonhang:[],
                magiamgia:[],
                tonggia:0,
                check_thanhtoan:false
            }
        },
        mounted(){

            this.getdonhang();
        },
        methods:{
            sumPrice(){
                var items= this.chitietdonhang;
                var toggia=0;
                var result = Object.keys(items).map(function(key) {
                    var soluong = items[key].soluong;
                    var gia = parseInt(soluong)*parseInt(items[key].giasp);
                    toggia=toggia+parseInt(gia);
                });
                if(this.magiamgia.phantram>0){
                    toggia = parseFloat(toggia)-(parseFloat(toggia)*(this.magiamgia.phantram/100));
                }
                this.tonggia=parseFloat(toggia);
            },
            formatPrice(value) {
                let val = (value/1).toFixed(2).replace('.', ',')
                return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
            },
            getdonhang(){
                if(this.madonhang>0){
                    this.axios.post('http://127.0.0.1:8000/api/donhang/chitiet',{madonhang:this.madonhang})
                    .then((response)=>{
                        //console.log(response);
                        this.donhang=response.data.success.donhang;
                        this.thongtin=response.data.success.thongtin;
                        this.chitietdonhang=response.data.success.chitiet;
                        this.magiamgia=response.data.success.magiamgia;
                        this.sumPrice();
                    })
                    .catch((error)=>{console.log(error)});
                }
                else{
                    this.$router.push({name:'Products'});
                }
            }
        }
    }
</script>
