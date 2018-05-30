<template>
  <div class="bg-color">
    <div class="container custom-container">
      <div class="row">
        <h1 class="page-title">
          Step 2 - Submission Process
        </h1>

        <div class="tester-text-content" v-if="!seen">
          <div class="white-box">
            <h4 class="block-title">
              How to do a good review
            </h4>
            <div class="row">
              <div class="col-12">
                <div class="mb-3">
                  <h5 class="text-bold">How to Test</h5>
                  <ul class="pl-2 mb-0">
                    <li>
                      Select a project from the Open Projects section of your Dashboard.
                    </li>
                    <li>
                      Read the description of the project and any additional information the Publisher has provided.
                    </li>
                    <li>
                      Each project will have an estimated time it will take to fully test.
                    </li>
                    <li>
                      Install the software for this app by downloading it to your computer.
                    </li>
                    <li>
                      Make sure your VR software is up to date as well as your video card drivers.
                    </li>
                    <li>
                      Start your recording software
                    </li>
                    <li>
                      (We recommend using OBS Studio ) <a href="https://obsproject.com/" class=""> https://obsproject.com/</a>
                    </li>
                    <li>
                      Launch the app Begin recording.
                    </li>
                    <li>
                      Stop recording and upload your video file to the Attachment section of the project screen.
                    </li>
                  </ul>
                </div>
                <div class="mb-3">
                  <h5 class="text-bold">Remember</h5>
                  <ul class="pl-2 mb-0">
                    <li>
                      Each Tester will be rated by the Publisher for each Project.
                    </li>
                    <li>
                      Ratings are based on professionalism, quality of the feedback, following instructions.
                    </li>
                    <li>
                      Great ratings means more projects!
                    </li>
                  </ul>
                </div>
                <div class="">
                  <h5 class="text-bold">Important</h5>
                  <ul class="pl-2 mb-0">
                    <li>
                      Setup a clutter and distraction free environment.
                    </li>
                    <li>
                      Make sure the area you are recording in is clean.
                    </li>
                    <li>
                      Remove any food, pets and other people from the recording area.
                    </li>
                    <li>
                      Don't smoke, drink, eat, or have music/TV on in the background.
                    </li>
                    <li>
                      The NDA requires that you do not share or publish your finished video anywhere else online.
                    </li>
                    <li>
                      You are not allowed to share anything related to any project shown on The Beta Plan portal
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
          <a class="btn text-uppercase text-center green-btn" @click="seen=true">next</a>
        </div>

        <div class="tester-step-page" v-if="seen">
          <div class="white-box">
            <h4 class="block-title">
              How to do a good review
            </h4>
            <div class="detail-form">
              <div class="row">
                <div class="col-12">
                  <div class="embed-responsive embed-responsive-16by9">
                    <iframe class="embed-responsive-item"  src="https://www.youtube.com/embed/xcJtL7QggTI" frameborder="0"></iframe>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <a @click="goToDashboard" class="btn text-uppercase text-center green-btn" >go to dashboard</a>
        </div>

      </div>
    </div>
  </div>
</template>
<script>
export default {
  name: "step-2",
  data() {
    return {
      seen: false
    };
  },
  methods: {
    showStep() {
      this.seen = true;
    },
    goToDashboard() {
      const requestData = {
        status: "Step_2",
        email: this.$store.state.user.email
      };
      axios
        .put(`/api/tester/${this.$store.state.user.id}`, requestData)
        .then(response => {
          this.$store.commit("set_user", response.data.data);
          this.$router.push({ name: "tester.dashboard" });
        })
        .catch(error => (this.errors = error.response.data.message));
    }
  }
};
</script>
<style lang="scss" scoped>
@import "../../layouts/css/_customvariables";
.custom-container {
  max-width: 100%;
  .page-title {
    font-family: $font-family-UniNeue-bold;
    font-size: 30px;
    width: 100%;
    text-align: center;
    color: #363e48;
    margin: 5px 0 25px;
  }
  .tester-step-page,
  .tester-text-content {
    width: 100%;
    .white-box {
      font-size: 14px;
      line-height: 24px;
      a {
        color: #2cac3d;
        text-decoration: underline !important;
      }
      .block-title {
        font-size: 20px;
        font-family: $font-family-UniNeue-bold;
        border-bottom: 1px solid #dadada;
        color: #2cac3d;
        padding-bottom: 10px;
        margin-bottom: 10px;
      }
      ul {
        list-style: none;
        li {
          padding-left: 15px;
          position: relative;
          &::before {
            height: 5px;
            width: 5px;
            border-radius: 50%;
            background-color: #949494;
            content: "";
            position: absolute;
            top: 10px;
            left: 0;
          }
        }
      }
    }
    .green-btn {
      max-width: 185px;
      padding: 7px 10px;
      margin: 15px auto;
      border-radius: 20px;
      display: block;
      color: #ffffff;
      &:hover {
        background-color: #158f25;
      }
    }
  }
}
@media screen and(max-width:1200px) {
  .custom-container {
    .page-title {
      font-size: 28px;
      margin: 0 0 20px;
    }
    .tester-step-page,
    .tester-text-content {
      .white-box {
        font-size: 14px;
        .block-title {
          font-size: 18px;
        }
      }
    }
  }
}

@media screen and(max-width:575px) {
  .custom-container {
    .page-title {
      font-size: 26px;
    }
    .tester-step-page,
    .tester-text-content {
      .white-box {
        line-height: 22px;
      }
    }
  }
}
</style>