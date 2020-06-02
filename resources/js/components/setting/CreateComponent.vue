<template>
  <div class="container-fluid">
    <ol class="breadcrumb mb-4">
      <li class="breadcrumb-item">
        <h1>Create Setting</h1>
      </li>
    </ol>
    <div class="card mb-4">
      <div class="card-body">
        <b-form @submit.prevent="onSubmit" ref="theForm">
          <b-form-group label="Key:" label-for="key">
            <b-form-input
              id="key"
              name="key"
              v-model="formdata.key"
              :class="allerrors.key ? 'is-invalid' : ''"
            ></b-form-input>
            <div v-if="allerrors.name" :class="['invalid-feedback']">{{ allerrors.name[0] }}</div>
          </b-form-group>
          <b-form-group label label-for="value">
            <b-form-checkbox v-model="isMultiple" name="multipleTypes" switch>
              Switch To{{ isMultiple? 'Single':'Multiple' }}
              <b>(Checked: {{ isMultiple? 'Mulitple':'Single' }})</b>
            </b-form-checkbox>
          </b-form-group>
          <b-form-group label="Value:" label-for="value" v-if="!isMultiple">
            <b-form-input id="value" name="value" type="text" v-model="formdata.value"></b-form-input>
          </b-form-group>
          <b-form-group label="Values:" label-for="values" v-if="isMultiple">
            <b-row v-for="(row, index) in rows" :key="index">
              <b-col cols="4">
                <b-form-input name="indexes[]" type="text" v-model="row.index"></b-form-input>
              </b-col>
              <b-col cols="7">
                <b-form-textarea name="values[]" rows="1" v-model="row.value"></b-form-textarea>
              </b-col>
              <b-col>
                <b-button-group>
                  <b-button type="button" variant="primary" @click="addRow(index)">
                    <i class="fas fa-plus"></i>
                  </b-button>
                  <b-button type="button" variant="danger" @click="delRow(index)">
                    <i class="fas fa-minus"></i>
                  </b-button>
                </b-button-group>
              </b-col>
            </b-row>
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
      apiRouteStore: "setting.store",
      vueRouteList: "setting.index",
      rows: [{ index: null, value: null }],
      isMultiple: false
    };
  },
  methods: {
    onSubmit(evt) {
      this.$store.dispatch("postItem", {
        url: this.$parent.route(this.apiRouteStore),
        data: new FormData(this.$refs.theForm)
      });
    },
    addRow: function(index) {
      try {
        this.rows.splice(index + 1, 0, {});
      } catch (e) {
        console.log(e);
      }
    },
    delRow: function(index) {
      this.rows.splice(index, 1);
    }
  },
  beforeMount() {
    this.formdata.rows = this.rows;
    this.formdata.isMultiple = this.isMultiple;
  },
  beforeCreate() {
    this.$store.dispatch("resetState");
  },
  computed: {
    ...mapGetters(["allerrors", "success", "formdata", "settings"])
  }
};
</script>
