<template lang="">
  
  <main class="main-wrapper" >
        <!-- Start Breadcrumb Area  -->
        <div class="axil-breadcrumb-area">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-8">
                        <div class="inner">
                            <ul class="axil-breadcrumb">
                                <li class="axil-breadcrumb-item"><a href="index-2.html">Home</a></li>
                                <li class="separator"></li>
                                <li class="axil-breadcrumb-item active" aria-current="page">Shop Now</li>
                            </ul>
                            <h4 class="title">Doors To A World Of Drip</h4>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-4">
                        <div class="inner">
                            <div class="bradcrumb-thumb">
                                <img :src="bannerImg" alt="Image">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Breadcrumb Area  -->

        <!-- Start Shop Area  -->
        <div class="axil-shop-area axil-section-gap bg-color-white">
            <div class="container">
                <div class="row">
                  <SideBarFilter/>
                  <ProductList/>

                </div>
            </div>
            <!-- End .container -->
        </div>
        <!-- End Shop Area  -->

    
    </main>



    <!-- <div class="cart-dropdown" id="cart-dropdown">
        <CartReview/>
    </div> -->

   

</template>
<script setup>
import { defineAsyncComponent } from 'vue';
const ProductList = defineAsyncComponent(()=>import('@/components/ProductList.vue'));
const SideBarFilter = defineAsyncComponent(()=>import('@/components/SideBarFilter.vue'));

import bannerImg from '../../images/others/Nike G.T jump2.png'

</script>