import Vue from 'vue';

Vue.component('sidebar', require('./components/SideBarComponent.vue').default);

import Dashboard from './components/DashboardComponent.vue';

export const routes = [
    {
        path: '/dashobard',
        component: Dashboard,
        name: 'dashboard',
        props: true
    }
];

require('./routers/profileRoutes');
require('./routers/userRoutes');
require('./routers/settingRoutes');
require('./routers/roleRoutes');
require('./routers/permissionRoutes');
require('./routers/activitylogRoutes');

/*--DoNotRemoveMe--*/
