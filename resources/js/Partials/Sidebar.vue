<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
  auth: Object, // Access the shared 'auth' prop in your component
});
</script>

<template>
    <aside class="main-sidebar elevation-4 sidebar-light-olive">
        <a href="" class="brand-link" style="background-color: #004d00;">
            <img src="" class="brand-image img-circle elevation-3" style="opacity:0.8;" alt="">
            <span class="brand-text font-weight-light text-white">Michael Angelo</span>
        </a>
        <div class="sidebar">
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <!-- Optional: You can display a user image if you want -->
                    <!-- <img src="{{ asset('path_to_user_image') }}" class="img-circle elevation-2" alt="User Image"> -->
                </div>
                <div class="info">
                    <!-- Display the logged-in user's name and email -->
                    <a href="#" class="d-block">
                        <!-- <h5 class="text-white">Welcome, {{ $page.props.user.name }}!</h5> -->
                        <!-- <p class="text-muted mb-0">{{ $page.props.user.email }}</p> -->
                    </a>
                </div>
            </div>

            <nav class="mt-2 mb-0">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item">
                        <Link
                            :href="route('dashboard.index')"
                            class="nav-link"
                            :class="{ active: $page.url.startsWith('/dashboard') }"
                        >
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Dashboard</p>
                        </Link>
                    </li>
                    <li class="nav-item">
                        <Link
                            :href="route('users.index')"
                            class="nav-link"
                            :class="{ active: $page.url.startsWith('/users') }"
                        >
                            <i class="nav-icon fas fa-users"></i>
                            <p>Users</p>
                        </Link>
                    </li>
                    <li class="nav-item">
                        <Link
                            :href="route('venues.index')"
                            class="nav-link"
                            :class="{ active: $page.url.startsWith('/venues') }"
                        >
                            <i class="nav-icon fas fa-map-marker"></i>
                            <p>Venue</p>
                        </Link>
                    </li>
                    <li class="nav-item">
                        <Link
                            :href="route('calendar.index')"
                            class="nav-link"
                            :class="{ active: $page.url.startsWith('/calendar') }"
                        >
                            <i class="nav-icon fas fa-calendar"></i>
                            <p>Calendar</p>
                        </Link>
                    </li>
                    <li class="nav-item">
                        <Link
                            :href="route('events.index')"
                            class="nav-link"
                            :class="{ active: $page.url.startsWith('/events') }"
                        >
                            <i class="nav-icon fas fa-bullhorn"></i>
                            <p>Events</p>
                        </Link>
                    </li>
                </ul>
            </nav>
        </div>
    </aside>
</template>



