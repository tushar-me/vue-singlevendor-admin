import Token from "./Token";
import Appstores from "./Appstores";

class User{
    responseAfterLogin(res){
        Appstores.storeAuthUser(res)
    }

    hasToken(){
        const storageToken = localStorage.getItem('_token');
        if (storageToken){
            return Token.isValidToken(storageToken)
        }
        false
    }

    userInfo(){
        return JSON.parse(JSON.parse(localStorage.getItem('_user')));
    }
    loggedIn(){
        return  JSON.parse(localStorage.getItem('_user')) ? true : false;
    }

    logout(){
        Appstores.clearAuth();
    }

    name(){
        if (this.loggedIn()){
            return localStorage.getItem('_user')
        }
    }
    userId(){
        if (this.loggedIn()){
            const payload = Token.payload(localStorage.getItem('_token'));
            return payload.sub;
        }
        return  false
    }
    authToken(){
        if (this.loggedIn()){
            return localStorage.getItem('_token')
        }
    }


}

export default User = new User();
