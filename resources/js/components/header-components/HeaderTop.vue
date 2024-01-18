<script setup>
import {useAuthStore} from '@/store/authStore.js';

const authStore=useAuthStore();
</script>
<template lang="">
    <div>
        <div class="axil-header-top">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-sm-6 col-12">
                       
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="header-top-link">
                            <ul class="quick-link" v-if="!authStore.user">
                                <li>  <router-link to="/contact-us" ><a>magicfit.wendani@gamil.com</a></router-link></li>
                                <li><router-link to="/register"><a >Create an Account ! </a></router-link></li>
                                <li><router-link to="/login"><a>Return Customer? Login</a></router-link></li>
                            </ul>
                            <ul class="quick-link" v-else>
                                <li> <router-link to="/contact-us" ><a >magicfit.wendani@gmail.com</a></router-link></li>
                                <li><p class="fw-bold text-white text-capitalize">Welcome {{authStore.user.first_name}}</p> </li>
                                <li><router-link to="/account"><a>Your Orders & Details</a></router-link></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

