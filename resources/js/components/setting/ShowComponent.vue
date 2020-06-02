<template>
  <div class="container-fluid">
    <ol class="breadcrumb mb-4">
      <li class="breadcrumb-item">
        <h1>Setting</h1>
      </li>
    </ol>
    <div class="card mb-4">
      <div class="card-body">
        <div class="row mb-4">
          <div class="col-md-2">ID</div>
          <div class="col-md-8">{{ formdata.id }}</div>
        </div>
        <div class="row mb-4">
          <div class="col-md-2">Key</div>
          <div class="col-md-8">{{ formdata.key }}</div>
        </div>
        <div class="row mb-4">
          <div class="col-md-2">Value</div>
          <div class="col-md-8">{{ formdata.value }}</div>
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
      vueRouteList: "setting.index",
      apiRouteShow: "setting.show"
    };
  },
  methods: {},
  mounted() {
    this.$store.dispatch(
      "getItem",
      this.$parent.route(this.apiRouteShow, this.id)
    );
  },
  computed: {
    ...mapGetters(["allerrors", "success", "formdata", "settings"])
  }
};
</script>
