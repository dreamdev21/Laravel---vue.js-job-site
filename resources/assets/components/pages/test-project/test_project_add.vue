<template>
    <div id="scroll-top" >
        <div class="container custom-container">
            <div class="row">
              <div class="col-12">
                <h1 class="step-page-title">
                   {{ header }}
                </h1>
              </div>
            </div>
            <div class="add-project-page">
                <vue-form class="form-horizontal form-validation" :state="formstate" @submit.prevent="onSubmit" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="white-box">
                                <div class="row">
                                    <div class="col-12">
                                        <h4 class="block-subtitle">
                                        Project Details
                                        </h4>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div style="color: red" v-if="errors" v-text="errors"></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 border-right">
                                        <validate tag="div">
                                            <div class="row pb-3">
                                                <div class="col-md-4 pr-md-0 mb-2 mb-sm-0"><span>Project Title :</span></div>
                                                <div class="col-md-8">
                                                    <input v-model="model.name" name="project_title" type="text" required autofocus placeholder="Enter Project Title" class="form-control custom-form-control " />
                                                    <field-messages name="project_title" show="$invalid && $submitted" class="text-danger">
                                                        <div slot="required">Project Title is a required field</div>
                                                    </field-messages>
                                                </div>
                                            </div>
                                        </validate>
                                        <validate tag="div">
                                            <div class="row pb-3">
                                                <div class="col-md-4 pr-md-0 mb-2 mb-sm-0"><span>Project Type :</span></div>
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
                                                <div class="col-md-4 pr-md-0 mb-2 mb-sm-0">
                                                    <span>Time Needed to Test : </span>
                                                </div>
                                                <div class="col-md-8">
                                                  <input type="time" class="without_ampm" name="estimate_tester_time" v-bind:step="900" style="-webkit-appearance: textfield !important;" v-model="model.estimate_tester_time" required>
                                                    <field-messages name="estimate_tester_time" show="$invalid && $submitted" class="text-danger">
                                                        <div slot="required">This is a required field</div>
                                                    </field-messages>
                                                </div>
                                            </div>
                                        </validate>
                                    </div>
                                    <div class="col-md-6 pr-0">
                                        <validate>
                                            <div class="row pb-3">
                                                <div class="col-md-12">Devices to test on :</div>
                                                <div class="col-md-8 pt-4">
                                                    <device-selector name="device-selector" v-model="model.devices" required></device-selector>
                                                    <field-messages name="device-selector" show="$invalid && $submitted" class="text-danger">
                                                        <div slot="required">Please select device</div>
                                                    </field-messages>
                                                </div>
                                            </div>
                                        </validate>
                                    </div>
                                </div>
                                <div class="row pt-3">
                                    <div class="col-12">
                                        <h4 class="block-subtitle">
                                        Project Description
                                        </h4>
                                    </div>
                                    <div class="col-md-12">
                                        <validate tag="div">
                                            <textarea rows="5" name="project_description" class="form-control custom-form-control resize_vertical" v-model="model.project_description" placeholder="Enter Project Description Here" required></textarea>
                                            <field-messages name="project_description" show="$invalid && $submitted" class="text-danger">
                                                <div slot="required">This is a required field</div>
                                            </field-messages>
                                        </validate>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="white-box">
                                <div class="row pb-3">
                                  <div class="col-md-6">
                                    <h4 class="block-subtitle mb-4">
                                      Links of App :
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
                                        Upload App :
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
                                          <div v-if="fileEmpty" class="pl-3"><span class="text-danger">This is a required field.</span></div>
                                      </div>
                                  </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="white-box">
                                <div class="row pb-4">
                                    <div class="col-md-12">
                                        <h4 class="block-subtitle">
                                            Notes/Instruction :
                                        </h4>
                                          <textarea rows="5" name="notes_instruction" class="form-control custom-form-control resize_vertical mb-3" v-model="model.notes_instruction" placeholder="Enter any notes for the Tester here including installation instructions and any needed codes"></textarea>
                                    </div>
                                </div>
                                <div class="row pb-3 pt-4">
                                    <div class="col-md-12">
                                        <h4 class="block-subtitle">
                                            Questions
                                        </h4>
                                        <div class="row pb-4"><span class="col-12">Add any specific questioins for the Testers</span></div>
                                        <transition-group :name="effect" tag="ul" class="list-group">
                                            <li v-for="(question, i) in model.questions" :key="i">
                                                <div class="form-group pb-3">
                                                    <div class="row">
                                                        <div class="col-md-2 pr-md-0 mb-2 mb-sm-0">
                                                            <span class="text-bold question-label">Question {{i+1}} :</span>
                                                        </div>
                                                        <div class="col-md-8 col-sm-9">
                                                            <input type="text" name="questions" class="form-control custom-form-control" placeholder="Enter question" v-model="model.questions[i]">
                                                        </div>
                                                        <div class="col-md-2 col-sm-3">
                                                            <button type="button" class="purple-btn" @click="deleteQuestion(i)">Remove</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        </transition-group>
                                        <div v-if="model.questionEmpty"><span class="text-danger">Please write question.</span></div>
                                        <div class="row pb-4" v-if="model.questions.length < 5">
                                            <div class="col-xl-3 col-md-6">
                                                <button type="button" class="purple-btn" @click="addQuestion(true)">Add more Question</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-5">
                        <div class="col-md-12 text-center">
                            <router-link :to="{name: 'admin.test_projects'}" class="d-inline-block mr-sm-2 mr-0 grey-btn back-proj-btn" > Back to Projects </router-link>
                            <button class="d-inline-block purple-btn post-poj-btn" type="submit">
                              <span class=""  v-if="$route.params.id">Save</span>
                              <span class="" v-else>Post</span>
                               Test Project
                            </button>
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
import DeviceSelector from "components/components/device-selector";
import AppUploader from "components/components/publisher/app-uploader";
import { objectToFormData } from "src/services/utils";
Vue.use(VueForm, options);
// validation jump
var VueScrollTo = require('vue-scrollto');
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
  project_type_id: "",
  estimate_tester_time: "01:30:00",
  project_description: "",
  notes_instruction: "",
  devices: [],
  questions: [],
  initQuestion: "",
  questionEmpty: false,
  initValue: false
};
export default {
  name: "test_project_add",
  components: {
    DeviceSelector,
    AppUploader
  },
 data() {
    return {
      formstate: {},
      header: this.$route.params.id
        ? "Edit Project"
        : "Add Test Project",
      action_name: this.$route.params.id ? "Edit Project" : "Post Project",
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
      initLink: "",
      titleEmpty: false,
      project_id: ""
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
        requestData.is_test_project = 1;
        if (this.model.id) {
          requestData._method = "PUT";
        }
        delete requestData.attachments;
        delete requestData.files;
        const formData = objectToFormData(requestData);
        if(this.files){
          this.files.filter(f => f.uploadedFile).forEach(f => {
            formData.append("app[]", f.uploadedFile);
            formData.append("app_description[]", f.description);
          });
          formData.append("existing_app", []);
          this.files.forEach(f => {
            formData.append("existing_app[]", f.name);
          });
          if(this.activeFile){
            formData.append("app[]", this.activeFile.uploadedFile);
            formData.append("app_description[]", this.activeFile.description);
          }
        }
        (this.attachments || []).forEach((a, index) => {
          formData.append(`attachments[${index}][title]`, a.title);
          formData.append(`attachments[${index}][link]`, a.link);
        });
        if(this.initTitle != "" && this.initLink != ""){
          formData.append(`attachments[${this.attachments.length}][title]`, this.initTitle);
          formData.append(`attachments[${this.attachments.length}][link]`, this.initLink);
        }
        this.$swal({
          title: "Are you sure?",
          text: "You want to submit this test project?",
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
              .then(response =>{
                this.project_id = response.data.data.id;
                this.$router.push({ name: "admin.test_project.view", params : { id: this.project_id } });
                this.$store.commit("set_devices", []); // reset device collection
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
      this.files.push(this.activeFile);
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
        if(flag) {
          this.model.questions.push("");
        }
      }
    },
    deleteQuestion: function(index) {
      this.model.questions.splice(index, 1);
    }
  },
  mounted: function() {
    if (this.$route.params.id) {
      axios
        .get(`/api/projects/${this.$route.params.id}`)
        .then(({ data: { data } }) => {
          this.model = data;
          this.files = data.media.map(file => ({ 'name': file.file_name, 'uploadedFile' : '' }));
          this.attachments = data.links.map( l => ({'link': l.link, 'title': l.title }));
          this.model.questions =  data.questions.map(q => q.question );
          this.initLink = "";
          this.initQuestion = "";
          this.initTitle = "" ;
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
  /*input[type=time]::-webkit-clear-button {*/
    /*-webkit-appearance: textfield !important;*/
    /*-webkit-appearance: none;*/
    /*-moz-appearance: none;*/
    /*-o-appearance: none;*/
    /*-ms-appearance:none;*/
    /*appearance: none;*/
    /*margin: -10px;*/
  /*}*/
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
.active {
  opacity: 0.5;
}
</style>
<style lang="scss" scoped>
@import "../../layouts/css/_customvariables";
  .custom-container{
    max-width: 100%;
    padding: 0;
  }
  .step-page-title{
    font-family: $font-family-UniNeue-bold;
    font-size : 30px;
    width: 100%;
    text-align: center;
    color: #363e48;
    margin: 5px 0 25px;
  }
  .add-project-page{
    width: 100%;
    .white-box{
      .block-title{
        font-size: 20px;
        font-family: $font-family-UniNeue-bold;
        border-bottom: 1px solid #dadada;
        color: #3e3a94;
        padding-bottom: 10px;
        margin-bottom: 10px;
        width: auto;
        min-height:35px;
        a{
          font-family: $font-family-brandon-medium;
          font-size: 17px;
          text-decoration: underline !important;
          float: right;
        }
      }
      .block-subtitle{
        font-family: $font-family-brandon-bold;
        font-size: 20px;
        color: #3e3a94;
        border-bottom: 1px solid #dadada;
        padding-bottom: 10px;
        margin-bottom: 15px;
      }
      .custom-form-control{
        font-size: 17px;
        border-radius: 4px;
        padding: 2px 8px;
        &:hover{
          outline: none !important;
        }
        &:focus{
          outline: none !important;
        }
      }
    }
    .purple-btn{
      cursor: pointer;
      width: auto;
      border-radius: 20px !important;
      padding: 6px 20px;
      display: block;
    }
    .post-poj-btn,.back-proj-btn{
      padding: 6px 20px;
      max-width: 230px;
      font-size: 16px;
      vertical-align: top;
      border-radius: 20px;
    }
    .question-label{
      font-size: 17px;
    }
  }

@media screen and(max-width:1281px) {
    .add-project-page{
      .white-box{
        .icon-34{
          font-size: 24px;
          margin-top: 4px;
        }
      }
      .purple-btn{
        padding: 6px;
      }
      .post-poj-btn{
        padding: 6px 15px;
      }
      .back-proj-btn{
      }
    }
}
@media screen and(max-width:1200px) {

    .page-title{
      font-size: 28px;
      margin: 0 0 20px;
    }
    .add-project-page{
      .blue-step-btn{
        // font-size: 12px;
        letter-spacing: 0;
      }
      .white-box{
        .block-title{
          font-size: 18px;
        }
       .add-question-btn{
       }
      }
    }
  }
@media screen and(max-width:991px) {
    .custom-container{
    max-width: 100%;
    .add-project-page{
      .white-box{
        padding: 15px;
      }
    }
  }
}
@media screen and(max-width:767px) {
    .add-project-page{
      .status-bar{
        font-size: 14px;
      }
    }
  }
@media screen and(max-width:575px) {
  .custom-container{
    padding: 0;
    .step-page-title{
      font-size: 26px;
      margin: 0 0 20px;
    }
    .add-project-page{
      .blue-step-btn{
          max-width: 180px;
          font-size: 14px;
          margin: 10px 0 0;
      }
      .grey-btn{
        font-size: 14px;
      }
      .purple-btn{
        margin-top: 10px;
        font-size: 14px;
        padding: 4px 6px;
      }
      .white-box{
        line-height: 18px;
      }
      .back-proj-btn,.post-poj-btn{
        font-size: 14px;
        margin: 0 auto !important;
        padding: 6px;
        max-width: 155px;
      }
      .question-label{
        margin-bottom: 10px;
      }
    }
  }
}
</style>