<template lang="">
     <section class="error-page onepage-screen-area">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="content" data-sal="slide-up" data-sal-duration="800" data-sal-delay="400">
                        <span class="title-highlighter highlighter-secondary"> <i class="fal fa-exclamation-circle"></i> Oops! Something's missing.</span>
                        <h1 class="title">Page not found</h1>
                        <p>It seems like we dont find what you searched. The page you were looking for doesn't exist, isn't available or its  loading incorrectly.</p>
                        <router-link to="/" class="axil-btn btn-bg-secondary right-icon">
      Back To Shopping <i class="fa fa-long-arrow-right"></i>
    </router-link>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="thumbnail" data-sal="zoom-in" data-sal-duration="800" data-sal-delay="400">
                        <img :src="notFoundImg" alt="404">
                    </div>
                </div>
            </div>
        </div>
    </section>

</template>
<script setup>
 import notFoundImg from '../../../public/assets/images/others/404.png'
</script>
<style lang="">
    
</style>