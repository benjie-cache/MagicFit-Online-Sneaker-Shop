<script setup>
import { defineAsyncComponent } from 'vue';


const ProductQuickView =defineAsyncComponent(()=>import('./ProductQuickView.vue'));


import useCartStore from "@/store/cartStore.js";

import { ref} from "vue";
const isQuickViewOpen=ref(false)

const props = defineProps({
    product: Object,
});
//Define a ref to keep track of the selected product for the modal
const selectedProduct = ref(null);

const visibleLiveDemo = ref(false);
// Replace openQuickView with openQuickViewModal
const openQuickViewModal = (product) => {
    // Set the product to be shown in the modal
    selectedProduct.value = product;
    console.log(selectedProduct.value)
    // Open the modal
    isQuickViewOpen.value = true;
};


const closeQuickView = () => {
    isQuickViewOpen.value = false;
};

//handle cart management
const cartStore = useCartStore();




</script>
<template lang="">
    

    <div class="axil-product product-style-one mb--30">
        <div class="thumbnail">
            <a href="single-product.html">
                <!-- <img :src="prodImgUrl" alt="Image"> -->

                <img
                    v-if="
                        product.images &&
                        product.images.length > 1 &&
                        product.images[1]
                    "
                    :src="'/storage' + product.images[1].url"
                    alt="Image"
                />
            </a>
            <div class="label-block label-right" v-if="product.discount">
                <div class="product-badget">
                    {{ product.discount.discount_percentage }}% OFF
                </div>
            </div>
            <div class="product-hover-action">
                <ul class="cart-action">
                    <li class="wishlist">
                        <a href="wishlist.html"><i class="far fa-heart"></i></a>
                    </li>
                    <li class="select-option">
                        <a  @click="useCartStore().addItem(product)">Add to Cart</a>
                    </li>
                    <li class="quickview">
                        <a
                            href="#"
                            data-bs-toggle="modal"
                            data-bs-target="#quick-view-modal"
                            @click="openQuickViewModal(product)"
                            ><i class="far fa-eye"></i
                        ></a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="product-content">
            <div class="inner">
                <h5 class="title">
                    {{ product.name }}
                </h5>

                <div class="product-price-variant" v-if="product.discount">
                    <span class="price current-price"
                        >ksh{{ product.price_after_discount }}/=</span
                    >
                    <span class="price old-price">
                        ksh {{ product.discount.original_price }}/=
                    </span>
                </div>
                <div class="product-price-variant" v-else>
                    <span class="price current-price"
                        >ksh{{ product.price }}/=</span
                    >
                </div>
            </div>
        </div>
    </div>
    <div
        class="modal fade quick-view-product"
        id="quick-view-modal"
        tabindex="-1"
        aria-hidden="true"
    >
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"
                    >
                        <i class="fa fa-times"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <ProductQuickView :product="selectedProduct" />
                </div>
            </div>
        </div>
    </div>
</template>
<style scoped>
@import "slick-carousel/slick/slick.css";
@import "slick-carousel/slick/slick-theme.css";
</style>
