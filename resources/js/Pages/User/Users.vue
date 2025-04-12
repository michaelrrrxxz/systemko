<script>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Link, router } from '@inertiajs/vue3';
import Swal from 'sweetalert2';
import ContentHeader from '@/Components/ContentHeader.vue';
import CardButton from '@/Components/CardButton.vue';
import ReusableTable from '@/Components/ReusableTable.vue';
import ReusableForm from '@/Components/ReusableForm.vue';
export default {
    layout: AdminLayout,
    components: {
        Link,
        ContentHeader,
        CardButton,
        ReusableTable,
        ReusableForm,
    },
    props: {
        users: Array,
    },
    data() {
        return {

      columns: [
            { label: 'ID', field: 'id' },
            { label: 'Name', field: 'name' },
            { label: 'Email', field: 'email' },
         ],
         userFields: [
        { name: 'name', label: 'Name', type: 'text', required: true, placeholder: 'Enter name' },
        { name: 'email', label: 'Email', type: 'email', required: true, placeholder: 'Enter email' },
        { name: 'password', label: 'Password', type: 'password', required: true, placeholder: 'Enter password' },
        { name: 'role', label: 'Role', type: 'select', required: true, options: [
            { label: 'Select Role', value: '' },
            { label: 'Admin', value: 'admin' },
            { label: 'User', value: 'user' },
          ] },
      ],
            newUser: {
                name: '',
                email: '',
                password: '',
                role: '',
            },
            errors: {
                name: '',
                email: '',
                password: '',
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
        validateForm() {
            let isValid = true;


            if (!this.newUser.name) {
                this.errors.name = 'Name is required.';
                isValid = false;
            } else {
                this.errors.name = '';
            }

            // Validate email
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!this.newUser.email) {
                this.errors.email = 'Email is required.';
                isValid = false;
            } else if (!emailRegex.test(this.newUser.email)) {
                this.errors.email = 'Invalid email format.';
                isValid = false;
            } else {
                this.errors.email = '';
            }

            if (!this.newUser.password) {
                this.errors.password = 'Password is required.';
                isValid = false;
            } else if (this.newUser.password.length < 8) {
                this.errors.password = 'Password must be at least 8 characters.';
                isValid = false;
            } else {
                this.errors.password = '';
            }

            return isValid;
        },
        saveUser() {
            if (this.validateForm()) {
                console.log('Saving user:', this.newUser);
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'User has been saved successfully.',
                    showConfirmButton: false,
                    timer: 1500,
                });
                this.newUser = { name: '', email: '', password: '', role: '' };
                this.closeModal();
            }
        },
        editUser(userId) {
            router.get(route('users.edit', { user: userId }), {
                onSuccess: () => {
                    const modal = new bootstrap.Modal(document.getElementById('users-modal'));
                    modal.show();
                },
            });
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
        <ContentHeader title="Users"
        :breadcrumbs="[{ label: 'Home', url: '/' },
        { label: 'Users', url: '/users' }]"
    />
    <div class="col-12 content-card">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title text-white">Users List</h3>
                <div class="card-tools">
                    <CardButton
                    label="Add User"
                    :openModal="openModal"
                    buttonClass="btn-success"
                    iconClass="fas fa-plus text-white"
                    tooltipText="Add Venue"
                    tooltipPlacement="bottom"
                    />
                </div>
            </div>

            <div class="card-body">
                <div>
                    <ReusableTable
                        :items="users"
                        :columns="columns"
                        tableName="users"
                        :onEdit="editUser"
                        :onDelete="deleteUser"
                        />
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="users-modal" tabindex="-1" aria-labelledby="users-modal-label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="users-modal-label">User Form</h4>
                    <button type="button" class="btn-close" @click="closeModal" aria-label="Close"></button>
                </div>
                <ReusableForm
                    :fields="userFields"
                    :formData="newUser"
                    :errors="errors"
                    :saveMethod="saveUser"
                    :closeModal="closeModal"
                    :resetForm="resetUserForm"
                    />
            </div>
        </div>
    </div>
</template>
