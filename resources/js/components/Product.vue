<script setup>
import { defineAsyncComponent, ref } from "vue";
import { useWishlistStore } from "@/store/wishlistStore.js";

const wishlistStore = useWishlistStore();
const ProductQuickView = defineAsyncComponent(() =>
    import("@/components/ProductQuickView.vue")
);
const ColorVariant= defineAsyncComponent(()=>import("@/components/product-components/ColorVariant.vue"))

import useCartStore from "@/store/cartStore.js";

const isQuickViewOpen = ref(false);

const openQuickViewModal = (product) => {
    isQuickViewOpen.value = true;
};

const props = defineProps({
    product: Object,
});

//handle cart management
const cartStore = useCartStore();

const handleActionClick = (event) => {
    const target = event.target.closest("[data-action]");
    if (!target) return;

    const action = target.dataset.action;
    console.log(action);

    if (action === "wishlist") {
        wishlistStore.addToWishlist(props.product);
    } else if (action === "addtocart") {
        useCartStore().addItem(props.product);
    } else if (action === "quickview") {
        openQuickViewModal(props.product);
    }
};
const isHovered = false;
const displayImage = ref("/storage" + props.product.images[1].url);
const handleImageHover = () => {
    console.log("image hovered");
    displayImage.value = "/storage" + props.product.images[0].url;
};
const handleImageLeave = () => {
    console.log("mouse left");
    displayImage.value = "/storage" + props.product.images[1].url;
};

</script>

<template lang="">
    <div
        class="axil-product product-style-one mb--30"
        @mouseover="handleImageHover"
        @mouseleave="handleImageLeave"
    >
        <div class="thumbnail">
            <a>
                <img
                    class="image-hover"
                    v-if="
                        product.images &&
                        product.images.length > 1 &&
                        product.images[1]
                    "
                    :src="displayImage"
                    alt="Image"
                />
            </a>
            <div class="label-block label-right" v-if="product.discount">
                <div class="product-badget">
                    {{ product.discount.discount_percentage }}% OFF
                </div>
            </div>
            <div class="product-hover-action">
                <ul class="cart-action" @click.stop="handleActionClick">
                    <li class="wishlist" data-action="wishlist">
                        <a><i class="far fa-heart"></i></a>
                    </li>
                    <li class="select-option" data-action="addtocart">
                        <a><i class="fa fa-shopping-cart"></i></a>
                    </li>
                    <li class="quickview" data-action="quickview">
                        <a><i class="far fa-eye"></i></a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="product-content">
            <div class="inner">
                <h5 class="title">
                    {{ product.name }}
                </h5>

                <div class="product-price-variant">
                    <span class="price current-price" 
                        >ksh {{ !product.discount ? product.price.toLocaleString(): product.discount.price_after_discount}}/=</span
                    >
                    <span class="price old-price" v-if="product.discount">
                        ksh
                        {{ product.discount.original_price.toLocaleString() }}/=
                    </span>

                    <ColorVariant :productColors="product.colors"/>
                </div>
              
            </div>
        </div>
    </div>

    <el-dialog
        v-model="isQuickViewOpen"
        title="Product Quick View"
        width="70%"
        height="70%"
        close-on-click-modal
        append-to-body
        lock-scroll
    >
        <ProductQuickView :selected_product="product" />
    </el-dialog>
</template>
