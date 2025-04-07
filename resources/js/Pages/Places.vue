<template>
    <div class="col-12 content-card">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title text-white">Place List</h3>
                <div class="card-tools">
                    <!-- Button to open modal -->
                    <button @click="openModal" class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="bottom" title="Add Place">
                        <i class="fas fa-plus text-white"></i> Add Place
                    </button>
                </div>
            </div>
            <div class="card-body">
                <table id="places-table" class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th>Place</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="place in places" :key="place.id">
                            <td>{{ place.name }}</td>
                            <td>
                                <inertia-link :href="`/places/${place.id}/edit`" class="btn btn-sm btn-warning">Edit</inertia-link>
                                <button @click="deletePlace(place.id)" class="btn btn-sm btn-danger">Delete</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Modal for adding a new place -->

    </div>
</template>

<script>
import AdminLayout from '@/Layouts/AdminLayout.vue';
export default {
    props: {
        places: Array,
    },
    layout: AdminLayout,
    data() {
        return {
            newPlace: {
                name: '',
                description: '',
                available: true,
            },
        };
    },
    methods: {
        openModal() {
            $('#addPlaceModal').modal('show');
        },
        closeModal() {
            this.newPlace = { name: '', description: '', available: true };
            $('#addPlaceModal').modal('hide');
        },
        async submitForm() {
            try {
                await this.$inertia.post('/places', this.newPlace);
                this.closeModal();
            } catch (error) {
                console.error('Error creating place:', error);
            }
        },
        async deletePlace(id) {
            if (confirm('Are you sure you want to delete this place?')) {
                try {
                    await this.$inertia.delete(`/places/${id}`);
                } catch (error) {
                    console.error('Error deleting place:', error);
                }
            }
        },
    },
};
</script>

<style scoped>
/* Optional styling for the modal */
</style>
