import { routes } from '../routes';
// activitylog routes
routes.push({
    path: '/activitylog',
    component: require('../components/activitylog/ListComponent.vue').default,
    name: 'activitylog.index',
    props: true
});
routes.push({
    path: '/activitylog/:id/show',
    component: require('../components/activitylog/ShowComponent.vue').default,
    name: 'activitylog.show',
    props: true
});
