<template>
     <div class="container">
           
           <div class="d-flex justify-content-center">
               
                       <div class="axil-signin-form">
                           <div class="d-flex mb-5 justify-content-center">
                               <h3 class="title">Signup To <span>   <img :src="logo" alt=" Logo"></span></h3>
                               
                           </div>
                          
                           <el-form :model="form" ref="registerForm" :rules="rules" label-width="80px" show-message :label-position="labelPosition">
                            <el-form-item prop="first_name" label="First Name">
                                   <el-input v-model="form.first_name" placeholder="Enter your first name"></el-input>
                               </el-form-item>
                            <el-form-item prop="email" label="Email">
                                   <el-input v-model="form.email" placeholder="Enter your email"></el-input>
                               </el-form-item>
                               <el-form-item prop="password" label="Password">
                                   <el-input type="password" v-model="form.password"
                                       placeholder="Enter your password"></el-input>
                               </el-form-item>
                               <el-form-item>
                                   <el-button type="primary" @click="register">Sign Up</el-button> 
                               </el-form-item>
                               <el-form-item>
                                   <el-button type="primary" @click="returnHome">Proceed as guest</el-button>
                               </el-form-item>
                                  <el-form-item>
                                   <router-link to="forgot-password">
                                       <el-link class="forgot-btn">Forgot password?</el-link>
                                       
                                   </router-link>
                                   <router-link to="/login">
                                       <el-link class="forgot-btn m-2">Already a member?Login</el-link>
                                       
                                   </router-link>
                                  </el-form-item>
                                
                               
                           </el-form>
                       </div>
       
           </div>
       
   </div>

</template>

<script setup>
import { useAuthStore } from "@/store/authStore.js";
import { ref ,reactive} from "vue";
import logo from '../../../images/logo/logo1.png';
import { useRouter } from "vue-router";
import { ElForm, ElFormItem, ElInput, ElButton, ElLink } from 'element-plus';
const router = useRouter();
const authStore=useAuthStore();
const labelPosition =ref('top');
const form = reactive({
    first_name:'',
     email:'',
     password:'',
 });


 const returnHome=()=>{
    try{
        
        router.push({ name: 'home' });
      }catch(error){
          console.error('redirect failed',error.message)
      }
}
const rules = ref({
    first_name: [
        { required: true, message: 'Please enter your first name', trigger: 'blur' },
    ],
    email: [
        { required: true, message: 'Please enter your email', trigger: 'blur' },
        { type: 'email', message: 'Please enter a valid email address', trigger: ['blur', 'change'] },
    ],
    password: [
        { required: true, message: 'Please enter your password', trigger: 'blur' },
    ],
});


const register = async () => {
    try {
        await authStore.signUp(
            form.first_name,
            form.email,
            form.password
        );
     
        
    } catch (error) {
        console.error("Registration failed:", error.message);
   
    }
};
</script>
