<script setup>
import {useWishlistStore} from '@/store/wishlistStore.js';

import useCartStore from '@/store/cartStore.js';

const cartStore=useCartStore();

const wishlistStore=useWishlistStore()
const props = defineProps({
    selected_product: Object,
});
const handleThumbnailChange=(index)=> {
      // Handle the change of active thumbnail index
      // Set the active index of the large carousel
      this.$refs.largeCarousel.setActiveItem(index);
    };





</script>

<template lang="" >
 <div class="single-product-thumb">
                        <div class="row">
                            <div class="col-lg-7 mb--40">
                                <div class="row">
                                    <div class="col-lg-12 order-lg-2">
                                        <div class="single-product-thumbnail product-large-thumbnail-{{ props.selected_product.id }} axil-product thumbnail-badge zoom-gallery">
                                            <el-carousel :interval="4000" type="card" height="700px" @change="handleLargeImageChange">
      <el-carousel-item v-for="(image, index) in selected_product.images" :key="index">
        <img :src="'/storage' + image.url" alt="Product Image">
      </el-carousel-item>
    </el-carousel>
                                          
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
                                        <h3 class="product-title">{{  selected_product.name
                            .split(" ")
                            .map(
                                (word) =>
                                    word.charAt(0).toUpperCase() +
                                    word.slice(1).toLowerCase()
                            )
                            .join(" ")}}</h3>
                                        <span class="price-amount">ksh {{selected_product.price.toLocaleString()}}</span>
                                        <ul class="product-meta">
                                            <li><i class="fa fa-check"></i>In stock</li>
                                            <li><i class="fa fa-check"></i>Delivery available</li>
                                      
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
                                                    <li>40</li>
                                                    <li>41</li>
                                                    <li>42</li>
                                                    <li>43</li>
                                                    <li>44</li>
                                                   
                                                </ul>
                                            </div>
                                            <!-- End Product Variation  -->

                                        </div>

                                        <!-- Start Product Action Wrapper  -->
                                        <div class="product-action-wrapper d-flex-center">
                                            <!-- Start Quentity Action  -->
                                            <!-- <div class="pro-qty"><input type="text" value="1"></div> -->
                                            <!-- End Quentity Action  -->

                                            <!-- Start Product Action  -->
                                            <ul class="product-action d-flex-center mb--0">
                                                <li class="add-to-cart"><a  @click="cartStore.addItem(selected_product)" class="axil-btn btn-bg-primary">Add to Cart</a></li>
                                                <li class="wishlist"><a  @click.prevent="wishlistStore.addToWishlist(product)" class="axil-btn wishlist-btn"><i class="far fa-heart"></i></a></li>
                                            </ul>
                                            <!-- End Product Action -->

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