import route from 'ziggy';
import { Ziggy } from '../../assets/js/ziggy';
Vue.mixin({
    methods: {
        route: (name, params, absolute) => route(name, params, absolute, Ziggy),
    },
});