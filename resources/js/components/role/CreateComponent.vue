<template>
  <div class="container-fluid">
    <ol class="breadcrumb mb-4">
      <li class="breadcrumb-item">
        <h1>Create Role</h1>
      </li>
    </ol>
    <div class="card mb-4">
      <div class="card-body">
        <b-form @submit.prevent="onSubmit" ref="theForm">
          <b-form-group label="Name:" label-for="name">
            <b-form-input
              id="name"
              name="name"
              v-model="formdata.name"
              :class="allerrors.name ? 'is-invalid' : ''"
            ></b-form-input>
            <div v-if="allerrors.name" :class="['invalid-feedback']">{{ allerrors.name[0] }}</div>
          </b-form-group>
          <b-form-group label="Permissions:">
            <b-card-group deck>
              <b-card :title="index" v-for="(opts, index) in options" :key="index">
                <b-card-text>
                  <b-form-group>
                    <b-form-checkbox-group
                      v-model="permissions"
                      name="permissions[]"
                      switches
                      stacked
                      :options="opts"
                    ></b-form-checkbox-group>
                  </b-form-group>
                </b-card-text>
              </b-card>
            </b-card-group>
          </b-form-group>
          <b-button type="submit" variant="dark">Submit</b-button>
          <b-button variant="danger" :to="{ name: vueRouteList }">Back</b-button>
        </b-form>
      </div>
    </div>
  </div>
</template>
<script>
import { mapGetters } from "vuex";
export default {
  data() {
    return {
      apiRouteStore: "role.store",
      vueRouteList: "role.index",
      permissions: [],
      options: []
    };
  },
  methods: {
    onSubmit(evt) {
      this.$store.dispatch("postItem", {
        url: this.$parent.route(this.apiRouteStore),
        data: new FormData(this.$refs.theForm)
      });
    }
  },
  mounted() {
    Fire.$loading(true);
    Fire.$Progress.start();
    axios
      .get(this.$parent.route("permission.checkboxes"))
      .then(response => {
        this.options = response.data;
      })
      .catch(error => {})
      .finally(() => {
        Fire.$loading(false);
        Fire.$Progress.finish();
      });
  },
  beforeCreate() {
    this.$store.dispatch("resetState");
  },
  computed: {
    ...mapGetters(["allerrors", "success", "formdata", "settings"])
  }
};
</script>
