<template>
  <div>
    <croppa @new-image-drawn="hasImage = true" @image-remove="hasImage = false" placeholder="" :show-remove-button="false" :prevent-white-space="true" :disabled="disabled" :width="120" :height="120" v-model="croppa" @init="onCroppaInit">
      <img slot="placeholder" :src="previewUrl" class="img-fluid" />
    </croppa>
    <div v-if="hasImage" style="margin-top: 10px; text-align: 'center'">
      <button type="button" @click.prevent="generateImage" class="btn btn-primary"><i class="fa fa-check"></i></button>
      <button type="button" class="btn btn-danger" @click.prevent="removeImage" style="margin-left: 5px"><i class="fa fa-times" style="color: white"></i></button>
    </div>
  </div>
</template>

<script>
import Vue from "vue";
import Croppa from "vue-croppa";
Vue.use(Croppa);
export default {
  name: "ProfileCropper",
  props: {
    image: {
      type: String
    },
    disabled: {
      type: Boolean,
      default() {
        return false;
      }
    }
  },
  data() {
    return {
      croppa: {},
      hasImage: false,
      previewUrl: "/images/user.jpg"
    };
  },
  computed: {
    containerStyle() {
      const style = {};
      if (this.hasImage) {
        style.border = "1px solid #ddd";
      }
      return style;
    }
  },
  methods: {
    generateImage() {
      this.croppa.generateBlob(blob => {
        this.$emit("change", blob);
        this.$emit("input", blob);
      }, "image/png");
    },
    removeImage() {
      this.croppa.remove();
      this.hasImage = false;
    },
    onCroppaInit() {
      this.croppa.addClipPlugin(function(ctx, x, y, w, h) {
        ctx.beginPath();
        ctx.arc(x + w / 2, y + h / 2, w / 2, 0, 2 * Math.PI, true);
        ctx.closePath();
      });
      this.hasImage = this.croppa.hasImage();
    }
  },
  watch: {
    image(newValue) {
      this.previewUrl = newValue;
      this.hasImage = false;
      this.croppa.refresh();
    }
  }
};
</script>
<style>
.croppa-container {
  width: 120px;
  height: 120px;
  margin-right: 15px;
  position: relative;
  margin-right: 15px;
  background-color: #eee;
}
</style>