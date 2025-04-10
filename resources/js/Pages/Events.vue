<template>
    <ContentHeader title="Events"
        :breadcrumbs="[{ label: 'Home', url: '/' },
        { label: 'Events', url: '/events' }]"
    />
    <div class="col-12 content-card">
      <div class="card">
        <div class="card-header">
            <h3 class="card-title text-white">Events List</h3>
        </div>
        <div class="card-body">
            <ReusableTable
                :items="events"
                :columns="columns"
                tableName="events"
                :onDelete="deleteEvent"
            />
        </div>
      </div>
    </div>
</template>

<script>
import AdminLayout from '../Layouts/AdminLayout.vue';
import ContentHeader from '../Components/ContentHeader.vue';
import ReusableTable from '../Components/ReusableTable.vue';
export default {
    components: {
        ContentHeader,
        ReusableTable
    },
    layout: AdminLayout,
    props: {
        events: Array,
    },
    data() {
    return {
      columns: [
        { label: 'ID', field: 'id' },
        { label: 'Name', field: 'name' },
        { label: 'Venue', field: 'venue' },
        { label: 'Start Time', field: 'start_time' },
        { label: 'End Time', field: 'end_time' },
      ],
    };
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
