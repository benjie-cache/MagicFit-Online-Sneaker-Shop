<template lang="">
    <div class="col-lg-9" >
        <div class="row">
            <div class="col-lg-12">
                <div class="axil-shop-top mb--40">
                    <div
                        class="category-select align-items-center justify-content-lg-end justify-content-between">
                        <!-- Start Single Select  -->
                        <span class="filter-results">Showing 1-12 of 84 results</span>
                        <select class="single-select">
                            <option>Short by Latest</option>
                            <option>Short by Oldest</option>
                            <option>Short by Name</option>
                            <option>Short by Price</option>
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
        <div class="row row--15" id="prod-list" >
            <div class="col-xl-4 col-sm-6"  v-for="(product, index) in products" :key="index">
                
                <Product  :product="product"/>
            </div>
            <!-- End Single Product  -->
        </div>
        <div class="text-center pt--20">
            <a href="#" class="axil-btn btn-bg-lighter btn-load-more"
                >Load more</a
            >
        </div>
    </div>
</template>

<script setup>
import axios from 'axios';
import { onMounted ,ref} from 'vue';
import Product from "./Product.vue";

const FETCH_PRODUCTS_URL = 'api/products';
let products =ref([]) ;
const headers = {
    "Content-Type": "application/json"
};

const fetchProducts = async () => {
    try {
        const res = await axios.get(FETCH_PRODUCTS_URL, headers);

        //console.log(res.data);
        products.value=res.data.data
        console.log(products.value)
    } catch (error) {
        console.error("An error occurred while fetching products:", error);
        throw (error);
    }
};

onMounted(() => {
    fetchProducts();
});
</script>
