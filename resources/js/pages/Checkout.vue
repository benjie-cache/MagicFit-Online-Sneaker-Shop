<script setup>
import { reactive, ref,onMounted } from "vue";
import { ElNotification, ElMessageBox } from "element-plus";

import { useAuthStore } from "@/store/authStore.js";
import { useCustomerStore } from "@/store/customerStore.js";
import useCartStore from "@/store/cartStore.js";
import { useRouter } from "vue-router";
import { ElForm, ElFormItem, ElInput } from "element-plus";
const customerStore = useCustomerStore();
const authStore = useAuthStore();
const cartStore = useCartStore();
const showNotification = (title, message, type) => {
    ElNotification({
        title,
        message,
        type,
    });
};
const labelPosition = ref("right");
const phone=ref("0741433144");
const formReadOnly = ref(true);
const toggleReadOnly = () => {
    formReadOnly.value = !formReadOnly.value;
   
};


const centerDialogVisible = ref(false);






const router = useRouter();
const processOrder = async () => {
    if (cartStore.items.length) {
        try {
            const headers = authStore.getHeaders();
            const data = {
                orderItems: cartStore.items,
                cartTotal: cartStore.totalCost,
            };

            const res = await axios.post(
                "api/checkout/process-order",
                JSON.stringify(data),
                { headers }
            );

            // Check the status from the response
            if (
                res.status === 200 &&
                res.data &&
                res.data.message === "Order processed"
            ) {
                centerDialogVisible.value = false;
                showNotification(
                    "Success",
                    "Order processed successfully",
                    "success"
                );
                ElMessageBox.confirm(
                    "Order placed successfully. What would you like to do?",
                    "Success",
                    {
                        confirmButtonText: "View Orders",
                        cancelButtonText: "Continue Shopping",
                        type: "success",
                    }
                )
                    .then(() => {
                        router.push({ name: "account" });
                    })
                    .catch(() => {
                        router.push({ name: "shop" });
                    });
            } else {
                //Handle other status or errors
                showNotification(
                    "Error",
                    res.data.message ||
                    "There was an issue processing the order",
                    "error"
                );
            }

            cartStore.clearCart();
        } catch (error) {
            console.error("Error processing order:", error);
            showNotification(
                "Error",
                "There was an unexpected error processing the order",
                "error"
            );
        }
    } else {
        showNotification(
            "No Cart Items",
            "You have no items in your cart",
            "warning"
        );
    }
};

