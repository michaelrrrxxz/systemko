<template>
    <div class="wrapper">
        <!-- Navbar -->
        <Navbar />

        <!-- Sidebar -->
        <Sidebar />

        <!-- Content Wrapper -->
        <div class="content-wrapper">
            <section class="content">
                <slot />
            </section>
        </div>

        <!-- Footer -->
        <!-- <Footer /> -->
    </div>
</template>

<script>
import Navbar from '../Partials/Navbar.vue';
import Sidebar from '../Partials/Sidebar.vue';
// import Footer from '../Partials/Footer.vue';

export default {
    components: {
        Navbar,
        Sidebar,
        // Footer,
    },
};
</script>

<style>
/* Add any custom AdminLTE styles here */
</style>
