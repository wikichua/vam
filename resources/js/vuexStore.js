import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

let state = {
    formdata: {},
    success: false,
    allerrors: [],
    settings: [],
    axiosConfigs: {
        headers: {
            'content-type': 'multipart/form-data'
        }
    },
};
let getters = {
    formdata: state => { return state.formdata; },
    success: state => { return state.success; },
    allerrors: state => { return state.allerrors; },
    settings: state => { return state.settings; },
};
let mutations = {};
let actions = {
    resetState({ commit }) {
        state.formdata = {};
        state.success = false;
        state.allerrors = [];
        state.settings = {};
    },
    getSettingsList({ commit }, key) {
        // Fire.route('setting.dropdown', key) // use Fire in customEvents.js to call route because in ziggy.js, Vue.mixin is defined
        Fire.$loading(true);
        Fire.$Progress.start();
        axios.get(Fire.route('setting.dropdown', { key }))
            .then(response => {
                state.settings = response.data;
            })
            .catch(error => {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Something went wrong!'
                });
            }).finally(() => {
                Fire.$loading(false);
                Fire.$Progress.finish();
            });
    },
    postItem({ commit }, obj) {
        let url = obj.url;
        let data = obj.data;
        Fire.$loading(true);
        Fire.$Progress.start();
        axios.post(url, data, state.axiosConfigs)
            .then(response => {
                state.success = true;
                state.response = response;
                Fire.$emit('responseHandling', response);
            })
            .catch(error => {
                state.success = false;
                state.allerrors = error.response.data.errors;
            }).finally(() => {
                Fire.$loading(false);
                Fire.$Progress.finish();
            });
    },
    patchItem({ commit }, obj) {
        let url = obj.url;
        let data = obj.data;
        data.append('_method', 'patch');
        Fire.$loading(true);
        Fire.$Progress.start();
        axios.post(url, data, state.axiosConfigs)
            .then(response => {
                state.success = true;
                state.response = response;
                Fire.$emit('responseHandling', response);
            })
            .catch(error => {
                state.success = false;
                state.allerrors = error.response.data.errors;
            }).finally(() => {
                Fire.$loading(false);
                Fire.$Progress.finish();
            });
    },
    putItem({ commit }, obj) {
        let url = obj.url;
        let data = obj.data;
        data.append('_method', 'put');
        Fire.$loading(true);
        Fire.$Progress.start();
        axios.post(url, data, state.axiosConfigs)
            .then(response => {
                state.success = true;
                state.response = response;
                Fire.$emit('responseHandling', response);
            })
            .catch(error => {
                state.success = false;
                state.allerrors = error.response.data.errors;
            }).finally(() => {
                Fire.$loading(false);
                Fire.$Progress.finish();
            });
    },
    deleteItem({ commit }, obj) {
        let url = obj.url;
        let table = obj.table;
        Swal.fire({
            title: 'Are you sure?',
            text: "You are going to make a difficult decision!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
                Fire.$loading(true);
                Fire.$Progress.start();
                axios.delete(url)
                    .then(response => {
                        Toast.fire({
                            icon: 'success',
                            title: 'Record deleted successfully'
                        });
                        Fire.$emit('reloadDataEvent', table);
                    }).catch(err => {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Something went wrong!'
                        });
                    }).finally(() => {
                        Fire.$loading(false);
                        Fire.$Progress.finish();
                    });
            }
        });
    },
    getItem({ commit }, url) {
        return new Promise((resolve, reject) => {
            Fire.$loading(true);
            Fire.$Progress.start();
            axios.get(url, {}, state.axiosConfigs)
                .then(response => {
                    state.formdata = response.data;
                    resolve(response);
                })
                .catch(error => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Something went wrong!'
                    });
                    reject(error);
                })
                .finally(() => {
                    Fire.$loading(false);
                    Fire.$Progress.finish();
                });
        });
    }
}

export default new Vuex.Store({
    state,
    mutations,
    getters,
    actions
})
