<template>
  <div>
  <div class="bg-color">
    <div class="container-fluid custom-container p-0">
      <div class="row">
        <div class="col-12">
          <h1 class="step-page-title" :header="header">
            <span class="" v-if="$route.params.id">Edit</span>
            <span class="" v-else>Add</span>
             System
          </h1>
          <div class="add-system-page">
            <vue-form class="form-horizontal form-validation" :state="formstate" @submit.prevent="onSubmit">
                <div class="white-box">
                  <div class="row">
                    <div class="col-12">
                      <h4 class="block-title">
                        System Information
                      </h4>
                    </div>
                    <form class="system-form form-inline">
                      <div class="col-md-6 col-12">
                        <validate tag="div">
                          <div class="form-group">
                            <label class="text-medium">OS <span class="text-red">*</span> : </label>
                            <select class="form-control" name="os" v-model="model.os" required>
                              <option>Select OS</option>
                              <option value="Mac-10.0">Mac-10.0</option>
                              <option value="Windows-7">Windows-7</option>
                              <option value="Windows-8">Windows-8</option>
                              <option value="Windows-9">Windows-9</option>
                              <option value="Windows-10">Windows-10</option>
                              <option value="Ubuntu-14">Ubuntu-14</option>
                            </select>
                            <field-messages name="os" show="$invalid && $submitted" class="text-danger">
                                <div slot="required">This field is missing</div>
                            </field-messages>
                          </div>
                        </validate>
                      </div>
                      <div class="col-md-6 col-12">
                        <validate tag="div">
                          <div class="form-group">
                            <label class="text-medium">Processor <span class="text-red">*</span> : </label>
                            <select class="form-control" name="processor" v-model="model.processor" required>
                              <option>Select Processor</option>
                              <option value="Intel-i3">Intel-i3</option>
                              <option value="Intel-i5">Intel-i5</option>
                              <option value="Intel-i7">Intel-i7</option>
                              <option value="AMD">AMD</option>
                            </select>
                            <field-messages name="processor" show="$invalid && $submitted" class="text-danger">
                                <div slot="required">This field is missing</div>
                            </field-messages>
                          </div>
                        </validate>
                      </div>
                      <div class="col-md-6 col-12">
                        <validate tag="div">
                          <div class="form-group">
                            <label class="text-medium">RAM <span class="text-red">*</span> : </label>
                            <select class="form-control" name="ram" v-model="model.ram" required>
                              <option>Select RAM</option>
                              <option value="2-GB">2-GB</option>
                              <option value="4-GB">4-GB</option>
                              <option value="6-GB">6-GB</option>
                              <option value="8-GB">8-GB</option>
                              <option value="16-GB">16-GB</option>
                              <option value="24-GB">24-GB</option>
                            </select>
                            <field-messages name="ram" show="$invalid && $submitted" class="text-danger">
                                <div slot="required">This field is missing</div>
                            </field-messages>
                          </div>
                        </validate>
                      </div>
                      <div class="col-md-6 col-12">
                        <validate tag="div">
                          <div class="form-group">
                            <label class="text-medium">GPU Memory <span class="text-red">*</span> : </label>
                            <input type="text" class="form-control" placeholder="Enter GPU Memory" name="gpu_memory" v-model="model.gpu_memory" required/>
                            <field-messages name="gpu_memory" show="$invalid && $submitted" class="text-danger">
                                <div slot="required">This field is missing</div>
                            </field-messages>
                          </div>
                        </validate>
                      </div>
                      <div class="col-md-6 col-12">
                        <validate tag="div">
                          <div class="form-group">
                            <label class="text-medium">GPU Model <span class="text-red">*</span> : </label>
                            <input type="text" class="form-control" placeholder="Enter GPU Model" name="gpu_model" v-model="model.gpu_model" required/>
                            <field-messages name="gpu_model" show="$invalid && $submitted" class="text-danger">
                                <div slot="required">This field is missing</div>
                            </field-messages>
                          </div>
                        </validate>
                      </div>
                      
                    </form>
                  </div>
                </div>
                <div class="row">
                  <div class="col-12 text-center">
                    <a @click="$router.go(-1)" class="btn text-uppercase text-center grey-btn">Back</a>
                    <button class="btn text-uppercase text-center green-btn">Save System</button>
                  </div>
                </div>
            </vue-form>  
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
</template>
<script>
import Vue from "vue";
import VueForm from "vue-form";
const cleanData = {
  os: "",
  processor: "",
  ram: "",
  gpu_memory: "",
  gpu_model: ""
};
export default {
  name: "add-system",
  data() {
    return {
      formstate: {},
      header: this.$route.params.id ? "Edit System" : "Add System",
      model: { ...cleanData }
    };
  },
  methods: {
    onSubmit: function() {
      if(this.formstate.$invalid){
        VueScrollTo.scrollTo("#scroll-top");
        return;
      } else {
        let p;
        const requestData = { ...this.model };
        if(this.model.id){
          p = axios.put(`/api/systems/${this.model.id}`, requestData);
        }else{
          p = axios.post("/api/systems", requestData);
        }
        p
          .then(response => this.$router.go(-1))
          .catch(error => (this.errors = error.response.data.message));
      }
    }
  },
  mounted:function(){
    if(this.$route.params.id){
      axios
        .get(`/api/systems/${this.$route.params.id}`)
        .then(({ data: { data } }) => {
          this.model = data;
        })
    }
  },
};
</script>
<style lang="scss" scoped>
@import "../../layouts/css/_customvariables";

