<script setup>
import logo from '../../../images/logo/logo1.png';
import prodImgUrl from '../../../images/others/luka 2 caves.webp';
import favicon from '../../../images/others/Nike G.T black.png';
import { ref, watch } from 'vue'
import useCartStore from '@/store/cartStore.js';


import useDropdownStore from '@/store/dropdownStore.js';
import {useAuthStore} from '@/store/authStore.js';
const cartStore = useCartStore();
//initialize authstore
const authStore=useAuthStore();
const dropDownStore = useDropdownStore();
const handleLogOut=async()=>{

    const res= await authStore.logOut()
};
</script>

<template lang="">

    <div class="axil-mainmenu">
            <div class="container">
                <div class="header-navbar">
                    <div class="header-brand">
                        <router-link to='/'><a href="index-2.html" class="logo logo-dark">
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
                           
                                <li><a href="">Talk To Us</a></li>
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
                                <div :class="['my-account-dropdown' , dropDownStore.isAccountDropdownopen ? 'open':'' ]" >
                                    <span class="title">QUICKLINKS</span>
                                    <ul>
                                        <li >
                                           <router-link to="/account"> <a >My Account</a></router-link>
                                        </li>
                                        <li >
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
      
      
   
<div  :class="['header-search-modal' ,dropDownStore.isHeaderSearchOpen? 'open':'' ]" id="header-search-modal">
        <button class="card-close sidebar-close"  @click="dropDownStore.toggleHeaderSearchDropdown"><i class="fas fa-times"></i></button>
        <div class="header-search-wrap">
            <div class="card-header">
                <form action="#">
                    <div class="input-group">
                        <input type="search" class="form-control" name="prod-search" id="prod-search" placeholder="Write Something....">
                        <button type="submit" class="axil-btn btn-bg-primary"><i class="flaticon-magnifying-glass"></i></button>
                    </div>
                </form>
            </div>
            <div class="card-body">
                <div class="search-result-header">
                    <h6 class="title">1 Result Found</h6>
                    <a href="shop.html" class="view-all">View All</a>
                </div>
                <div class="psearch-results">
                    <div class="axil-product-list">
                        <div class="thumbnail">
                            <a href="single-product.html">
                                <img :src="prodImgUrl" alt="Luka Caves sneakers" class="search-image">
                            </a>
                        </div>
                        <div class="product-content">
                          
                            <h6 class="product-title"><a href="single-product.html">Luka 2 caves</a></h6>
                            <div class="product-price-variant">
                                <span class="price current-price">KSH 4500</span>
                                <span class="price old-price">KSH 5000</span>
                            </div>
                            <div class="product-cart">
                                <a href="cart.html" class="cart-btn"><i class="fa fa-shopping-cart"></i></a>
                                <a href="wishlist.html" class="cart-btn"><i class="fa fa-heart"></i></a>
                            </div>
                        </div>
                    </div>
                   
                </div>
            </div>
        </div>
    </div>     
       
<div  id="cart-dropdown"  :class="['cart-dropdown' ,dropDownStore.isOpen? 'open':'' ]">
       
        <div class="cart-content-wrap">
            <div class="cart-header">
                <h2 class="header-title">Cart review</h2>
                <button class="cart-close sidebar-close" @click="dropDownStore.toggleDropdown">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="cart-body">
                <ul class="cart-item-list">
                    <li
                        class="cart-item"
                        v-if="cartStore.items.length"
                        v-for="(item, index) in cartStore.items"
                        :key="index"
                    >
                        <div class="item-img">
                            <a href=""
                                > <img v-if="item.images && item.images.length > 1 && item.images[1]" :src="'/storage' + item.images[1].url" alt="Image"></a>
                            <button
                                class="close-btn"
                             
                                @click="cartStore.decreaseItem(item,'all')">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                        <div class="item-content">
                            
                            <h3 class="item-title">
                                <a href="">{{
                                    item.name
                                }}</a>
                            </h3>
                            <div class="item-price">
                                <span class="currency-symbol">KSH  </span
                                >   {{ item.price }}
                            </div>
                            <div class="pro-qty item-quantity"><span class="dec qtybtn"    @click="cartStore.decreaseItem(item)">-</span>
                                <input type="number" class="quantity-input"     @input="handleQuantityInput(item)"    v-model="item.count">
                            <span class="inc qtybtn" @click="cartStore.increaseItem(item)">+</span></div>
                            
                        </div>
                    </li>
                    <h6 v-else>You havent added any items in your cart yet</h6>
                </ul>
            </div>
            <div class="cart-footer"  v-if="cartStore.items.length > 0 && !showAlert">
                <h3 class="cart-subtotal">
                    <span class="subtotal-title">Subtotal:</span>
                    <span class="subtotal-amount">{{ parseFloat(cartStore.totalCost).toFixed(2)}}</span>
                </h3>
                <div class="group-btn" >
                     <router-link to="/cart">
                        <a @click="dropDownStore.toggleDropdown" class="axil-btn btn-bg-primary viewcart-btn"
                            >View Cart</a
                        ></router-link
                    > 
         <router-link to="/checkout"> <a  @click="dropDownStore.toggleDropdown"
                       
                       class="axil-btn btn-bg-secondary checkout-btn"
                       >Checkout</a
                   ></router-link>
                   
                </div>
            </div>
        </div>
    </div>
        
   

</template>

<style scoped>
.search-image {
    width: 50px;
    height: 50px;
}

.cart-dropdown.open {
    right: 0
}
</style>