<template>
    <div class="messages">
        <div class="container">
            <div class="content-title">
                <h3>Here are all of your blogs</h3>
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
                            to="/blogs/create"
                            class="btn btn-primary btn-sm float-right mb-2"
                            >Add Blog</router-link
                        >
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Title</th>
                                    <th>Image Link</th>
                                    <th>Author</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="blog in blog_posts"
                                    v-bind:key="blog.id"
                                >
                                    <td>{{ blog.id }}</td>
                                    <td>{{ blog.title }}</td>
                                    <td>{{ blog.imageLink }}</td>
                                    <td>{{ blog.author }}</td>

                                    <td>
                                        <router-link
                                            class="btn btn-success btn-sm"
                                            :to="{
                                                name: 'EditBlog',
                                                params: {
                                                    blogId: blog.id,
                                                },
                                            }"
                                            >Edit</router-link
                                        >
                                        <button
                                            class="btn btn-danger btn-sm"
                                            @click="deleteBlog(blog.id)"
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
            blog_posts: {},
        };
    },
    created() {
        this.getBlogs();
    },
    methods: {
        getBlogs() {
            this.axios
                .get("http://127.0.0.1:8000/api/blogs-list")
                .then((response) => {
                    this.blog_posts = response.data;
                    console.log(this.blog_posts);
                });
        },
        deleteBlog(id) {
            if (confirm("Do you confirm removing this blog?")) {
                this.axios
                    .delete(`/api/blogPost/${id}`)
                    .then((response) => {
                        this.deleteBlog();
                        this.$route.push("/blogs-list");
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
