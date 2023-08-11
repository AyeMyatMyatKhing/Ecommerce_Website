import {createStore} from 'vuex'
import axios from '../axios';

const store = createStore({
    state: {
        user: {
            token: sessionStorage.getItem('Token'),
            data: {}
        },
        product: {
            data: {}
        }
    },
    mutations: {
        setUser(state , user) {
            state.user.data = user
        },
        setToken(state , data) {
            state.user.token = data
            console.log('token',data)
            if (data) {
                sessionStorage.setItem('Token' , data)
            } else {
                sessionStorage.removeItem('Token')
            }
        },
        setProduct(state , data) {
            state.product.data = data
        }
    },
    actions: {
        async login({commit} ,payload) {
            await axios.post('/login' , payload).then(response => {
                commit('setUser' , response.data.user)
                commit('setToken' , response.data.token)
            })
        },
        async logout({commit}){
            await axios.post('/logout' ,{} ,{headers: {
                'Authorization' : `Bearer ${this.state.user.token}`
            }}).then((response)=>{
                commit('setToken' , null)
            })
        },
        async getProduct({commit}){
            await axios.get('/products' , { headers: {
                'Authorization' : `Bearer ${this.state.user.token}`
            }}).then((res) => {
                commit('setProduct' , res.data.data)
            })
        },
        async createProduct({commit} , payload) {
            await axios.post('/product/store' , payload , { headers : {
                'Authorization' : `Bearer ${this.state.user.token}`
            }}).then((res) => {
                console.log(res.data.data)
                commit('setProduct' , res.data.data)
            })
        }
    },
    getters: {},
})

export default store;