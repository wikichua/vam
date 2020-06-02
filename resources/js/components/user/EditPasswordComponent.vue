<template>
  <div class="container-fluid">
    <ol class="breadcrumb mb-4">
      <li class="breadcrumb-item">
        <h1>Edit User Password</h1>
      </li>
    </ol>
    <div class="card mb-4">
      <div class="card-body">
        <b-form @submit.prevent="onSubmit" ref="theForm">
          <b-form-group label="Password:" label-for="password">
            <b-form-input
              id="password"
              name="password"
              type="password"
              v-model="formdata.password"
              :class="allerrors.password ? 'is-invalid' : ''"
            ></b-form-input>
            <div v-if="allerrors.password" :class="['invalid-feedback']">{{ allerrors.password[0] }}</div>
          </b-form-group>
          <b-form-group label="Confirm Password:" label-for="password_confirmation">
            <b-form-input
              id="password_confirmation"
              name="password_confirmation"
              type="password"
              v-model="formdata.password_confirmation"
              :class="allerrors.password_confirmation ? 'is-invalid' : ''"
            ></b-form-input>
            <div
              v-if="allerrors.password_confirmation"
              :class="['invalid-feedback']"
            >{{ allerrors.password_confirmation[0] }}</div>
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
  props: ["id"],
  data() {
    return {
      apiRouteUpdatePassword: "user.updatePassword",
      apiRouteShow: "user.show",
      vueRouteList: "user.index"
    };
  },
  methods: {
    onSubmit(evt) {
      this.$store.dispatch("putItem", {
        url: this.$parent.route(this.apiRouteUpdatePassword, this.id),
        data: new FormData(evt.srcElement)
      });
    }
  },
  beforeMount() {
    this.$store.dispatch(
      "getItem",
      this.$parent.route(this.apiRouteShow, this.id)
    );
  },
  beforeCreate() {
    this.$store.dispatch("resetState");
  },
  computed: {
    ...mapGetters(["allerrors", "success", "formdata", "settings"])
  }
};
</script>
