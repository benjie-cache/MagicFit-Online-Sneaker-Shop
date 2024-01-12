<template>
  

   
        <!-- End Header -->

       
           
            <div class="container">
           
                <div class="d-flex justify-content-center">
                    
                             <div class="axil-signin-form">
                                <div class="d-flex mb-5 justify-content-center">
                                    <h3 class="title">Login To MagicFit</h3>
                                    
                                </div>
                               
                                <el-form :model="form" ref="loginForm" :rules="rules" label-width="80px">
                                    <el-form-item prop="email">
                                        <el-input v-model="form.email" placeholder="Enter your email"></el-input>
                                    </el-form-item>
                                    <el-form-item prop="password">
                                        <el-input type="password" v-model="form.password"
                                            placeholder="Enter your password"></el-input>
                                    </el-form-item>
                                    <el-form-item>
                                        <el-button type="primary" @click="login">Sign In</el-button> 
                                    </el-form-item>
                                    <el-form-item>
                                        <el-button type="primary" @click="returnHome">Proceed as guest</el-button>
                                    </el-form-item>
                                       <el-form-item>
                                        <router-link to="forgot-password.html">
                                            <el-link class="forgot-btn">Forgot password?</el-link>
                                            
                                        </router-link>
                                        <router-link to="/register">
                                            <el-link class="forgot-btn m-2">Not a member?Sign Up</el-link>
                                            
                                        </router-link>
                                       </el-form-item>
                                     
                                    
                                </el-form>
                    </div>
            
                </div>
            
        </div>
    
   
</template>
<script setup>
import {useRouter} from 'vue-router';
import { ref,reactive } from 'vue';
import logo from '../../../images/logo/logo1.png';
import { useAuthStore } from '@/store/authStore.js';
import { ElForm, ElFormItem, ElInput, ElButton, ElLink } from 'element-plus';
const router =useRouter()


 const form = reactive({
     email:'',
     password:'',
 });
const rules = ref({
    email: [
        { required: true, message: 'Please enter your email', trigger: 'blur' },
        { type: 'email', message: 'Please enter a valid email address', trigger: ['blur', 'change'] },
    ],
    password: [
        { required: true, message: 'Please enter your password', trigger: 'blur' },
    ],
});
const returnHome=()=>{
    try{
        
        router.push({ name: 'home' });
      }catch(error){
          console.error('redirect failed',error.message)
      }
}
const login = async () => {
    try {
      //  console.log(form.email)
       // console.log(form.password)
   
        await useAuthStore().signIn(form.email,form.password);
        // Redirect to a new route after successful login
      // Access router directly in script setup
      
         
    
      
       
    } catch (error) {
        console.error('Login failed:', error.message);
        // Handle login failure (e.g., show an error message to the user)
    }
};
</script>
