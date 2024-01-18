<script setup>
import {ref} from 'vue';
import { useCustomerStore } from "@/store/customerStore.js";
import useOrderProcessing from '@/composables/useOrderProcessing.js';
const customerStore = useCustomerStore();
import useCartStore from "@/store/cartStore.js";

const phone=ref(customerStore.customerInfo.phone);
const cartStore = useCartStore();


const orderProcessing = useOrderProcessing();
const loading = ref(false);
const handlePayment = async (phone) => {
   
   customerStore.isValidKenyanPhoneNumber(phone)
       ? (loading.value =
           true &&
           setTimeout(() => {
            orderProcessing.processOrder();
           
               loading.value = false;
           }, 4000))
       : showNotification(
           "Warning",
           "Invalid  Info: Invalid Kenyan phone number",
           "warning"
       );
 };
const svg = `
        <path class="path" d="
          M 30 15
          L 28 17
          M 25.61 25.61
          A 15 15, 0, 0, 1, 15 30
          A 15 15, 0, 1, 1, 27.99 7.5
          L 15 15
        " style="stroke-width: 4px; fill: rgba(0, 0, 0, 0)"/> `;
</script>


<template >
    <p class="text-dark fw-bold text-center">
        You will receive mpesa notification prompting you to pay KSH
        {{ cartStore.totalCost.toLocaleString() }}
    </p>
    <form
        action=""
        class="form"
        v-loading="loading"
        element-loading-text="Processing payment..."
        :element-loading-spinner="svg"
        element-loading-svg-view-box="-20, -20, 50, 50"
        element-loading-background="rgba(122, 122, 122, 0.8)"
    >
        <div class="form-group">
            <label for="phone"></label>
            <input
                type="text"
                class="form-control text-center"
                placeholder="Enter mpesa number"
                v-model="phone"
            />
        </div>
    </form>

    <span class="dialog-footer">
        <el-button
            type="primary"
            plain
            @click="handlePayment(phone)"
        >
            Get Payment Notification
        </el-button>
    </span>
</template>
<style>
.form-control {
    font-weight: 600;
}

.form-control:focus {
    color: #495057;
    background-color: #fff;
    border-color: #8bbafe;
    outline: 0;
    box-shadow: none;
}
</style>
