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

