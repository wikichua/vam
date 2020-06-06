import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

let state = {
    formdata: {},
    success: false,
    allerrors: [],
    settings: [],
    models: [],
    axiosConfigs: {
        headers: {
            'content-type': 'multipart/form-data'
        }
    },
    swalOptions: {
        title: 'Are you sure?',
        text: null,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, do it!'
    }
};
let getters = {
    formdata: state => { return state.formdata; },
    success: state => { return state.success; },
    allerrors: state => { return state.allerrors; },
    settings: state => { return state.settings; },
    models: state => { return state.models; },
};
let mutations = {};
// use Fire.route() for ziggy router laravel route name
let actions = {
    resetState({ commit }) {
        state.formdata = {};
        state.success = false;
        state.allerrors = [];
        // state.settings = {};
        // state.models = {};
    },
    getSettingsList({ commit }, key) {
        if (Array.isArray(key)) {
            key.forEach((keyName) => {
                state.settings[keyName] = Fire.$settings(keyName);
            });
        } else {
            state.settings[key] = Fire.$settings(key);
        }
    },
    getModelsList({ commit }, url) {
        // Fire.route('setting.dropdown', key) // use Fire in customEvents.js to call route because in ziggy.js, Vue.mixin is defined
        let key = url.urlParams.key;
        key.forEach((keyName) => {
            if (!(keyName in state.models)) {
                Fire.$loading(true);
                Fire.$Progress.start();
                axios.get(url)
                    .then(response => {
                        let respData = response.data;
                        for (let [index, value] of Object.entries(respData)) {
                            state.models[index] = value;
                        }
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
            }
        });

    },
    postItem({ commit, dispatch }, obj) {
        let canSubmitNow = true;
        if (obj.hasOwnProperty('confirmed')) {
            canSubmitNow = false;
            state.swalOptions['text'] = obj.confirmed;
            Swal.fire(state.swalOptions).then((result) => {
                if (result.value) {
                    dispatch('commitPost', obj);
                }
            });
        } else {
            dispatch('commitPost', obj);
        }
    },
    patchItem({ commit, dispatch }, obj) {
        let canSubmitNow = true;
        obj.data.append('_method', 'patch');
        if (obj.hasOwnProperty('confirmed')) {
            canSubmitNow = false;
            state.swalOptions['text'] = obj.confirmed;
            Swal.fire(state.swalOptions).then((result) => {
                if (result.value) {
                    dispatch('commitPost', obj);
                }
            });
        } else {
            dispatch('commitPost', obj);
        }
    },
    putItem({ commit, dispatch }, obj) {
        let canSubmitNow = true;
        obj.data.append('_method', 'put');
        if (obj.hasOwnProperty('confirmed')) {
            canSubmitNow = false;
            state.swalOptions['text'] = obj.confirmed;
            Swal.fire(state.swalOptions).then((result) => {
                if (result.value) {
                    dispatch('commitPost', obj);
                }
            });
        } else {
            dispatch('commitPost', obj);
        }
    },
    deleteItem({ commit }, obj) {
        let url = obj.url;
        let table = obj.table;
        let msg = "You are going to make a very difficult decision!";
        if (obj.hasOwnProperty('confirmed')) {
            msg = obj.confirmed;
        }
        state.swalOptions['text'] = msg;
        Swal.fire(state.swalOptions).then((result) => {
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
    },
    commitPost({ commit }, obj) {
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
    }
}

export default new Vuex.Store({
    state,
    mutations,
    getters,
    actions
})
