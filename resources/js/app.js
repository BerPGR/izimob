import './bootstrap';
import '../css/app.css';
import { Link, Head } from '@inertiajs/vue3';
import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';
import Layout from './Layouts/Layout.vue';
import VueTheMask from 'vue-the-mask';

createInertiaApp({
    title: title => `Izimob`,
    resolve: name => {
        const pages = import.meta.glob('./Pages/**/*.vue', { eager: true });
        let page = pages[`./Pages/${name}.vue`];
        page.default.layout = page.default.layout || Layout
        return page;
    },
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .use(VueTheMask)
            .component('Link', Link)
            .component('Head', Head)
            .mount(el);
    }
})