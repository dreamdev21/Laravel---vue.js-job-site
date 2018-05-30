<template>
    <div>
        <div class="row">
            <div class="col-md-12 mb-5">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="status" class="product_label">Status:</label>
                            <select id="example-select" name="status-select" class="form-control" size="1">
                                <option value="0">Running</option>
                                <option value="1">Pending Approval</option>
                                <option value="2">Completed</option>
                                <option value="3">Unpaid Projects - pending payments to receive</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="devices" class="product_label">Devices:</label>
                            <select name="devices" class="form-control" v-model="model.aDevices" checkbox>
                                <option value="" selected>All Devices</option>
                                <option v-for="aDevice in aDevices " :value="aDevice.id" :key="aDevice.id"> {{ aDevice.name }} </option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="status" class="product_label">Tester:</label>
                            <input name="Tester" type="text" placeholder="Enter Tester Name" class="form-control p-2" />
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="status" class="product_label">Sort by:</label>
                            <select id="example-select-2" name="example-select" class="form-control" size="1">
                                <option value="0">Recent Activity</option>
                                <option value="1">Posted Date</option>
                                <option value="2">End Date</option>
                                <option value="3">Lowest Amount</option>
                                <option value="4">Highest Amount</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row pb-1">
                    <div class="col-md-12">
                        <h4 class="pull-right">
                            <a href="#" class="btn btn-primary rounded-0 mr-2 mb-3 mb-sm-0 top-btn" > Moderate Test Projects </a>
                            <a href="#" class="btn btn-primary rounded-0 mr-2 mb-3 mb-sm-0 top-btn" > Manage Test Projects </a>
                       </h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card box_shadow pb-2" ref="testprojectList">
                            <div class="card-header bg-white border-0">
                                <label class="font-24">Test Project Moderation</label>
                            </div>
                            <div class="card-body" >
                                <div class="border-row-bottom mb-4">
                                    <div class="row">
                                        <div class="col-md-4 pb-3">
                                            <span class="font-bold-16 font-title-color">Tester 1</span>
                                        </div>
                                        <div class="col-md-4 pb-3">
                                            <span class="font-bold-16 font-title-color">Oculus VR Applicatio Test</span>
                                        </div>
                                    </div>
                                    <div class="row pb-3">
                                        <div class="col-md-4 col-12 text-left">
                                            <ul class="pl-0">
                                                <li>
                                                    <label class="font-bold-12">Email: </label>
                                                    <span class="font-12">tester1@gmail.com</span>
                                                </li>
                                                <li>
                                                    <label class="font-bold-12">Birth Day: </label>
                                                    <span class="font-12">December 12, 1990</span>
                                                </li>
                                                <li>
                                                    <label class="font-bold-12">Gender: </label>
                                                    <span class="font-12">Male</span>
                                                </li>
                                                <li>
                                                    <label class="font-bold-12">Registered On </label>
                                                    <span class="font-12">February 1, 2016</span>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-md-4 col-12 text-left">
                                            <ul class="pl-0 mb-0">
                                                <li>
                                                    <label class="font-bold-12">Publisher: </label>
                                                    <span class="font-12">Mrs. Natasha Boyle</span>
                                                </li>
                                                <li>
                                                    <label class="font-bold-12">Devices: </label>
                                                    <span class="font-12">Cardboard, Oculus Rift</span>
                                                </li>
                                                <li>
                                                    <label class="font-bold-12">Type: </label>
                                                    <span class="font-12">VR Application</span>
                                                </li>
                                                <li>
                                                    <label class="font-bold-12">Tester Working</label>
                                                    <span class="font-12">1000 Testers</span>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-md-2 col-12 text-left text-md-center">
                                            <a class="btn btn-primary rounded-0 px-5 view-submision-btn mb-1 mb-sm-2" >View Submission</a>
                                        </div>
                                        <div class="col-md-2 col-12 text-left text-md-right">
                                            <ul class="pl-0">
                                                <li>
                                                    <label class="font-bold-12 mb-0">Submitted at: </label>
                                                    <span class="font-12"> February 15, 2018 </span>
                                                </li>
                                            </ul>
                                            <a  href="javascript:;" class="btn btn-info text-white">
                                                <img src="~img/edit_18x18.png" class="img-fluid"/>
                                                <!-- <i class="fa fa-edit"></i> -->
                                            </a>
                                            <a href="javascript:;" class="btn btn-warning text-white">
                                                <img src="~img/bin_18x18.png" class="img-fluid"/>
                                                <!-- <i class="fa fa-trash"></i> -->
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="border-row-bottom mb-4">
                                    <div class="row">
                                        <div class="col-md-4 pb-3">
                                            <span class="font-bold-16 font-title-color">Tester 1</span>
                                        </div>
                                        <div class="col-md-4 pb-3">
                                            <span class="font-bold-16 font-title-color">Oculus VR Applicatio Test</span>
                                        </div>
                                    </div>
                                    <div class="row pb-3">
                                        <div class="col-md-4 col-12 text-left">
                                            <ul class="pl-0">
                                                <li>
                                                    <label class="font-bold-12">Email: </label>
                                                    <span class="font-12">tester1@gmail.com</span>
                                                </li>
                                                <li>
                                                    <label class="font-bold-12">Birth Day: </label>
                                                    <span class="font-12">December 12, 1990</span>
                                                </li>
                                                <li>
                                                    <label class="font-bold-12">Gender: </label>
                                                    <span class="font-12">Male</span>
                                                </li>
                                                <li>
                                                    <label class="font-bold-12">Registered On </label>
                                                    <span class="font-12">February 1, 2016</span>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-md-4 col-12 text-left">
                                            <ul class="pl-0 mb-0">
                                                <li>
                                                    <label class="font-bold-12">Publisher: </label>
                                                    <span class="font-12">Mrs. Natasha Boyle</span>
                                                </li>
                                                <li>
                                                    <label class="font-bold-12">Devices: </label>
                                                    <span class="font-12">Cardboard, Oculus Rift</span>
                                                </li>
                                                <li>
                                                    <label class="font-bold-12">Type: </label>
                                                    <span class="font-12">VR Application</span>
                                                </li>
                                                <li>
                                                    <label class="font-bold-12">Tester Working</label>
                                                    <span class="font-12">1000 Testers</span>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-md-2 col-12 text-left text-md-center">
                                            <a class="btn btn-primary rounded-0 px-5 view-submision-btn mb-1 mb-sm-2" >View Submission</a>
                                        </div>
                                        <div class="col-md-2 col-12 text-left text-md-right">
                                            <ul class="pl-0">
                                                <li>
                                                    <label class="font-bold-12 mb-0">Submitted at: </label>
                                                    <span class="font-12"> February 15, 2018 </span>
                                                </li>
                                            </ul>
                                            <a  href="javascript:;" class="btn btn-info text-white">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a href="javascript:;" class="btn btn-warning text-white"><i class="fa fa-trash"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Vue from "vue";
