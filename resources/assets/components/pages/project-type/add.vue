<template>
    <div class="row">
        <div class="col-lg-12">
            <b-card :header="header" header-tag="h4" class="bg-success-card">
                <div class="row">
                    <div class="col-lg-12">
                        <div style="color: red" v-if="errors">
                            <ul id="example-1">
                                <li v-for="error in errors">
                                    {{ error }}
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-7 col-12 mb-3">
                        <vue-form class="form-horizontal form-validation" :state="formstate" @submit.prevent="onSubmit">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <validate tag="div">
                                        <label for="name"> Project type name</label>
                                        <input v-model="model.name" name="name" type="text" required autofocus placeholder="Project type" class="form-control" />
                                        <field-messages name="name" show="$invalid && $submitted" class="text-danger">
                                            <div slot="required">Type name is a required field</div>
                                        </field-messages>
                                    </validate>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <validate tag="div">
                                        <label for="name">Status</label>
                                        <select id="status" name="status" size="1" class="form-control" v-model="model.status" required checkbox>
                                            <option value="active">active</option>
                                            <option value="deactive">deactive</option>
                                        </select>
                                    </validate>
                                </div>
                            </div>
                            <div class="col-md-offset-4 col-md-8 m-t-25">
                                <button type="submit" class="btn btn-primary">
                                   <span class="" v-if="$route.params.id">
                                    Save Project
                                    </span>
                                    <span class="" v-else>
                                        Submit
                                    </span>
                                </button>
                                <router-link :to="{ name: 'admin.project-type' }" class="btn btn-primary">Cancel</router-link>
                            </div>
                        </vue-form>
                    </div>
                </div>
            </b-card>
        </div>
    </div>
</template>
<script>
    import Vue from "vue";
    import VueForm from "vue-form";
    import options from "src/validations/validations.js";
    Vue.use(VueForm, options);
    const cleanData = {
        name: "",
        status: "active"
    };
    export default {
        name: "add_project_type",
        data() {
            return {
                formstate: {},
                header: this.$route.params.id ? "Edit project type" : "Add project type",
                model: { ...cleanData },
                errors: null,
                old_file: "",
                originalType: {}
            };
        },
        methods: {
            onSubmit: function() {
                if (this.formstate.$invalid) {
                    return;
                } else {
                    let p;
                    if (this.model.id) {
                        p = axios.put(`/api/project-type/${this.model.id}`, this.model);
                    } else {
                        p = axios.post("/api/project-type", this.model);
                    }
                    p
                        .then(response => this.$router.push({ name: "admin.project-type" }))
                        .catch(error => (this.errors = error.response.data.message));
                }
            }
        },
        mounted: function() {
            if (this.$route.params.id) {
                axios
                    .get(`/api/project-type/${this.$route.params.id}`)
                    .then(({ data: { data } }) => {
                        this.model = data;
                        this.originalType = data;
                    })
                    .catch(() => this.$router.push({ name: "admin.project-type" }));
            }
        },
        destroyed: function() {}
    };
</script>
<style scoped>
    .dropzone_wrapper {
        width: 100%;
        height: 300px;
    }
    .red-asterisk {
        color: red;
    }
</style>