.custom-container {
  max-width: 100%;
  .step-page-title {
    font-family: $font-family-UniNeue-bold;
    font-size: 30px;
    width: 100%;
    text-align: center;
    color: #363e48;
    margin: 5px 0 25px;
  }
  .add-system-page {
    width: 100%;
    .white-box {
      font-size: 14px;
      .block-title {
        font-size: 20px;
        font-family: $font-family-UniNeue-bold;
        border-bottom: 1px solid #dadada;
        color: #2cac3d;
        padding-bottom: 10px;
        margin-bottom: 20px;
      }
      .system-form{
        width: 100%;
        .form-group{
          margin-bottom: 10px;
          label{
           min-width: 30%;
            margin-right: 10px;
            justify-content: normal;
          }
          .form-control{
            min-width: 50%;
          }
        }
      }
    }
    .green-btn,.grey-btn{
      width: 100%;
      max-width: 150px;
      padding: 7px 10px;
      color: #fff;
      margin: 15px auto;
      border-radius: 20px;
      display: inline-block;
      margin-right: 10px;
    }
  }
}
@media screen and(max-width:1281px) {
  .custom-container {
    .add-system-page {
      .white-box {
        font-size: 16px;
      }
    }
  }
}
@media screen and(max-width:1200px) {
  .custom-container {
    .step-page-title {
      font-size: 28px;
      margin: 0 0 20px;
    }
    .add-system-page {
      .white-box {
        .block-title {
          font-size: 18px;
        }
      }
    }
  }
}
@media screen and(max-width:991px) {
  .custom-container {
    .add-system-page {
      .white-box {
        
      }
    }
  }
}
@media screen and(max-width:767px) {
.custom-container {
  .add-system-page {
    .white-box {
        .user-profile-form{
          width: 100%;
          .form-group{
            min-width: 60px;
            width: 30%;
            margin-right: 15px;
          }
        }
        .toggle-btn-group{
          width: 100%;
        }
      }
    }
  }
}
@media screen and(max-width:575px) {
  .custom-container {
    .step-page-title {
      font-size: 26px;
    }
    .add-system-page {
      .white-box {
        font-size: 14px;
        line-height: 18px;
      }
      .green-btn,.grey-btn{
        margin: 5px auto;
        max-width: 125px;
        margin-right: 5px;
      }
    }
  }
}
</style>