import { routes } from '../routes';
// setting routes
routes.push({
    path: '/setting',
    component: require('../components/setting/ListComponent.vue').default,
    name: 'setting.index',
    props: true
});
routes.push({
    path: '/setting/create',
    component: require('../components/setting/CreateComponent.vue').default,
    name: 'setting.create',
    props: true
});
routes.push({
    path: '/setting/:id/show',
    component: require('../components/setting/ShowComponent.vue').default,
    name: 'setting.show',
    props: true
});
routes.push({
    path: '/setting/:id/edit',
    component: require('../components/setting/EditComponent.vue').default,
    name: 'setting.edit',
    props: true
});
