import Vue from 'vue';

Vue.component('sidebar', require('./components/SideBarComponent.vue').default);

import Dashboard from './components/DashboardComponent.vue';
import Profile from './components/ProfileComponent.vue';

export const routes = [
    {
        path: '/dashobard',
        component: Dashboard,
        name: 'dashboard',
        props: true
    },
    {
        path: '/profile',
        component: Profile,
        name: 'profile',
        props: true
    },
];

require('./routers/userRoutes');
require('./routers/settingRoutes');
require('./routers/roleRoutes');
require('./routers/permissionRoutes');
require('./routers/activitylogRoutes');

/*--DoNotRemoveMe--*/