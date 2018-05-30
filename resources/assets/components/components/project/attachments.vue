<template>
  <div class="tester-attachment-tab">
    <div class="row" v-if="!disabled">
      <div class="col-12">
        <div v-if="uploading">
          <span>
            Uploading: {{uploadProgress}}%
          </span>
          <b-progress :value="uploadProgress" :max="100" :precision="0" variant="success" show-value show-progress animated></b-progress>
        </div>
        <div v-else class="text-uppercase green-btn add-files-btn">
          <span>
            Add Files
          </span>
          <input type="file" multiple @change="addAttachment" class="btn" />
        </div>
      </div>
    </div>
    <div class="attachment-table-wrap mt-3">
      <div class="row">
        <div class="col-12">
          <div class="table-responsive">
            <table class="table table-bordered attachment-table">
              <tbody>
                <tr v-for="m in mediaCollection" :key="m.id">
                  <td scope="row">
                    <img :src="`/images/file-icons/${m.ext}.png`" class="img-fluid" />
                  </td>
                  <td class=" text-medium">{{m.file_name}}</td>
                  <td>{{m.size | fileSize}}</td>
                  <td class="text-center">
                    <a :href="m.url" target="_blank" class="d-inline-block"><i class="fa fa-eye"></i></a>
                    <a href="#" class="d-inline-block" @click.prevent="deleteMedia(m.id)" v-if="!disabled"><i class="fa fa-trash"></i></a>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import { ALLOWED_EXTENSIONS } from "src/services/utils";
export default {
  name: "Attachments",
  props: {
    testerId: {
      type: Number,
      default() {
        // current user (tester)
        return this.$store.state.user.id;
      }
    },
    projectId: {
      required: true,
      type: Number
    },
    disabled: {
      type: Boolean,
      default() {
        return false;
      }
    }
  },
  data() {
    return { mediaCollection: [], uploading: false, uploadProgress: 0 };
  },
  methods: {
    deleteMedia(id) {
      this.$swal({
        title: "Are you sure?",
        text: "You want to delete this attachment?",
        icon: "warning",
        buttons: true,
        dangerMode: true
      }).then(willDelete => {
        if (willDelete) {
          return axios
            .delete(
              `/api/projects/${this.projectId}/testers/${
                this.testerId
              }/attachments/${id}`
            )
            .then(() => {
              this.mediaCollection = this.mediaCollection.filter(
                m => m.id !== id
              );
            });
        }
      });
    },
    getAttachments() {
      return axios
        .get(
          `/api/projects/${this.projectId}/testers/${this.testerId}/attachments`
        )
        .then(
          ({ data }) =>
            (this.mediaCollection = data.map(d => ({
              ...d,
              ext: d.file_name.split(".")[d.file_name.split(".").length - 1]
            })))
        );
    },
    addAttachment(e) {
      const files = e.target.files;
      for (let i = 0; i < files.length; i++) {
        const f = files[i];
        const ext = f.name.split(".").pop();
        if (!ext || ALLOWED_EXTENSIONS.indexOf(ext.toLowerCase()) === -1) {
          return this.$swal("Error", "Only app files are allowed", "error");
        }
      }
      const formData = new FormData();
      for (let i = 0; i < files.length; i++) {
        formData.append("file[]", files[i]);
      }
      this.uploading = true;
      return axios
        .post(
          `/api/projects/${this.projectId}/testers/${
            this.testerId
          }/attachments`,
          formData,
          {
            onUploadProgress: (progressEvent) => {
              const totalLength = progressEvent.lengthComputable
                ? progressEvent.total
                : progressEvent.target.getResponseHeader("content-length") ||
                  progressEvent.target.getResponseHeader(
                    "x-decompressed-content-length"
                  );
              if (totalLength !== null) {
                this.uploadProgress = Math.round(
                  progressEvent.loaded * 100 / totalLength
                );
              }
            }
          }
        )
        .then(({ data }) => {
          e.target.value = null;
          this.mediaCollection = [
            ...data.map(m => ({
              ...m,
              ext: m.file_name.split(".")[m.file_name.split(".").length - 1]
            })),
            ...this.mediaCollection
          ];
          this.uploading = false;
        })
        .catch(e => {
          this.uploading = false;
          return this.$swal("Error", error.response.data.message, "error");
        });
    }
  },
  mounted() {
    this.getAttachments();
  },
  watch: {
    testerId(newValue) {
      this.getAttachments();
    }
  }
};
</script>
<style lang="scss" scoped>
@import "../../layouts/css/_customvariables";
.green-btn {
    width: 100%;
    max-width: 180px;
    padding: 7px 10px;
    border: 2px solid #118921;
    background-color: #2cac3d;
    font-size: 14px;
    font-family: $font-family-brandon-medium;
    letter-spacing: 0.05rem;
    color: #fff;
    border-radius: 20px;
    display: inline-block;
    text-align: center;
    margin: 10px 15px 30px 0px;
    &:hover {
      background-color: #158f25;
      color: #fff;
      outline: none !important;
    }
  }
.tester-attachment-tab {
  .add-files-btn {
    width: 160px;
    float: right;
    margin: 10px 0;
    input {
      opacity: 0;
      position: absolute;
      top: 0;
      right: 0;
    }
  }
  .attachment-table-wrap {
    .attachment-table {
      border-radius: 6px;
      margin-bottom: 0;
      tr {
        td {
          &:first-child {
            min-width: 60px;
            max-width: 60px;
            width: 60px;
            text-align: center;
          }
          &:last-child {
            min-width: 130px;
            max-width: 130px;
            width: 130px;
            display: table-cell;
          }
          &:nth-child(3) {
            min-width: 160px;
            max-width: 160px;
            width: 160px;
            display: table-cell;
            text-align: center;
          }
          a {
            margin-right: 10px;
            color: #1f1f1f;
            font-size: 20px;
          }
        }
      }
    }
  }
}
@media screen and(max-width:767px) {
  .tester-attachment-tab {
    .add-files-btn {
      float: left;
      max-width: 100px;
      padding: 2px;
    }
    .attachment-table-wrap {
      .attachment-table {
        border-radius: 6px;
        tr {
          td {
            &:nth-child(2) {
              min-width: 320px;
            }
          }
        }
      }
    }
  }
}
</style>