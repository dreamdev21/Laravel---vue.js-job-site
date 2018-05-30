<template>
    <div id="scroll-top">
        <div class="container custom-container">
          <div class="row">
            <h1 class="step-page-title">
              {{header}}
            </h1>
          </div>
        <div class="add-project-page">
          <vue-form class="form-horizontal form-validation" :state="formstate" @submit.prevent="onSubmit">
            <div class="white-box">
              <div class="row">
                <div class="col-12">
                  <h4 class="block-subtitle">
                    Project Details
                  </h4>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-12">
                  <div style="color: red" v-if="errors" >
                    <ul id="example-1">
                      <li v-for="error in errors">
                      {{ error }}
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="row mb-4">
                <div class="col-md-6 border-right">
                    <validate tag="div">
                        <div class="row pb-3">
                            <div class="col-md-4 mb-2 mb-sm-0"><span>Project Title :</span></div>
                            <div class="col-md-8">
                                <input v-model="model.name" name="project_title" type="text" required autofocus placeholder="Enter Project Title" class="form-control custom-form-control" />
                                <field-messages name="project_title" show="$invalid && $submitted" class="text-danger">
                                    <div slot="required">Project Title is a required field</div>
                                </field-messages>
                            </div>
                        </div>
                    </validate>
                    <validate tag="div">
                        <div class="row pb-3">
                            <div class="col-md-4 pr-0 mb-2 mb-sm-0"><span>Project Type :</span></div>
                            <div class="col-md-8">
                                <select id="project_type" name="project_type" size="1" class="form-control custom-form-control" v-model="model.project_type_id" required checkbox>
                                    <option value="-1" selected disabled>
                                        Select Type of Project
                                    </option>
                                    <option v-for="projectType in projectTypes" :value="projectType.id"> {{ projectType.name }} </option>
                                </select>
                                <field-messages name="project_type" show="$invalid && $submitted" class="text-danger">
                                  <div slot="required">Project Type is a required field</div>
                                </field-messages>
                            </div>
                        </div>
                    </validate>
                    <validate tag="div">
                        <div class="row pb-3">
                            <div class="col-md-4 pr-0 mb-2 mb-sm-0">
                                <span>Start Date :</span>
                            </div>
                            <div class="col-md-8">
                                <datepicker input-class="form-control custom-form-control" :format="'dd MMM yyyy'" @selected="disableTo" :disabled="disabled_init" :highlighted="highlighted" v-model="model.start_date" name="dob" required></datepicker>
                                <field-messages name="start_date" show="$invalid && $submitted" class="text-danger">
                                    <div slot="required">Start Date is a required field</div>
                                </field-messages>
                            </div>
                        </div>
                    </validate>
                    <validate tag="div">
                        <div class="row pb-3">
                            <div class="col-md-4 pr-0 mb-2 mb-sm-0">
                                <span>End Date :</span>
                            </div>
                            <div class="col-md-8">
                                <datepicker input-class="form-control custom-form-control" :format="'dd MMM yyyy'" :disabled="disabled" :highlighted="highlighted" v-model="model.end_date" name="dob" required></datepicker>
                                <field-messages name="end_date" show="$invalid && $submitted" class="text-danger">
                                    <div slot="required">End Date is a required field</div>
                                </field-messages>
                            </div>
                        </div>
                    </validate>
                    <validate tag="div">
                        <div class="row pb-3">
                            <div class="col-md-4 pr-0 mb-2 mb-sm-0">
                                <span class="">Time Needed to Test : </span>
                            </div>
                            <div class="col-md-8">
                                <!--<input type="number" v-bind:step="0.5" v-bind:min="0" class="form-control custom-form-control" name="estimate_tester_time" v-model="model.estimate_tester_time" required>-->
                              <input type="time" class="without_ampm custom-form-control" name="estimate_tester_time" v-bind:step="900" style="-webkit-appearance: textfield !important;" v-model="model.estimate_tester_time" required>
                                <field-messages name="estimate_tester_time" show="$invalid && $submitted" class="text-danger">
                                    <div slot="required">This is a required field</div>
                                </field-messages>
                            </div>
                        </div>
                    </validate>
                    <validate tag="div">
                        <div class="row pb-3">
                            <div class="col-md-4 col-12 pr-0 mb-2 mb-sm-0">
                                <span>Testers Needed :</span>
                            </div>
                            <div class="col-md-4 col-6">
                                <input type="number" v-bind:min="1" v-bind:max="50" class="form-control custom-form-control" name="tester_needed" v-model="model.tester_needed" required v-bind:disabled="!this.hasPublisherRole" pattern="^[0-9]{1,45}$">
                                <field-messages name="tester_needed" show="$invalid && $submitted" class="text-danger">
                                    <div slot="required">This is a required field</div>
                                    <div slot="pattern">Enter Integer value</div>
                                </field-messages>
                            </div>
                            <div class="col-md-4 col-6 pl-0 mt-0 mt-sm-2">
                              <project-cost-calculator v-if="this.hasPublisherRole" :testers="+model.tester_needed"></project-cost-calculator>
                              <project-cost-calculator v-else :projectId=Number($route.params.id) :testers="+model.tester_needed"></project-cost-calculator>
                            </div>
                        </div>
                    </validate>
                </div>
                <div class="col-md-6 pr-0">
                    <validate>
                        <div class="row pb-4">
                            <div class="col-md-12 mb-3">Devices to test on :</div>
                            <div class="col-md-12">
                                <device-selector v-model="model.devices" name="device-selector" required></device-selector>
                                <field-messages name="device-selector" show="$invalid && $submitted" class="text-danger">
                                    <div slot="required">Please select device</div>
                                </field-messages>
                            </div>
                        </div>
                    </validate>
                </div>
              </div>
              <div class="row pb-3">
                <div class="col-12">
                  <h4 class="block-subtitle">
                    Project Description
                  </h4>
                </div>
                <div class="col-md-12 pt-2">
                    <validate tag="div">
                        <textarea rows="5" name="project_description" class="form-control custom-form-control resize_vertical" v-model="model.project_description" placeholder="Enter Project Description Here" required></textarea>
                        <field-messages name="project_description" show="$invalid && $submitted" class="text-danger">
                            <div slot="required">This is a required field</div>
                        </field-messages>
                    </validate>
                </div>
              </div>
            </div>
            <div class="white-box">
                <div class="row">
                    <div class="col-md-6">
                        <h4 class="block-subtitle mb-4">
                          Links of App
                        </h4>
                        <transition-group :name="effect" tag="ul" class="list-group">
                          <li v-for="(attachment, i) in attachments" :key="i">
                            <div class="row pb-3">
                              <div class="col-md-4 col-sm-3 col-12 pr-md-0 pb-3 pb-sm-0"><input type="text" class="form-control custom-form-control" placeholder="Title of Link"  v-model="attachment.title" /></div>
                              <div class="col-md-7 col-sm-8 col-10"><input type="text" class="form-control custom-form-control" placeholder="https://" v-model="attachment.link"/></div>
                              <div class="col-md-1 col-sm-1 col-2 p-0"><i class="fa fa-minus-circle icon-34" @click="deleteAttachment(i)"></i></div>
                            </div>
                          </li>
                        </transition-group>
                        <div class="row pb-3" v-if="attachments.length < 5">
                            <div class="col-md-4 col-sm-3 col-12 pr-md-0 pb-3 pb-sm-0"><input name="title_of_link" type="text" class="form-control custom-form-control" placeholder="Title of Link" v-model="initTitle" /></div>
                            <div class="col-md-7 col-sm-8 col-10"><input type="text" class="form-control custom-form-control" placeholder="https://" v-model="initLink" /></div>
                            <div class="col-md-1 col-sm-1 p-0 col-2"><i class="fa fa-plus-circle icon-34" @click="addAttachment"></i></div>
                            <div v-if="titleEmpty" class="pl-3"><span class="text-danger">This is a required field.</span></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                          <h4 class="block-subtitle mb-4">
                          Upload App
                        </h4>
                        <transition-group :name="effect" tag="ul" class="list-group">
                            <li v-for="(file, i) in files" :key="i">
                              <app-uploader canRemove="true" class="row pb-2" :index="i" :file="file" @change="updateFileInCollection" @delete="deleteFile(i)"></app-uploader>
                            </li>
                        </transition-group>
                        <div v-if="files.length < 5">
                            <app-uploader class="row pb-sm-2 pb-4" :canRemove="false" :file="activeFile" @change="updateActiveFile">
                              <div slot="add-icon" class="col-md-1 col-sm-1 col-2 p-0 pt-2 pt-sm-0"><i class="fa fa-plus-circle icon-34" @click="addFile"></i></div>
                            </app-uploader>
                            <div v-if="fileEmpty" class="pl-3 "><span class="text-danger">This is a required field.</span></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="white-box">
                <div class="row pb-3">
                    <div class="col-md-12">
                        <h4 class="block-subtitle mb-4">
                          Notes/Instruction
                        </h4>
                        <textarea name="notes_instruction" rows="5" class="form-control custom-form-control resize_vertical mb-3" v-model="model.notes_instruction" placeholder="Enter any instructions, notes for tester"></textarea>
                    </div>
                </div>
                <div class="row pb-3 pt-md-4">
                    <div class="col-md-12">
                        <div class="row">
                          <div class="col-12">
                            <h4 class="block-subtitle mb-4">
                              Questions
                            </h4>
                          </div>
                        </div>
                        <div class="row pb-4"><span class="col-12">Please add questions here you would like the Testers to answer.</span></div>
                        <transition-group :name="effect" tag="ul" class="list-group">
                            <li v-for="(question, i) in model.questions" :key="i">
                                <div class="form-group pb-3">
                                    <div class="row">
                                        <div class="col-md-2 pr-md-0">
                                          <label for="text" class="text-medium question-label">Question {{i+1}} :</label>
                                        </div>
                                        <div class="col-md-8 col-sm-9">
                                            <input type="text" name="questions" class="form-control custom-form-control" placeholder="" v-model="model.questions[i]">
                                        </div>
                                        <div class="col-md-2 col-sm-3">
                                            <button type="button" class="btn-outline-dark px-4 mt-3 mt-sm-0 blue-btn" @click="deleteQuestion(i)">Remove</button>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </transition-group>
                        <div v-if="model.questionEmpty"><span class="text-danger">Please write question.</span></div>
                        <div class="row">
                            <div class="col-md-3">
                                <button type="button" class="btn-primary blue-btn add-question-btn" @click="addQuestion(true)">Add a Question</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-5">
                <div class="col-md-12 text-center">
                    <router-link :to="{name: this.hasPublisherRole ? 'publisher.projects':'admin.projects'}" class="d-inline-block mr-sm-2 mr-0 grey-btn back-proj-btn"> Back to Projects </router-link>
                    <button type="submit" class="d-inline-block blue-btn post-poj-btn" >{{action_name}}</button>
                </div>
            </div>
          </vue-form>
        </div>
      </div>
    </div>
