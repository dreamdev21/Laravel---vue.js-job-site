<template>
    <aside class="right-aside">
        <!-- Content Header (Page header) -->
        <!-- <section class="content-header ">
            <h1>{{this.$store.state.page_title?this.$store.state.page_title:this.$route.meta.title}}</h1>
        </section> -->
        <!-- Main content -->
        <section class="content">
            <slot></slot>
        </section>
        <!-- /.content -->
    </aside>
</template>
<script>
export default {
  name: "right-side",
  methods: {}
};
</script>
<style lang="scss" scoped>
@import "css/customvariables";
.right-aside {
  padding: 20px 20px 10px 20px;
  width: 100%;
  max-width: 100%;
  max-height: 100%;
  min-height: calc(100vh - 70px);
  // height: calc(100vh - 100px);
  position: relative;
  // font-family: $font-family-brandon-regular !important;
  .content-header > h1 {
    margin: 2px;
    padding-left: 13px;
    padding-top: 12px;
    font-size: 20px;
    line-height: 1.5;
  }
  .content-header {
    margin: -2px -20px 25px -20px;
    height: 55px;
    background: #f9fafb;
    box-shadow: 3px 1px 5px #ccc;
  }
}
@media screen and(max-width:991px) {
  .right-aside {
    .welcome-page {
      h1 {
        font-size: 34px;
      }
      p {
        font-size: 16px;
      }
    }
  }
}
@media screen and(max-width:576px) {
  .right-aside {
    .welcome-page {
      h1 {
        font-size: 28px;
      }
      p {
        font-size: 14px;
      }
    }
  }
}
</style>
