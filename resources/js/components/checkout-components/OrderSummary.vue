<script setup>
import useCartStore from "@/store/cartStore.js";
const cartStore = useCartStore();
import { useCustomerStore } from "@/store/customerStore.js";
import {defineEmits  } from 'vue';
const emit = defineEmits(['payBtnClicked'])
const customerStore = useCustomerStore();
const handlePayBtnClick = () => {
   
    emit('payBtnClicked');
  };


</script>
<template >
    <div class="col-md-4 order-md-2 mb-4">
                <h6 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-muted">Order Summary</span>
                </h6>
                <ul class="list-group mb-3">
                    <li class="list-group-item d-flex justify-content-between  lh-condensed"
                        v-for="(item, index) in cartStore.items" :key="index">
                        <div>
                            <h6 class="my-0">
                                {{
                                    item.name
                                        .split(" ")
                                        .map(
                                            (word) =>
                                                word
                                                    .charAt(0)
                                                    .toUpperCase() +
                                                word
                                                    .slice(1)
                                                    .toLowerCase()
                                        )
                                        .join(" ")
                                }}
                            </h6>
                            <small class="text-muted">
                                {{ item.count }} x
                                {{
                                    item.price.toLocaleString()
                                }}</small>
                        </div>
                        <span class="text-dark fw-bolder">KSH
                            {{
                                item.subtotal.toLocaleString()
                            }}</span>
                    </li>

                    <li class="list-group-item d-flex justify-content-between">
                        <span>Total (KSH )</span>
                        <strong>KSH
                            {{
                                cartStore.totalCost.toLocaleString()
                            }}</strong>
                    </li>
                </ul>
                <button type="button" class="axil-btn btn-bg-secondary checkout-btn" @click="handlePayBtnClick">
                    <i class="fa fa-rocket"></i> Pay Now
                </button>
            </div>
</template>

