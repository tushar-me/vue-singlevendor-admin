class Token{
    isValidToken(token){
        const payload = this.payload(token);
        if (payload){
            return payload.iss = "http://localhost:8000/api/auth/login" || "http://localhost:8000/api/auth/register" ? true : false;
        }
        return false;
    }
    payload(token){
        const payloadSplit = token.split(".")[1];
        return this.decode(payloadSplit);
    }

    decode(payloadSplit){
        return JSON.parse(atob(payloadSplit));
    }

}
export default Token = new Token();