import moment from "moment";
Vue.filter("dateString", function(value) {
  return moment(String(value)).format("MMM Do YYYY");
});
export default {
  components: {
    moment: moment
  },
  name: "moderate-test-projects",
  data() {
    return {
      testprojects: {},
      formstate: {},
      model: {},
      originalUser: {},
      aDevices: {},
      additional_devices: [],
      project_types: {}
    };
  },
  mounted: function() {
    axios
      .get("/api/projects?test=1")
      .then(response => {
        this.testprojects = response.data;
        console.log(this.testprojects);
      })
      .catch(function(error) {});
    axios
      .get("/api/devices")
      .then(response => {
        this.aDevices = response.data;
      })
      .then(({ data: { data } }) => this.assignData(data))
      .catch(function(error) {});

    axios
      .get("/api/project-types")
      .then(response => {
        this.project_types = response.data;
      })
      .catch(function(error) {});

    this.originalUser = window.USER;
  },
  methods: {}
};
</script>

<style scoped>
.border-row-bottom {
  border-bottom: 1px solid #797979 !important;
}
select {
  height: 34px;
}
.font-12 {
  font-weight: 400;
  font-style: normal;
  font-size: 12px;
}
.font-24 {
  font-weight: 400;
  font-style: normal;
  font-size: 24px;
}
.font-bold-12 {
  font-weight: 700;
  font-style: normal;
  font-size: 12px;
}
.font-bold-16 {
  font-weight: 700;
  font-style: normal;
  font-size: 16px;
}
.font-title-color {
  color: #666699;
}
.view-submision-btn {
  color: #fff !important;
  padding: 5px !important;
  white-space: normal;
}
</style>
