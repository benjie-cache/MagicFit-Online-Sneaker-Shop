<script setup lang="ts">
import axios from "axios";
import {defineAsyncComponent, onMounted, ref } from 'vue'
const ColorVariant = defineAsyncComponent(() =>
import("../product-components/ColorVariant.vue")
);
//import rateIcon from '../../images/icons/rate.png';
const props = defineProps({
    selected_product: Object,
    activeProductColor: Object
});
const emit = defineEmits(['actionClicked','colorChanged']);
//handle action click
const handleActionClick = (event: Event) => {
       emit('actionClicked',event);
};
const productDetails=ref(null)

onMounted(async()=>{
    try{
         const headers:object={   "Content-Type": "application/json"}

         const response = await axios.get(`/api/products/${props.selected_product.id}`,headers);
         productDetails.value=response.data
    }catch(error:any){
        console.log(error)
    }
})

</script>

<template  >
    <div class="single-product-thumb">
        <div class="row">
            <div class="col-lg-7 ">
                <div class="row">
                    <div class="col-lg-12 order-lg-2">
                        <div
                            class="single-product-thumbnail product-large-thumbnail-{{ props.selected_product.id }} axil-product thumbnail-badge zoom-gallery">
                            <el-carousel  type="card" height="300px" >
                                <el-carousel-item v-for="(image, index) in activeProductColor.productImages" :key="index">
                                    <img loading="lazy" :src="'/storage' + image.url" alt="Product Image">
                                </el-carousel-item>
                            </el-carousel>
                            <div class="d-flex m-2  justify-content-center">
                                <div class="color-variant-wrapper">
                                    <ColorVariant  :productColors="selected_product.productColors"
                                    @colorChanged="emit('colorChanged')"/>
                                </div>
                            </div>


                        </div>
                    </div>

                </div>
            </div>
            <div class="col-lg-5 ">
                <div class="single-product-content">
                    <div class="inner">
                        <div class="product-rating">
                            <div class="star-rating">
                                <img src="" alt="Rate Images">
                            </div>
                            <div class="review-link">
                                <a href="">(<span>1</span> customer reviews)</a>
                            </div>
                        </div>
                        <h3 class="product-title text-capitalize">{{ selected_product.name }}</h3>
                        <span class="price-amount h4 text-muted">{{activeProductColor.color_name}}</span>
                        <span class="price-amount">KSH {{activeProductColor.price}}</span>
                        <ul class="product-meta">
                            <li><i class="fa fa-check"></i>In stock</li>
                            <li><i class="fa fa-check"></i>Delivery available</li>

                        </ul>
                        <p class="description">{{ selected_product.description }}</p>

                        <!-- Start Product Action Wrapper  -->
                        <div class="product-action-wrapper d-flex-center">

                            <!-- Start Product Action  -->
                            <ul class="product-action d-flex-center mb--0" @click.stop="handleActionClick">
                                <li class="add-to-cart"><a
                                        class="axil-btn btn-bg-primary" data-action="addtocart">Add to Cart</a></li>
                                <li class="wishlist"><a
                                        class="axil-btn wishlist-btn" data-action="wishlist"><i class="far fa-heart" ></i></a></li>
                            </ul>
                            <!-- End Product Action -->

                        </div>
                        <!-- End Product Action Wrapper  -->
                    </div>

                </div>
            </div>
        </div>
    </div>
</template>
