//auth.js
import axios from 'axios';
import {useRouter } from 'vue-router'
export const getToken = () => {
  return localStorage.getItem('token');
};

export const getHeadersWithoutToken = () => {
  return {
    "Content-Type": "application/json"
  };
};

export const getHeaders = () => {
  return {
    "Content-Type": "application/json",
    "Authorization": `Bearer ${getToken()}`
  };
};
export const setUserToken = (user, token) => {
  try { 


    localStorage.setItem("user", JSON.stringify(user));
    localStorage.setItem("token", token);
    return "User and token set";
  }catch(error){
    console.error("There was an error setting user token",error)
    throw error; 
  }
 
 
};

export const clearUserToken=(user_key,token_key)=>{
  try{
    localStorage.removeItem(user_key)
    localStorage.removeItem(token_key)
    return "user and token removed"
  }catch(error){
    console.error('There was an error clearing user token',error)
    throw error;
  }
          
}
export const signUp = async (name, email, password) => {
  const SIGNUP_URL = 'api/v1/register';
  const user_info = {
    'name': name,
    'email': email,
    'password': password
  };
  try{
     const res = await axios.post(SIGNUP_URL, user_info, getHeadersWithoutToken());
  }catch(error){
       console.error('There was error signing up',error.message)
  }
  
  setUserToken(res.data.data.user, res.data.data.token)
  return res.data.data.user;
};

export const signIn = async (email, password) => {
  const SIGNIN_URL = 'api/v1/login';
  const credentials = {
    email: email,
    password: password
  };
  try {

    const res = await axios.post(SIGNIN_URL, credentials, getHeadersWithoutToken());
  
    setUserToken(res.data.data.user, res.data.data.token)
    
  
   
   
    return res.data.data.user;
  }catch (error) {
    console.error('There was an error signing in:', error.message);
    if (error.response && error.response.data) {
      console.error('Error details:', error.response.data);
    }
    throw error;
  }
};
export const logOut=async()=>{
   const LOGOUT_URL='api/v1/logout'
   try{
    const headers=getHeaders()
   
    const res= await axios.post(LOGOUT_URL,null,{headers})
    
    clearUserToken('user','token')
    const router =useRouter()
    router.push({ name: 'login' });
  
    
   
   // return res.data
   }catch(error){
      console.error("There was an error logging out ",error)
      throw error;
   }
}
