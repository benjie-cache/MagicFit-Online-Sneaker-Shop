import { defineStore } from 'pinia';
import {reactive} from 'vue';
import axios from 'axios';

import { getToken, getHeadersWithoutToken, getHeaders,signUp, signIn,logOut } from './auth.js'; 
export const useTodoStore = defineStore({
  id: 'todos',
  state: () => ({
    items: reactive([]),
  }),

  actions:{
    updateItems(newItems){
      this.items = newItems;
    },

    addTask(newTask) {
      this.items.push(newTask);
    },
    deleteTask(deletedTask){
      const indexToRemove = this.items.indexOf(deletedTask);
      if (indexToRemove !== -1) {
          this.items.splice(indexToRemove, 1);
      }
      
    },
    markTaskComplete(completeTaskId){
      const foundItem=this.items.find((item)=> item.id ===completeTaskId);
      foundItem.done=true
    }
    
   
   
  },
});




export const useAuthStore = defineStore({
  id: 'users',
  state: () => ({
    user:  JSON.parse(localStorage.getItem('user')),
  
  }),
  actions: {
    getToken,
    getHeadersWithoutToken,
    getHeaders,
   
    async signUp(name, email, password) {
      this.user = await signUp(name, email, password);
    },
    async signin(email, password) {
      this.user = await signIn(email, password);
    },
    async logOut(){
      try{
        await logOut()
        
      }catch(error){
        console.error(error)
        throw error;
      }
      

    }
  },
});

