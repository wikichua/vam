import { routes } from '../routes';
// user routes
routes.push({
    path: '/user',
    component: require('../components/user/ListComponent.vue').default,
    name: 'user.index',
    props: true
});
routes.push({
    path: '/user/create',
    component: require('../components/user/CreateComponent.vue').default,
    name: 'user.create',
    props: true
});
routes.push({
    path: '/user/:id/show',
    component: require('../components/user/ShowComponent.vue').default,
    name: 'user.show',
    props: true
});
routes.push({
    path: '/user/:id/edit',
    component: require('../components/user/EditComponent.vue').default,
    name: 'user.edit',
    props: true
});
routes.push({
    path: '/user/:id/editPassword',
    component: require('../components/user/EditPasswordComponent.vue').default,
    name: 'user.editPassword',
    props: true
});
