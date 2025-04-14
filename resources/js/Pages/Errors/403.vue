<template>
    <div class="error-page">
        <h1 class="error-code">403</h1>
        <p class="error-message">You do not have the required permissions to access this page.</p>
        <Link :href="route('dashboard.index')" class="btn btn-primary">Go to Dashboard</Link>
    </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
</script>

<style scoped>
.error-page {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    height: 100vh;
    text-align: center;
    background-color: #f8f9fa;
}

.error-code {
    font-size: 6rem;
    font-weight: bold;
    color: #dc3545;
}

.error-message {
    font-size: 1.5rem;
    margin-bottom: 1.5rem;
    color: #6c757d;
}

.btn {
    padding: 0.5rem 1rem;
    font-size: 1rem;
    text-decoration: none;
    color: #fff;
    background-color: #007bff;
    border-radius: 0.25rem;
}
</style>
