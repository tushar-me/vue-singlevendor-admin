<template>

</template>

<script>
import axios from "axios";

export default {
    name: "Logout",
    methods:{
        refresh(){
            let _token = localStorage.getItem('_token');
            axios.post('http://localhost:8000/api/auth/refresh?token='+_token)
            .then(res => {
                User.responseAfterLogin(res);
            })
            .catch(e=>{
                Toast.fire({
                    icon:'warning',
                    title:e.response.data.error
                });
                if (e.response.status == 500 ){
                    Toast.fire({
                        icon:'error',
                        title:e.response.statusText
                    });
                }
            });
        }
    },

    created() {
        // this.isLogined();
        if (!User.loggedIn()){
            this.$router.push({name:"Login"})
        }else{
            // this.refresh();
            let _token = localStorage.getItem('_token');
            axios.post('api/auth/logout?token='+_token).then(res =>{
                localStorage.removeItem('_token');
                localStorage.removeItem('_user');
                Toast.fire({
                    icon:'success',
                    title: res.data.message
                })
                this.$router.push({name:'Login'})
                window.reload();
            }).catch(e => {
                Toast.fire({
                    icon:'warning',
                    title: e.response.statusText
                })
            });
        }

    }
}
</script>

<style scoped>

</style>
