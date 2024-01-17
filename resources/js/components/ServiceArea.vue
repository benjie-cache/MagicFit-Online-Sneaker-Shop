<template lang="">
     <div class="service-area">
        <div class="container">
            <div class="row row-cols-xl-4 row-cols-sm-2 row-cols-1 row--20">
                <div class="col">
                    <div class="service-box service-style-2">
                        <div class="icon">
                            <img :src="service1" alt="Service">
                        </div>
                        <div class="content">
                            <h6 class="title">Fast &amp; Secure Delivery</h6>
                            <p>Package to you safe and sound</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="service-box service-style-2">
                        <div class="icon">
                            <img :src="service2" alt="Service">
                        </div>
                        <div class="content">
                            <h6 class="title">Original Brands Guarantee</h6>
                            <p>No Imitations</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="service-box service-style-2">
                        <div class="icon">
                            <img :src="service3" alt="Service">
                        </div>
                        <div class="content">
                            <h6 class="title">24 Hour Return Policy</h6>
                            <p>No question ask.</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="service-box service-style-2">
                        <div class="icon">
                            <img :src="service4" alt="Service">
                        </div>
                        <div class="content">
                            <h6 class="title">Pro Quality Support</h6>
                            <p>24/7 Live support.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script setup>
import service1 from '../../../public/assets/images/icons/service1.png';
import service2 from '../../../public/assets/images/icons/service2.png';
import service3 from '../../../public/assets/images/icons/service3.png'
import service4 from '../../../public/assets/images/icons/service4.png'
</script>
<style lang="">
    
</style>
