<script>
import AdminLayout from '../../Layouts/AdminLayout.vue';

import { Link, router } from '@inertiajs/vue3';

export default {
    layout: AdminLayout,
    components: {
    
        Link
    },
    props: {
        users: Array,
    },
    data() {
        return {
            newUser: {
                name: '',
                email: '',
            },
            isModalOpen: false,
        };
    },
    methods: {
        deleteUser(userId) {
            if (confirm('Are you sure you want to delete this user?')) {
                router.delete(route('users.destroy', { user: userId }), {
                    onSuccess: () => {
                        alert('User deleted successfully.');
                    },
                    onError: () => {
                        alert('Failed to delete the user.');
                    }
                });
            }
        }
    }
};
</script>

<template>
    <div class="container mt-5">
        <div class="card border-0 shadow-lg rounded-3">
            <div class="card-header">
                <h1 class="card-title text-dark">Users List</h1>
                <div class="card-tools">
                    <!-- Trigger Modal -->
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#users-modal">
                        <i class="fa fa-plus" aria-hidden="true"></i> <span>Create User</span>
                    </button>
                </div>
            </div>
            <div class="card-body p-4">
                <table class="table table-bordered table-hover shadow-sm rounded-3 custom-table">
                    <thead class="table-light">
                        <tr class="text-muted">
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="user in users" :key="user.id">
                            <td>{{ user.id }}</td>
                            <td>{{ user.name }}</td>
                            <td>{{ user.email }}</td>
                            <td class="space-between d-flex">
                                <!-- Edit Button -->
                                <Link :href="route('users.edit', { user: user.id })" class="btn btn-primary btn-sm">
                                Edit
                                </Link>
                                <!-- Delete Button -->
                                <button class="btn btn-danger btn-sm" @click="deleteUser(user.id)">
                                    Delete
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="users-modal" tabindex="-1" aria-labelledby="users-modal-label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="users-modal-label">User Form</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="users-form">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" class="form-control" name="username" id="username" required />
                            <label>Password</label>
                            <input type="password" class="form-control" name="password" id="password" required />
                            <label>Role</label>
                            <input type="text" class="form-control" name="role" id="role" required />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="id" id="id" />
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Close
                        </button>
                        <button type="reset" class="btn btn-warning">Reset</button>
                        <button type="submit" class="btn btn-success" name="save">
                            Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<style scoped>
/* Table Card Styling */
.card {
    border-radius: 15px;
}

/* Table Border and Shadows */
.custom-table {
    border: 1px solid #ddd;
    border-radius: 12px;
}

.custom-table th {
    font-weight: 600;
}

/* Hover Effects on Rows */
.custom-table tbody tr:hover {
    background-color: rgba(0, 0, 0, 0.05);
    transition: background-color 0.3s ease;
}

/* Light Table Header */
.table-light {
    background-color: #f7f7f7;
}

/* Header Styling */
.card-header {
    padding: 16px 24px;
    background-color: #fff;
    border-bottom: 1px solid #e1e1e1;
}

/* Table Cell Padding */
.table td,
.table th {
    padding: 12px 15px;
}
</style>
