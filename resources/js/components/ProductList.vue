<script setup>
import axios from "axios";
import { onMounted, ref } from "vue";
import { useProductStore } from "@/store/productStore.js";
import { defineAsyncComponent } from "vue";
const Product = defineAsyncComponent(() => import("./Product.vue"));
const productStore = useProductStore();
const FETCH_PRODUCTS_URL = "api/products";

const headers = {
    "Content-Type": "application/json",
};
const selectedSort = ref("latest");

const sortProducts = () => {
    switch (selectedSort.value) {
        case "latest":
            productStore.sortProductsBy("created_at");
            break;
        case "oldest":
            productStore.sortProductsBy("created_at");
            productStore.sortedProducts.reverse();
            break;
        case "name":
            productStore.sortProductsBy("name");
            break;
        case "price":
            productStore.sortProductsBy("price");
            break;
        default:
            break;
    }
};
const fetchProducts = async () => {
    try {
        const res = await axios.get(FETCH_PRODUCTS_URL, headers);
        productStore.setProducts(res.data.data);
    } catch (error) {
        console.error("An error occurred while fetching products:", error);
        throw error;
    }
};

onMounted(() => {
    fetchProducts();
});
</script>

<template lang="">
    <div class="col-lg-9">
        <div class="row">
            <div class="col-lg-12">
                <div class="axil-shop-top mb--40">
                    <div
                        class="category-select align-items-center justify-content-lg-end justify-content-between"
                    >
                        <!-- Start Single Select  -->
                        <span class="filter-results"
                            >Showing 1-12 of 84 results</span
                        >
                        <select
                            class="single-select"
                            v-model="selectedSort"
                            @change="sortProducts"
                        >
                            <option value="latest">Short by Latest</option>
                            <option value="oldest">Short by Oldest</option>
                            <option value="name">Short by Name</option>
                            <option value="price">Short by Price</option>
                        </select>
                        <!-- End Single Select  -->
                    </div>
                    <div class="d-lg-none">
                        <button class="product-filter-mobile filter-toggle">
                            <i class="fas fa-filter"></i> FILTER
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- End .row -->
        <div class="row row--15" id="prod-list">
            <div
                class="col-xl-4 col-sm-6"
                v-for="(product, index) in productStore.sortedProducts"
                :key="index"
            >
                <Product :product="product" />
            </div>
            <!-- End Single Product  -->
        </div>
        <div class="text-center pt--20">
            <a href="#" class="axil-btn btn-bg-lighter btn-load-more"
                >Pagination goes here</a
            >
        </div>
    </div>
</template>
