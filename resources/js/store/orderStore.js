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
    billingDetails: {
      firstName: '',
      lastName: '',
      estate: '',
      homeAddress: '',
      phone: '',
      email: '',
    },
    billingInfoProcessed:false,

    paymentMethod: '',
    paymentIsProcessed:false,
    notes: '',

    
    cardDetails: {
      username: '',
      cardNumber: '',
      expiryMonth: '',
      expiryYear: '',
      cvv: '',
    },
    phoneNumber: '',

    isOrderProcessed: false,
  }),

  actions: {
    updateBillingDetails(details) {
      
      this.billingDetails = { ...this.billingDetails, ...details };
    },

    updatePaymentMethod(method) {
      // Implement validation logic if necessary
      this.paymentMethod = method;
    },

    updateNotes(notes) {
      this.notes = notes;
    },

    async processOrder() {
      try {
         // Start the loading indicator
         

        const response = await axios.post('/api/orders', {
         // billingDetails: this.billingDetails,
        //  paymentMethod: this.paymentMethod,
          order_items: cartStore.items,
        },
        {headers}
        );
        const loadingInstance = ElLoading.service({
          fullscreen: true, 
        });
        if (response.data && response.data.success) {
          this.isOrderProcessed = true;
          loadingInstance.close();
          this.showNotification("Success", "Order Processed successfully", "success");
        } else {
          loadingInstance.close();
          this.showNotification("Failed", "Checkout Failed", "warning");
        }
      } catch (error) {
        console.error('Error processing the order:', error);
        loadingInstance.close();
        this.showNotification("Error", "An error occurred while processing the order.", "error");
      } 
    },

    // Additional method to reset the order store state
    resetOrderState() {
      this.billingDetails = {
        firstName: '',
        lastName: '',
        estate: '',
        homeAddress: '',
        phone: '',
        email: '',
      };
      this.paymentMethod = '';
      this.notes = '';
      this.isOrderProcessed = false;
      this.cardDetails = {
        username: '',
        cardNumber: '',
        expiryMonth: '',
        expiryYear: '',
        cvv: '',
      };
      this.phoneNumber = '';
    },
  },
});
