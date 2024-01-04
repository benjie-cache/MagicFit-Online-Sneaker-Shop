<script setup>
import {onMounted,reactive } from 'vue';
import prodImgUrl from '../../../images/others/Nike G.T jump2.webp';
import prodImgUrl2 from '../../../images/others/Nike G.T red.png';
import prodImgUrl3 from '../../../images/others/Nike G.T black.png';
const featured_images=reactive(
{'white':prodImgUrl,
'black':prodImgUrl2,
'red':prodImgUrl3})

onMounted(()=>{
   
    $('.slider-activation-two').slick({
                infinite: true,
                autoplay: false,
                slidesToShow: 1,
                slidesToScroll: 1,
                arrows: false,
                dots: true,
                fade: true,
                adaptiveHeight: true,
                cssEase: 'linear',
                speed: 400
            });
});
</script>
<template lang="">
      <!-- Start Slider Area -->
      <div class="axil-main-slider-area main-slider-style-5">
            <div class="container">
                <div class="slider-box-wrap">
                    <div class="slider-activation-two axil-slick-dots">
                        <div class="single-slide slick-slide" v-for="(value, key, index) in featured_images" :key="index">
                            <div class="main-slider-content">
                                <span class="subtitle"><i class="fas fa-fire"></i> Hot Deal In This Week</span>
                                <h1 class="title">Nike G.T Jump2 Sneakers</h1>
                                <div class="shop-btn">
                                   <router-link  to="/shop"><a  class="axil-btn btn-bg-white"><i class="flaticon-shopping-cart"></i> Shop Now</a></router-link> 
                                </div>
                            </div>
                            <div class="main-slider-thumb">
                                <img :src="value" alt="Product">
                            </div>
                        </div>
                      
                    </div>
                </div>
            </div>
        </div>
    
</template>
