<template>
  <div class="container-fluid">
    <ol class="breadcrumb mb-4">
      <li class="breadcrumb-item">
        <h1>Users</h1>
      </li>
    </ol>
    <div class="card mb-4">
      <div class="card-body">
        <b-button-toolbar align="justify">
          <b-input-group>
            <b-input-group-prepend>
              <b-form-select v-model="dt.perPage" :options="dt.perPages"></b-form-select>
            </b-input-group-prepend>
            <b-form-input v-model="dt.filter" placeholder="Type to Search"></b-form-input>
            <b-input-group-append>
              <b-button :disabled="!dt.filter" @click="dt.filter = ''">Clear</b-button>
              <b-button :to="{ name: vueRouteCreate }">New</b-button>
            </b-input-group-append>
          </b-input-group>
        </b-button-toolbar>
        <b-table
          striped
          hover
          :items="loadItems"
          :busy.sync="dt.isBusy"
          :fields="dt.fields"
          class="mt-3"
          outlined
          show-empty
          :per-page="dt.perPage"
          :current-page="dt.currentPage"
          :filter="dt.filter"
          ref="theTable"
        >
          <template v-slot:cell(action)="data">
            <b-button-group size="sm">
              <router-link
                :to="{ name: vueRouteShow, params: { id: data.item.id } }"
                class="btn btn-secondary"
                v-if="$can('Read Users')"
              >
                <i class="fab fa-readme"></i>
              </router-link>
              <router-link
                :to="{ name: vueRouteEdit, params: { id: data.item.id } }"
                class="btn btn-secondary"
                v-if="$can('Update Users')"
              >
                <i class="fas fa-pencil-alt"></i>
              </router-link>
              <router-link
                :to="{ name: vueRouteEditPassword, params: { id: data.item.id } }"
                class="btn btn-secondary"
                v-if="$can('Update User Password')"
              >
                <i class="fas fa-lock"></i>
              </router-link>
              <a class="btn btn-secondary" href="#" @click="deleteItem(data.item)"
              v-if="$can('Delete Users')">
                <i class="fas fa-trash-alt"></i>
              </a>
            </b-button-group>
          </template>
        </b-table>
        <div class="overflow-auto">
          <b-pagination
            v-model="dt.currentPage"
            :total-rows="dt.totalPage"
            :per-page="dt.perPage"
            aria-controls="datatable"
            align="center"
          ></b-pagination>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      dt: {
        fields: [
          { key: "name", label: "Name", sortable: true, filterable: true },
          { key: "email", label: "Email", sortable: true, filterable: true },
          { key: "type", label: "Type", sortable: false },
          { key: "created_at", label: "Created at", sortable: true },
          { key: "action", label: "Action" }
        ],
        isBusy: false,
        perPage: 10,
        currentPage: 1,
        totalPage: 1,
        filter: null,
        perPages: [10, 25, 50, 75, 100],
        data: []
      },

      editMode: false,
      vueRouteShow: "user.show",
      apiRouteList: "user.index",
      vueRouteCreate: "user.create",
      vueRouteEdit: "user.edit",
      vueRouteEditPassword: "user.editPassword",
      apiRouteDestroy: "user.destroy"
    };
  },
  methods: {
    loadItems(ctx) {
      let params = {
        page: ctx.currentPage,
        size: this.dt.perPage,
        sortBy: ctx.sortBy,
        filter: ctx.filter,
        sortDesc: ctx.sortDesc,
        fields: this.dt.fields
      };
      this.dt.isBusy = true;
      let promise = axios.get(this.$parent.route(this.apiRouteList, params));
      Fire.$loading(true);
      Fire.$Progress.start();
      return promise
        .then(response => {
          const resp = (this.dt.data = response.data);
          const items = resp.data;
          this.dt.totalPage = resp.total;
          this.dt.isBusy = false;
          return items;
        })
        .catch(error => {
          this.dt.isBusy = false;
          return [];
        })
        .finally(() => {
          Fire.$loading(false);
          Fire.$Progress.finish();
        });
    },
    deleteItem(item) {
      this.$store.dispatch("deleteItem", {
        url: this.$parent.route(this.apiRouteDestroy, item.id),
        table: this.$refs.theTable
      });
    }
  },
  created() {}
};
</script>
