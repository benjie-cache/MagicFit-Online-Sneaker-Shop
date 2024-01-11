<script setup>
import { defineAsyncComponent, reactive, ref, watch } from "vue";
import { ElNotification } from "element-plus";


import { useAuthStore } from "@/store/authStore.js";

import { useOrderStore } from "@/store/orderStore.js";

import useCartStore from "@/store/cartStore.js";
const authStore = useAuthStore();
const cartStore = useCartStore();
const orderStore = useOrderStore();
const paymentMethod = ref(orderStore.paymentMethod);

const cartTotal = ref(parseFloat(cartStore.totalCost).toFixed(2));
const cartItems = ref(cartStore.items);
const showNotification = (title, message, type) => {
    ElNotification({
        title,
        message,
        type,
    });
};
watch(
    () => cartStore.items,
    (newItems) => {
        cartItems.value = newItems;
    }
);
watch(
    () => cartStore.totalCost,
    (newTotalCost) => {
        cartTotal.value = parseFloat(newTotalCost).toFixed(2);
    }
);



</script>
<template lang="">
    <main class="main-wrapper">
        <div class="axil-checkout-area axil-section-gap">
            <div class="container">
                <form action="#">
                    <div class="row">
                        <div class="col-lg-8">
                            <div
                                class="axil-checkout-notice"
                                v-if="!authStore.user"
                            >
                                <div class="axil-toggle-box">
                                    <div class="toggle-bar">
                                        <i class="fas fa-user"></i> Returning
                                        customer?
                                        <a
                                            href="javascript:void(0)"
                                            class="toggle-btn"
                                            >Click here to login
                                            <i class="fas fa-angle-down"></i
                                        ></a>
                                    </div>
                                    <div
                                        class="axil-checkout-login toggle-open"
                                    >
                                        <p>
                                            If you didn't Logged in, Please Log
                                            in first.
                                        </p>
                                        <div class="signin-box">
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input
                                                    type="email"
                                                    class="form-control"
                                                    name="email"
                                                />
                                            </div>
                                            <div class="form-group">
                                                <label>Password</label>
                                                <input
                                                    type="password"
                                                    class="form-control"
                                                    name="password"
                                                />
                                            </div>
                                            <div class="form-group mb--0">
                                                <button
                                                    type="submit"
                                                    class="axil-btn btn-bg-primary submit-btn"
                                                >
                                                    Sign In
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="axil-checkout-billing">
                                <h4 class="title mb--40">Billing details</h4>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label
                                                >First Name
                                                <span>*</span></label
                                            >
                                            <input
                                                type="text"
                                                id="first-name"
                                                placeholder="Adam"
                                            />
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label
                                                >Last Name <span>*</span></label
                                            >
                                            <input
                                                type="text"
                                                id="last-name"
                                                placeholder="John"
                                            />
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Estate <span>*</span></label>
                                            <input
                                                type="text"
                                                id="estate"
                                                placeholder="Where do you live?"
                                            />
                                        </div>
                                    </div>
                                    <div>
                                        <div class="form-group">
                                            <label
                                                >Street Address
                                                <span>*</span></label
                                            >
                                            <input
                                                type="text"
                                                id="address1"
                                                class="mb--15"
                                                placeholder="House number and street name"
                                            />
                                            <input
                                                type="text"
                                                id="address2"
                                                placeholder="Apartment, suite, unit, etc. (optonal)"
                                            />
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Phone <span>*</span></label>
                                    <input type="tel" id="phone" />
                                </div>

                                <div class="form-group input-group"   v-if="!authStore.user">
                                    <input
                                        type="checkbox"
                                        id="checkbox1"
                                        name="account-create"
                                    />
                                    <label for="checkbox1"
                                        >Create an account</label
                                    >
                                </div>
                                <div class="form-group different-shippng">
                                    <div class="toggle-bar">
                                        <a
                                            href="javascript:void(0)"
                                            class="toggle-btn"
                                        >
                                            <input
                                                type="checkbox"
                                                id="checkbox2"
                                                name="diffrent-ship"
                                            />
                                            <label for="checkbox2"
                                                >Ship to a different
                                                address?</label
                                            >
                                        </a>
                                    </div>
                                    <div class="toggle-open">
                                        <div class="form-group">
                                            <label
                                                >Country/ Region
                                                <span>*</span></label
                                            >
                                            <select id="Region">
                                                <option value="3">
                                                    Australia
                                                </option>
                                                <option value="4">
                                                    England
                                                </option>
                                                <option value="6">
                                                    New Zealand
                                                </option>
                                                <option value="5">
                                                    Switzerland
                                                </option>
                                                <option value="1">
                                                    United Kindom (UK)
                                                </option>
                                                <option value="2">
                                                    United States (USA)
                                                </option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label
                                                >Street Address
                                                <span>*</span></label
                                            >
                                            <input
                                                type="text"
                                                id="address1"
                                                class="mb--15"
                                                placeholder="House number and street name"
                                            />
                                            <input
                                                type="text"
                                                id="address2"
                                                placeholder="Apartment, suite, unit, etc. (optonal)"
                                            />
                                        </div>
                                        <div class="form-group">
                                            <label
                                                >Town/ City
                                                <span>*</span></label
                                            >
                                            <input type="text" id="town" />
                                        </div>
                                        <div class="form-group">
                                            <label>Country</label>
                                            <input type="text" id="country" />
                                        </div>
                                        <div class="form-group">
                                            <label>Phone <span>*</span></label>
                                            <input type="tel" id="phone" />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Other Notes (optional)</label>
                                    <textarea
                                        id="notes"
                                        rows="2"
                                        placeholder="Notes about your order, e.g. speacial notes for delivery."
                                    ></textarea>
                                </div>
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
                                    v-for="(item, index) in cartItems"
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
                                    <span class="text-muted"
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
                                        {{ cartTotal.toLocaleString() }}</strong
                                    >
                                </li>
                            </ul>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>
</template>

<style lang=""></style>
