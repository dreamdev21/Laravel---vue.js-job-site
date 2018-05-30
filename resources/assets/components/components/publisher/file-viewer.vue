<template>
  <div class="row">
    <div class="col-12">
    <div :class="['file', colorTheme ]" :key="file.id" v-for="file in files">
      <a :href="file.url" target="_blank">
       {{file.file_name}} - {{file.size | fileSize}}
      </a>
    </div>
    </div>
  </div>
</template>
<script>
export default {
  name: "FileViewer",
  props: {
    files: {
      type: Array,
      default() {
        return [];
      }
    },
    colorTheme: {
      type: String,
      default() {
        return 'publisher';
      }
    }
  }
};
</script>
<style scoped lang="scss">
.publisher{
  background: #fff;
}
.file {
  padding: 0px;
  color: #606368;
  text-decoration: none;
  margin-top: 3px;
  border-radius: 4px;
  margin-left: 0px;
  a {
    color: #606368;
    padding: 0;
    &:hover {
      text-decoration: underline !important;
    }
  }
}
.tester{
  background: #fff;
}
</style>