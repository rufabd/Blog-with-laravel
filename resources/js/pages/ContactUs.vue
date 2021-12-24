<template>
    <div>
        <Navigation />
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card" style="margin-top: 150px">
                    <div class="card-header">PERSONALLY CONTACT ME HERE!</div>
                    <div class="card-body">
                        <form action="#" @submit.prevent="createContact">
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
                                <input
                                    type="text"
                                    class="form-control"
                                    name="subject"
                                    placeholder="Enter subject of your message"
                                    v-model="formData.subject"
                                />
                                <p class="text-danger" v-text="errors.name"></p>
                            </div>
                            <div class="form-group">
                                <textarea
                                    cols="12"
                                    rows="16"
                                    placeholder="Enter your message. I will read it :)"
                                    type="text"
                                    name="message"
                                    class="form-control"
                                    v-model="formData.message"
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
                                        Send Your Message
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
                subject: "",
                message: "",
            },
            token: localStorage.getItem("token"),
            errors: {},
        };
    },
    components: {
        Navigation,
    },
    methods: {
        createContact() {
            axios
                .post("/api/contact-me", this.formData, {
                    headers: {
                        Authorization: "Bearer " + this.token,
                    },
                })
                .then((response) => {
                    console.log(response.data);

                    this.errors = {};
                    this.$router.push("/");
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
