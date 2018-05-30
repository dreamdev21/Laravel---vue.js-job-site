<template>
    <div class="row">
        <div class="col-lg-12">
            <b-card :header="header" header-tag="h4" class="bg-success-card">
                <div class="row">
                    <div class="col-lg-12">
                        <div style="color: red" v-if="errors">
                            <ul id="example-1">
                                <li v-for="error in errors">
                                    {{ error }}
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-7 col-12 mb-3">
                        <vue-form class="form-horizontal form-validation" :state="formstate" @submit.prevent="onSubmit">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <validate tag="div">
                                        <label for="name"> Device Name</label>
                                        <input v-model="model.name" name="name" type="text" required autofocus placeholder="Device Name" class="form-control" />
                                        <field-messages name="name" show="$invalid && $submitted" class="text-danger">
                                            <div slot="required">Please enter device name</div>
                                        </field-messages>
                                    </validate>
                                </div>
                            </div>
                            <!--<div class="col-lg-12">-->
                                <!--<div class="form-group">-->
                                    <!--<validate tag="div">-->
                                        <!--<label for="name">Status</label>-->
                                        <!--<select id="status" name="status" size="1" class="form-control" v-model="model.status" required checkbox>-->
                                            <!--<option value="active">active</option>-->
                                            <!--<option value="deactive">deactive</option>-->
                                        <!--</select>-->
                                    <!--</validate>-->
                                <!--</div>-->
                            <!--</div>-->
                            <div class="col-lg-12" style="margin-bottom: 15px;">
                                <label for="icon">Icon</label>
                                <div class="clearfix"></div>
                                <img width="50" height="50" :src="previewUrl ? previewUrl : model.icon" />
                                <div class="clearfix"></div>
                                <input @change="checkFile" type="file" name="icon" style="display: none" ref="icon_file" />
                                <a href="javascript:;" @click="triggerFileClick">Edit</a>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <validate tag="div">
                                        <label for="status">Status</label> <br/>
                                        <label class="radio-inline">
                                            <input type="radio" name="status" v-model="model.status" class="form-control" value="Active" />Active
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="status" v-model="model.status" class="form-control" value="Deactive" />Deactive
                                        </label>
                                    </validate>
                                </div>
                            </div>
                            <div class="col-md-offset-4 col-md-8 m-t-25">
                                <button type="submit" class="btn btn-primary">
                                    <span class="" v-if="$route.params.id">
                                    Save Device
                                    </span>
                                    <span class="" v-else>
                                        Submit
                                    </span>
                                </button>
                                <router-link :to="{ name: 'admin.device' }" class="btn btn-primary">Cancel</router-link>
                            </div>
                        </vue-form>
                    </div>
                </div>
            </b-card>
        </div>
    </div>
</template>
<script>
import Vue from "vue";
import VueForm from "vue-form";
import options from "src/validations/validations.js";
Vue.use(VueForm, options);
const cleanData = {
  name: "",
  status: "Active"
};
export default {
  name: "add_device",
  data() {
    return {
      formstate: {},
      header: this.$route.params.id ? "Edit Device" : "Add Device",
      model: { ...cleanData },
      errors: null,
      old_file: "",
      originalDevice: {},
      iconFile: null,
      previewUrl: "/images/device_no_icon.png"
    };
  },
  methods: {
    checkFile(e) {
      const file = e.target.files[0];
      if (file){
        const ext = file.name.split(".").pop();
        if (["jpg", "jpeg", "png"].indexOf(ext) === -1) {
          return this.$swal(
            "Error",
            "Only jpg, jpeg, png images are allowed",
            "error"
          );
        }
      }
      this.iconFile = file;
      var reader = new FileReader();
      reader.onload = e => (this.previewUrl = e.target.result);
      reader.readAsDataURL(file);
    },
    triggerFileClick() {
      this.$refs.icon_file.click();
    },
    onSubmit: function() {
      if (this.formstate.$invalid) {
        return;
      } else {
        let p;
        let requestData;
        if (this.iconFile) {
          requestData = new FormData();
          requestData.append("name", this.model.name);
          requestData.append("status", this.model.status);
          requestData.append("icon", this.iconFile);
          if (this.model.id) {
            requestData.append("_method", "PUT");
          }
        } else {
          requestData = { ...this.model };
          if (this.model.id) {
            requestData._method = "PUT";
          }
        }
        if (this.model.id) {
          p = axios.post(`/api/device/${this.model.id}`, requestData);
        } else {
          p = axios.post("/api/device", requestData);
        }
        p
          .then(response => {
            this.$router.push({ name: "admin.device" });
            this.$store.commit("set_devices", []); // reset device collection
          })
          .catch(error => (this.errors = error.response.data.message));
      }
    }
  },
  mounted: function() {
    if (this.$route.params.id) {
      axios
        .get(`/api/device/${this.$route.params.id}`)
        .then(({ data: { data } }) => {
          this.model = data;
          this.previewUrl = data.icon;
          this.originalDevice = data;
        })
        .catch(() => this.$router.push({ name: "admin.device" }));
    }
  },
  destroyed: function() {}
};
</script>
<style scoped>
.dropzone_wrapper {
  width: 100%;
  height: 300px;
}
.red-asterisk {
  color: red;
}
</style>
