<script setup>
import {onMounted,ref}  from "vue";
import { ElNotification,ElMessageBox } from "element-plus";

import { useAuthStore } from "@/store/authStore.js";
import { useCustomerStore } from "@/store/customerStore.js";


import useCartStore from "@/store/cartStore.js";
import { useRouter } from "vue-router";





const authStore = useAuthStore();
const cartStore = useCartStore();

const customerStore= useCustomerStore();
const phone_number=ref('')


const router=useRouter()
const processOrder = async () => {

if(cartStore.items.length){
    try {
    const headers = authStore.getHeaders();
    const data = {
      'orderItems': cartStore.items,
      'cartTotal': cartStore.totalCost
    };

    const res = await axios.post('api/checkout/process-order', JSON.stringify(data), { headers });

    // Check the status from the response
    if (res.status === 200 && res.data && res.data.message === 'Order processed') {
    
   
        paymentModalOpen.value =! paymentModalOpen.value
      showNotification('Success', 'Order processed successfully', 'success');
      ElMessageBox.confirm('Order placed successfully. What would you like to do?', 'Success', {
        confirmButtonText: 'View Orders',
        cancelButtonText: 'Continue Shopping',
        type: 'success'
      }).then(() => {
          router.push({name:'account'})
         
      }).catch(() => {
       
        router.push({name:'shop'})
      
      });
    } else {
      //Handle other status or errors
      showNotification('Error', res.data.message || 'There was an issue processing the order', 'error');
    }

    cartStore.clearCart();
  } catch (error) {
    console.error('Error processing order:', error);
    showNotification('Error', 'There was an unexpected error processing the order', 'error');
  }
}else{
    showNotification('No Cart Items',"You have no items in your cart",'warning')
}
 


};
const paymentModalOpen=ref(false);
const loading = ref(false)
const handlePayment = () => {
  loading.value = true;
  setTimeout(() => {
    //processOrder();
    loading.value = false;

  }, 5000);
};

const showNotification = (title, message, type) => {
    ElNotification({
        title,
        message,
        type,
    });
};
const togglePaymentModal=()=>{
    paymentModalOpen.value =! paymentModalOpen.value
};

