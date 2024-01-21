<script setup>
import axios from "axios";
import { onMounted,ref } from "vue";
import { useProductStore } from "@/store/productStore.js";
import { defineAsyncComponent } from "vue";
const Product = defineAsyncComponent(() => import("./Product.vue"));
const productStore = useProductStore();


const headers = {
    "Content-Type": "application/json",
};
const selectedSort = ref("latest");

const handlePageChange=(newPage)=>{
          productStore.current_page=newPage;
          console.log(productStore.current_page)
          productStore.applyFilters(newPage)

};
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


onMounted(() => {
    productStore.fetchProducts();
   
});

</script>

<template lang="">
    <div class="col-lg-10">
        <div class="row">
            <div class="col-lg-12">
                <div class="axil-shop-top mb--40">
                    <div
                        class="category-select align-items-center justify-content-lg-end justify-content-between"
                    >
                        <!-- Start Single Select  -->
                        <span class="filter-results"
                        >Showing  {{ productStore.sortedProducts.length}} results</span
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
                  
                </div>
            </div>
        </div>
        <!-- End .row -->
        <div class="row row--15" id="prod-list">
            <div class="col-xl-3 col-sm-6"
                v-for="(product,index) in productStore.sortedProducts"
                :key="product.id" >
            
                <Product :product="product" />
            </div>
            <!-- End Single Product  -->
        </div>
        <div class="text-center pt--20">
            <el-pagination background layout="prev, pager, next" 
      :total="productStore.total"   @current-change="handlePageChange"  hide-on-single-page  />
            
        </div>
       
    </div>
</template>