</template>
<script>
require("vue2-animate/dist/vue2-animate.min.css");
import Vue from "vue";
import VueForm from "vue-form";
import options from "src/validations/validations.js";
import { isAdmin, hasPublisherRole } from "src/services/auth";
import moment from "moment";
import DeviceSelector from "components/components/device-selector";
import ProjectCostCalculator from "components/components/project-cost-calculator";
import AppUploader from "components/components/publisher/app-uploader";
import { objectToFormData } from "src/services/utils";
Vue.use(VueForm, options);
var state = {
  date1: new Date()
};
var today = new Date();
// validation jump
var VueScrollTo = require("vue-scrollto");
Vue.use(VueScrollTo, {
  container: "body",
  duration: 500,
  easing: "ease",
  offset: -100,
  cancelable: true,
  onDone: false,
  onCancel: false,
  x: false,
  y: true
});

const cleanData = {
  name: "",
  project_type_id: "-1",
  start_date: null,
  end_date: null,
  estimate_tester_time: "01:30:00",
  tester_needed: 4,
  project_description: "",
  notes_instruction: "",
  devices: [],
  questions: [],
  initQuestion: "",
  questionEmpty: false,
  initValue: false
  // attachments: [],
  // files: [],
  // initLink: "",
  // titleEmpty: false,
};
export default {
  name: "project_add",
  components: {
    DeviceSelector,
    AppUploader,
    ProjectCostCalculator
  },
  data() {
    return {
      formstate: {},
      header: this.$route.params.id ? "Edit Project" : "Add Project",
      action_name: this.$route.params.id ? "Save Project" : "Post Project",
      model: { ...cleanData },
      errors: null,
      old_file: "",
      originalTestProjects: {},
      projectTypes: {},
      input: "",
      effect: "fadeUp",
      activeFile: {},
      fileEmpty: false,
      attachments: [],
      files: [],
      initTitle: "",
      initValue: "",
      initLink: "",
      titleEmpty: false,
      project_id: "",
      hasPublisherRole: hasPublisherRole(),
      disabled: {
        to: new Date(today.getFullYear(), today.getMonth(), today.getDate())
      },
      highlighted: {
        customPredictor: function(date) {
          if (
            date.getDate() === today.getDate() &&
            date.getMonth() === today.getMonth() &&
            date.getFullYear() === today.getFullYear()
          ) {
            return true;
          }
        }
      },
      disabled_init: {
        to: new Date(today.getFullYear(), today.getMonth(), today.getDate())
      },
      state: state
    };
  },
  methods: {
    onSubmit: function() {
      this.model.initValue = true;
      this.addQuestion(false);
      if (this.formstate.$invalid || this.model.questionEmpty) {
        VueScrollTo.scrollTo("#scroll-top");
        return;
      } else {
        let p;
        this.errors = null;
        const requestData = {
          ...this.model,
          files: undefined,
          attachments: undefined,
          project_info_update: true,
        };
        if (typeof requestData.start_date !== "string") {
          requestData.start_date = requestData.start_date.toMysql();
        }
        if (requestData.end_date && typeof requestData.end_date !== "string") {
          requestData.end_date = requestData.end_date.toMysql();
        }
        if (this.model.id) {
          requestData._method = "PUT";
        }
        delete requestData.attachments;
        delete requestData.files;
        const formData = objectToFormData(requestData);
        if (this.files) {
          this.files.filter(f => f.uploadedFile).forEach(f => {
            formData.append("app[]", f.uploadedFile);
            formData.append("app_description[]", f.description);
          });
          formData.append("existing_app", []);
          this.files.forEach(f => {
            formData.append("existing_app[]", f.name);
          });
          if (this.activeFile) {
            formData.append("app[]", this.activeFile.uploadedFile);
            formData.append("app_description[]", this.activeFile.description);
          }
        }
        (this.attachments || []).forEach((a, index) => {
          formData.append(`attachments[${index}][title]`, a.title);
          formData.append(`attachments[${index}][link]`, a.link);
        });
        if (this.initTitle != "" && this.initLink != "") {
          formData.append(
            `attachments[${this.attachments.length}][title]`,
            this.initTitle
          );
          formData.append(
            `attachments[${this.attachments.length}][link]`,
            this.initLink
          );
        }
        this.$swal({
          title: "Are you sure?",
          text: "You want to submit this project?",
          icon: "success",
          buttons: ["No", "Yes"],
          dangerMode: true
        }).then(isConfirmed => {
          if (isConfirmed) {
            if (this.model.id) {
              p = axios.post(`/api/projects/${this.model.id}`, formData);
            } else {
              p = axios.post("/api/projects", formData);
            }
            p
              .then(response => {
                this.project_id = response.data.data.id;
                this.$router.push({
                  name: this.hasPublisherRole
                    ? "publisher.project.view"
                    : "admin.project.view",
                  params: { id: this.project_id }
                });
              })
              .catch(error => (this.errors = error.response.data.message));
          }
        });
      }
    },
    addAttachment: function() {
      if (this.initTitle == "" || this.initLink == "") {
        this.titleEmpty = true;
        return false;
      } else {
        this.titleEmpty = false;
        this.attachments.push({});
        var key = this.attachments.length - 1;
        this.attachments[key] = {
          title: this.initTitle,
          link: this.initLink
        };
        this.initTitle = "";
        this.initLink = "";
      }
    },
    deleteAttachment: function(index) {
      this.attachments.splice(index, 1);
    },
    updateActiveFile(file) {
      this.activeFile = { ...file };
    },
    addFile: function(file) {
      if (!this.activeFile.name) {
        this.fileEmpty = true;
        return false;
      }
      this.fileEmpty = false;
      if(this.files.length < 5) {
        this.files.push(this.activeFile);
      }
      this.activeFile = {};
    },
    updateFileInCollection(file, index) {
      this.files = [
        ...this.files.slice(0, index),
        { ...this.files[index], ...file },
        ...this.files.slice(index + 1)
      ];
    },
    deleteFile: function(index) {
      this.files = [
        ...this.files.slice(0, index),
        ...this.files.slice(index + 1)
      ];
    },
    addQuestion: function(flag) {
      var key = this.model.questions.length - 1;
      if (this.model.questions[key] === "") {
        this.model.questionEmpty = true;
        return false;
      } else {
        this.model.questionEmpty = false;
        if (flag && key < 4) {
          this.model.questions.push("");
        }
      }
    },
    deleteQuestion: function(index) {
      this.model.questions.splice(index, 1);
    },
    disableTo(val) {
      if (typeof this.disabled.to === "undefined") {
        this.disabled = {
          to: null,
          from: this.disabled.from
        };
      }
      this.disabled.to = val;
    }
  },
  // created: function() {
  //   this.model.start_date = moment().format("D MMM YYYY");
  // },
  mounted: function() {
    if (this.$route.params.id) {
      axios
        .get(`/api/projects/${this.$route.params.id}`)
        .then(({ data: { data } }) => {
          this.model = data;
          this.files = data.media.map(file => ({
            name: file.file_name,
            uploadedFile: ""
          }));
          this.attachments = data.links.map(l => ({
            link: l.link,
            title: l.title
          }));
          this.model.questions = data.questions.map(q => q.question);
          this.initLink = "";
          this.initQuestion = "";
          this.initTitle = "";
          this.titleEmpty = false;
          this.model.devices = data.devices.map(({ id }) => id);
          this.originalTestProjects = data;
        })
        .catch(() => this.$router.push({ name: "admin.test_project" }));
    }
    axios
      .get("/api/project-types")
      .then(response => {
        this.projectTypes = response.data;
      })
      .catch(function(error) {});
    if(this.model.questions) {
      this.model.questions = [];
    }
  }
};
</script>
<style scoped>
.without_ampm::-webkit-datetime-edit-ampm-field {
  display: none;
}
.dropzone_wrapper {
  width: 100%;
  height: 300px;
}
.red-asterisk {
  color: red;
}
@media only screen and (min-width: 768px) {
  .border-right {
    border-right: 1px solid #ccc;
  }
}
.border-bottom {
  border-bottom: 1px solid #ccc;
}
.devices-icon {
  font-size: 50px;
  padding-right: 15px;
}
select {
  height: 34px;
}
.label-title {
  font-size: 14px;
  color: #656599;
  font-weight: 700;
}
.icon-34 {
  font-size: 34px;
}
.btn {
  border-radius: 0 !important;
}
</style>
<style lang="scss" scoped>
@import "../../layouts/css/_customvariables";

