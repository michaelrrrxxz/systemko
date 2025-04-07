<template>
    <div class="login-container d-flex justify-content-center align-items-center">
        <div class="login-form p-4 border rounded shadow-sm">
            <h2 class="text-center mb-4">Login</h2>
            <form @submit.prevent="submit">
                <!-- Email Input -->
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" class="form-control" v-model="form.email"
                        placeholder="Enter your email" required />
                    <small v-if="form.errors.email" class="text-danger">{{ form.errors.email }}</small>
                </div>

                <!-- Password Input -->
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" class="form-control" v-model="form.password"
                        placeholder="Enter your password" required />
                    <small v-if="form.errors.password" class="text-danger">{{ form.errors.password }}</small>
                </div>

                <!-- Submit Button -->
                <div class="d-flex justify-content-between align-items-center">
                    <button type="submit" class="btn btn-custom btn-block" :disabled="form.processing">
                        {{ form.processing ? 'Logging in...' : 'Login' }}
                    </button>
                    <Link :href="route('password.request')" class="forgot-password-link">Forgot Password?</Link>
                </div>
            </form>
            <p class="mt-3 text-center">
                Don't have an account? <a href="#">Sign up</a>
            </p>
        </div>
    </div>
</template>

<script>
import { Link, useForm } from '@inertiajs/vue3';

export default {
    components: {
        Link,
    },
    setup() {
        const form = useForm({
            email: '',
            password: '',
        });

        const submit = () => {
            form.post(route('login'), {
                onFinish: () => form.reset('password'), // Reset password field after submission
            });
        };

        return { form, submit };
    },
};
</script>

<style scoped>
.login-container {
    min-height: 100vh;
    background: linear-gradient(to right, #2ecc71, #27ae60);
}

.login-form {
    width: 100%;
    max-width: 400px;
    background-color: #fff;
    padding: 2rem;
}

.forgot-password-link {
    text-decoration: none;
    color: #2ecc71;
}

.forgot-password-link:hover {
    text-decoration: underline;
}

button[type="submit"] {
    background-color: #2ecc71;
    color: white;
    border: none;
    font-size: 1.1rem;
    padding: 10px;
    border-radius: 4px;
}

button[type="submit"]:hover {
    background-color: #27ae60;
}

button[type="submit"]:focus {
    outline: none;
}

p {
    color: #555;
}

a {
    color: #2ecc71;
}

a:hover {
    text-decoration: underline;
}

.text-danger {
    font-size: 0.875rem;
}
</style>
