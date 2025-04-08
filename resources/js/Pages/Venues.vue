<template>
    <div class="col-12 content-card">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title text-white"> List</h3>
                <div class="card-tools">
                    <!-- Button to open modal -->
                    <button @click="openModal" class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="bottom" title="Add Venue">
                        <i class="fas fa-plus text-white"></i> Add
                    </button>
                </div>
            </div>
            <div class="card-body">
                <table id="venues-table" class="table table-bordered table-hover table-striped table=responsive">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="venue in venues" :key="venue.id">
                            <td>{{ venue.name }}</td>
                            <td>
                                <inertia-link :href="`/venues/${venue.id}/edit`" class="btn btn-sm btn-warning">Edit</inertia-link>
                                <button @click="deleteVenue(venue.id)" class="btn btn-sm btn-danger">Delete</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>



        <div class="modal fade" id="venues-modal" tabindex="-1" aria-labelledby="venues-modal-label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="users-modal-label">User Form</h4>
                    <!-- <button type="button" class="btn-close" @click="closeModal" aria-label="Close"></button> -->
                </div>

            </div>
        </div>
    </div>

    </div>
</template>

<script>
import AdminLayout from '@/Layouts/AdminLayout.vue';
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
                await this.$inertia.post('/venues', this.newVenue);
                this.closeModal();
            } catch (error) {
                console.error('Error creating venue:', error);
            }
        },
        async deleteVenue(id) {
            if (confirm('Are you sure you want to delete this venue?')) {
                try {
                    await this.$inertia.delete(`/venues/${id}`);
                } catch (error) {
                    console.error('Error deleting venue:', error);
                }
            }
        },
    },
};
</script>

<style scoped>
/* Optional styling for the modal */
</style>
