<script setup>
import {onMounted} from 'vue';
import 'slick-carousel';
import $ from 'jquery/dist/jquery.min.js';
const props = defineProps({
    selected_product: Object,
});
onMounted(() => {
  try {
    console.log('Trying to initialize Slick Carousel...');
    
    const smallThumb = $(`.product-small-thumb-${selected_product.id}`);
    const largeThumb = $(`.product-large-thumbnail-${selected_product.id}`);


    if (smallThumb.length && largeThumb.length) {
      console.log('Both smallThumb and largeThumb elements found.');

      if (!smallThumb.hasClass('slick-initialized')) {
        console.log('Initializing Slick Carousel for smallThumb...');
        smallThumb.slick({
          infinite: false,
          slidesToShow: 6,
          slidesToScroll: 1,
          arrows: false,
          dots: false,
          focusOnSelect: true,
          vertical: true,
          speed: 800,
          asNavFor: '.product-large-thumbnail-{{ selected_product.id }}',
          responsive: [
            {
              breakpoint: 992,
              settings: {
                vertical: false,
              },
            },
            {
              breakpoint: 768,
              settings: {
                vertical: false,
                slidesToShow: 4,
              },
            },
          ],
        });
      } else {
        console.log('smallThumb is already initialized with Slick Carousel.');
      }

      if (!largeThumb.hasClass('slick-initialized')) {
        console.log('Initializing Slick Carousel for largeThumb...');
        largeThumb.slick({
          infinite: false,
          slidesToShow: 1,
          slidesToScroll: 1,
          arrows: false,
          dots: false,
          speed: 800,
          draggable: false,
          asNavFor: '.product-small-thumb-${selected_product.id}',
        });
      } else {
        console.log('largeThumb is already initialized with Slick Carousel.');
      }
    } else {
      console.error('Either smallThumb or largeThumb element not found.');
    }
  } catch (error) {
    console.error('Error during Slick Carousel initialization:', error.message);
  }
});




</script>

<template lang="" >
 <div class="single-product-thumb">
                        <div class="row">
                            <div class="col-lg-7 mb--40">
                                <div class="row">
                                    <div class="col-lg-10 order-lg-2">
                                        <div class="single-product-thumbnail product-large-thumbnail-{{ selected_product.id }} axil-product thumbnail-badge zoom-gallery">
                                            <div class="thumbnail">
                                                <img :src="'/storage' + selected_product.images[0].url" alt="Product Images">
                                                <div class="label-block label-right">
                                                    <div class="product-badget">20% OFF</div>
                                                </div>
                                                <div class="product-quick-view position-view">
                                                    <a :href="'/storage' + selected_product.images[0].url" class="popup-zoom">
                                                        <i class="fa fa-search-plus"></i>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="thumbnail">
                                                <img :src="'/storage' + selected_product.images[1].url" alt="Product Images">
                                                <div class="label-block label-right">
                                                    <div class="product-badget">20% OFF</div>
                                                </div>
                                                <div class="product-quick-view position-view">
                                                    <a :href="'/storage' + selected_product.images[1].url" class="popup-zoom">
                                                        <i class="far fa-search-plus"></i>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="thumbnail">
                                                <img :src="'/storage' + selected_product.images[2].url" alt="Product Images">
                                                <div class="label-block label-right">
                                                    <div class="product-badget">20% OFF</div>
                                                </div>
                                                <div class="product-quick-view position-view">
                                                    <a :href="'/storage' + selected_product.images[2].url" class="popup-zoom">
                                                        <i class="fa fa-search-plus"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 order-lg-1">
                                        <div class="product-small-thumb-${selected_product.id} small-thumb-wrapper">
                                            <div class="small-thumb-img">
                                                <img :src="'/storage' + selected_product.images[0].url" alt="thumb image">
                                            </div>
                                            <div class="small-thumb-img">
                                                <img :src="'/storage' + selected_product.images[1].url" alt="thumb image">
                                            </div>
                                            <div class="small-thumb-img">
                                                <img :src="'/storage' + selected_product.images[2].url" alt="thumb image">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-5 mb--40">
                                <div class="single-product-content">
                                    <div class="inner">
                                        <div class="product-rating">
                                            <div class="star-rating">
                                                <img src="assets/images/icons/rate.png" alt="Rate Images">
                                            </div>
                                            <div class="review-link">
                                                <a href="#">(<span>1</span> customer reviews)</a>
                                            </div>
                                        </div>
                                        <h3 class="product-title">{{selected_product.name}}</h3>
                                        <span class="price-amount">ksh {{selected_product.price}}</span>
                                        <ul class="product-meta">
                                            <li><i class="fa fa-check"></i>In stock</li>
                                            <li><i class="fa fa-check"></i>Free delivery available</li>
                                      
                                        </ul>
                                        <p class="description">{{selected_product.description}}</p>

                                        <div class="product-variations-wrapper">

                                            <!-- Start Product Variation  -->
                                            <div class="product-variation">
                                                <h6 class="title">Colors:</h6>
                                                <div class="color-variant-wrapper">
                                                    <ul class="color-variant mt--0">
                                                        <li class="color-extra-01 active"><span><span class="color"></span></span>
                                                        </li>
                                                        <li class="color-extra-02"><span><span class="color"></span></span>
                                                        </li>
                                                        <li class="color-extra-03"><span><span class="color"></span></span>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <!-- End Product Variation  -->

                                            <!-- Start Product Variation  -->
                                            <div class="product-variation">
                                                <h6 class="title">Size:</h6>
                                                <ul class="range-variant">
                                                    <li>xs</li>
                                                    <li>s</li>
                                                    <li>m</li>
                                                    <li>l</li>
                                                    <li>xl</li>
                                                </ul>
                                            </div>
                                            <!-- End Product Variation  -->

                                        </div>

                                        <!-- Start Product Action Wrapper  -->
                                        <div class="product-action-wrapper d-flex-center">
                                            <!-- Start Quentity Action  -->
                                            <div class="pro-qty"><input type="text" value="1"></div>
                                            <!-- End Quentity Action  -->

                                            <!-- Start Product Action  -->
                                            <ul class="product-action d-flex-center mb--0">
                                                <li class="add-to-cart"><a href="cart.html" class="axil-btn btn-bg-primary">Add to Cart</a></li>
                                                <li class="wishlist"><a href="wishlist.html" class="axil-btn wishlist-btn"><i class="far fa-heart"></i></a></li>
                                            </ul>
                                            <!-- End Product Action  -->

                                        </div>
                                        <!-- End Product Action Wrapper  -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> 
   
</template>
<style scoped>
@import "slick-carousel/slick/slick.css";
@import "slick-carousel/slick/slick-theme.css";
</style>