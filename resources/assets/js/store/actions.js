export default {
    getThongtin({commit},thongtin){
        commit('getThongtin',thongtin);
    },
    getAllProducts({commit}, products) {
        commit('getAllProducts', products)
    },
    addGiohang({commit}, product) {
        commit('addGiohang', product)
    },
    editGiohang({commit},giohang){
        commit('editGiohang',giohang)
    },
    deleteGiohang({commit},giohang){
        commit('deleteGiohang',giohang);
    },
    deleteAllGiohang({commit},giohang){
        commit('deleteAllGiohang',giohang);
    },
    addtongtien({commit},tongtien){
        commit('addtongtien',tongtien);
    },
    check_thanhtoan({commit},check){
        commit('check_thanhtoan',check);
    }
}