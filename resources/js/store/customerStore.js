import { defineStore } from 'pinia';
import { ElNotification } from 'element-plus';
import { useAuthStore } from "@/store/authStore.js";
const showNotification = (title,message,type) => {
  ElNotification({
    title,
    message,
    type,
  });
};

export const useCustomerStore = defineStore({
  id: 'customer',
  state: () => ({
    customerInfo:JSON.parse(localStorage.getItem('customerInfo')) ||null,
    customerOrders:null,
    current_page: 1,
    totalPages: 1,
    total:1,
    per_page:1,
    

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
    isNonEmptyString(value){
      return typeof value === 'string' && value.trim() !== '';
    },
    
    isValidKenyanPhoneNumber(phoneNumber){
      const cleanedPhoneNumber = phoneNumber.replace(/\s/g, '');
      const kenyanPhoneNumberRegex = /^(\+2547\d{8}|07\d{8})$/;
      return kenyanPhoneNumberRegex.test(cleanedPhoneNumber);
    },
    
    isValidAddress(address){
      const addressRequiredFields = ["estate", "street_address", "apartment_name", "house_number"];
    
      for (const field of addressRequiredFields) {
        if (!this.isNonEmptyString(address[field])) {
          return false;
        }
      }
    
      return true;
    },
    
    isValidCustomerInfo(customerInfo){
      if (!customerInfo) {
        showNotification("Warning", "Invalid delivery Info: Missing customer data", "warning");
        return false;
      }
    
      const requiredFields = ['first_name', 'last_name', 'phone'];
    
      for (const field of requiredFields) {
        if (!this.isNonEmptyString(customerInfo[field])) {
          showNotification("Warning", `Invalid delivery Info: ${field} is required`, "warning");
          return false;
        }
      }
    
      if (!this.isValidKenyanPhoneNumber(customerInfo.phone)) {
        showNotification("Warning", "Invalid delivery Info: Invalid Kenyan phone number", "warning");
        return false;
      }
    
      const addresses = customerInfo.addresses;
    
      if (!Array.isArray(addresses) || addresses.length === 0) {
        showNotification("Warning", "Invalid delivery Info: Missing address data", "warning");
        return false;
      }
    
      if (!this.isValidAddress(addresses[0])) {
        showNotification("Warning", "Invalid delivery Info: Address details are incomplete", "warning");
        return false;
      }
    
     // showNotification("Success", "Delivery details are valid you can checkout", "success");
      return true;
    },
    
    
    async handleDeliveryInfo() {
      const UPDATE_DELIVERY_INFO_URL='api/customer/update-delivery-info'
      const authStore=useAuthStore();
      const headers = authStore.getHeaders();
      console.log(JSON.stringify(this.customerInfo))
      const response = await axios.post(UPDATE_DELIVERY_INFO_URL,JSON.stringify(this.customerInfo),{headers})
      console.log(response)
      if (response.status==200) {
           showNotification("Success","Your delivery details have been updated","success")
            console.log('update was successful')
            authStore.getCustomerInfo()
      } else if(response.status==201){
        showNotification("Success","Your customer account created and updated","success")
        // Handle the case where there is a new customer created
       // showNotification("Warning","There was an error updating your details","warning")
        console.log('Account Info Updated:', response.message);
        authStore.getCustomerInfo()
       
      }else{
        console.log("There was an issue saving/creating customer account")
        showNotification("Warning","There was an error updating your details","warning")
      }
    },
    async getCustomerOrders(newPage=1){
      const GET_CUSTOMER_ORDERS_URL='api/customer/get-customer-orders'
      const authStore=useAuthStore();
      const headers = authStore.getHeaders();
      
      const response = await axios.get(GET_CUSTOMER_ORDERS_URL, {
        headers,
          params:  {page: newPage }
      
      
       });
     console.log(response)
      if (response.status==200) {
             this.customerOrders=response.data.data
        //   showNotification("Success","Your delivery details have been updated","success")
            console.log('Customer Orders Returned Successfully')

            this.totalPages = response.data.meta.last_page;
            this.current_page = response.data.meta.current_page;
            this.total=response.data.meta.total;
           this.per_page=response.data.meta.per_page
          
       
      } else {

        console.error('There was a problem with returning of customer orders:', response.error);
       
      }
    },
    handlePageChange(newPage) {
      this.getCustomerOrders(newPage);
    },

  },
});


