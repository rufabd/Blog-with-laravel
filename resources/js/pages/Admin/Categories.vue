<template>
    <div class="messages">
        <div class="container">
            <div class="content-title">
                <h3>Here are all of your categories</h3>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <router-link
                            :to="{ name: 'editorDashboard' }"
                            class="btn btn-primary btn-sm float-right mb-2"
                            >Back</router-link
                        >
                        <router-link
                            to="/categories/create"
                            class="btn btn-primary btn-sm float-right mb-2"
                            >Add Category</router-link
                        >
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Create Date</th>
                                    <th>Update Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="category in categories"
                                    v-bind:key="category.id"
                                >
                                    <!-- hello
                                    {{
                                        category
                                    }} -->
                                    <td>{{ category.id }}</td>
                                    <td>{{ category.title }}</td>
                                    <td>{{ category.created_at }}</td>
                                    <td>{{ category.updated_at }}</td>

                                    <td>
                                        <router-link
                                            class="btn btn-success btn-sm"
                                            :to="{
                                                name: 'CategoryEdit',
                                                params: {
                                                    categoryId: category.id,
                                                },
                                            }"
                                            >Edit</router-link
                                        >
                                        <button
                                            class="btn btn-danger btn-sm"
                                            @click="deleteCategory(category.id)"
                                        >
                                            Delete
                                        </button>
                                    </td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
// import Sidebar from "../../components/Sidebar.vue";
export default {
    data() {
        return {
            categories: {},
        };
    },
    created() {
        this.getCategories();
    },
    methods: {
        getCategories() {
            this.axios
                .get("http://127.0.0.1:8000/api/categories-list")
                .then((response) => {
                    this.categories = response.data;
                    console.log(this.categories);
                });
        },
        deleteCategory(id) {
            if (confirm("Do you confirm removing this category?")) {
                this.axios
                    .delete(`/api/category/${id}`)
                    .then((response) => {
                        this.deleteCategory();
                        this.$route.push("/categories-list");
                    })
                    .catch((error) => {
                        console.log(error);
                    });
            }
        },
    },
};

// components: {
//     Sidebar,
// },
</script>

<style scoped>
.messages {
    width: 100%;
    grid-template-columns: 1fr 5fr;
}

.content-title {
    width: 100%;
    margin-left: 40%;
    color: rgba(0, 0, 0, 0.6);
    margin-top: 2%;
}
</style>
