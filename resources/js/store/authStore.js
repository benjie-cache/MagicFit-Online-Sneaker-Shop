// store/authStore.js
import { defineStore } from 'pinia';
import axios from 'axios';
import { useRouter } from 'vue-router';

export const useAuthStore = defineStore({
  id: 'auth',
  state: () => ({
    user: JSON.parse(localStorage.getItem('user')) || null,
    token: localStorage.getItem('token') || null,
    router : useRouter()
  }),
  actions: {

    async signUp(first_name, email, password) {
      try {
        const headers = this.getHeadersWithoutToken()
        const response = await axios.post('api/auth/register', {
          first_name,
          email,
          password,
        },
        {headers}
        );

        const { user, token } = response.data.data;
        this.setUserToken(user, token);

        return user;
      } catch (error) {
        console.error('There was an error signing up', error.message);
        throw error;
      }
    },

    async signIn(email, password) {
      try {
        const headers = this.getHeadersWithoutToken()
   
        const response = await axios.post('api/auth/login', {
          email,
          password,
        },
          {headers});

        const { user, token } = response.data.data;
        this.setUserToken(user, token);
    
        return user;
      } catch (error) {
        console.error('There was an error signing in:', error.message);
        throw error;
      }
    },

    async logOut() {
      try {
        const headers = this.getHeaders();
        await axios.post('api/auth/logout', null, { headers });

        this.clearUserToken();
       
        this.router.push({ name: 'login' });
      } catch (error) {
        console.error('There was an error logging out ', error);
        throw error;
      }
    },

    // Helper function to set user and token in the state and localStorage
    setUserToken(user, token) {
      try {
        this.user = user;
        this.token = token;

        localStorage.setItem('user', JSON.stringify(user));
        localStorage.setItem('token', token);
      } catch (error) {
        console.error('There was an error setting user token', error);
        throw error;
      }
    },

    // Helper function to clear user and token from the state and localStorage
    clearUserToken() {
      try {
        this.user = null;
        this.token = null;

        localStorage.removeItem('user');
        localStorage.removeItem('token');
      } catch (error) {
        console.error('There was an error clearing user token', error);
        throw error;
      }
    },
    // Helper function to get headers without token
    getHeadersWithoutToken() {
      return {
        "Content-Type": "application/json"
      };
    },
    //Helper function to get headers with token
    getHeaders() {
      return {
        'Content-Type': 'application/json',
        Authorization: `Bearer ${this.token}`,
      };
    },
  },
});
