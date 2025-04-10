<template>
    <aside class="control-sidebar control-sidebar-dark">
        <div class="p-3">
            <h5 class="text-white">Quick Actions</h5>
            <hr class="bg-secondary">
            <nav class="mt-3">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#" @click="confirmLogout" role="button">
                            <i class="fas fa-sign-out-alt me-2"></i> Logout
                        </a>
                    </li>
                </ul>
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
                    Inertia.post(route('logout'), {}, {
                        onSuccess: () => {
                            // Reload the page after successful logout
                            window.location.reload();
                        },
                        onError: (errors) => {
                            console.error('Logout failed:', errors);
                        },
                    });
                }
            });
        },
    },
};
</script>

<style scoped>
.control-sidebar {
    background-color: #343a40;
    color: #fff;
    min-height: 100vh;
}

.control-sidebar .nav-link {
    display: flex;
    align-items: center;
    padding: 0.5rem 1rem;
    border-radius: 0.25rem;
    transition: background-color 0.3s ease;
}

.control-sidebar .nav-link:hover {
    background-color: #495057;
    text-decoration: none;
}

.control-sidebar .nav-link i {
    margin-right: 0.5rem;
}
</style>