const loading = ref(false);
const handlePayment = (phone) => {
    console.log(phone)
    customerStore. isValidKenyanPhoneNumber(phone) ?
    loading.value = true &&
    setTimeout(() => {
        processOrder();
        loading.value = false;
    }, 4000): showNotification("Warning", "Invalid  Info: Invalid Kenyan phone number", "warning");
};
const handlePayBtnClick=()=>{
    customerStore.isValidCustomerInfo(customerStore.customerInfo) ? centerDialogVisible.value=true:  centerDialogVisible.value=false
}
onMounted(() => {
if(customerStore.isValidCustomerInfo(customerStore.customerInfo)){
    showNotification("Success", "Delivery details are valid you can checkout", "success");
}
    

});
//const updateDeliveryDetails()
</script>
<template lang="">
    <main class="main-wrapper">
        <div class="axil-checkout-area axil-section-gap">
            <div class="container" v-if="cartStore.items.length">
                <form action="#">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="axil-checkout-billing">
                                <div
                                    class="addrss-header d-flex align-items-center justify-content-between"
                                >
                                    <h4 class="title mb-20 py-5">
                                        Delivery Address<br>
                                        <p>These details have been prefilled from your customer account</p>
                                    </h4>
                                    <el-switch
                                        v-model="formReadOnly"
                                        size="large"
                                        active-text="Edit Your Details"
                                        inactive-text="Details are fine"
                                        class="ml-2"
                                        inline-prompt
                                        style="
                                            --el-switch-on-color: #13ce66;
                                            --el-switch-off-color: #ff4949;
                                        "
                                    />
                                </div>
                                <form>
                                    <div class="row">
                                        <div class="form-group col-lg-6">
                                            <label
                                                >First Name
                                                <span>*</span></label
                                            >
                                            <input
                                                type="text"
                                                id="first-name"
                                                placeholder="Your First Name"
                                                v-model="
                                                    customerStore.customerInfo
                                                        .first_name
                                                "
                                                :readonly="formReadOnly"
                                                ref="firstNameInput"
                                            />
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label
                                                >Last Name <span>*</span></label
                                            >
                                            <input
                                                type="text"
                                                id="last-name"
                                                placeholder="Enter Your Last Name"
                                                v-model="
                                                    customerStore.customerInfo
                                                        .last_name
                                                "
                                                :readonly="formReadOnly"
                                            />
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label>Phone <span>*</span></label>
                                            <input
                                                type="text"
                                                id="phone"
                                                placeholder="Phone Number"
                                                v-model="
                                                    customerStore.customerInfo
                                                        .phone
                                                "
                                                :readonly="formReadOnly"
                                            />
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label>Estate <span>*</span></label>
                                            <input
                                                type="text"
                                                id="estate"
                                                placeholder="Where do you live?"
                                                :readonly="formReadOnly"
                                                v-model="
                                                    customerStore.customerInfo
                                                        .addresses[0].estate
                                                "
                                            />
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label
                                                >Street Name
                                                <span>*</span></label
                                            >
                                            <input
                                                type="text"
                                                id="address1"
                                                class="mb--15"
                                                placeholder="Street Name"
                                                :readonly="formReadOnly"
                                                v-model="
                                                    customerStore.customerInfo
                                                        .addresses[0]
                                                        .street_address
                                                "
                                            />
                                        </div>

                                        <div class="form-group col-lg-6">
                                            <label
                                                >Apartment Name
                                                <span>*</span></label
                                            >
                                            <input
                                                type="text"
                                                id="address2"
                                                placeholder="Apartment Name"
                                                :readonly="formReadOnly"
                                                v-model="
                                                    customerStore.customerInfo
                                                        .addresses[0]
                                                        .apartment_name
                                                "
                                            />
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label
                                                >House Number
                                                <span>*</span></label
                                            >
                                            <input
                                                type="text"
                                                id="address2"
                                                placeholder="House Number"
                                                :readonly="formReadOnly"
                                                v-model="
                                                    customerStore.customerInfo
                                                        .addresses[0]
                                                        .house_number
                                                "
                                            />
                                        </div>
                                        <a v-if="!formReadOnly" @click="customerStore.handleDeliveryInfo()" class="axil-btn btn-bg-primary right-icon">
                                               Update Your Delivery Details
                           
                          <i class="fa fa-money" aria-hidden="true"></i></a>
                                    </div>

                                </form>
                            </div>
                        </div>
                        <div class="col-md-4 order-md-2 mb-4">
                            <h6
                                class="d-flex justify-content-between align-items-center mb-3"
                            >
                                <span class="text-muted">Order Summary</span>
                            </h6>
                            <ul class="list-group mb-3">
                                <li
                                    class="list-group-item d-flex justify-content-between lh-condensed"
                                    v-for="(item, index) in cartStore.items"
                                    :key="index"
                                >
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
                                            }}</small
                                        >
                                    </div>
                                    <span class="text-dark fw-bolder"
                                        >KSH
                                        {{
                                            item.subtotal.toLocaleString()
                                        }}</span
                                    >
                                </li>

                                <li
                                    class="list-group-item d-flex justify-content-between"
                                >
                                    <span>Total (KSH )</span>
                                    <strong
                                        >KSH
                                        {{
                                            cartStore.totalCost.toLocaleString()
                                        }}</strong
                                    >
                                </li>
                            </ul>
                            <button
                                type="button"
                                class="axil-btn btn-bg-secondary checkout-btn"
                                @click="handlePayBtnClick"
                            >
                                <i class="fa fa-rocket"></i> Pay Now
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="d-flex justify-content-center" v-else>
                <div class="content">
                    <span class="title-highlighter highlighter-secondary">
                        <i class="fa-solid fa-circle-exclamation"></i> You have
                        no products in your Cart to checkout</span
                    >

                    <p>
                        Continue Shopping if you find products you like add
                        them....
                    </p>
                    <router-link to="/shop"
                        ><a class="axil-btn btn-bg-secondary right-icon">
                            Back To Shopping
                            <i class="fa fa-arrow-left"></i
                        ></a>
                    </router-link>
                </div>
            </div>
        </div>
        <!-- Modal -->
    </main>
    <el-dialog
        v-model="centerDialogVisible"
        title="Lipa Na Mpesa"
       
        center
        destroy-on-close>
        <p class="text-dark fw-bold text-center">
            You will receive mpesa notification prompting you to pay KSH
            {{ cartStore.totalCost.toLocaleString() }}
        </p>
         <form action="" class="form ">
            <div class="form-group ">
                <label for="phone"></label>
                <input type="text" class="form-control text-center" placeholder="Enter mpesa number"  v-model="phone" >
            </div>
         </form>
      
        <template #footer>
            <span class="dialog-footer">
                <el-button type="primary" plain @click="handlePayment(phone)">
                    Get Payment Notification
                </el-button>
            </span>
        </template>
    </el-dialog>
</template>

<style scoped>
.dialog-footer button:first-child {
    margin-right: 10px;
}

.dialog-footer button:first-child {
    margin-right: 10px;
}


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
