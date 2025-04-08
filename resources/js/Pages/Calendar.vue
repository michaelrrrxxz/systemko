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
                        <h4 class="modal-title" id="venues-modal-label">Add Event on  {{ selectedDate }}</h4>
                        <button type="button" class="btn-close" @click="closeModal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form @submit.prevent="submitEvent">
                            <p><strong>Selected Date:</strong> {{ selectedDate }}</p>
                            <label for="name">Name</label>
                            <input type="text" v-model="name" class="form-control">
                            <label for="venue">Venue</label>
                            <select name="venue" id="venue" class="form-select" v-model="selectedVenue" required>
                                <option value="">Select a venue</option>
                                <option v-for="venue in venues" :key="venue.id" :value="venue.id">
                                    {{ venue.name }}
                                </option>
                            </select>

                            <label for="start_time">Start Time</label>
                            <input type="time" id="start_time" v-model="startTime" class="form-control" required />

                            <label for="end_time">End Time</label>
                            <input type="time" id="end_time" v-model="endTime" class="form-control" required />

                            <button type="submit" class="btn btn-primary mt-3">Add Event</button>
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
import Swal from 'sweetalert2';

export default {
    layout: AdminLayout,
    props: {
        events: Array,
        venues: Array,
    },
    data() {
        return {
            selectedDate: null,
            selectedVenue: null,
            name: '',
            description: '',
            startTime: '',
            endTime: '',
            calendar: null,
        };
    },
    mounted() {
        const calendarEl = document.getElementById('calendar');
        this.calendar = new Calendar(calendarEl, {
            plugins: [dayGridPlugin, interactionPlugin],
            initialView: 'dayGridMonth',
            events: this.events,
            editable: true,
            selectable: true,
            dateClick: this.handleDateClick,
            eventClick: this.handleEventClick,
        });
        this.calendar.render();
    },
    methods: {
        closeModal() {
            const modalElement = document.getElementById('calendar-modal');
            const modal = bootstrap.Modal.getInstance(modalElement); // Ensure we get the existing instance
            if (modal) {
                modal.hide();
            }
        },
        handleDateClick(info) {
            const selectedDate = new Date(info.dateStr);
            const today = new Date();
            today.setHours(0, 0, 0, 0); // Set time to midnight for comparison

            if (selectedDate < today) {
                Swal.fire('Error', 'You cannot add events to past dates.', 'error');
                return;
            }

            this.selectedDate = info.dateStr;
            const modal = new bootstrap.Modal(document.getElementById('calendar-modal'));
            modal.show();
        },
        async submitEvent() {
            if (!this.selectedVenue || !this.startTime || !this.endTime) {
                Swal.fire('Error', 'Please fill in all fields.', 'error');
                return;
            }

            try {
                const response = await axios.post('/calendar', {
                    name: this.name,
                    description: this.description,
                    date: this.selectedDate,
                    venue_id: this.selectedVenue,
                    start_time: this.startTime,
                    end_time: this.endTime,
                });

                if (response.data.success) {
                    Swal.fire('Success', 'Event added successfully!', 'success');
                    this.calendar.addEvent(response.data.event); // Add event to calendar

                  
                    this.closeModal();
                } else {
                    Swal.fire('Error', response.data.message, 'error');
                }
            } catch (error) {
                Swal.fire('Error', error.response?.data?.message || 'An error occurred.', 'error');
            }
        },
        async handleEventClick(info) {
            const eventId = info.event.id;

            const result = await Swal.fire({
                title: 'Are you sure?',
                text: 'Do you want to delete this event?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel',
            });

            if (result.isConfirmed) {
                try {
                    const response = await axios.delete(`/calendar/${eventId}`);

                    if (response.data.success) {
                        Swal.fire('Deleted!', response.data.message, 'success');
                        info.event.remove();
                    }
                } catch (error) {
                    Swal.fire('Error', 'An error occurred while deleting the event.', 'error');
                }
            }
        },
    },
    beforeDestroy() {
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
