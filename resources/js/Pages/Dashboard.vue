<script>
import AdminLayout from '../Layouts/AdminLayout.vue';

export default {
    layout: AdminLayout,
    props: {
        userCount: Number,
        finishedEvents: Number,
        ongoingEvents: Number,
        futureEvents: Number,
    },
};
</script>

<template>
        <!-- Main Content -->
        <div class="col-12 content-card">

            <div class="row">
                <!-- User Count Card -->
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ userCount }}</h3>
                            <p>Total Users</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-users"></i>
                        </div>
                    </div>
                </div>

                <!-- Ongoing Events Count -->
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ ongoingEvents }}</h3>
                            <p>Ongoing Events</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-calendar-check"></i>
                        </div>
                    </div>
                </div>

                <!-- Finished Events Count -->
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ finishedEvents }}</h3>
                            <p>Finished Events</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-calendar-times"></i>
                        </div>
                    </div>
                </div>

                <!-- Future Events Count -->
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ futureEvents }}</h3>
                            <p>Future Events</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                    </div>
                </div>
            </div>

        </div>
</template>

<style scoped>
.small-box {
    border-radius: 10px;
    padding: 20px;
    color: white;
}
.small-box .icon {
    position: absolute;
    top: 10px;
    right: 15px;
    font-size: 40px;
    opacity: 0.5;
}
</style>
