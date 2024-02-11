<script setup lang="ts">
import { defineAsyncComponent, ref } from "vue";
import { useWishlistStore } from "../store/useWishlistStore";



const wishlistStore = useWishlistStore();
const ProductQuickView = defineAsyncComponent(() =>
  import("../components/product-components/ProductQuickView.vue")
);
const ColorVariant = defineAsyncComponent(
    () => import("../components/product-components/ColorVariant.vue")
);

import { Item, useCartStore } from "../store/cartStore";
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
//find the active product color index
const activeColorIndex = ref(
    props.product.productColors.findIndex(
        (item) => item.id === activeProductColor.value.id
    )
);


//clean this up
const handleActionClick = (event) => {
    const target = event.target.closest("[data-action]");
    if (!target) return;

    const action = target.dataset.action;
    //console.log(action);
    const item: Item = {
        id: activeProductColor.value.id,
        brand_id: props.product.brand_id,
        category_id: props.product.category_id,
        name: props.product.name,
        productColor: {
            id: activeProductColor.value.id,
            color_name: activeProductColor.value.color_name,
            color_code: activeProductColor.value.color_code,
            price: activeProductColor.value.price,
            productImages: activeProductColor.value.productImages,
        },
        description: props.product.description,
        // count:1,
        //itemSubtotal:
    };
    switch (action) {
        case "wishlist":
            wishlistStore.addToWishList(item);
            break;
        case "addtocart":
            cartStore.addItem(item);
            break;
        case "quickview":
            openQuickViewModal();
            break;
        default:
            break;
    }
};

const handleColorChange = (colorCode, colorId) => {

    activeProductColor.value = props.product.productColors.find(
        (item) => item.id === colorId && item.color_code === colorCode
    );
    console.log(activeProductColor.value);
};
</script>

<template lang="">
    <div class="axil-product product-style-one mb--30">
        <div class="thumbnail">
            <img
                loading="lazy"
                class="image-hover"
                :src="'/storage' + activeProductColor.productImages[1].url"
                alt="Image"
                style="height: 100"
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
                    {{ product.name }}
                </h5>

                <div class="product-price-variant">
                    <span class="price current-price"
                        >KSH {{ activeProductColor.price }}/= (
                        {{ activeProductColor.color_name }} )</span
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
        top="0"
        width="70%"
        height="70%"
        close-on-click-modal
        append-to-body

        destroy-on-close
    >
        <ProductQuickView
        :selected_product="product"
        :activeProductColor="activeProductColor"
        @colorChanged="handleColorChange"
        @actionClicked="handleActionClick"/>
    </el-dialog>
</template>
