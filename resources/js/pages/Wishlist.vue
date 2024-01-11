<script setup>
import {useWishlistStore} from '@/store/wishlistStore.js'
const wishlistStore=useWishlistStore();

</script>
<template lang="">
   <main class="main-wrapper">
        <!-- Start Wishlist Area  -->
        <div class="axil-wishlist-area axil-section-gap">
            <div class="container">
                <div class="product-table-heading">
                    <h4 class="title">My Wish List on MagicFit</h4>
                </div>
                <div class="table-responsive">
                    <table class="table axil-product-table axil-wishlist-table">
                        <thead>
                            <tr>
                                <th scope="col" class="product-remove"></th>
                                <th scope="col" class="product-thumbnail">Product</th>
                                <th scope="col" class="product-title"></th>
                                <th scope="col" class="product-price">Unit Price</th>
                                <th scope="col" class="product-stock-status">Stock Status</th>
                                <th scope="col" class="product-add-cart"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(item,index) in wishlistStore.wishlistItems" :key="index">

                                <td class="product-remove"><a @click.prevent="wishlistStore.removeFromWishlist(item)" class="remove-wishlist"><i class="fa fa-times"></i></a></td>
                                <td class="product-thumbnail"><a><img :src="item.images[1].url" alt="Product"></a></td>
                                <td class="product-title"><a >{{item.name}}</a></td>
                                <td class="product-price" data-title="Price"><span class="currency-symbol">Ksh</span>{{item.price}}</td>
                                <td class="product-stock-status" data-title="Status">In Stock</td>
                                <td class="product-add-cart"><a @click="wishlistStore.moveItemToCart(item)" class="axil-btn btn-outline">Add to Cart</a></td>
                            </tr>
                           
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
        <!-- End Wishlist Area  -->
</template>

<style lang="">
    
</style>
