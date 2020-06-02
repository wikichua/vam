import { routes } from '../routes';
// permission routes
routes.push({
    path: '/permission',
    component: require('../components/permission/ListComponent.vue').default,
    name: 'permission.index',
    props: true
});
routes.push({
    path: '/permission/create',
    component: require('../components/permission/CreateComponent.vue').default,
    name: 'permission.create',
    props: true
});
routes.push({
    path: '/permission/:id/show',
    component: require('../components/permission/ShowComponent.vue').default,
    name: 'permission.show',
    props: true
});
routes.push({
    path: '/permission/:id/edit',
    component: require('../components/permission/EditComponent.vue').default,
    name: 'permission.edit',
    props: true
});
