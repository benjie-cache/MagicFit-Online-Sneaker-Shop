<script setup>
import { defineAsyncComponent, ref, onMounted } from "vue";
import { ElNotification, ElMessageBox } from "element-plus";

import { useCustomerStore } from "@/store/customerStore.js";
import useCartStore from "@/store/cartStore.js";

const AddressForm = defineAsyncComponent(() =>
    import("@/components/checkout-components/AddressForm.vue")
);
const OrderSummary = defineAsyncComponent(() =>
    import("@/components/checkout-components/OrderSummary.vue")
);
const PaymentForm = defineAsyncComponent(() =>
    import("@/components/checkout-components/PaymentForm.vue")
);
const NoItem = defineAsyncComponent(()=>
import('@/components/NoItem.vue')
);

const customerStore = useCustomerStore();

const cartStore = useCartStore();
const handlePayBtnClick = () => {
    customerStore.isValidCustomerInfo(customerStore.customerInfo)
        ? (centerDialogVisible.value = true)
        : (centerDialogVisible.value = false);
};

const showNotification = (title, message, type) => {
    ElNotification({
        title,
        message,
        type,
    });
};

const centerDialogVisible = ref(false);

onMounted(() => {
    if (
        customerStore.isValidCustomerInfo(customerStore.customerInfo) &&
        cartStore.items.length
    ) {
        showNotification(
            "Success",
            "Delivery details prefilled you can checkout",
            "success"
        );
    }
});
</script>
<template lang="">
    <main class="main-wrapper">
        <div class="axil-checkout-area axil-section-gap">
            <div class="container" v-if="cartStore.items.length">
                <div class="row">
                    <AddressForm />
                    <OrderSummary @payBtnClicked="handlePayBtnClick" />
                </div>
            </div>
           <NoItem v-else
           title="You have no products in your Cart to checkout"
           explanation="Continue Shopping if you find products you like add them...."
           backText="Back To Shopping"/>
        </div>
        <!-- Modal -->
    </main>
<el-dialog
        v-model="centerDialogVisible"
        title="Lipa Na Mpesa"
        center
        destroy-on-close
    >
        <PaymentForm />
</el-dialog>
</template>
