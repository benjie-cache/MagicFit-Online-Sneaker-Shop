<script setup>
import useCartStore  from '../../store/cartStore';
import {ref,watch } from 'vue';
const cartStore=useCartStore();

const cartTotal = ref(parseFloat(cartStore.totalCost).toFixed(2));
const cartItems=ref(cartStore.items);

watch(() => cartStore.items, (newItems) => {
  cartItems.value = newItems;
});
watch(() => cartStore.totalCost, (newTotalCost) => {
  cartTotal.value = parseFloat(newTotalCost).toFixed(2);
});

</script>
<template lang="">
      <div class="axil-order-summery order-checkout-summery">
                                <h5 class="title mb--20">Your Order</h5>
                                <div class="summery-table-wrap">
                                    <table class="table summery-table">
                                        <thead>
                                            <tr>
                                                <th>Product</th>
                                                <th>Subtotal</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="order-product" v-for="(item ,index) in cartItems" :key="index">
                                                <td>{{item.name}}<span class="quantity">x{{item.quantity}}</span></td>
                                                <td>KSH {{item.subtotal}}</td>
                                            </tr>
                                           
                                            <tr class="order-total">
                                                <td>Cart Total</td>
                                                <td class="order-total-amount">KSH {{cartTotal}}</td>
                                                
                                            </tr>
                                            <tr class="order-total">
                                                <td>Delivery Fee</td>
                                                <td class="order-total-amount">KSH 200</td>
                                            </tr>
                                            <tr class="order-total">
                                                <td>Total</td>
                                                <td class="order-total-amount">KSH 200</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="order-payment-method">
                                    <div class="single-payment">
                                        <div class="input-group">
                                            <input type="radio" id="radio4" name="payment">
                                            <label for="radio4">Lipa Na Mpesa</label>
                                        </div>
                                        <p>We a going to send a payment notification to your phone.Enter your details to fulfill your order</p>
                                    </div>
                                    <div class="single-payment">
                                        <div class="input-group">
                                            <input type="radio" id="radio5" name="payment">
                                            <label for="radio5">Cash on delivery</label>
                                        </div>
                                        <p>Pay with cash upon delivery.</p>
                                    </div>
                                    <div class="single-payment">
                                        <div class="input-group justify-content-between align-items-center">
                                            <input type="radio" id="radio6" name="payment" checked>
                                            <label for="radio6">Binance Wallet</label>
                                           
                                        </div>
                                        <p>We accept transfer of stable coins into our wallet.(USDT)</p>
                                    </div>
                                </div>
                                <button type="submit" class="axil-btn btn-bg-primary checkout-btn">Process to Checkout</button>
                            </div>
</template>

<style lang="">
    
</style>