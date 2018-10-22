export default {
    getThongtin(state,thongtin){
        state.InfoUser=thongtin;
    },
    getProduct(state,product){
        state.idProduct = product
    },
    getAllProducts(state,products){
        state.products=products;
    },
    addGiohang(state,product){
        // var giohangs = state.giohangs; 
        // if(giohangs.length>0){
        //     var vitri=0;
        //     var check_sp=false;
        //     Object.keys(giohangs).map(function(key) {
        //         if(giohangs[key].idProduct==product.id){
        //             check_sp=true;
        //             vitri=key; 
        //         }
        //      });
        //      if(check_sp){
        //          state.giohangs[vitri]={
        //              idProduct:product.id,
        //              nameProduct:product.name,
        //              price:product.price,
        //              image:product.image,
        //              soluong:parseInt(state.giohangs[vitri].soluong)+parseInt(product.soluong)
                     
        //          }
        //     }
        //     else{
        //         state.giohangs.push({
        //             idProduct:product.id,
        //             nameProduct:product.name,
        //             price:product.price,
        //             image:product.image,
        //             soluong:product.soluong
                   
        //         })
        //     }
        // }
        // else{
        //      state.giohangs.push({
        //          idProduct:product.id,
        //          nameProduct:product.name,
        //          price:product.price,
        //          image:product.image,
        //          soluong:product.soluong
               
        //      });
        //}
        const record = state.giohangs.find(p => p.idProduct === product.id);
        if (!record) {
            state.giohangs.push({
                idProduct:product.id,
                nameProduct:product.name,
                price:product.price,
                image:product.image,
                soluong:product.soluong
            })
          } else {
            record.soluong=parseInt(record.soluong)+parseInt(product.soluong);
          }
        
    
       
    },
    editGiohang(state,giohang){
        var giohangs = state.giohangs;
        var check=false;
        var vitri=0;
        Object.keys(giohangs).map(function(key) {
            if(giohangs[key].idProduct==giohang.idProduct){
                check=true;
                vitri=key; 
            }
            
         });
         if(check){
            state.giohangs[vitri]={
                idProduct:giohang.idProduct,
                nameProduct:giohang.nameProduct,
                price:giohang.price,
                image:giohang.image, 
                soluong:parseInt(giohang.soluong)
                
            }
           
         }  
       
    },
    deleteGiohang(state,giohang){
        var index = state.giohangs.findIndex(giohang => giohang.idProduct === giohang.id);
        state.giohangs.splice(index, 1);
    },
    deleteAllGiohang(state,giohang){
        state.giohangs=giohang;
    },
    addtongtien(state,tongtien){
        state.tongtien=tongtien;
    },
    check_thanhtoan(state,check){
        state.check_thanhtoan=check;
    }
   
   
}