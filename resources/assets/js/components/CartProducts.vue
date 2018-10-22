<template>  
    <div class="cart-products" v-if="giohangs.length>0">
        <div class="box-cart">
            <div class="col1-cart">
                <table>
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Name</th>
                            <th>Image</th>
                            <th>SL</th>
                            <th>Price</th>
                            <th>Total Price</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(item,index) in giohangs" :key="index">
                            <td>{{index+1}}</td>
                            <td>{{item.nameProduct}}</td>
                            <td><img :src="item.image" height="80" width="80"/></td>
                            <td><input type="text" name="txt_sl" class="sl" min="1" max="50"  v-model="item.soluong" @change="sumPrice"/></td>
                            <td>{{item.price}}</td>
                            <td>{{item.soluong*item.price}}</td>
                            <td><span v-on:click="deleteGiohang(item)">Delete</span></td>
                        </tr>
                        
                    </tbody>
                </table>
            </div>
            <div class="col2-cart">
                <label>Mã giảm giá</label>
                <input type="text" name="magiamgia" v-model="magiamgia" v-bind:class="{ 'txt_magiamgia': check_magiamgia}"/>
                <button v-on:click="check_ma" v-if="!check_magiamgia">Áp dụng</button>
                <button v-on:click="check_ma" v-if="check_magiamgia">Xóa mã</button>
                <h2>Tổng tiền:{{formatPrice(tonggia)}}</h2>
                <router-link :to="{name:'Products'}">Tiếp tục mua</router-link>
            </div>
        </div>
        <div class="thongtin">
            <div class="form-content">
                <form @submit.prevent="addDathang">
                    <div class="form-thongtin">
                        <label for="name">Họ và tên</label>
                        <input type="text" name="tenkh" class="txt_tk" placeholder="Nhập họ tên" v-model="tenkh"/>
                    </div>
                    <div class="form-thongtin">
                        <label for="dienthoai">Số điện thoại</label>
                        <input type="text" name="sodienthoai" class="txt_sodienthoai" placeholder="Nhập số điện thoại" v-model="sodienthoai"/>
                    </div>
                    <div class="form-thongtin">
                        <label for="diachi">Địa chỉ</label>
                        <input type="text" name="hoten" class="txt_diachi" placeholder="Địa chỉ giao hàng" v-model="diachi"/>
                    </div>
                    <div class="form-thongtin">
                        <button type="submit">thanh Toán</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        data(){
            return{
                title:'',
                giohangs:[],
                tongthanhtien:0,
                tonggia:0,
                tenkh:"",
                sodienthoai:"",
                diachi:"",
                magiamgia:"",
                idma:1,
                check_magiamgia:false,
                check_thanhtoan:false
            }
        },
        mounted(){
           this.giohangs=this.$store.getters.giohangs;
           this.check_thanhtoan=this.$store.getters.check_thanhtoan;
           if(this.giohangs.length<=0){
               this.$router.push({name:'Products'});
           }
           this.sumPrice();
        },
        methods:{
            editGiohang(giohang){
                this.$store.dispatch('editGiohang', giohang);
                this.sumPrice();
            },
            sumPrice(){
                var items= this.$store.getters.giohangs;
                var toggia=0;
                var result = Object.keys(items).map(function(key) {
                    var soluong = items[key].soluong;
                    var gia = parseInt(soluong)*parseInt(items[key].price);
                    toggia=toggia+parseInt(gia);
                });
                this.tongthanhtien=toggia;
                this.tonggia=toggia;
            },
            deleteGiohang(giohang){
                 this.$store.dispatch('deleteGiohang', giohang);
                 this.sumPrice();
            },
            formatPrice(value) {
                let val = (value/1).toFixed(2).replace('.', ',')
                return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
            },
            addDathang(e){
                e.preventDefault();
                var token = this.$auth.token();
                if(token!=null){
                    this.axios.get('http://127.0.0.1:8000/api/auth/user',{token:token}).then((response)=>{
                        let userId = response.data.data.id;
                        let add_data = [
                                {
                                        "magiamgia":this.idma,
                                        "userId":userId,
                                        "tenkh":this.tenkh,
                                        "sodienthoai":parseInt(this.sodienthoai),
                                        "diachi":this.diachi
                                }
                            ]
                        this.axios.post('http://127.0.0.1:8000/api/donhang/add-donhang',
                            {thongtin:add_data,giohangs:this.giohangs}).then(response=>{
                                if(response.data.success>0){
                                    this.$store.dispatch('addtongtien', this.tonggia);
                                    this.$store.dispatch('check_thanhtoan',true);
                                    this.giohangs=[];
                                    this.$store.dispatch('deleteAllGiohang', this.giohangs);
                                    this.$router.push({ name: 'chitietdonhang', params: { madonhang:response.data.madonhang }});

                                }
                                else{
                                    alert('Bạn đặt hàng chưa thành công!');
                                }
                            })
                            .catch(e => {
                                    console.log(e);
                                })
                    })
                    .catch((e)=>{
                        console.log(e);
                    })
                }
            },
            check_ma(){
               // console.log(this.magiamgia);
              
                this.axios.post("http://127.0.0.1:8000/api/donhang/magiamgia",{magiamgia:this.magiamgia,"check_ma":(!this.check_magiamgia?1:0)})
                .then((response)=>{
                // console.log();
                if(response.data.success>0){
                    this.check_magiamgia=true;
                    this.idma=response.data.idma;
                    let giagiam = this.tongthanhtien*(parseFloat(response.data.phantram)/100);
                    this.tonggia = this.tonggia-(parseFloat(giagiam));
                    console.log(this.tonggia);
                }else{
                    this.check_magiamgia=false;
                    this.magiamgia="";
                    this.idma=1;
                    this.tonggia=this.tongthanhtien;
                }
                
                }).catch(error=>{
                    console.log(error)
                })
            },

                

        }
    }
</script>
