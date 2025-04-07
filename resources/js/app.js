import './bootstrap';
import '../css/app.css';

import { createApp, h as renderComponent } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';
import { Link } from '@inertiajs/vue3';
import $ from 'jquery';
import { InertiaProgress } from '@inertiajs/progress';

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';
window.$ = $;  // Make jQuery globally available
window.jQuery = $;

createInertiaApp({
    title: (title) => title || appName, // Use the page title or fallback to appName
    resolve: (path) => resolvePageComponent(
        `./Pages/${path}.vue`,
        import.meta.glob('./Pages/**/*.vue')
    ),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => renderComponent(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .mount(el);
    },
});

// Initialize Inertia Progress with Bootstrap-compatible styles
InertiaProgress.init({
    delay: 250, // Delay before showing the progress bar
    color: '#2ecc71', // Progress bar color
    includeCSS: false, // Disable default styles
    showSpinner: true, // Show spinner
});
