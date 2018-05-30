<template>
  <div class="row">
    <div class="d-inline-block text-center proj-status active">
      <p class="proj-progress">
        <i class="fa fa-circle-thin"></i>
      </p>
      <span class="d-none d-md-block text-medium">New</span>
    </div>
    <div class="d-inline-block text-center proj-status">
      <p class="proj-progress">
        <i class="fa fa-circle-thin"></i>
      </p>
      <span class="d-none d-md-block text-medium">Accepted/Working</span>
    </div>
    <div class="d-inline-block text-center proj-status">
      <p class="proj-progress">
        <i class="fa fa-circle-thin"></i>
      </p>
      <span class="d-none d-md-block text-medium">Submitted</span>
    </div>
    <div class="d-inline-block text-center proj-status">
      <p class="proj-progress">
        <i class="fa fa-circle-thin"></i>
      </p>
      <span class="d-none d-md-block text-medium"> Under Review</span>
    </div>
    <div class="d-inline-block text-center proj-status">
      <p class="proj-progress">
        <i class="fa fa-circle-thin"></i>
      </p>
      <span class="d-none d-md-block text-medium">Completed</span>
    </div>
  </div>
</template>

<script>
  export default {
    name: "ProjectStatusTestProject",
  }
</script>

<style lang="scss" scoped>
  
</style>