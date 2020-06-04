<template>
  <div class="container-fluid">
    <ol class="breadcrumb mb-4">
      <li class="breadcrumb-item">
        <h1>My Profile</h1>
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
          <b-form-group label="Email:" label-for="email">
            <b-form-input
              id="email"
              name="email"
              type="email"
              v-model="formdata.email"
              :class="allerrors.email ? 'is-invalid' : ''"
            ></b-form-input>
            <div v-if="allerrors.email" :class="['invalid-feedback']">{{ allerrors.email[0] }}</div>
          </b-form-group>
          <b-button type="submit" variant="dark">Submit</b-button>
        </b-form>
      </div>
    </div>
  </div>
</template>
<script>
import { mapGetters } from "vuex";
export default {
  props: ["id"],
  data() {
    return {
      apiRouteUpdate: "profile.update",
      apiRouteShow: "profile.show"
    };
  },
  methods: {
    onSubmit(evt) {
      this.$store.dispatch("patchItem", {
        url: this.$parent.route(this.apiRouteUpdate, this.id),
        data: new FormData(evt.srcElement)
      });
    }
  },
  mounted() {
    Fire.$loading(true);
    Fire.$Progress.start();
    this.$store.dispatch("getSettingsList", "user_types"); // may get multiple settings in array format
    axios
      .get(this.$parent.route("role.checkboxes"))
      .then(response => {
        this.options = response.data;
      })
      .catch(error => {})
      .finally(() => {
        Fire.$loading(false);
        Fire.$Progress.finish();
      });
    this.$store
      .dispatch("getItem", this.$parent.route(this.apiRouteShow, this.id))
      .then(response => {
        this.roles = this.formdata.rolesSelected;
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
