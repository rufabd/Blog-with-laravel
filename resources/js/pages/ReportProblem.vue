<template>
    <div>
        <Navigation />
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card" style="margin-top: 150px">
                    <div class="card-header">
                        If you face any problem, let us know!
                    </div>
                    <div class="card-body">
                        <form action="#" @submit.prevent="createReport">
                            <div class="form-group">
                                <input
                                    type="text"
                                    class="form-control"
                                    name="name"
                                    placeholder="Enter your name"
                                    v-model="formData.name"
                                />
                                <p class="text-danger" v-text="errors.name"></p>
                            </div>
                            <div class="form-group">
                                <input
                                    type="text"
                                    class="form-control"
                                    name="email"
                                    placeholder="Enter your email"
                                    v-model="formData.email"
                                />
                                <p class="text-danger" v-text="errors.name"></p>
                            </div>
                            <div class="form-group">
                                <!-- <input
                                    cols="12"
                                    row="12"
                                    type="text"
                                    class="form-control"
                                    name="body"
                                    placeholder="Enter your text"
                                    v-model="formData.body"
                                /> -->
                                <textarea
                                    cols="12"
                                    rows="16"
                                    placeholder="Enter your text"
                                    type="text"
                                    name="body"
                                    class="form-control"
                                    v-model="formData.body"
                                >
                                </textarea>
                                <p class="text-danger" v-text="errors.body"></p>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <button
                                        type="submit"
                                        class="btn btn-primary"
                                    >
                                        Report Problem
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
import Navigation from "../components/Navigation.vue";
export default {
    data() {
        return {
            formData: {
                name: "",
                email: "",
                body: "",
            },
            token: localStorage.getItem("token"),
            errors: {},
        };
    },
    components: {
        Navigation,
    },
    methods: {
        createReport() {
            axios
                .post("/api/report-problem", this.formData, {
                    headers: {
                        Authorization: "Bearer " + this.token,
                    },
                })
                .then((response) => {
                    console.log(response.data);

                    this.errors = {};
                    this.$router.push("/");
                    // this.$toaster.success("Category Created");
                })
                .catch((errors) => {
                    this.errors = errors.response.data.errors;
                    console.log(errors.response.data.errors);
                });
        },
    },
};
</script>

<style>
.login {
    margin-left: 25rem;
}
</style>
