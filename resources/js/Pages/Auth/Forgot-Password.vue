<template>
    <div class="forgot-password-container d-flex justify-content-center align-items-center">
      <div class="forgot-password-form p-4 border rounded shadow-sm">
        <h2 class="text-center mb-4">Forgot Your Password?</h2>
        <p class="text-center mb-4">Enter your email address and we'll send you a link to reset your password.</p>

        <form @submit.prevent="handlePasswordReset">

          <div class="form-group">
            <label for="resetEmail">Email Address</label>
            <input
              type="email"
              id="resetEmail"
              class="form-control"
              v-model="resetEmail"
              placeholder="Enter your email"
              required
            />
          </div>


          <div class="d-flex justify-content-center mt-4">
            <button type="submit" class="btn btn-custom btn-block">Send Reset Link</button>
          </div>
        </form>

        <p class="mt-3 text-center">
          Remember your password? <Link :href="route('login')">Login</Link>
        </p>
      </div>
    </div>
  </template>

  <script>
  import { Link } from '@inertiajs/vue3';

  export default {
    components: {
        Link
    },
    data() {
      return {
        resetEmail: '',
      };
    },
    methods: {
      handlePasswordReset() {

        if (this.resetEmail) {
          console.log('Password reset link sent to:', this.resetEmail);

          alert('A password reset link has been sent to your email address.');
        } else {
          alert('Please enter a valid email address.');
        }
      },
    },
  };
  </script>

  <style scoped>
  .forgot-password-container {
    min-height: 100vh;
    background: linear-gradient(to right, #004d00, #004d00);
  }

  .forgot-password-form {
    width: 100%;
    max-width: 400px;
    background-color: #fff;
    padding: 2rem;
  }

  h2 {
    color: #333;
  }

  button[type="submit"] {
    background-color: #004d00;
    color: white;
    border: none;
    font-size: 1.1rem;
    padding: 10px;
    border-radius: 4px;
  }

  button[type="submit"]:hover {
    background-color: #004d00;
  }

  button[type="submit"]:focus {
    outline: none;
  }

  p {
    color: #555;
  }

  a {
    color: #004d00;
  }

  a:hover {
    text-decoration: underline;
  }
  </style>
