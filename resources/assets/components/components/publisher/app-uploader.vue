<template>
  <div class="row">
      <div class="col-md-8 col-sm-8 col-12">
          <input type="text" class="form-control custom-form-control" placeholder="Title of File" v-model="activeFile.name" @change="updateModel" disabled />
          <!-- <span class="text-success">{{ activeFile.name }}</span> -->
      </div>
      <div class="col-md-3 col-sm-3 col-10 pl-sm-0 pt-3 pt-sm-0">
          <input @change="checkFile" type="file" style="display: none" ref="app_file">
          <a href="javascript:;" class="btn-primary blue-step-btn" @click="triggerFileClick">Browse</a>
      </div>
      <div v-if="canRemove && file.name" class="col-md-1 col-sm-1 col-2 p-0 pt-2 pt-sm-0"><i class="fa fa-minus-circle icon-34" @click="deleteFile()"></i></div>
      <slot name="add-icon"></slot>
  </div>
</template>
<script>
import { ALLOWED_EXTENSIONS } from "src/services/utils";
export default {
  name: "AppUploader",
  props: {
    file: {
      type: Object,
      default() {
        return {
          file: {
            name: "",
            description: "",
            uploadedFile: null
          }
        };
      }
    },
    index: {
      type: Number,
      default() {
        return 0;
      }
    },
    canRemove: {
      default() {
        return true;
      }
    }
  },
  data() {
    return {
      activeFile: this.file
    };
  },
  methods: {
    triggerFileClick() {
      this.$refs.app_file.value = null;
      this.$refs.app_file.click();
    },
    deleteFile() {
      this.$emit("delete");
    },
    updateModel() {
      this.$emit("change", this.activeFile, this.index);
    },
    checkFile(e) {
      const file = e.target.files[0];
      if (file) {
        const ext = file.name.split(".").pop();
        if (ALLOWED_EXTENSIONS.indexOf(ext) === -1) {
          return this.$swal("Error", "Only app files are allowed", "error");
        }
        this.activeFile = {
          ...this.file,
          ...this.activeFile,
          uploadedFile: file,
          name: file.name
        };
        this.$emit("change", this.activeFile, this.index);
      }
    }
  },
  watch: {
    file(newValue) {
      this.activeFile = { ...newValue };
    }
  }
};
</script>
<style scoped lang="scss">
@import "../../layouts/css/_customvariables";
.icon-34 {
  font-size: 34px;
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
.blue-step-btn {
  cursor: pointer;
  width: auto;
  padding: 2px 4px;
  border: 2px solid #0082cc;
  background-color: #00aff5;
  font-size: 14px;
  font-family: $font-family-brandon-medium;
  letter-spacing: 0.05rem;
  color: #fff;
  border-radius: 20px;
  display: block;
  text-align: center;
  &:hover {
    background-color: #13b9fb;
  }
}
</style>