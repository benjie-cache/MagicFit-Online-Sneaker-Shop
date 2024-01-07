<script setup>
import prodImgUrl from "../../../images/others/product-36.webp";

import { ref } from "vue";
import useDropdownStore from '../../store/dropdownStore';
import useCartStore from '../../store/cartStore';
////handle drop downs
const {isOpen,toggleDropdown} = useDropdownStore();
const cartStore = useCartStore();

const cartTotal = ref(parseFloat(cartStore.totalCost).toFixed(2));
const cartItems = ref(cartStore.items);
//:class="['cart-dropdown' , isOpen ? 'open':'']"
</script>

<template lang="" >
 <div class="single-product-thumb">
                        <div class="row">
                            <div class="col-lg-7 mb--40">
                                <div class="row">
                                    <div class="col-lg-10 order-lg-2">
                                        <div class="single-product-thumbnail product-large-thumbnail axil-product thumbnail-badge zoom-gallery">
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
                                        <div class="product-small-thumb small-thumb-wrapper">
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
    <div  id="cart-dropdown" :class="['cart-dropdown' ,isOpen? 'open' : '']"  >
        <div class="cart-content-wrap">
            <div class="cart-header">
                <h2 class="header-title">Cart review</h2>
                <button class="cart-close sidebar-close" @click="isOpen=!isOpen">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="cart-body">
                <ul class="cart-item-list">
                    <li
                        class="cart-item"
                        v-if="cartItems.length"
                        v-for="(item, index) in cartItems"
                        :key="index"
                    >
                        <div class="item-img">
                            <a href="single-product.html"
                                ><img
                                    src="assets/images/product/electric/product-01.png"
                                    alt="Commodo Blown Lamp"
                            /></a>
                            <button
                                class="close-btn"
                                @click="cartStore.removeItem(item)"
                            >
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                        <div class="item-content">
                            <div class="product-rating">
                                <span class="icon">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </span>
                                <span class="rating-number">(64)</span>
                            </div>
                            <h3 class="item-title">
                                <a href="single-product-3.html">{{
                                    item.name
                                }}</a>
                            </h3>
                            <div class="item-price">
                                <span class="currency-symbol">KSH</span
                                >{{ item.price }}
                            </div>
                            <div class="pro-qty item-quantity">
                                
                                <input
                                    type="number"
                                    class="quantity-input"
                                    :value="item.quantity"
                                />
                             
                            </div>
                        </div>
                    </li>
                    <h6 v-else>You havent added any items in your cart yet</h6>
                </ul>
            </div>
            <div class="cart-footer" v-if="cartItems.length">
                <h3 class="cart-subtotal">
                    <span class="subtotal-title">Subtotal:</span>
                    <span class="subtotal-amount">{{ cartTotal }}</span>
                </h3>
                <div class="group-btn">
                    <router-link to="/cart">
                        <a class="axil-btn btn-bg-primary viewcart-btn"
                            >View Cart</a
                        ></router-link
                    >

                    <a
                        href="checkout.html"
                        class="axil-btn btn-bg-secondary checkout-btn"
                        >Checkout</a
                    >
                </div>
            </div>
        </div>
    </div>

</template>

