<template>
    <!-- <div class="container">
        <form action="#" @submit.prevent="createBlog">
            <div class="form-group">
                <input type="text" class="form-control" />
            </div>
            <div class="form-group">
                <vue-editor />
            </div>
        </form>
    </div> -->
    <div class="row justify-content-center" style="margin-top: 80px">
        <div class="col-md-6">
            <div class="container">
                <form action="#" @submit.prevent="createBlog">
                    <div class="form-group" style="margin-bottom: 8px">
                        <input
                            type="text"
                            class="form-control"
                            name="title"
                            placeholder="Enter title of the Blog"
                            v-model="formData.title"
                        />
                    </div>
                    <div class="form-group">
                        <p style="padding-top: 20px">
                            Please write the blog content below
                        </p>
                        <vue-editor v-model="formData.body" />
                    </div>
                    <div
                        class="form-group"
                        style="margin-bottom: 8px; margin-top: 10px"
                    >
                        <input
                            type="text"
                            class="form-control"
                            name="imageLink"
                            placeholder="Enter image link"
                            v-model="formData.imageLink"
                        />
                    </div>
                    <div
                        class="form-group"
                        style="margin-bottom: 8px; margin-top: 10px"
                    >
                        <input
                            type="text"
                            class="form-control"
                            name="author"
                            placeholder="Enter author name"
                            v-model="formData.author"
                        />
                    </div>
                    <!-- <div
                        class="form-group"
                        style="margin-bottom: 8px; margin-top: 10px"
                    >
                        <input
                            type="text"
                            class="form-control"
                            name="category_id"
                            placeholder="Enter category id"
                            v-model="formData.category_id"
                        />
                    </div> -->

                    <!-- <div
                        class="form-group"
                        style="margin-bottom: 8px; margin-top: 10px"
                    >
                        <select
                            v-model="category"
                            name="category"
                            class="form-control"
                            @change="loadCategories"
                        >
                            <option>Select Category</option>
                            <option
                                v-for="category in categories"
                                :value="category.id"
                                v-bind:key="category.id"
                            >
                                @{{ category.title }}
                            </option>
                        </select>
                    </div> -->
                    <div
                        class="form-group"
                        style="margin-bottom: 8px; margin-top: 10px"
                    >
                        <label for="category">Select a category for post</label>
                        <select
                            v-model="category"
                            name="category"
                            class="form-control"
                            @change="loadCategories"
                        >
                            <option>Business</option>
                            <option>Self Development</option>
                            <option>Investing</option>
                            <option>Motivation</option>
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-primary">
                                Add Blog
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
export default {
    data() {
        return {
            categories: [],
            category: "",
            formData: {
                title: "",
                body: "",
                imageLink: "",
                author: "",
                category_id: "",
            },
            token: localStorage.getItem("token"),
            errors: {},
        };
    },
    mounted() {
        this.loadCategories();
    },
    methods: {
        createBlog() {
            axios
                .post("/api/blogPosts", this.formData, {
                    headers: {
                        Authorization: "Bearer " + this.token,
                    },
                })
                .then((response) => {
                    console.log(response.data);

                    this.errors = {};
                    this.$router.push("/blogs-list");
                    this.$toaster.success("Blog Created");
                })
                .catch((errors) => {
                    this.errors = errors.response.data.errors;
                    console.log(errors.response.data.errors);
                });
        },
        loadCategories() {
            axios
                .get("http://127.0.0.1:8000/categories-list", {
                    params: { category: this.category },
                })
                .then(
                    (response) => (this.categories = response.data.categories)
                )
                .catch((error) => console.log(error));
        },
    },
};
</script>

<style>
.login {
    margin-left: 25rem;
}
</style>
