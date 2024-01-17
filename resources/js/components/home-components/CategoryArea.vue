<template lang="">
    <!-- Start Categorie Area  -->
    <div class="axil-categorie-area pt--5 bg-color-white">
           <div class="container">
               <div class="categrie-product-activation-2 categorie-product-two slick-layout-wrapper--15">
                   <div class="slick-single-layout slick-slide" v-for="(index,item) in popularShoeBrands" :key="index">
                       <div class="categrie-product-2">
                           <router-link to="/shop">  <a >
                               <img class="img-fluid" :src="favicon" alt="product categorie">
                               <h6 class="cat-title">{{index}}</h6>
                           </a></router-link>
                         
                       </div>
                       <!-- End .categrie-product -->
                   </div>
               
               </div>
           </div>
       </div>
       <!-- End Categorie Area  -->
</template>
<script setup>
import {onMounted} from 'vue';
import favicon from '../../../images/others/Nike G.T black.png';
const popularShoeBrands=['Jordans','Airforce','Slides','Dunks','AirMax','Lebrons','Gym','Training','Running','Nike Sb','Golf']
onMounted(() => {
    $(document).ready(() => {
   $('.categrie-product-activation-2').slick({
              infinite: true,
              slidesToShow: 7,
              slidesToScroll: 7,
              arrows: true,
              dots: false,
              autoplay: true,
              speed: 1000,
               prevArrow: '<button class="slide-arrow prev-arrow"><i class="fa fa-arrow-left"></i></button>',
              nextArrow: '<button class="slide-arrow next-arrow"><i class="fa fa-arrow-right"></i></button>',
              responsive: [
                  {
                      breakpoint: 1399,
                      settings: {
                          slidesToShow: 6,
                          slidesToScroll: 6
                      }
                  },
                  {
                      breakpoint: 1199,
                      settings: {
                          slidesToShow: 5,
                          slidesToScroll: 5
                      }
                  },
                  {
                      breakpoint: 991,
                      settings: {
                          slidesToShow: 3,
                          slidesToScroll: 3
                      }
                  },
                  {
                      breakpoint: 767,
                      settings: {
                          slidesToShow: 2,
                          slidesToScroll: 2
                      }
                  },
                  {
                      breakpoint: 479,
                      settings: {
                          slidesToShow: 1,
                          slidesToScroll: 1
                      }
                  }
              ]
          });
        })

})
</script>
