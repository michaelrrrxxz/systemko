<script>
import AdminLayout from '../../Layouts/AdminLayout.vue';
import { reactive } from 'vue';
import { router } from '@inertiajs/vue3';

export default {
    layout: AdminLayout,
    props: {
        user: Object, // The user data passed from the controller
    },
    setup(props) {
        const form = reactive({
            email: props.user.email || '',
            name: props.user.name || '',
            password: '',
            password_confirmation: ''
        });

        function submit() {
            router.put(`/users/${props.user.id}`, form, {
                onSuccess: () => {
                    alert('User updated successfully!');
                },
                onError: () => {
                    alert('Failed to update the user.');
                }
            });
        }

        return {
            form,
            submit
        };
    }
};
</script>

<template>
    <div class="container mt-5">
        <div class="card border-0 shadow-lg rounded-3 col-md-8 mx-auto">
            <div class="card-header bg-primary text-white">
                <h3 class="mb-0">Edit User</h3>
            </div>
            <div class="card-body">
                <form @submit.prevent="submit" method="post">
                    <div class="form-group mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input id="email" name="email" type="email" class="form-control" v-model="form.email"
                            placeholder="Enter user email" required />
                    </div>
                    <div class="form-group mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input id="name" name="name" type="text" class="form-control" v-model="form.name"
                            placeholder="Enter user name" required />
                    </div>
                    <div class="form-group mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input id="password" name="password" type="password" class="form-control"
                            v-model="form.password" placeholder="Enter new password" />
                        <small class="form-text text-muted">Leave blank if you don't want to change the
                            password.</small>
                    </div>
                    <div class="form-group mb-3">
                        <label for="password_confirmation" class="form-label">Confirm Password</label>
                        <input id="password_confirmation" name="password_confirmation" type="password"
                            class="form-control" v-model="form.password_confirmation"
                            placeholder="Confirm new password" />
                    </div>
                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-save me-2"></i> Update User
                        </button>
                        <a href="javascript:history.back()" class="btn btn-secondary">
                            <i class="fa fa-arrow-left me-2"></i> Back
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<style scoped>
/* Card Styling */
.card {
    border-radius: 15px;
}

/* Header Styling */
.card-header {
    border-bottom: none;
    padding: 16px 24px;
}

/* Form Styling */
.form-label {
    font-weight: 600;
}

.form-control {
    border-radius: 8px;
    padding: 10px 12px;
}

/* Button Styling */
.btn {
    border-radius: 8px;
    padding: 10px 20px;
}
</style>
