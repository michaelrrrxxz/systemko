<template>
    <ContentHeader title="Calendar" :breadcrumbs="[
        { label: 'Calendar', url: '/calendar' },

    ]" />
    <div class="col-12 content-card">
        <div class="card">

            <div class="card-body">
                <div id="calendar"></div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="calendar-modal" tabindex="-1" aria-labelledby="calendar-modal-label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="venues-modal-label">Add Event on {{ selectedDate }}</h4>
                    <button type="button" class="btn-close" @click="closeModal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form @submit.prevent="submitEvent">

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
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="closeModal">Close</button>

                            <button type="submit" class="btn btn-primary">Add Event</button>
                        </div>

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



import AdminLayout from '@/Layouts/AdminLayout.vue';
import Swal from 'sweetalert2';
import ContentHeader from '@/Components/ContentHeader.vue';
export default {
    components: {
        ContentHeader,
    },
    layout: AdminLayout,
    props: {
        events: Array,
        venues: Array,
    },
    data() {
        return {
            selectedDate: null,
            selectedVenue: null,
            selectedFilterVenue: '',
            name: '',
            description: '',
            startTime: '',
            endTime: '',
            calendar: null,
            editingEvent: null,
        };
    },
    mounted() {
        const philippineHolidays = [
    { title: 'New Year\'s Day', date: '2025-01-01', type: 'Regular Holiday' },
    { title: 'First Philippine Republic Day', date: '2025-01-23', type: 'Special Working Day' },
    { title: 'Lunar New Year\'s Day', date: '2025-01-29', type: 'Special Non-working Holiday' },
    { title: 'Eidul-Fitar Holiday', date: '2025-04-01', type: 'Regular Holiday' },
    { title: 'The Day of Valor', date: '2025-04-09', type: 'Regular Holiday' },
    { title: 'Maundy Thursday', date: '2025-04-17', type: 'Regular Holiday' },
    { title: 'Good Friday', date: '2025-04-18', type: 'Regular Holiday' },
    { title: 'Black Saturday', date: '2025-04-19', type: 'Special Non-working Holiday' },
    { title: 'Labor Day', date: '2025-05-01', type: 'Regular Holiday' },
    { title: 'Eid al-Adha (Feast of the Sacrifice)', date: '2025-06-07', type: 'Regular Holiday', notes: 'Tentative Date' },
    { title: 'Independence Day', date: '2025-06-12', type: 'Regular Holiday' },
    { title: 'Ninoy Aquino Day', date: '2025-08-21', type: 'Special Non-working Holiday' },
    { title: 'National Heroes Day', date: '2025-08-25', type: 'Regular Holiday' },
    { title: 'Yamashita Surrender Day', date: '2025-09-03', type: 'Special Working Day' },
    { title: 'Feast of the Nativity of Mary', date: '2025-09-08', type: 'Special Working Day' },
    { title: 'Special Non-working Day', date: '2025-10-31', type: 'Special Non-working Holiday' },
    { title: 'All Saints\' Day', date: '2025-11-01', type: 'Special Non-working Holiday' },
    { title: 'Bonifacio Day', date: '2025-11-30', type: 'Regular Holiday' },
    { title: 'Feast of the Immaculate Conception', date: '2025-12-08', type: 'Special Non-working Holiday' },
    { title: 'Christmas Eve', date: '2025-12-24', type: 'Special Non-working Holiday' },
    { title: 'Christmas Day', date: '2025-12-25', type: 'Regular Holiday' },
    { title: 'Rizal Day', date: '2025-12-30', type: 'Regular Holiday' },
    { title: 'New Year\'s Eve', date: '2025-12-31', type: 'Special Non-working Holiday' },
];


        const calendarEl = document.getElementById('calendar');
        const holidayEvents = philippineHolidays.map(holiday => ({
    ...holiday,
    display: 'background',
    color: 'rgba(255, 0, 0, 0.2)',
    textColor: 'red',
    classNames: ['philippine-holiday']
}));

this.calendar = new Calendar(calendarEl, {
    plugins: [dayGridPlugin, interactionPlugin],
    initialView: 'dayGridMonth',
    events: [
        ...this.events.map(event => ({
            ...event,
            color: this.getVenueColor(event.venue_id),
        })),
        ...holidayEvents
    ],
    editable: true,
    selectable: true,
    dateClick: this.handleDateClick,
    eventClick: this.handleEventClick,
});
this.calendar.render();

    },
    methods: {
        getVenueColor(venueId) {

            const colors = ['#FF5733', '#33FF57', '#3357FF', '#FFC300', '#DAF7A6'];
            return colors[venueId % colors.length] || '#CCCCCC';
        },
        filterEvents() {
            const filteredEvents = this.selectedFilterVenue
                ? this.events.filter(event => event.venue_id === this.selectedFilterVenue)
                : this.events;

            this.calendar.removeAllEvents();
            this.calendar.addEventSource(
                filteredEvents.map(event => ({
                    ...event,
                    color: this.getVenueColor(event.venue_id),
                }))
            );
        },
        closeModal() {
            const modalElement = document.getElementById('calendar-modal');
            const modal = bootstrap.Modal.getInstance(modalElement);
            if (modal) {
                modal.hide();
            }
            this.resetForm();
        },
        resetForm() {
            this.selectedDate = null;
            this.selectedVenue = null;
            this.name = '';
            this.description = '';
            this.startTime = '';
            this.endTime = '';
            this.editingEvent = null;
        },
        handleDateClick(info) {
            const selectedDate = new Date(info.dateStr);
            const today = new Date();
            today.setHours(0, 0, 0, 0);
            if (selectedDate < today) {
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'warning',
                    title: 'You cannot select a past date.',
                    showConfirmButton: false,
                    timer: 1500,
                });
                return;
            }

            this.selectedDate = info.dateStr;
            const modal = new bootstrap.Modal(document.getElementById('calendar-modal'));
            modal.show();
        },
        handleEventClick(info) {
            const event = info.event;


            this.editingEvent = event;
            this.name = event.title;
            this.description = event.extendedProps.description || '';
            this.selectedDate = event.start.toISOString().split('T')[0];
            this.startTime = event.start.toTimeString().split(' ')[0].slice(0, 5);
            this.endTime = event.end ? event.end.toTimeString().split(' ')[0].slice(0, 5) : '';
            this.selectedVenue = event.extendedProps.venue_id || null;

            const modal = new bootstrap.Modal(document.getElementById('calendar-modal'));
            modal.show();
        },
        async submitEvent() {
            if (!this.selectedVenue || !this.startTime || !this.endTime) {
                Swal.fire('Error', 'Please fill in all fields.', 'error');
                return;
            }

            try {
                if (this.editingEvent) {
                    const response = await axios.put(`/calendar/${this.editingEvent.id}`, {
                        name: this.name,
                        description: this.description,
                        date: this.selectedDate,
                        venue_id: this.selectedVenue,
                        start_time: this.startTime,
                        end_time: this.endTime,
                    });

                    if (response.data.success) {
                        Swal.fire({
                            toast: true,
                            position: 'top-end',
                            icon: 'success',
                            title: 'Event updated successfully!',
                            showConfirmButton: false,
                            timer: 1500,
                        });

                        this.editingEvent.setProp('title', this.name);
                        this.editingEvent.setExtendedProp('description', this.description);
                        this.editingEvent.setExtendedProp('venue_id', this.selectedVenue);
                        this.editingEvent.setStart(`${this.selectedDate}T${this.startTime}`);
                        this.editingEvent.setEnd(`${this.selectedDate}T${this.endTime}`);
                        this.editingEvent.setProp('color', this.getVenueColor(this.selectedVenue));
                    }
                } else {
                    const response = await axios.post('/calendar', {
                        name: this.name,
                        description: this.description,
                        date: this.selectedDate,
                        venue_id: this.selectedVenue,
                        start_time: this.startTime,
                        end_time: this.endTime,
                    });

                    if (response.data.success) {
                        Swal.fire({
                            toast: true,
                            position: 'top-end',
                            icon: 'success',
                            title: 'Event created successfully!',
                            showConfirmButton: false,
                            timer: 1500,
                        });

                        this.calendar.addEvent({
                            ...response.data.event,
                            color: this.getVenueColor(this.selectedVenue),
                        });
                    }
                }

                this.closeModal();
            } catch (error) {
                Swal.fire('Error', error.response?.data?.message || 'An error occurred.', 'error');
            }
        },
        async deleteEvent() {
            if (!this.editingEvent) return;

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
                    const response = await axios.delete(`/calendar/${this.editingEvent.id}`);

                    if (response.data.success) {
                        Swal.fire({
                            toast: true,
                            position: 'top-end',
                            icon: 'success',
                            title: 'Event deleted successfully!',
                            showConfirmButton: false,
                            timer: 1500,
                        });


                        this.editingEvent.remove();
                        this.closeModal();
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

<style>
#calendar {
    width: 100%;
    height: 100%;
    background-color: #ffffff;
    color: #333333;
    padding: 16px;
    border-radius: 12px;
    border: 6px solid #004d00;
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.05);
    box-sizing: border-box;
}


