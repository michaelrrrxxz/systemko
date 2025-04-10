<template>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ title }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li v-for="(item, index) in breadcrumbs" :key="index" class="breadcrumb-item"
                            :class="{ active: index === breadcrumbs.length - 1 }">
                            <template v-if="item.url && index !== breadcrumbs.length - 1">
                                <a :href="item.url">{{ item.label }}</a>
                            </template>
                            <template v-else>
                                {{ item.label }}
                            </template>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
export default {
    name: "ContentHeader",
    props: {
        title: {
            type: String,
            default: "Page Title",
        },
        breadcrumbs: {
            type: Array,
            default: () => [
                { label: "Home", url: "#" },
                { label: "Page Title" },
            ],
        },
    },
};
</script>

<style>
.content-header {
    padding: 15px 0;
    border-bottom: 1px solid #dee2e6;
}

.breadcrumb-item a {
    color: #007bff;
    text-decoration: none;
}

.breadcrumb-item a:hover {
    text-decoration: underline;
}

.breadcrumb-item.active {
    color: #6c757d;
}
</style>
