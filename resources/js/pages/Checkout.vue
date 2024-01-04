<script setup>
import { defineAsyncComponent } from 'vue';

const CheckoutAuthNotice = defineAsyncComponent(() => import('@/components/checkout-components/CheckOutAuthNotice.vue'));
const CheckoutBilling = defineAsyncComponent(() => import('@/components/checkout-components/CheckOutBilling.vue'));
const CheckoutOrderDetails = defineAsyncComponent(() => import('@/components/checkout-components/CheckOutOrderDetails.vue'));
import {useAuthStore } from '@/store/authStore.js';
const authStore=useAuthStore();
</script>
<template lang="">
     <div class="axil-checkout-area axil-section-gap">
            <div class="container">
                <form action="#">
                    <div class="row">
                        <div class="col-lg-6">
                            <CheckoutAuthNotice v-if="!authStore.user"/>
                            <CheckoutBilling/>
                        </div>
                        <div class="col-lg-6">
                          <CheckoutOrderDetails/>
                        </div>
                    </div>
                </form>
            </div>
        </div>
</template>

<style lang="">
    
</style>