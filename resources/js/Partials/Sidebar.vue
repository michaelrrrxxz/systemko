<script setup>
import { Link } from '@inertiajs/vue3';

</script>



<template>
    <aside class="main-sidebar elevation-4 sidebar-light-olive">
    <a href="" class="brand-link" style="background-color: #004d00;"><img src="" class="brand-image img-circle elevation-3" style="opacity:0.8;" alt=""><span class="brand-text font-weight-light text-white">Michael Angelo</span></a>
    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="info">
                <a href="#" class="d-block">Code ni Mangaoang</a>
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
                        <i class="nav-icon fas fa-tachometer"></i>
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
                                :href="route('places.index')"
                                class="nav-link"
                                :class="{ active: $page.url.startsWith('/places') }"
                            >
                        <i class="nav-icon fas fa-map-marker"></i>
                        <p>Venue</p>
                        </Link>
                    </li>
            </ul>
        </nav>
    </div>
</aside>

</template>



