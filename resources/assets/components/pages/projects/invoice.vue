<template>
  <invoice :invoice="invoice" :project="project"></invoice>
</template>
<script>
import invoice from "components/components/invoice";
export default {
  name: "ProjectInvoice",
  components: {
    invoice
  },
  data() {
    return {
      invoice: {},
      project: {
        publisher: {}
      }
    };
  },
  mounted() {
    axios
      .get(`/api/projects/${this.$route.params.id}`)
      .then(({ data: { data } }) => (this.project = data));
    axios
      .get(`/api/projects/${this.$route.params.id}/invoice`)
      .then(({ data: { data } }) => (this.invoice = data));
  }
};
</script>