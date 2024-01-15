import { defineStore } from 'pinia';
import { ElNotification } from 'element-plus';

const showNotification = () => {
  ElNotification({
    title,
    message,
    type,
  });
};

export const useCustomerStore = defineStore({
  id: 'customer',
  state: () => ({
    customerInfo: JSON.parse(localStorage.getItem('customerInfo')) || null,
  }),
  actions: {
    setCustomerInfo(customerInfo) {
      this.customerInfo = customerInfo;
      localStorage.setItem('customerInfo', JSON.stringify(customerInfo));
    },
    clearCustomerInfo() {
      this.customerInfo = null;
      localStorage.removeItem('customerInfo');
    },
  },
});


