<template>
    <div>
      
        <section class="hero-section text-white text-center d-flex justify-content-center align-items-center">
            <div class="hero-content">
                <h1 class="display-4 mb-4">Welcome to Our Service</h1>
                <p class="lead mb-4">Revolutionize the way you work with our cutting-edge technology.</p>
                <Link :href="route('login')" class="btn btn-custom btn-lg">Get Started</Link>
            </div>
        </section>

        <section class="calendar-section py-5 text-center">
            <div class="container">
                <h2 class="mb-4">Upcoming Events</h2>
                <div id="landing-calendar"></div>
            </div>
        </section>


        <footer class="footer bg-dark text-white text-center py-3">
            <p>&copy; 2025 Our Service. All Rights Reserved.</p>
        </footer>
    </div>
</template>

<script>
import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import interactionPlugin from '@fullcalendar/interaction';
import { Link } from '@inertiajs/vue3';

export default {
    name: 'LandingPage',
    components: {
        Link,
    },
    props: {
        events: Array,
    },
    data() {
        return {
            calendar: null,
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


        const calendarEl = document.getElementById('landing-calendar');
        const holidayEvents = philippineHolidays.map(holiday => ({
            ...holiday,
            color: 'red',
            textColor: 'white',
            classNames: ['philippine-holiday'],
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
    beforeDestroy() {
        if (this.calendar) {
            this.calendar.destroy();
        }
    },
    methods: {
        getVenueColor(venue_id) {
            const colors = ['#3498db', '#2ecc71', '#f39c12', '#9b59b6'];
            return colors[venue_id % colors.length];
        },
        handleDateClick(info) {
            alert(`Clicked on date: ${info.dateStr}`);
        },
        handleEventClick(info) {
            alert(`Event: ${info.event.title}`);
        },
    }
};
</script>

<style>
/* Hero Section */
.hero-section {
    background: linear-gradient(to right, #004d00, #004d00);
    height: 100vh;
    color: white;
}

.hero-content {
    max-width: 600px;
    text-align: center;
}

/* Calendar Section */
.calendar-section {
    background-color: #f8f9fa;
}

#landing-calendar {
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

/* Header Toolbar */
.fc .fc-toolbar {
    background-color: #004d00;
    border-bottom: 6px solid #5c7c66;
    padding: 10px;
    border-radius: 8px 8px 0 0;
}

/* Toolbar Title */
.fc .fc-toolbar-title {
    color: #ffffff;
    font-size: 2rem;
    font-weight: bold;
    text-align: center;
}

/* Buttons */
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

/* Day Grid Cell Border */
.fc .fc-daygrid-day-frame {
    border: 1px solid #333 !important;
}

/* Date Numbers */
.fc .fc-daygrid-day-number {
    font-size: 2rem !important;
    font-weight: 700 !important;
    padding: 4px;
}

/* Red Sundays */
.fc-day-sun .fc-daygrid-day-number {
    color: red !important;
}

/* Blue Saturdays */
.fc-day-sat .fc-daygrid-day-number {
    color: #4d94ff !important;
}

/* Week Numbers */
.fc .fc-daygrid-week-number {
    font-size: 1rem;
    font-weight: bold;
    padding: 10px;
}

/* Philippine Holiday Styling */
.fc-event.philippine-holiday {
    background-color: red !important;
    color: white !important;
    font-weight: bold;
    border-radius: 4px;
    padding: 2px 4px;
}

/* Header Day Names */
.fc .fc-col-header-cell-cushion {
    font-weight: bold;
}

/* Footer */
.footer {
    background-color: #333;
}

/* Custom Button */
.btn-custom {
    background-color: #2ecc71;
    color: white;
    border-radius: 4px;
    padding: 12px 24px;
    font-size: 1.2rem;
    text-decoration: none;
}

.btn-custom:hover {
    background-color: #27ae60;
}

/* General Styles */
h2 {
    font-weight: bold;
}

p {
    color: #555;
}
</style>
