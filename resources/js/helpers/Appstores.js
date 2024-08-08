class Appstores {
    storeAuthToken(token){
        localStorage.setItem('_token', token);
    }
    storeAuthUser(user){
        localStorage.setItem('_user', JSON.stringify(user));
    }
    storeAuth(token,user){
        this.storeAuthToken(token);
        this.storeAuthUser(user);
    }
    getAuthToken(){
        localStorage.getItem('_token')
    }
    getAuthUser(){
        localStorage.getItem('_user')
    }
    clearAuth(){
        localStorage.removeItem('_token');
        localStorage.removeItem('_user');
    }


}

export default Appstores = new Appstores();
