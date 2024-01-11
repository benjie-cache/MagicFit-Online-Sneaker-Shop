<template>
    <div class="axil-signin-area">

        <!-- Start Header -->
        <div class="signin-header">
            <div class="row align-items-center">
                <div class="col-sm-4 " >
                    <a class="site-logo"><img :src="logo" alt="logo"></a>
                </div>
                <div class="col-sm-8">
                    <div class="singin-header-btn">
                        <p>Not a member?</p>
                        <router-link to="/register"> <a class="axil-btn btn-bg-secondary sign-up-btn">Sign Up
                                Now</a></router-link>

                    </div>
                </div>
            </div>
        </div>
        <!-- End Header -->

        <div class="row">
            <div class="col-xl-4 col-lg-6">
                <div class="axil-signin-banner bg_image bg_image--9 ">
                    <h3 class="title">Lets take care of your feet...</h3>
                </div>
            </div>
            <div class="col-lg-6 offset-xl-2">
                <div class="axil-signin-form-wrap">
                    <div class="axil-signin-form">
                        <h3 class="title">Sign in to MagicFit.</h3>
                        <p class="b2 mb--55">Enter your details below</p>
                        <el-form :model="form" ref="loginForm" :rules="rules" label-width="80px">
                            <el-form-item prop="email">
                                <el-input v-model="email" placeholder="Enter your email"></el-input>
                            </el-form-item>
                            <el-form-item prop="password">
                                <el-input type="password" v-model="password"
                                    placeholder="Enter your password"></el-input>
                            </el-form-item>
                            <el-form-item>
                                <el-button type="primary" @click="login">Sign In</el-button>
                                <router-link to="forgot-password.html">
                                    <el-link class="forgot-btn">Forgot password?</el-link>
                                </router-link>
                            </el-form-item>
                        </el-form>
                    </div>
                </div>
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

const email=ref('');
const password=ref('');
 const form = reactive({
     email: email.value,
     password: password.value,
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

const login = async () => {
    try {
   
        await useAuthStore().signIn(email.value,password.value);
        // Redirect to a new route after successful login
      // Access router directly in script setup
      try{
        
        router.push({ name: 'home' });
      }catch(error){
          console.error('redirect failed',error.message)
      }
         
    
      
       
    } catch (error) {
        console.error('Login failed:', error.message);
        // Handle login failure (e.g., show an error message to the user)
    }
};
</script>
