<script>
import AdminLayout from '../../Layouts/AdminLayout.vue';
import { reactive } from 'vue';
import { router, Link } from '@inertiajs/vue3';


const form = reactive({
    email: '',
    name: '',
    password: '',
    password_confirmation: ''
});


function submit() {
    router.post('/users', form)
}

export default {
    layout: AdminLayout,
    components: {
        Link
    },
    setup() {
        return {
            form,
            submit
        };
    }

};
</script>

<template>
    <div class="container mt-5">
        <div class="card col-8">
            <div class="card">
                <div class="card-header">
                    Add User
                </div>
                <div class="card-body">
                    <form @submit.prevent="submit" method="post">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input id="email" name="email" type="text" class="form-control" v-model="form.email" />
                        </div>
                        <div class="form-group mt-3">
                            <label for="name">Name</label>
                            <input id="name" name="name" type="text" class="form-control" v-model="form.name" />
                        </div>
                        <div class="form-group mt-3">
                            <label for="password">Password</label>
                            <input id="password" name="password" type="password" class="form-control"
                                v-model="form.password" />
                        </div>
                        <div class="form-group mt-3">
                            <label for="password_confirmation">Confirm Password</label>
                            <input id="password_confirmation" name="password_confirmation" type="password"
                                class="form-control" v-model="form.password_confirmation" />
                        </div>
                        <div class="mt-3">
                            <a href="javascript:history.back()" class="btn btn-secondary">
                            <i class="fa fa-arrow-left me-2"></i> Back
                        </a>
                            <button type="submit" class="btn btn-primary">Add User</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
