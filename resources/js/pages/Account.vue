<script setup>
import { useAuthStore } from "@/store/authStore.js";
import {ref } from 'vue';
import { useCustomerStore } from "@/store/customerStore.js";

import profile from '../../images/icons/profile.jpeg';
const customerStore=useCustomerStore();

const authStore=useAuthStore();

const handleLogout=async()=>{
    authStore.logOut()
};
const gridData = ref([]);

const dialogTableVisible = ref(false)
const viewOrderDetails=(items)=>{
    gridData.value=[];
    dialogTableVisible.value = true;
    gridData.value.push(...items)
};
</script>
<template lang="">
   <main class="main-wrapper">
     <div class="axil-dashboard-area axil-section-gap">
            <div class="container">
                <div class="axil-dashboard-warp"  v-if="authStore.user">
                    <div class="axil-dashboard-author">
                        <div class="media">
                            <div class="thumbnail">
                                <img :src="profile" alt="Profile Photo" style="height:30px">
                            </div>
                            <div class="media-body">
                                <h5 class="title mb-0 text-capitalize">Hello {{ customerStore.customerInfo.first_name }}</h5>
                                <span class="joining-date">Thanks for being such a loyal customer...we are your plug</span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-3 col-md-4">
                            <aside class="axil-dashboard-aside">
                                <nav class="axil-dashboard-nav">
                                    <div class="nav nav-tabs" role="tablist">
                                        <a class="nav-item nav-link active" data-bs-toggle="tab" href="#nav-dashboard" role="tab" aria-selected="true"><i class="fa fa-th-large"></i>Dashboard</a>
                                        <a class="nav-item nav-link" data-bs-toggle="tab" href="#nav-orders" @click="customerStore.getCustomerOrders()" role="tab" aria-selected="false"><i class="fa fa-shopping-basket"></i>Orders</a>
  
                                        <a class="nav-item nav-link" data-bs-toggle="tab" href="#nav-address" role="tab" aria-selected="false"><i class="fa fa-home"></i>Addresses</a>
                                        <a class="nav-item nav-link" data-bs-toggle="tab" href="#nav-account" role="tab" aria-selected="false"><i class="fa fa-user"></i>Account Details</a>
                                      <a class="nav-item nav-link" @click="handleLogout()"><i class="fa fa-sign-out"></i>Logout</a>
                                    </div>
                                </nav>
                            </aside>
                        </div>
                        <div class="col-xl-9 col-md-8">
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="nav-dashboard" role="tabpanel">
                                    <div class="axil-dashboard-overview">
                                        <div class="welcome-text">Hello {{ authStore.user.first_name }} (not <span>{{authStore.user.first_name}}?</span><a>Log Out</a> )</div>
                                        <p>From your account dashboard you can view your recent orders, manage your delivery address, and edit your password and account details.</p>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="nav-orders" role="tabpanel">
                                    <div class="axil-dashboard-order">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Order</th>
                                                        <th scope="col">Date</th>
                                                        <th scope="col">Status</th>
                                                        <th scope="col">Total</th>
                                                        <th scope="col">Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr v-for="(item,index) in customerStore.customerOrders ">
                                                        <th scope="row">#{{item.id }}</th>
                                                        <td>{{ item.date }}</td>
                                                        <td>{{ item.status }}</td>
                                                        <td>KSH {{ item.total_price }} for {{ item.item_quantity }} items</td>
                                                        <td><a @click="viewOrderDetails(item.orderItems)" class="axil-btn view-btn">View</a></td>
                                                    </tr>

                                           
                                                  
                                              
                                                  
                                                </tbody>
                                            </table>
                                            <el-pagination background layout="prev, pager, next" 
                                                                   :total="customerStore.total"  
                                                                    @current-change="customerStore.getCustomerOrders"  
                                                                    hide-on-single-page  />
                                        
                                        </div>
                                    </div>
                                </div>
                              
                                <div class="tab-pane fade" id="nav-address" role="tabpanel">
                                    <div class="axil-dashboard-address">
                                        <p class="notice-text">The following addresses will be used on the checkout page by default.</p>
                                        <div class="row row--30">
                                          
                                            <div class="col-lg-12">
                                                <div class="address-info">
                                                    <div class="addrss-header d-flex align-items-center justify-content-between">
                                                        <h4 class="title mb-0">Delivery  Address</h4>
                                                        <a href="#" class="address-edit"><i class="far fa-edit"></i></a>
                                                    </div>
                                                    <ul class="address-details">
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
                                        <a  @click="customerStore.handleDeliveryInfo()" class="axil-btn btn-bg-primary right-icon">
                                               Update Your Delivery Details
                           
                          <i class="fa fa-money" aria-hidden="true"></i></a>
                                    </div>

                                </form>
                                             
                                       
                                                        
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="nav-account" role="tabpanel">
                                    <div class="col-lg-9">
                                        <div class="axil-dashboard-account">
                                            <form class="account-details-form">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label>First Name</label>
                                                            <input type="text" class="form-control" v-model="authStore.user.first_name">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label>Last Name</label>
                                                            <input type="text" class="form-control" v-model="authStore.user.last_name">
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-12">
                                                        <div class="form-group mb--40">
                                                            <label>Email</label>
                                                            <input type="text" class="form-control" v-model="authStore.user.email">
                                                            <p class="b3 mt--10">This will be how your name will be displayed in the account section and in reviews</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <h5 class="title">Password Change</h5>
                                                        <div class="form-group">
                                                            <label>Password</label>
                                                            <input type="password" class="form-control" value="123456789101112131415">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>New Password</label>
                                                            <input type="password" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Confirm New Password</label>
                                                            <input type="password" class="form-control">
                                                        </div>
                                                        <div class="form-group mb--0">
                                                            <input type="submit" class="axil-btn" value="Save Changes">
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div v-else class="d-flex justify-content-center">
                    <div 
                        class="content"
                       
                    >
                        <span class="title-highlighter highlighter-secondary">
                            <i class="fa fa-exclamation-circle"></i>Hello there, Your are not logged in yet...</span
                        >
                      
                        <p>
                          Dont worry setting up and account with magic fit is a one-step process.<br>You can log in to keep track of your orders and provide your delivery address
                        </p>
                        <div class="d-flex-column justify-content-space-between">
                        <router-link
                            to="/login"
                          
                        ><a  class="axil-btn btn-bg-secondary right-icon">Go to Login
                            <i class="fa fa-shopping-basket"> </i></a>
                           
                        </router-link>
                        
                    </div>
                </div>
                </div>
            </div>
        </div>
    </main>
    <el-dialog v-model="dialogTableVisible" title="Order Details">
    <el-table :data="gridData">
      <el-table-column property="product_id" label="Product" width="150" />
      <el-table-column property="unit_price" label="Price" />
      <el-table-column property="quantity" label="Quantity" width="200" />
      <el-table-column property="total" label="Total" />
     
    </el-table>
  </el-dialog>
</template>

