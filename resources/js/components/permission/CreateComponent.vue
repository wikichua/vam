<template>
  <div class="container-fluid">
    <ol class="breadcrumb mb-4">
      <li class="breadcrumb-item">
        <h1>Create Permission</h1>
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
          <b-form-group label="Group:" label-for="group">
            <b-form-select
              id="group"
              name="group"
              v-model="formdata.group"
              :class="allerrors.group ? 'is-invalid' : ''"
              :options="settings['permission_groups']"
            ></b-form-select>
            <div v-if="allerrors.group" :class="['invalid-feedback']">{{ allerrors.group[0] }}</div>
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
      apiRouteStore: "permission.store",
      vueRouteList: "permission.index"
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
  beforeCreate() {
    this.$store.dispatch("resetState");
  },
  mounted() {
    this.$store.dispatch("getSettingsList", ["permission_groups"]);
  },
  computed: {
    ...mapGetters(["allerrors", "success", "formdata", "settings"])
  }
};
</script>
