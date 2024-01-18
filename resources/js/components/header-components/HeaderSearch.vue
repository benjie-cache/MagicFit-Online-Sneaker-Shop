<script setup>
import prodImgUrl from '../../../images/others/luka 2 caves.webp';
import useDropdownStore from '@/store/dropdownStore.js';
const dropDownStore = useDropdownStore();

</script>
<template lang="">
    <button class="card-close sidebar-close"  @click="dropDownStore.toggleHeaderSearchDropdown"><i class="fas fa-times"></i></button>
        <div class="header-search-wrap">
            <div class="card-header">
                <form action="#">
                    <div class="input-group">
                        <input type="search" class="form-control" name="prod-search" id="prod-search" placeholder="Write Something....">
                        <button type="submit" class="axil-btn btn-bg-primary"><i class="flaticon-magnifying-glass"></i></button>
                    </div>
                </form>
            </div>
            <div class="card-body">
                <div class="search-result-header">
                    <h6 class="title">1 Result Found</h6>
                    <a href="shop.html" class="view-all">View All</a>
                </div>
                <div class="psearch-results">
                    <div class="axil-product-list">
                        <div class="thumbnail">
                            <a href="single-product.html">
                                <img :src="prodImgUrl" alt="Luka Caves sneakers" class="search-image">
                            </a>
                        </div>
                        <div class="product-content">
                          
                            <h6 class="product-title"><a href="single-product.html">Luka 2 caves</a></h6>
                            <div class="product-price-variant">
                                <span class="price current-price">KSH 4500</span>
                                <span class="price old-price">KSH 5000</span>
                            </div>
                            <div class="product-cart">
                                <a href="cart.html" class="cart-btn"><i class="fa fa-shopping-cart"></i></a>
                                <a href="wishlist.html" class="cart-btn"><i class="fa fa-heart"></i></a>
                            </div>
                        </div>
                    </div>
                   
                </div>
            </div>
        </div>
</template>

<style scoped>
    .search-image {
    width: 50px;
    height: 50px;
}
</style>