<template>
    <div class="col-12 content-card">
      <div class="card">
        <div class="card-header">
            <h3 class="card-title text-white">Events List</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Venue</th>
                        <th>Start Time</th>
                        <th>End Time</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="event in events" :key="event.id">
                        <td>{{ event.id }}</td>
                        <td>{{ event.name }}</td>
                        <td>{{ event.venue }}</td>
                        <td>{{ formatDate(event.start_time) }}</td>
                        <td>{{ formatDate(event.end_time) }}</td>
                        <td>
                            <!-- Add your action buttons here -->
                            <button class="btn btn-danger" @click="deleteEvent(event.id)">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
      </div>
    </div>
</template>

<script>
import AdminLayout from '../Layouts/AdminLayout.vue';

export default {
    layout: AdminLayout,
    props: {
        events: Array,
    },
    methods: {

        formatDate(date) {
            const options = {
                year: 'numeric',
                month: 'long',
                day: 'numeric',
                hour: '2-digit',
                minute: '2-digit',
                hour12: true
            };
            return new Date(date).toLocaleDateString('en-US', options);
        },
        
        deleteEvent(eventId) {
            // Make a request to delete the event
            axios.delete(`/events/${eventId}`)
                .then(response => {
                    // After successful deletion, update the local events array
                    this.events = this.events.filter(event => event.id !== eventId);
                })
                .catch(error => {
                    console.error('Error deleting event:', error);
                    alert('An error occurred while deleting the event.');
                });
        }
    },
}
</script>
