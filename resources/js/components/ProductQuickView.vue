<script setup>
import { onMounted, onUnmounted } from "vue";
import prodImgUrl from "../../images/others/product-36.png";
import prodImgUrlHigh from "../../images/others/product-36-1.png";

const props = defineProps({
    product: Object,
});
import { quantityRanger } from "../utils";
// Call quantityRanger when the component is mounted

// clean up the event listeners when the component is unmounted
</script>

<template lang="" #body>
    <div class="single-product-thumb">
        <div class="row">
            <div class="col-lg-7 mb--40">
                <div class="row">
                    <div class="col-lg-10 order-lg-2">
                        <div
                            class="single-product-thumbnail product-large-thumbnail axil-product thumbnail-badge zoom-gallery"
                        >
                            <CCarousel
                                controls
                                indicators
                                transition="crossfade"
                            >
                               
                                <CCarouselItem>
                                    <div class="thumbnail">
                                        <img
                                            v-if="
                                                product.images &&
                                                product.images.length > 1 &&
                                                product.images[1]
                                            "
                                            :src="
                                                '/storage' +
                                                product.images[1].url
                                            "
                                            alt="Image"
                                        />
                                        <div
                                            class="label-block label-right"
                                            v-if="product.discount"
                                        >
                                            <div class="product-badget">
                                                {{
                                                    product.discount
                                                        .discount_percentage
                                                }}% OFF
                                            </div>
                                        </div>
                                        <div
                                            class="product-quick-view position-view"
                                        >
                                            <a
                                            :href="
                                                 '/storage' +
                                                product.images[1].url
                                            "
                                                class="popup-zoom"
                                            >
                                                <i
                                                    class="fa fa-search-plus"
                                                ></i>
                                            </a>
                                        </div>
                                    </div>
                                </CCarouselItem>
                                <CCarouselItem>
                                    <div class="thumbnail">
                                        <img
                                            v-if="
                                                product.images &&
                                                product.images.length > 1 &&
                                                product.images[1]
                                            "
                                            :src="
                                                 '/storage' +
                                                product.images[1].url
                                            "
                                            alt="Image"
                                        />
                                        <div
                                            class="label-block label-right"
                                            v-if="product.discount"
                                        >
                                            <div class="product-badget">
                                                {{
                                                    product.discount
                                                        .discount_percentage
                                                }}% OFF
                                            </div>
                                        </div>
                                        <div
                                            class="product-quick-view position-view"
                                        >
                                            <a
                                            :href="
                                                 '/storage' +
                                                product.images[1].url
                                            "
                                                class="popup-zoom"
                                            >
                                                <i
                                                    class="fa fa-search-plus"
                                                ></i>
                                            </a>
                                        </div>
                                    </div>
                                </CCarouselItem>
                            </CCarousel>
                        </div>
                    </div>
                    <div class="col-lg-2 order-lg-1">
                        <div class="product-small-thumb small-thumb-wrapper">
                            <div class="small-thumb-img">
                                <img
                                            v-if="
                                                product.images &&
                                                product.images.length > 1 &&
                                                product.images[1]
                                            "
                                            :src="
                                                '/storage' +
                                                product.images[1].url
                                            "
                                            alt="Image"
                                        />
                            </div>
                            <div class="small-thumb-img">
                               <img
                                            v-if="
                                                product.images &&
                                                product.images.length > 1 &&
                                                product.images[1]
                                            "
                                            :src="
                                                 '/storage' +
                                                product.images[1].url
                                            "
                                            alt="Image"
                                        />
                            </div>
                          
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 mb--40">
                <div class="single-product-content">
                    <div class="inner">
                        <h3 class="product-title">
                            {{ product.name }}
                        </h3>
                        <span class="price-amount">ksh {{ product.price }}/=</span>
                        <ul class="product-meta">
                            <li><i class="fa fa-check"></i>In stock</li>
                            <li>
                                <i class="fa fa-check"></i>Delivery Around
                                Nairobi
                            </li>
                            <li>
                                <i class="fa fa-check"></i>Available in all
                                colours
                            </li>
                        </ul>
                        <p class="description">
                            {{ product.description }}
                        </p>

                        <div class="product-variations-wrapper">
                            <!-- Start Product Variation  -->
                            <div class="product-variation">
                                <h6 class="title">Colors:</h6>
                                <div class="color-variant-wrapper">
                                    <ul class="color-variant mt--0">
                                        <li class="color-extra-01 active">
                                            <span
                                                ><span class="color"></span
                                            ></span>
                                        </li>
                                        <li class="color-extra-02">
                                            <span
                                                ><span class="color"></span
                                            ></span>
                                        </li>
                                        <li class="color-extra-03">
                                            <span
                                                ><span class="color"></span
                                            ></span>
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
                            <div class="pro-qty">
                                <span class="dec qtybtn">-</span>
                                <input type="text" value="1" />
                                <span class="inc qtybtn">+</span>
                            </div>
                            <!-- End Quentity Action  -->

                            <!-- Start Product Action  -->
                            <ul class="product-action d-flex-center mb--0">
                                <li class="add-to-cart">
                                    <a  @click="checkItemPresence(product)" class="axil-btn btn-bg-primary"
                                        >Add to Cart</a
                                    >
                                </li>
                                <li class="wishlist">
                                    <a
                                        href="wishlist.html"
                                        class="axil-btn wishlist-btn"
                                        ><i class="far fa-heart"></i
                                    ></a>
                                </li>
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
