<template>
    <div class="d-flex justify-content-center">
        <div class="axil-signin-form">
            <h3 class="title">I'm New To MagicFit</h3>
            <p class="b2 mb--55">Enter your details below</p>
            <form class="singin-form" @submit.prevent="register">
                <div class="form-group">
                    <label>User Name</label>
                    <input
                        v-model="first_name"
                        type="text"
                        class="form-control"
                        name="first_name"
                    />
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input
                        v-model="email"
                        type="email"
                        class="form-control"
                        name="email"
                    />
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input
                        v-model="password"
                        type="password"
                        class="form-control"
                        name="password"
                    />
                </div>
                <div class="form-group">
                    <button
                        type="submit"
                        class="axil-btn btn-bg-primary submit-btn"
                    >
                        Create Account
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<script setup>
import { useAuthStore } from "@/store/authStore.js";
import { ref } from "vue";
import { useRouter } from "vue-router";
const router = useRouter();
const first_name = ref("");
const email = ref("");
const password = ref("");

const register = async () => {
    try {
        await useAuthStore().signUp(
            first_name.value,
            email.value,
            password.value
        );
        // Redirect to a new route after successful registration
        // For example, you can redirect to the login page
        try{
            router.push({ name: "home" });
        }catch(error){
            console.error('Redirect failed',error.message)
        }
        
    } catch (error) {
        console.error("Registration failed:", error.message);
        // Handle registration failure (e.g., show an error message to the user)
    }
};
</script>
