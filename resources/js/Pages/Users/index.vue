<script>
import AdminLayout from '../../Layouts/AdminLayout.vue';
import { Link, router } from '@inertiajs/vue3';
import Swal from 'sweetalert2';

export default {
    layout: AdminLayout,
    components: {
        Link,
    },
    props: {
        users: Array,
    },
    data() {
        return {
            newUser: {
                name: '',
                email: '',
                role: '',
            },
        };
    },
    methods: {
        openModal() {
            const modal = new bootstrap.Modal(document.getElementById('users-modal'));
            modal.show();
        },
        closeModal() {
            const modal = bootstrap.Modal.getInstance(document.getElementById('users-modal'));
            modal.hide();
        },
        saveUser() {
            console.log('Saving user:', this.newUser);
            this.newUser = { name: '', email: '', role: '' };
            this.closeModal();
        },
        deleteUser(userId) {
            Swal.fire({
                title: 'Are you sure?',
                text: 'You won\'t be able to revert this!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
            }).then((result) => {
                if (result.isConfirmed) {
                    router.delete(route('users.destroy', { user: userId }), {
                        onSuccess: () => {
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'User has been deleted successfully.',
                                showConfirmButton: false,
                                timer: 1500,
                            });
                        },
                        onError: () => {
                            Swal.fire({
                                position: 'top-right',
                                icon: 'error',
                                title: 'Failed to delete the user.',
                                showConfirmButton: false,
                                timer: 1500,
                            });
                        },
                    });
                }
            });
        },
    },
};
</script>

<template>
    <div class="col-12 content-card">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title text-white">Users List</h3>
                <div class="card-tools">
                    <button @click="openModal" class="btn btn-sm btn-success" data-toggle="tooltip"
                        data-placement="bottom" title="Add Place">
                        <i class="fas fa-plus text-white"></i> Add User
                    </button>
                </div>
            </div>

            <div class="card-body">
                <div>
                    <table class="table table-bordered table-hover table-striped">
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
                                    <Link :href="route('users.edit', { user: user.id })" class="btn btn-primary btn-sm">
                                    Edit
                                    </Link>
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
    </div>

    <!-- Modal -->
    <div class="modal fade" id="users-modal" tabindex="-1" aria-labelledby="users-modal-label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="users-modal-label">User Form</h4>
                    <!-- <button type="button" class="btn-close" @click="closeModal" aria-label="Close"></button> -->
                </div>
                <form @submit.prevent="saveUser">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" class="form-control" v-model="newUser.name" required />
                            <label>Email</label>
                            <input type="email" class="form-control" v-model="newUser.email" required />
                            <label>Role</label>
                            <input type="text" class="form-control" v-model="newUser.role" required />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" @click="closeModal">
                            Close
                        </button>
                        <button type="reset" class="btn btn-warning"
                            @click="newUser = { name: '', email: '', role: '' }">
                            Reset
                        </button>
                        <button type="submit" class="btn btn-success">
                            Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
