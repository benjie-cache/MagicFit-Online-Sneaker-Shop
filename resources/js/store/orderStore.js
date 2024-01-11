import { defineStore } from 'pinia';
import useCartStore from "@/store/cartStore.js";
import axios from 'axios'; 
import { ElNotification, ElLoading  } from "element-plus";
import { useAuthStore } from "@/store/authStore.js";
const cartStore=useCartStore();
const authStore=useAuthStore();
const headers=authStore.getHeadersWithoutToken()
const showNotification = (title, message, type) => {
  ElNotification({
    title,
    message,
    type,
  });
};

export const useOrderStore = defineStore('order', {
  state: () => ({
    step: 'signin',
    signinData: null,
    signupData: null,
    billingInfo:{
      first_name:'',
      last_name:'',
      estate:'',
      street_address:'',
      apartment_name:'',
      house_number:'',
      phone:'',
      },
    paymentInfo: null,
    orderDetails: null,
  }),

  actions: {
    // Method to update the active step
    updateStep(step) {
      this.step = step;
      // Persist the current step in local storage
      localStorage.setItem('checkoutStep', step);
    },

    // Method to load the saved step from local storage
    loadSavedStep() {
      const savedStep = localStorage.getItem('checkoutStep');
      if (savedStep) {
        this.step = savedStep;
      }
    },

    // Method to clear saved step when the checkout is completed
    clearSavedStep() {
      localStorage.removeItem('checkoutStep');
    },

    // Method to handle the optional login or sign in step
    async handleSignIn(isGuest) {
      // You can customize this method based on your authentication logic
      if (isGuest) {
        // If the user chooses guest checkout, move to the billing info step
        this.updateStep('billingInfo');
      } else {
        // If the user chooses to sign in, handle the sign-in logic
        // For simplicity, we'll assume a synchronous sign-in process
        // Replace the following lines with your actual sign-in logic
        const signInSuccess = await this.simulateSignIn(); // Simulated synchronous sign-in
        if (signInSuccess) {
          // If sign-in is successful, move to the billing info step
          this.updateStep('billingInfo');
        } else {
          // Handle the case where sign-in fails
          console.error('Sign-in failed');
          // Optionally, you may want to redirect the user to the sign-in page or show an error message
        }
      }
    },

    //Method to handle the billing info step
    async handleBillingInfo() {
      const CHECKOUT_INFO_SAVE_URL='api/checkout/save_checkout_information'
      const headers={   "Content-Type": "application/json"}
      const response = await axios.post(CHECKOUT_INFO_SAVE_URL,JSON.stringify(this.billingInfo),{headers})

      // Check the server response to determine whether to move to the next step
      if (response.success) {
       
        this.updateStep('paymentInfo');
      } else {
        // Handle the case where saving billing info fails
        console.error('Saving billing info failed:', response.error);
        // Optionally, you may want to show an error message to the user
      }
    },

    // Method to simulate a sign-in (replace this with your actual sign-in logic)
    async simulateSignIn() {
      return new Promise((resolve) => {
        setTimeout(() => {
          resolve(true); // Simulate a successful sign-in
        }, 1000); // Simulated delay for sign-in
      });
    },

   
    //Method to handle the payment process step
    async handlePayment(paymentData) {
      // Make an asynchronous request to simulate the payment process
      const paymentSuccess = await this.simulatePayment(paymentData);

      // Check whether the payment was successful
      if (paymentSuccess) {
        // If the payment is successful, move to the finish order process step
        this.updateStep('finishOrder');
      } else {
        // Handle the case where the payment fails
        console.error('Payment failed');
        // Optionally, you may want to show an error message to the user
      }
    },

    // Method to simulate the payment process (replace this with your actual payment processing logic)
    async simulatePayment(paymentData) {
      return new Promise((resolve) => {
        setTimeout(() => {
          // Simulate a successful payment (true) or a failed payment (false)
          resolve(Math.random() < 0.8); // Simulate an 80% success rate
        }, 1000); // Simulated delay for payment processing
      });
    },
  },
});
