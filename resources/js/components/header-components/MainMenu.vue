<script setup>
import logo from '../../../images/logo/logo1.png';


import { defineAsyncComponent} from 'vue'
import useCartStore from '@/store/cartStore.js';


import useDropdownStore from '@/store/dropdownStore.js';
import {useAuthStore} from '@/store/authStore.js';
import {useWishlistStore} from '@/store/wishlistStore.js';
const CartReview = defineAsyncComponent(()=>import('@/components/cart-components/CartReview.vue'));
const HeaderSearch = defineAsyncComponent(()=>import('@/components/header-components/HeaderSearch.vue'));
const cartStore = useCartStore();
//initialize authstore
const authStore=useAuthStore();
const dropDownStore = useDropdownStore();
const handleLogOut=async()=>{

    const res= await authStore.logOut()
};
const wishlistStore=useWishlistStore();
</script>

<template lang="">

    <div class="axil-mainmenu">
            <div class="container">
                <div class="header-navbar">
                    <div class="header-brand">
                        <router-link to='/'><a  class="logo logo-dark">
                            <img  :src="logo" alt="Site Logo">
                        </a></router-link>
                        <router-link to='/'><a class="logo logo-light">
                            <img  :src="logo" alt="Site Logo">
                        </a></router-link>
                    </div>
                    <div class="header-main-nav">
                        <!-- Start Mainmanu Nav -->
                        <nav class="mainmenu-nav">
                            <button class="mobile-close-btn mobile-nav-toggler"><i class="fas fa-times"></i></button>
                            <div class="mobile-nav-brand">
                                <a href="index-2.html" class="logo">
                                    <img :src="logo" alt="Site Logo">
                                </a>
                            </div>
                            <ul class="mainmenu">
                                
                             
                                <li><router-link to="/"><a >Featured & Deals</a></router-link></li>
                                <li><router-link to="/shop" ><a >Shop Now</a></router-link></li>
                           
                                <li><router-link to="/contact-us" ><a >Talk To Us</a></router-link></li>
                            </ul>
                        </nav>
                        <!-- End Mainmanu Nav -->
                    </div>
                    <div class="header-action">
                        <ul class="action-list">
                            <li class="axil-search d-xl-block d-none">
                                <input type="search" class="placeholder product-search-input"  @click="dropDownStore.toggleHeaderSearchDropdown" name="search2" id="search2" value="" maxlength="128" placeholder="What are you looking for?" autocomplete="off">
                                <button type="submit" class="icon wooc-btn-search">
                                    <i class="flaticon-magnifying-glass"></i>
                                </button>
                            </li>
                            <li class="axil-search d-xl-none d-block">
                                <a href="javascript:void(0)" class="header-search-icon" title="Search">
                                    <i class="flaticon-magnifying-glass"></i>
                                </a>
                            </li>
                           
                            <li class="shopping-cart">
                                 <router-link to="/wishlist" class="cart-dropdown-btn">
                                    
                                    <span class="wishlist-count" v-if="wishlistStore.wishlistItems.length">{{wishlistStore.totalItems}}</span>
                                    <i class="flaticon-heart"></i>

                                </router-link>
                            </li>
                          
                            <li class="shopping-cart">
                                <a  class="cart-dropdown-btn"  @click="dropDownStore.toggleDropdown"  >
                                    <span class="cart-count">{{cartStore.totalItems}}</span>
                                    <i class="flaticon-shopping-cart"></i>
                                </a>
                            </li>
                            <li class="my-account">
                                <a @click="dropDownStore.toggleAccountDropdown()" :class={open:dropDownStore.isAccountDropdownopen}>
                                    <i class="flaticon-person"></i>
                                </a>
                                <div v-if="dropDownStore.isAccountDropdownopen" :class="['my-account-dropdown' , dropDownStore.isAccountDropdownopen ? 'open':'' ]" >
                                    <span class="title">QUICKLINKS</span>
                                    <ul>
                                        <li >
                                           <router-link to="/account"> <a >My Account</a></router-link>
                                        </li>
                                        <li v-if="authStore.user">
                                         <a @click="handleLogOut" >Logout</a>
                                        </li>
                                    </ul>
                                  <router-link to="/login" v-if="!authStore.user"> <router-link to="/login"></router-link><a  class="axil-btn btn-bg-primary">Login</a></router-link>
                                    <div class="reg-footer text-center" v-if="!authStore.user" >No account yet? <router-link to="/register"><a  class="btn-link">REGISTER HERE.</a></router-link></div>
                                </div>
                            </li>
                            <li class="axil-mobile-toggle">
                                <button class="menu-btn mobile-nav-toggler">
                                    <i class="flaticon-menu-2"></i>
                                </button>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
      
      <!--This is the header searcch component-->
<Teleport to="body">
  <div  :class="['' ,dropDownStore.isOpen || dropDownStore.isHeaderSearchOpen ? 'closeMask':'']" >
  
  </div>
</Teleport>  
<div v-if="dropDownStore.isHeaderSearchOpen" :class="['header-search-modal' ,dropDownStore.isHeaderSearchOpen? 'open':'' ]" id="header-search-modal">
    <HeaderSearch/>
</div>     
   <!--This is the cart review searcch component-->    
<div v-if="dropDownStore.isOpen"  id="cart-dropdown"  :class="['cart-dropdown' ,dropDownStore.isOpen? 'open':'' ]">
<CartReview/>
</div>
        
   

</template>
