<script setup>
import { useWishlistStore } from '@/store/wishlistStore.js';
import axios from "axios";
import useCartStore from '@/store/cartStore.js';
import {defineAsyncComponent, onMounted, ref } from 'vue'
const cartStore = useCartStore();
const ColorVariant = defineAsyncComponent(() =>
    import("@/components/product-components/ColorVariant.vue")
);
//import rateIcon from '../../images/icons/rate.png';

const wishlistStore = useWishlistStore()
const props = defineProps({
    selected_product: Object,
});


const productDetails=ref(null)
const activeProductColor = ref(props.selected_product.productColors[0]);

const handleColorChange = (colorCode, colorId) => {
    activeProductColor.value = props.selected_product.productColors.find(
        (item) => item.id === colorId && item.color_code === colorCode
    );
};
onMounted(async () => {
  try {
    const headers={   "Content-Type": "application/json"}
    const response = await axios.get(`/api/products/${props.selected_product.id}`,headers);
    productDetails.value=response.data

  } catch (error) {
    console.error("Error fetching product details:", error);
  }
});
</script>

<template  >
    <div class="single-product-thumb">
        <div class="row">
            <div class="col-lg-7 ">
                <div class="row">
                    <div class="col-lg-12 order-lg-2">
                        <div
                            class="single-product-thumbnail product-large-thumbnail-{{ props.selected_product.id }} axil-product thumbnail-badge zoom-gallery">
                            <el-carousel  type="card" height="300px" @change="handleLargeImageChange">
                                <el-carousel-item v-for="(image, index) in activeProductColor.productImages" :key="index">
                                    <img loading="lazy" :src="'/storage' + image.url" alt="Product Image">
                                </el-carousel-item>
                            </el-carousel>
                            <div class="color-variant-wrapper">
                                <ColorVariant  :productColors="selected_product.productColors"
                                @colorChanged="handleColorChange"/>
                                </div>

                        </div>
                    </div>

                </div>
            </div>
            <div class="col-lg-5 ">
                <div class="single-product-content">
                    <div class="inner">
                        <div class="product-rating">
                            <div class="star-rating">
                                <img :src="rateIcon" alt="Rate Images">
                            </div>
                            <div class="review-link">
                                <a href="">(<span>1</span> customer reviews)</a>
                            </div>
                        </div>
                        <h3 class="product-title text-capitalize">{{ selected_product.name }}</h3>
                        <span class="price-amount h4 text-muted">{{activeProductColor.color_name}}</span>
                        <span class="price-amount">KSH {{activeProductColor.price}}</span>
                        <ul class="product-meta">
                            <li><i class="fa fa-check"></i>In stock</li>
                            <li><i class="fa fa-check"></i>Delivery available</li>

                        </ul>
                        <p class="description">{{ selected_product.description }}</p>

                        <!-- Start Product Action Wrapper  -->
                        <div class="product-action-wrapper d-flex-center">

                            <!-- Start Product Action  -->
                            <ul class="product-action d-flex-center mb--0">
                                <li class="add-to-cart"><a @click="cartStore.addItem(selected_product)"
                                        class="axil-btn btn-bg-primary">Add to Cart</a></li>
                                <li class="wishlist"><a @click.prevent="wishlistStore.addToWishlist(product)"
                                        class="axil-btn wishlist-btn"><i class="far fa-heart"></i></a></li>
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
