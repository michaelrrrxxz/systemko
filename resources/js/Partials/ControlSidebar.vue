<template>
     <aside class="control-sidebar control-sidebar-dark">
            <div class="p-3">
                <!-- <h5>Settings</h5>
                <p>Sidebar content like quick settings, notifications, or recent activity can go here.</p>
                <hr class="bg-secondary">
                <div class="form-group">
                    <label for="darkModeSwitch">Dark Mode</label>
                    <input type="checkbox" id="darkModeSwitch" class="ml-2">
                </div> -->
                <nav class="mt-2 mb-0">
                    <li class="nav-item">
                    <a class="nav-link text-white" href="#" @click="confirmLogout" role="button">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                </li>
                </nav>
            </div>
        </aside>
</template>
<script>
import Swal from 'sweetalert2';
import { Inertia } from '@inertiajs/inertia';
export default {

    methods: {
        confirmLogout() {
            Swal.fire({
                title: 'Are you sure?',
                text: 'You will be logged out of your account.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, logout!',
            }).then((result) => {
                if (result.isConfirmed) {
                    // Send a POST request to the logout route
                    Inertia.post(route('logout'));
                }
            });
        },
    },
};
</script>
