<script setup>
import { defineAsyncComponent ,onMounted} from "vue";

const ProductQuickView = defineAsyncComponent(() =>
    import("@/components/ProductQuickView.vue")
);

import useCartStore from "@/store/cartStore.js";

import { ref } from "vue";
const isQuickViewOpen = ref(false);
const modalIdPrefix = "quick-view-modal"; // Prefix for modal IDs
const openQuickViewModal = (product) => {
    isQuickViewOpen.value = true;
};

const closeQuickView = () => {
    isQuickViewOpen.value = false;
};
const props = defineProps({
    product: Object,
});
// onMounted(()=>{
//     $('.slick-slider').slick('setPosition');
//      $('.product-large-thumbnail').slick({
//                 infinite: false,
//                 slidesToShow: 1,
//                 slidesToScroll: 1,
//                 arrows: false,
//                 dots: false,
//                 speed: 800,
//                 draggable: false,
//                 asNavFor: '.product-small-thumb'
//             });
//     $('.product-small-thumb').slick({
//                 infinite: false,
//                 slidesToShow: 6,
//                 slidesToScroll: 1,
//                 arrows: false,
//                 dots: false,
//                 focusOnSelect: true,
//                 vertical: true,
//                 speed: 800,
//                 asNavFor: '.product-large-thumbnail',
//                 responsive: [{
//                         breakpoint: 992,
//                         settings: {
//                             vertical: false,
//                         }
//                     },
//                     {
//                         breakpoint: 768,
//                         settings: {
//                             vertical: false,
//                             slidesToShow: 4,
//                         }
//                     }
//                 ]

//             });
// })
// Define a function to generate a unique modal ID based on product ID
const getModalId = (productId) => `${modalIdPrefix}-${productId}`;

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
                        <a @click="useCartStore().addItem(product)"
                            >Add to Cart</a
                        >
                    </li>
                    <li class="quickview">
                        <a
                            href="#"
                            data-bs-toggle="modal"
                            :data-bs-target="'#'+getModalId(product.id)"
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
                    {{
                        product.name
                            .split(" ")
                            .map(
                                (word) =>
                                    word.charAt(0).toUpperCase() +
                                    word.slice(1).toLowerCase()
                            )
                            .join(" ")
                    }}
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
    <div
        class="modal fade quick-view-product"
        :id="getModalId(product.id)"
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
                    <ProductQuickView :selected_product="product"/>
                </div>
            </div>
        </div>
    </div>
</template>
<style scoped>
@import "slick-carousel/slick/slick.css";
@import "slick-carousel/slick/slick-theme.css";
</style>
