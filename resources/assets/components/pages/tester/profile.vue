<template>
  <div>
    <tester-component skin="_tester" portal="tester"></tester-component>
  </div>
</template>
<script>
  import TesterComponent from "components/components/profile";
  export default {
    components: {
      TesterComponent
    },
    name: "tester_profile",
  };
</script>
<style lang="scss" scoped>

</style>