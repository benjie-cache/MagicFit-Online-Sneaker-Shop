<template>
    <div class="axil-signin-area">
      <!-- ... (Header and other HTML) ... -->
  
      <div class="row">
        <div class="col-xl-4 col-lg-6">
          <!-- ... (Banner) ... -->
        </div>
        <div class="col-lg-6 offset-xl-2">
          <div class="axil-signin-form-wrap">
            <div class="axil-signin-form">
              <h3 class="title">I'm New Here</h3>
              <p class="b2 mb--55">Enter your details below</p>
              <form class="singin-form" @submit.prevent="register">
                <div class="form-group">
                  <label>User Name</label>
                  <input v-model="userName" type="text" class="form-control" name="first_name" />
                </div>
                <div class="form-group">
                  <label>Email</label>
                  <input v-model="email" type="email" class="form-control" name="email" />
                </div>
                <div class="form-group">
                  <label>Password</label>
                  <input v-model="password" type="password" class="form-control" name="password" />
                </div>
                <div class="form-group">
                  <button type="submit" class="axil-btn btn-bg-primary submit-btn">Create Account</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script setup>
  import { useAuthStore } from '@/store/authStore.js';
  import { ref } from 'vue';
  import {useRouter} from 'vue-router'
  const userName = ref('');
  const email = ref('');
  const password = ref('');
  
  const register = async () => {
    try {
      await useAuthStore().signUp(userName.value, email.value, password.value);
      // Redirect to a new route after successful registration
      // For example, you can redirect to the login page
      const router = useRouter();
      router.push({ name: 'home' });
    } catch (error) {
      console.error('Registration failed:', error.message);
      // Handle registration failure (e.g., show an error message to the user)
    }
  };
  </script>
  