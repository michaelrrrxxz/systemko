<template>
    <div class="col-12 content-card">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title text-white">Calendar</h3>
                <div class="card-tools">

                </div>

            </div>
            <div class="card-body">
                <div id="calendar"></div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="calendar-modal" tabindex="-1" aria-labelledby="calendar-modal-label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="venues-modal-label">Add Event</h4>
                        <button type="button" class="btn-close" @click="closeModal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <label for="venue">Venue</label>
                            <select name="venue" id="venue" class="form-select" v-model="selectedVenue">
                            <option value="">Select a venue</option>
                            <option v-for="venue in venues" :key="venue.id" :value="venue.id">
                                {{ venue.name }}
                            </option>
                            </select>
                        </form>
                    </div>
                </div>
            </div>
        </div>

</template>

<script>
import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import interactionPlugin from '@fullcalendar/interaction';
import AdminLayout from '../Layouts/AdminLayout.vue';

export default {
    layout: AdminLayout,
    props: {
        events: Array,
        venues: Array,
    },
    mounted() {
        // Initialize FullCalendar
        const calendarEl = document.getElementById('calendar');
        this.calendar = new Calendar(calendarEl, {
            plugins: [dayGridPlugin, interactionPlugin],
            initialView: 'dayGridMonth',
            events: this.events, // Load events
            editable: true, // Allow drag-and-drop
            selectable: true, // Allow date selection
            dateClick: this.handleDateClick, // Handle date clicks
            eventClick: this.handleEventClick, // Handle event clicks
        });
        this.calendar.render();
    },
    methods: {

        closeModal() {
            // Close the modal
            const modal = new bootstrap.Modal(document.getElementById('calendar-modal'));
            modal.hide();
        },


        handleDateClick(info) {
            const modal = new bootstrap.Modal(document.getElementById('calendar-modal'));
            modal.show();
            // alert(`Date clicked: ${info.dateStr}`);
        },
        handleEventClick(info) {
            // Triggered when an event is clicked
            alert(`Event clicked: ${info.event.title}`);
        },
    },
    beforeDestroy() {
        // Destroy the calendar instance
        if (this.calendar) {
            this.calendar.destroy();
        }
    },
};
</script>

<style scoped>
/* Full-width calendar wrapper */
#calendar {
    width: 100%;
    height: 100%;
    background-color: #f9f9f9;
    color: #333333;
    padding: 16px;
    border-radius: 12px;
    border: 6px solid #004d00; /* Thicker border for the calendar */
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.05);
    box-sizing: border-box;
}

/* Toolbar (header) */
.fc .fc-toolbar {
    background-color: #7ba684; /* New background color for the header */
    border-bottom: 6px solid #5c7c66; /* Thicker bottom border */
    padding: 10px; /* Add padding for a thicker appearance */
    border-radius: 8px 8px 0 0; /* Rounded corners for the top */
}

/* Toolbar title */
.fc .fc-toolbar-title {
    color: #ffffff; /* Change title color to white */
    font-size: 2rem; /* Larger font size for the title */
    font-weight: bold;
    text-align: center;
}

/* Navigation buttons */
.fc .fc-button {
    background-color: #5c7c66;
    color: #ffffff;
    border: none;
    border-radius: 6px;
    padding: 6px 14px;
    font-weight: 500;
}

.fc .fc-button:hover {
    background-color: #3e5a4a;
}

/* Day grid cells */
.fc .fc-daygrid-day {
    background-color: #ffffff;
    color: #333333;
    border: 8px solid #999999; /* Thicker border for day grid cells */
    transition: background-color 0.3s ease;
    font-size: 1rem;
    font-weight: 500;
}

/* On hover */
.fc .fc-daygrid-day:hover {
    background-color: #e6f0e9;
}

/* Date number (top corner of each cell) */
.fc-daygrid-day-number {
    font-size: 2rem; /* Larger size for date numbers */
    font-weight: 700;
    padding: 4px;
}

/* Events inside days */
.fc .fc-event {
    background-color: #d8a47f;
    color: #2f2f2f;
    border-radius: 4px;
    padding: 4px 6px;
    font-size: 0.85rem;
    border: none;
}

.fc .fc-event:hover {
    background-color: #f4c9b5;
    color: #2f2f2f;
}
</style>
