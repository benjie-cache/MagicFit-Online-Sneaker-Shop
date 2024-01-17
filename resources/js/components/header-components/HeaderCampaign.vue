<template lang="">
    <div class="header-top-campaign">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-5 col-lg-6 col-md-10">
                        <el-carousel indicator-position="none" height="30px" class="header-campaign-activation axil-slick-arrow arrow-both-side header-campaign-arrow">
                        <el-carousel-item v-for="item in 2" :key="item" class="slick-slide">
                            <div class="campaign-content">
                                    <p>HAPPY NEW YEAR 10% OFF!! : <a href="#">GET OFFER</a></p>
                                </div>
                        </el-carousel-item>
                        </el-carousel>
                      
                    </div>
                </div>
            </div>
        </div>
</template>
<script setup>
import {onMounted } from 'vue';
onMounted(()=>{
    $(document).ready(() => {
    $('.header-campaign-activation').slick({
                infinite: true,
                slidesToShow: 1,
                slidesToScroll: 1,
                arrows: true,
                dots: false,
                autoplay: true,
                prevArrow: '<button class="slide-arrow prev-arrow"><i class="fa fa-long-arrow-left"></i></button>',
                nextArrow: '<button class="slide-arrow next-arrow"><i class="fa fa-long-arrow-right"></i></button>'
            });
        })
});
</script>