</script>
<template lang="">
    <main class="main-wrapper">
        <div class="axil-checkout-area axil-section-gap">
            <div class="container" v-if="cartStore.items.length">
                <form action="#">
                    <div class="row">
                        <div class="col-lg-8">
                            
                            <div class="axil-checkout-billing">
                                <h4 class="title mb--40">Receiver details</h4>
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
                                                v-model="customerStore.customerInfo.first_name"
                                                
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
                                                v-model="customerStore.customerInfo.last_name"
                                            />
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label>Phone <span>*</span></label>
                                            <input
                                                type="text"
                                                id="phone"
                                                placeholder="Phone Number"
                                                v-model="customerStore.customerInfo.phone"
                                            />
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label>Estate <span>*</span></label>
                                            <input
                                                type="text"
                                                id="estate"
                                                placeholder="Where do you live?"
                                                v-model="customerStore.customerInfo.addresses[0].estate"
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
                                                v-model="customerStore.customerInfo.addresses[0].street_address"
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
                                                v-model="customerStore.customerInfo.addresses[0].apartment_name"
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
                                                v-model="customerStore.customerInfo.addresses[0].house_number"
                                            />
                                        </div>

                                        <button
                                            type="submit"
                                            class="axil-btn btn-bg-primary viewcart-btn"
                                        >
                                           Update Receiver Details
                                        </button>
                                    </div>
                                </form>

                               
                            </div>
                        </div>
                        <div class="col-md-4 order-md-2 mb-4 ">
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
                                        {{ cartStore.totalCost.toLocaleString() }}</strong
                                    >
                                </li>
                            </ul>
                            <button
                                type="button"
                            class="axil-btn btn-bg-secondary checkout-btn"
                                data-bs-toggle="modal"
                                data-bs-target="#staticBackdrop"
                               @click.prevent="togglePaymentModal"
                            >
                                <i class="fa fa-rocket"></i> Pay Now
                        </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="d-flex justify-content-center" v-else>
                <div 
                        class="content"
                       
                    >
                        <span class="title-highlighter highlighter-secondary">
                            <i class="fa-solid fa-circle-exclamation"></i> You have no products in your Cart to checkout</span
                        >
                      
                        <p>
                          Continue Shopping if you find products you like add them....
                        </p>
                        <router-link
                            to="/shop"
                            class="axil-btn btn-bg-secondary right-icon"
                        >
                            Back To Shopping
                            <i class="fa fa-cart-arrow-down"></i>
                        </router-link>
            </div>
            </div>
            
        </div>
        <!-- Modal -->
    </main>
    <div 
        class="modal fade"
        id="staticBackdrop"
        data-bs-backdrop="static"
        data-bs-keyboard="false"
        tabindex="-1"
        aria-labelledby="staticBackdropLabel"
        aria-hidden="true"
       
    >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body" v-loading="loading" element-loading-text="Processing Payment">
                    <div class="text-right">
                        <i
                            class="fa fa-close close"
                            data-bs-dismiss="modal"
                        ></i>
                    </div>
                    <div class="tabs mt-3">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            
                          
                        </ul>
                        <div class="tab-content" id="myTabContent">
                           
                            <div
                                class="tab-pane fade show active"
                                id="paypal"
                                role="tabpanel"
                                aria-labelledby="paypal-tab"
                            >
                                <div class="px-5 mt-5">
                                    <div class="text-center">
                                        <h5>Lipa na M-pesa</h5>
                                        <p class="text-dark">You will receive mpesa notification prompting you to pay KSH
                                        {{ cartStore.totalCost.toLocaleString() }}</p>
                                    </div>
                                    <form  >
                                    <div class="inputbox">
                                        <input v-model="phone_number"
                                           type="tel"
                                            name="mpesa number"
                                            class="form-control"
                                            required="required"
                                        />
                                        <span>Your Mobile Number</span>
                                    </div>
                                    <div class="pay px-5">
                                        <a
                                        @click.prevent="handlePayment"
                                         type="submit"
                                            class="axil-btn btn-outline"
                                        >
                                            Get Payment Notification
                                    </a>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
.launch {
    height: 50px;
}

.close {
    font-size: 21px;
    cursor: pointer;
}

.modal-body {
    height: auto;
}

.nav-tabs {
    border: none !important;
}

.nav-tabs .nav-link.active {
    color: #495057;
    background-color: #fff;
    border-color: #ffffff #ffffff #fff;
    border-top: 3px solid rgb(54, 4, 50) !important;
}

.nav-tabs .nav-link {
    margin-bottom: -1px;
    border: 1px solid transparent;
    border-top-left-radius: 0rem;
    border-top-right-radius: 0rem;
    border-top: 3px solid #eee;
    font-size: 20px;
}

.nav-tabs .nav-link:hover {
    border-color: #e9ecef #ffffff #ffffff;
}

.nav-tabs {
    display: table !important;
    width: 100%;
}

.nav-item {
    display: table-cell;
}

.form-control {
    border-bottom: 1px solid #807777 !important;
    border: none;
    font-weight: 600;
}

.form-control:focus {
    color: #495057;
    background-color: #fff;
    border-color: #8bbafe;
    outline: 0;
    box-shadow: none;
}

.inputbox {
    position: relative;
    margin-bottom: 20px;
    width: 100%;
}

.inputbox span {
    position: absolute;
    top: 7px;
    left: 11px;
    transition: 0.5s;
}

.inputbox i {
    position: absolute;
    top: 13px;
    right: 8px;
    transition: 0.5s;
    color: #3f51b5;
}

input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}

.inputbox input:focus~span {
    transform: translateX(-0px) translateY(-15px);
    font-size: 12px;
}

.inputbox input:valid~span {
    transform: translateX(-0px) translateY(-15px);
    font-size: 12px;
}

.pay button {
    height: 30px;
    border-radius: 37px;
}</style>
