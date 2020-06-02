import { routes } from '../routes';
// role routes
routes.push({
    path: '/role',
    component: require('../components/role/ListComponent.vue').default,
    name: 'role.index',
    props: true
});
routes.push({
    path: '/role/create',
    component: require('../components/role/CreateComponent.vue').default,
    name: 'role.create',
    props: true
});
routes.push({
    path: '/role/:id/show',
    component: require('../components/role/ShowComponent.vue').default,
    name: 'role.show',
    props: true
});
routes.push({
    path: '/role/:id/edit',
    component: require('../components/role/EditComponent.vue').default,
    name: 'role.edit',
    props: true
});
