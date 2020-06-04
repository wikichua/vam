import { routes } from '../routes';
// profile routes
routes.push({
    path: '/profile',
    component: require('../components/profile/EditComponent.vue').default,
    name: 'profile.edit',
    props: true
});
routes.push({
    path: '/profile/password',
    component: require('../components/profile/EditPasswordComponent.vue').default,
    name: 'profile.editPassword',
    props: true
});
