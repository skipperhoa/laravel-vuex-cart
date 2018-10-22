import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);
import getters from './store/getters';
import mutations from './store/mutations';
import actions from './store/actions';

export default new Vuex.Store({
    state:{
        InfoUser:[],
        products:[],
        giohangs:[],
        tongtien:0,
        check_thanhtoan:false
    },
    getters,
    mutations,
    actions
})