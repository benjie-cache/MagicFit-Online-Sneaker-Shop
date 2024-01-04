<script setup>
import { defineAsyncComponent } from 'vue';
import prodImgUrl from "../../images/others/luka 2 caves.webp";

const ProductQuickView =defineAsyncComponent(()=>import('./ProductQuickView.vue'));
import { ElAlert, ElButton } from "element-plus";

import useCartStore from "../store/cartStore";

import { ref } from "vue";


const props = defineProps({
    product: Object,
});

const visibleLiveDemo = ref(false);
// Replace openQuickView with openQuickViewModal
const openQuickViewModal = (product) => {
    // Set the product to be shown in the modal
    selectedProduct.value = product;

    // Open the modal
    isQuickViewOpen.value = true;
};

// Define a ref to keep track of the selected product for the modal
const selectedProduct = ref(null);

const closeQuickView = () => {
    isQuickViewOpen.value = false;
};

//handle cart management
const cartStore = useCartStore();
const cartItems = ref(cartStore.items);

const showAlert=ref(false)
const showAddCartSuccess=ref(false)

// Modify your addToCart function to show/hide the alert
const addToCart = (item) => {
  let targetItem = cartItems.value.find(
    (currItem) => currItem.id === item.id
  );

  if (targetItem) {
    // Show the alert if the item is already in the cart
    showAlert.value = true;
    setTimeout(() => {
      showAlert.value = false;
    }, 3000);
  } else {
    useCartStore().addItem(item);
    showAddCartSuccess.value= true;
    setTimeout(() => {
      showAddCartSuccess.value= false;
    }, 3000);
  }
};
</script>
<template lang="">
  <el-alert
  v-if="showAlert"
  title="Item Already In the Cart"
  type="warning"
  :closable="true"
  show-icon
  @close="showAlert = false"
></el-alert>



<el-alert
  v-if="showAddCartSuccess"
  title="Item Added In the Cart"
  type="success"
  :closable="true"
  show-icon
  @close="showAddCartSuccess= false"
></el-alert>


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
                        <a @click="addToCart(product)">Add to Cart</a>
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
                    <ProductQuickView :selectedProduct />
                </div>
            </div>
        </div>
    </div>
</template>