.custom-container {
  max-width: 100%;
  padding: 0;
  .text-blue {
    color: #0082cc;
  }
  .text-red {
    color: #e63423;
  }
  .text-green {
    color: #2cac3d;
  }
  .text-bold {
    font-family: $font-family-brandon-bold;
  }
  .text-medium {
    font-family: $font-family-brandon-medium;
  }
  .step-page-title {
    font-family: $font-family-UniNeue-bold;
    font-size: 30px;
    width: 100%;
    text-align: center;
    color: #363e48;
    margin: 5px 0 25px;
  }
  .add-project-page {
    width: 100%;
    .white-box {
      .block-title {
        font-size: 20px;
        font-family: $font-family-UniNeue-bold;
        border-bottom: 1px solid #dadada;
        color: #0082cc;
        padding-bottom: 10px;
        margin-bottom: 10px;
        width: auto;
        min-height: 35px;
        a {
          font-family: $font-family-brandon-medium;
          font-size: 17px;
          text-decoration: underline !important;
          float: right;
        }
      }
      .block-subtitle {
        font-family: $font-family-brandon-bold;
        font-size: 18px;
        color: #606368;
        border-bottom: 1px solid #dadada;
        padding-bottom: 10px;
        margin-bottom: 15px;
      }
      .custom-form-control {
        font-size: 14px;
        border-radius: 4px;
        padding: 6px 8px;
        &:hover {
          outline: none !important;
        }
        &:focus {
          outline: none !important;
        }
      }
      .tester-amt {
        font-size: 17px;
      }
    }
    .blue-btn {
      cursor: pointer;
      width: auto;
      padding: 2px 10px;
      font-size: 14px;
      letter-spacing: 0.05rem;
      color: #fff;
      border-radius: 20px;
      display: block;
      &:hover {
        background-color: #13b9fb;
      }
    }
    .grey-btn {
      padding: 2px 4px;
      font-size: 14px;
      letter-spacing: 0.05rem;
      color: #fff;
      border-radius: 20px;
      display: block;
      &:hover {
        background-color: #95979a;
      }
    }
    .post-poj-btn {
      padding: 6px 15px;
      min-width: 180px;
      font-size: 16px;
    }
    .back-proj-btn {
      padding: 6px 15px;
      min-width: 180px;
      font-size: 16px;
    }
    .question-label {
      font-size: 17px;
    }
  }
}
@media screen and(max-width:1200px) {
  .custom-container {
    .page-title {
      font-size: 28px;
      margin: 0 0 20px;
    }
    .add-project-page {
      .blue-step-btn {
        // font-size: 12px;
        letter-spacing: 0;
      }
      .white-box {
        font-size: 14px;
        .block-title {
          font-size: 18px;
        }
      }
    }
  }
}
@media screen and(max-width:767px) {
  .custom-container {
    .add-project-page {
      .status-bar {
        font-size: 14px;
      }
      .post-poj-btn {
        padding: 6px 10px;
        min-width: 150px;
        font-size: 14px;
      }
      .back-proj-btn {
        padding: 6px 10px;
        min-width: 150px;
        font-size: 14px;
      }
    }
  }
}
@media screen and(max-width:575px) {
  .custom-container {
    padding: 0;
    .step-page-title {
      font-size: 26px;
      margin: 0 0 20px;
    }
    .add-project-page {
      .blue-btn {
        max-width: 130px;
        font-size: 14px;
        margin: 10px 0 0;
      }
      .grey-btn {
        font-size: 14px;
      }
      .white-box {
        line-height: 18px;
      }
      .back-proj-btn {
        padding: 6px;
        max-width: 130px;
        min-width: 130px;
        max-width: 140px;
        font-size: 14px;
      }
      .post-poj-btn {
        min-width: 130px;
      }
    }
  }
}
</style>
