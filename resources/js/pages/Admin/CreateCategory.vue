<template>
    <div>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Create New Category</div>
                    <div class="card-body">
                        <form action="#" @submit.prevent="createCategory">
                            <div class="form-group">
                                <input
                                    type="text"
                                    class="form-control"
                                    name="title"
                                    placeholder="Enter title of the category"
                                    v-model="formData.title"
                                />
                                <p
                                    class="text-danger"
                                    v-text="errors.title"
                                ></p>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <button
                                        type="submit"
                                        class="btn btn-primary"
                                    >
                                        Add Category
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
export default {
    data() {
        return {
            formData: {
                title: "",
            },
            token: localStorage.getItem("token"),
            errors: {},
        };
    },
    methods: {
        createCategory() {
            axios
                .post("/api/categories", this.formData, {
                    headers: {
                        Authorization: "Bearer " + this.token,
                    },
                })
                .then((response) => {
                    console.log(response.data);

                    this.errors = {};
                    this.$router.push("/categories-list");
                    this.$toaster.success("Category Created");
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
