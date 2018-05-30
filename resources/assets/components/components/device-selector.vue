<template>
  <div>
    <span class="d-inline-block pr-3" v-for="device in availableDevices">
      <img @click="toggleItem(device)" :title="device.name" :src="device.icon" class="img-fluid" :class="{ selected: value.indexOf(device.id) !== -1, disabled: disabled }" />
    </span>
  </div>
</template>

<script>
export default {
  name: "DeviceSelector",
  props: {
    disabled: {
      type: Boolean,
      defualt() {
        return false;
      }
    },
    value: {
      type: Array,
      required: true,
      default() {
        return [];
      }
    }
  },
  data() {
    return {
      devices: []
    };
  },
  methods: {
    toggleItem(device) {
      if (this.disabled) {
        return true;
      }
      const index = this.value.indexOf(device.id);
      let newDevices = [];
      if (index >= 0) {
        newDevices = this.value.filter(i => i !== device.id);
      } else {
        newDevices = [...this.value, device.id];
      }
      this.$emit("input", newDevices);
      this.$emit("change", newDevices);
    }
  },
  mounted: function() {
    if (!this.$store.state.devices.length) {
      axios.get("/api/device").then(({ data }) => {
        this.$store.commit("set_devices", data);
        this.devices = data;
      });
    } else {
      this.devices = this.$store.state.devices;
    }
  },
  computed: {
    availableDevices() {
      if (this.disabled) {
        return this.devices.filter(({ id }) => this.value.indexOf(id) >= 0);
      }
      return this.devices;
    }
  }
};
</script>

<style scoped lang="less">
img {
  height: 50px;
  width: 50px;
  display: inline-block;
  margin-right: 10px;
  float: left;
  opacity: 0.5;
  cursor: pointer;
  &.disabled {
    cursor: auto;
  }
  &.selected {
    opacity: 1;
  }
}
</style>