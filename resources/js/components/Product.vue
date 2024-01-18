<script setup>
import { defineAsyncComponent, onMounted } from "vue";
import { useWishlistStore } from "@/store/wishlistStore.js";

const wishlistStore = useWishlistStore();
const ProductQuickView = defineAsyncComponent(() =>
    import("@/components/ProductQuickView.vue")
);

import useCartStore from "@/store/cartStore.js";

import { ref } from "vue";

const isQuickViewOpen = ref(false);

const openQuickViewModal = (product) => {
    isQuickViewOpen.value = true;
};

const closeQuickView = () => {
    isQuickViewOpen.value = false;
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
</script>
<template lang="">
    <div class="axil-product product-style-one mb--30">
        <div class="thumbnail">
            <a>
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

                <div class="product-price-variant" v-if="product.discount">
                    <span class="price current-price"
                        >ksh
                        {{
                            product.discount.price_after_discount.toLocaleString()
                        }}/=</span
                    >
                    <span class="price old-price">
                        ksh
                        {{ product.discount.original_price.toLocaleString() }}/=
                    </span>
                </div>
                <div class="product-price-variant" v-else>
                    <span class="price current-price"
                        >ksh {{ product.price.toLocaleString() }}/=</span
                    >
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
