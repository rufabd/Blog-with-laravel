<template>
    <div>
        <Navigation />
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card" style="margin-top: 200px">
                    <div class="card-header justify-content-center">
                        REGISTER FOR POSSIBILITY OF USING MORE FEATURES
                    </div>
                    <div class="card-body">
                        <form action="#" @submit.prevent="register">
                            <div class="form-group">
                                <input
                                    type="text"
                                    class="form-control"
                                    name="name"
                                    placeholder="Full Name"
                                    v-model="formData.name"
                                />
                                <p class="text-danger" v-text="errors.name"></p>
                            </div>
                            <div class="form-group">
                                <input
                                    type="text"
                                    class="form-control"
                                    name="email"
                                    placeholder="Email Address"
                                    v-model="formData.email"
                                />
                                <p
                                    class="text-danger"
                                    v-text="errors.email"
                                ></p>
                            </div>
                            <div class="form-group">
                                <input
                                    type="password"
                                    class="form-control"
                                    name="password"
                                    placeholder="Enter new password"
                                    v-model="formData.password"
                                />
                                <p
                                    class="text-danger"
                                    v-text="errors.password"
                                ></p>
                            </div>
                            <div class="form-group">
                                <input
                                    type="password"
                                    class="form-control"
                                    name="password_confirmation"
                                    placeholder="Repeat your password"
                                    v-model="formData.password_confirmation"
                                />
                                <p
                                    class="text-danger"
                                    v-text="errors.password"
                                ></p>
                            </div>
                            <div class="form-group">
                                <select name="role" v-model="formData.role">
                                    <option value="user">user</option>
                                    <option value="blogWriter">
                                        blogWriter
                                    </option>
                                </select>
                                {{ formData.role }}
                                <p class="text-danger" v-text="errors.role"></p>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <button
                                        type="submit"
                                        class="btn btn-primary"
                                    >
                                        Register
                                    </button>
                                </div>
                                <div class="col-md-6">
                                    <router-link to="/login"
                                        >Already have an account? Sign In
                                        Here!</router-link
                                    >
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- <pre>
  {{ formData }}
</pre
        > -->
    </div>
</template>

<script>
import Navigation from "../components/Navigation.vue";
export default {
    data() {
        return {
            formData: {
                name: "",
                email: "",
                password: "",
                password_confirmation: "",
                role: "",
            },
            errors: {},
        };
    },
    components: {
        Navigation,
    },
    methods: {
        register() {
            axios
                .post("/api/register", this.formData)
                .then((response) => {
                    console.log("User has been saved");
                    this.$router.push("/login");
                })
                .catch((errors) => {
                    this.errors = errors.response.data.errors;
                    console.log(errors.response.data.errors);
                });
        },
    },
};
</script>
