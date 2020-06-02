<template>
  <div class="container-fluid">
    <ol class="breadcrumb mb-4">
      <li class="breadcrumb-item">
        <h1>Role</h1>
      </li>
    </ol>
    <div class="card mb-4">
      <div class="card-body">
        <div class="row mb-4">
          <div class="col-md-2">ID</div>
          <div class="col-md-8">{{ formdata.id }}</div>
        </div>
        <div class="row mb-4">
          <div class="col-md-2">Name</div>
          <div class="col-md-8">{{ formdata.name }}</div>
        </div>
        <div class="row mb-4">
          <div class="col-md-2">Permissions</div>
          <div class="col-md-8">{{ formdata.permissionsShow }}</div>
        </div>
        <div class="row mb-4">
          <div class="col-md-2">Created At</div>
          <div class="col-md-8">{{ formdata.created_at }}</div>
        </div>
        <div class="row mb-4">
          <div class="col-md-2">Updated At</div>
          <div class="col-md-8">{{ formdata.updated_at }}</div>
        </div>
        <div class="row mb-4">
          <div class="col-md-12">
            <b-button variant="danger" :to="{ name: vueRouteList }">Back</b-button>
          </div>
        </div>
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
      vueRouteList: "role.index",
      apiRouteShow: "role.show"
    };
  },
  methods: {},
  beforeMount() {
    this.$store.dispatch(
      "getItem",
      this.$parent.route(this.apiRouteShow, this.id)
    );
    console.log(this.formdata);
  },
  computed: {
    ...mapGetters(["allerrors", "success", "formdata", "settings"])
  }
};
</script>
