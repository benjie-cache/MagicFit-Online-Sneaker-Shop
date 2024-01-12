<script setup>
import { useAuthStore } from "@/store/authStore.js";

const authStore=useAuthStore()
</script>
<template lang="">
   <main class="main-wrapper">
     <div class="axil-dashboard-area axil-section-gap">
            <div class="container">
                <div class="axil-dashboard-warp">
                    <div class="axil-dashboard-author">
                        <div class="media">
                            <div class="thumbnail">
                                <img src="" alt="Hello Ben">
                            </div>
                            <div class="media-body">
                                <h5 class="title mb-0">Hello Ben</h5>
                                <span class="joining-date">You have been a loyal customer since 1 Jan 2023,Thanks</span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-3 col-md-4">
                            <aside class="axil-dashboard-aside">
                                <nav class="axil-dashboard-nav">
                                    <div class="nav nav-tabs" role="tablist">
                                        <a class="nav-item nav-link active" data-bs-toggle="tab" href="#nav-dashboard" role="tab" aria-selected="true"><i class="fa fa-th-large"></i>Dashboard</a>
                                        <a class="nav-item nav-link" data-bs-toggle="tab" href="#nav-orders" role="tab" aria-selected="false"><i class="fa fa-shopping-basket"></i>Orders</a>
                                        <a class="nav-item nav-link" data-bs-toggle="tab" href="#nav-downloads" role="tab" aria-selected="false"><i class="fa fa-file-download"></i>Downloads</a>
                                        <a class="nav-item nav-link" data-bs-toggle="tab" href="#nav-address" role="tab" aria-selected="false"><i class="fa fa-home"></i>Addresses</a>
                                        <a class="nav-item nav-link" data-bs-toggle="tab" href="#nav-account" role="tab" aria-selected="false"><i class="fa fa-user"></i>Account Details</a>
                                     <router-link  to="/login">  <a class="nav-item nav-link"><i class="fa fa-sign-out"></i>Logout</a></router-link> 
                                    </div>
                                </nav>
                            </aside>
                        </div>
                        <div class="col-xl-9 col-md-8">
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="nav-dashboard" role="tabpanel">
                                    <div class="axil-dashboard-overview">
                                        <div class="welcome-text">Hello Ben (not <span>Ben?</span><router-link to="/register"><a>Log Out</a></router-link> )</div>
                                        <p>From your account dashboard you can view your recent orders, manage your shipping and billing addresses, and edit your password and account details.</p>
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
                                                    <tr>
                                                        <th scope="row">#6523</th>
                                                        <td>Jan 1, 2023</td>
                                                        <td>Processing</td>
                                                        <td>KSH 3,600 for 3 items</td>
                                                        <td><a href="#" class="axil-btn view-btn">View</a></td>
                                                    </tr>
                                                  
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="nav-downloads" role="tabpanel">
                                    <div class="axil-dashboard-order">
                                        <p>You don't have any download</p>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="nav-address" role="tabpanel">
                                    <div class="axil-dashboard-address">
                                        <p class="notice-text">The following addresses will be used on the checkout page by default.</p>
                                        <div class="row row--30">
                                            <div class="col-lg-6">
                                                <div class="address-info mb--40">
                                                    <div class="addrss-header d-flex align-items-center justify-content-between">
                                                        <h4 class="title mb-0">Shipping Address</h4>
                                                        <a href="#" class="address-edit"><i class="far fa-edit"></i></a>
                                                    </div>
                                                    <ul class="address-details">
                                                        <li>Name:  user.name</li>
                                                        <li>Email:user.email</li>
                                                        <li>Phone:user.phone</li>
                                                        <li class="mt--30">user.address1 <br>
                                                     user.address2</li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="address-info">
                                                    <div class="addrss-header d-flex align-items-center justify-content-between">
                                                        <h4 class="title mb-0">Billing Address</h4>
                                                        <a href="#" class="address-edit"><i class="far fa-edit"></i></a>
                                                    </div>
                                                    <ul class="address-details">
                                                        <li>Name:  user.name</li>
                                                        <li>Email:user.email</li>
                                                        <li>Phone:user.phone</li>
                                                        <li class="mt--30">user.address1 <br>
                                                     user.address2</li>
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
                                                            <label>Country/ Region</label>
                                                            <select class="select2">
                                                                <option value="1">Wendani</option>
                                                                <option value="1">Kasarani</option>
                                                                <option value="1">Sukari</option>
                                                                <option value="1">Royasambu</option>
                                                            </select>
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
            </div>
        </div>
    </main>
</template>

