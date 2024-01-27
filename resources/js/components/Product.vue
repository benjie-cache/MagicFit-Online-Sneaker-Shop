<script setup>
import { defineAsyncComponent, ref } from "vue";
import { useWishlistStore } from "@/store/wishlistStore.js";

const wishlistStore = useWishlistStore();
const ProductQuickView = defineAsyncComponent(() =>
    import("@/components/ProductQuickView.vue")
);
const ColorVariant = defineAsyncComponent(() =>
    import("@/components/product-components/ColorVariant.vue")
);

import useCartStore from "@/store/cartStore.js";
const cartStore = useCartStore();

const isQuickViewOpen = ref(false);

const openQuickViewModal = () => {
    isQuickViewOpen.value = true;
};

const props = defineProps({
    product: Object,
});

////manage the state of active productColor
const activeProductColor = ref(props.product.productColors[0]);
const handleActionClick = (event) => {
    const target = event.target.closest("[data-action]");
    if (!target) return;

    const action = target.dataset.action;
    //console.log(action);

    if (action === "wishlist") {
        wishlistStore.addToWishlist(props.product);
    } else if (action === "addtocart") {
        useCartStore().addItem(props.product);
    } else if (action === "quickview") {
        openQuickViewModal(props.product);
    }
};

const handleColorChange = (colorCode, colorId) => {
    activeProductColor.value = props.product.productColors.find(
        (item) => item.id === colorId && item.color_code === colorCode
    );
};
</script>

<template lang="">
    <div class="axil-product product-style-one mb--30">
        <div class="thumbnail">
            <img
                class="image-hover"
                :src="'/storage' + activeProductColor.productImages[1].url"
                alt="Image"
                style="height:100"
            />

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
                <h5 class="title text-capitalize">
                    {{ activeProductColor.color_name }} {{ product.name }}
                </h5>

                <div class="product-price-variant">
                    <span class="price current-price"
                        >KSH {{ activeProductColor.price }}/=</span
                    >

                    <div class="color-variant-wrapper">
                        <ColorVariant
                            :productColors="product.productColors"
                            @colorChanged="handleColorChange"
                        />
                    </div>
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
