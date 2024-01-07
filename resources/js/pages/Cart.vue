<script setup>
import {defineAsyncComponent} from 'vue';
import useCartStore from '@/store/cartStore.js';

const cartStore=useCartStore();
const ServiceArea=defineAsyncComponent(()=>import('@/components/ServiceArea.vue'));
</script>
<template lang="">
    <div class="axil-product-cart-area axil-section-gap">
            <div class="container">
                <div class="axil-product-cart-wrap">
                    <div class="product-table-heading">
                        <h4 class="title">Your Cart</h4>
                        <a href="#" class="cart-clear" v-if="cartStore.items.length">Clear Shoping Cart</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table axil-product-table axil-cart-table mb--40">
                            <thead v-if="cartStore.items.length">
                                <tr>
                                    <th scope="col" class="product-remove"></th>
                                    <th scope="col" class="product-thumbnail">Product</th>
                                    <th scope="col" class="product-title"></th>
                                    <th scope="col" class="product-price">Price</th>
                                    <th scope="col" class="product-quantity">Quantity</th>
                                    <th scope="col" class="product-subtotal">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr   v-if="cartStore.items.length" v-for="(item,index) in cartStore.items" :key="item.id">
                                    <td class="product-remove"><a    @click="cartStore.decreaseItem(item,'all')" class="remove-wishlist"><i class="fa fa-times"></i></a></td>
                                    <td class="product-thumbnail"><a href="single-product.html"><img v-if="item.images && item.images.length > 1 && item.images[1]" :src="'/storage' + item.images[1].url" alt="Image"></a></td>
                                    <td class="product-title"><a >{{item.name}}</a></td>
                                    <td class="product-price" data-title="Price"><span class="currency-symbol">KSH</span>{{item.price}}</td>
                                    <td class="product-quantity" data-title="Qty">
                                        <div class="pro-qty item-quantity"><span class="dec qtybtn"    @click="cartStore.decreaseItem(item)">-</span>
                                <input type="number" class="quantity-input"     @input="handleQuantityInput(item)"    v-model="item.count">
                            <span class="inc qtybtn" @click="cartStore.increaseItem(item)">+</span></div>
                                    </td>
                                    <td class="product-subtotal" data-title="Subtotal"><span class="currency-symbol">KSH </span>{{item.subtotal}}</td>
                                </tr>
                                <h6 v-else>Your cart is empty you cant check out just yet</h6>
                            </tbody>
                        </table>
                    </div>
                    <div class="cart-update-btn-area"  v-if="cartStore.items.length">
                        <div class="input-group product-cupon">
                            <input placeholder="Enter Discount code" type="text">
                            <div class="product-cupon-btn">
                                <button type="submit" class="axil-btn btn-outline">Apply</button>
                            </div>
                        </div>
                        <div class="update-btn">
                            <router-link to="/cart">   <a  class="axil-btn btn-outline">Proceed To Checkout</a></router-link>
                         
                        </div>
                    </div>
                  
                </div>
            </div>
        </div>

    <ServiceArea />
</template>

<style lang="">
    
</style>