.fc .fc-toolbar {
    background-color: #004d00;
    border-bottom: 6px solid #5c7c66;
    padding: 10px;
    border-radius: 8px 8px 0 0;
}

.fc .fc-toolbar-title {
    color: #ffffff;
    font-size: 2rem;
    font-weight: bold;
    text-align: center;
}


.fc .fc-button {
    background-color: #5c7c66 !important;
    color: #ffffff !important;
    border: none;
    border-radius: 6px;
    padding: 6px 14px;
    font-weight: 500;
}

.fc .fc-button:hover {
    background-color: #3e5a4a !important;
}

.fc .fc-daygrid-day-frame {
    border: 1px solid #333 !important;
}


.fc .fc-daygrid-day-number {
    font-size: 2rem !important;
    font-weight: 700 !important;
    padding: 4px;
}


.fc-day-sun .fc-daygrid-day-number {
    color: red !important;
}


.fc-day-sat .fc-daygrid-day-number {
    color: #4d94ff !important;
}

.fc .fc-daygrid-week-number {
    font-size: 1rem;
    font-weight: bold;
    padding: 10px;
}
.fc-event.philippine-holiday {
    background-color: red !important;
    color: white !important;
    font-weight: bold;
    border-radius: 4px;
    padding: 2px 4px;
}

.fc .fc-col-header-cell-cushion {
    font-weight: bold;
}
</style>
