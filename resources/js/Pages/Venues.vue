<template>
        <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Venue</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Venue</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <div class="col-12 content-card">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title text-white">Venues List</h3>
                <div class="card-tools">
                    <!-- Button to open modal -->
                    <button @click="openModal" class="btn btn-sm btn-success" data-toggle="tooltip"
                        data-placement="bottom" title="Add Venue">
                        <i class="fas fa-plus text-white"></i> Add Venue
                    </button>
                </div>
            </div>
            <div class="card-body">
                <table id="venues-table" class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th >Description</th>
                            <th >Options</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="venue in venues" :key="venue.id">
                            <td>{{ venue.name }}</td>
                            <td>{{venue.description }}</td>
                            <td>
                                <inertia-link :href="`/venues/${venue.id}/edit`"
                                    class="btn btn-sm btn-warning">Edit</inertia-link>
                                <button @click="deleteVenue(venue.id)" class="btn btn-sm btn-danger">Delete</button>
                            </td>
                        </tr>
                        <tr v-if="venues.length === 0">
                            <td colspan="2" class="text-center">No venues found</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="venues-modal" tabindex="-1" aria-labelledby="venues-modal-label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="venues-modal-label">Add Venue</h4>
                        <button type="button" class="btn-close" @click="closeModal" aria-label="Close"></button>
                    </div>
                    <form @submit.prevent="submitForm" novalidate>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="venue-name">Name</label>
                                <input type="text" id="venue-name" class="form-control" v-model="newVenue.name"
                                    :class="{ 'is-invalid': errors.name }" required />
                                <div class="invalid-feedback">{{ errors.name }}</div>

                                <label for="venue-description" class="mt-3">Description</label>
                                <textarea id="venue-description" class="form-control" v-model="newVenue.description"
                                    :class="{ 'is-invalid': errors.description }" required></textarea>
                                <div class="invalid-feedback">{{ errors.description }}</div>

                                <div class="form-check mt-3">
                                    <input type="checkbox" id="venue-available" class="form-check-input"
                                        v-model="newVenue.available" />
                                    <label for="venue-available" class="form-check-label">Available</label>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="closeModal">Close</button>
                            <button type="submit" class="btn btn-success">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import Swal from 'sweetalert2';

export default {
    props: {
        venues: Array,
    },
    layout: AdminLayout,
    data() {
        return {
            newVenue: {
                name: '',
                description: '',
                available: true,
            },
            errors: {
                name: '',
                description: '',
            },
        };
    },
    methods: {
        openModal() {
            const modal = new bootstrap.Modal(document.getElementById('venues-modal'));
            modal.show();
        },
        closeModal() {
            const modal = bootstrap.Modal.getInstance(document.getElementById('venues-modal'));
            modal.hide();
        },
        async submitForm() {
            try {
                await this.$inertia.post('/venues', this.newVenue, {
                    onError: (errors) => {
                        this.errors = errors;
                    },
                    onSuccess: () => {
                        Swal.fire({
                            toast: true,
                            position: 'top-end',
                            icon: 'success',
                            title: 'Venue added successfully!',
                            showConfirmButton: false,
                            timer: 1500,
                        });
                        this.newVenue = { name: '', description: '', available: true };
                        this.errors = {};
                        this.closeModal();
                    },
                });
            } catch (error) {
                console.error('Error creating venue:', error);
            }
        },
        async deleteVenue(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: 'You won\'t be able to revert this!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
            }).then(async (result) => {
                if (result.isConfirmed) {
                    try {
                        await this.$inertia.delete(`/venues/${id}`, {
                            onSuccess: () => {
                                Swal.fire({
                                    toast: true,
                                    position: 'top-end',
                                    icon: 'success',
                                    title: 'Venue deleted successfully!',
                                    showConfirmButton: false,
                                    timer: 1500,
                                });
                            },
                            onError: () => {
                                Swal.fire({
                                    toast: true,
                                    position: 'top-end',
                                    icon: 'error',
                                    title: 'Failed to delete the venue.',
                                    showConfirmButton: false,
                                    timer: 1500,
                                });
                            },
                        });
                    } catch (error) {
                        console.error('Error deleting venue:', error);
                    }
                }
            });
        },
    },
};
</script>

<style scoped>
/* Optional styling for the modal */
</style>
