<script setup>
import { useCustomerStore } from "@/store/customerStore.js";
import {ref } from 'vue';
const customerStore = useCustomerStore();
const formReadOnly = ref(true);
const toggleReadOnly = () => {
    formReadOnly.value = !formReadOnly.value;
};
</script>
<template>
    <div class="col-lg-8">
                <div class="axil-checkout-billing">
                    <div class="addrss-header d-flex align-items-center justify-content-between">
                        <h4 class="title mb-20 py-5">
                            Delivery Address<br>
                            <p>These details have been prefilled from your customer account</p>
                        </h4>
                        <el-switch v-model="formReadOnly" size="large" active-text="Edit Your Details"
                            inactive-text="Details are fine" class="ml-2" inline-prompt style="
                                            --el-switch-on-color: #13ce66;
                                            --el-switch-off-color: #ff4949;
                                        " />
                    </div>
                    <form>
                        <div class="row">
                            <div class="form-group col-lg-6">
                                <label>First Name
                                    <span>*</span></label>
                                <input type="text" id="first-name" placeholder="Your First Name" v-model="customerStore.customerInfo
                                        .first_name
                                    " :readonly="formReadOnly" ref="firstNameInput" />
                            </div>
                            <div class="form-group col-lg-6">
                                <label>Last Name <span>*</span></label>
                                <input type="text" id="last-name" placeholder="Enter Your Last Name" v-model="customerStore.customerInfo
                                        .last_name
                                    " :readonly="formReadOnly" />
                            </div>
                            <div class="form-group col-lg-6">
                                <label>Phone <span>*</span></label>
                                <input type="text" id="phone" placeholder="Phone Number" v-model="customerStore.customerInfo
                                        .phone
                                    " :readonly="formReadOnly" />
                            </div>
                            <div class="form-group col-lg-6">
                                <label>Estate <span>*</span></label>
                                <input type="text" id="estate" placeholder="Where do you live?" :readonly="formReadOnly"
                                    v-model="customerStore.customerInfo
                                            .addresses[0].estate
                                        " />
                            </div>
                            <div class="form-group col-lg-6">
                                <label>Street Name
                                    <span>*</span></label>
                                <input type="text" id="address1" class="mb--15" placeholder="Street Name"
                                    :readonly="formReadOnly" v-model="customerStore.customerInfo
                                            .addresses[0]
                                            .street_address
                                        " />
                            </div>

                            <div class="form-group col-lg-6">
                                <label>Apartment Name
                                    <span>*</span></label>
                                <input type="text" id="address2" placeholder="Apartment Name" :readonly="formReadOnly"
                                    v-model="customerStore.customerInfo
                                            .addresses[0]
                                            .apartment_name
                                        " />
                            </div>
                            <div class="form-group col-lg-6">
                                <label>House Number
                                    <span>*</span></label>
                                <input type="text" id="address2" placeholder="House Number" :readonly="formReadOnly"
                                    v-model="customerStore.customerInfo
                                            .addresses[0]
                                            .house_number
                                        " />
                            </div>
                            <a v-if="!formReadOnly" @click="customerStore.handleDeliveryInfo()"
                                class="axil-btn btn-bg-primary right-icon">
                                Update Your Delivery Details

                                <i class="fa fa-money" aria-hidden="true"></i></a>
                        </div>

                    </form>
                </div>
            </div>
          
           
      
   
</template>