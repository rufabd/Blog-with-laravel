<template>
    <div class="messages">
        <div class="container">
            <div class="content-title">
                <h3>Update selected post</h3>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <router-link
                            to="/categories-list"
                            class="btn btn-primary btn-sm float-right mb-2"
                            >Back</router-link
                        >
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <form>
                            <!-- <div class="form-group">
                                <label>Title</label>
                                <input
                                    type="text"
                                    placeholder="Insert new title"
                                    class="form-control"
                                    v-model="category.title"
                                />
                            </div> -->
                            <div class="form-group">
                                <label>Title</label>
                                <input
                                    type="text"
                                    placeholder="Insert new title"
                                    class="form-control"
                                    v-model="blog.title"
                                />
                            </div>
                            <div class="form-group">
                                <p style="padding-top: 20px">
                                    Please update the blog content below
                                </p>
                                <vue-editor v-model="blog.body" />
                            </div>
                            <div class="form-group">
                                <label>Image Link</label>
                                <input
                                    type="text"
                                    placeholder="Insert new imageLink"
                                    class="form-control"
                                    v-model="blog.imageLink"
                                />
                            </div>
                            <div class="form-group">
                                <label>Author</label>
                                <input
                                    type="text"
                                    placeholder="Insert new imageLink"
                                    class="form-control"
                                    v-model="blog.author"
                                />
                            </div>
                            <!-- <div class="form-group">
                                <label>Category</label>
                                <input
                                    type="text"
                                    placeholder="Insert new imageLink"
                                    class="form-control"
                                    v-model="blog.imageLink"
                                />
                            </div> -->

                            <button
                                type="button"
                                class="btn btn-primary"
                                @click="updateBlog()"
                            >
                                Update
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            blog: {},
        };
    },
    mounted() {
        this.editBlog(this.$route.params.blogId);
    },
    methods: {
        editBlog(blogId) {
            this.axios
                .get(`http://127.0.0.1:8000/api/blogPost/${blogId}`)
                .then((res) => {
                    this.blog = res.data;
                });
        },
        updateBlog() {
            this.axios
                .put(
                    `http://127.0.0.1:8000/api/blogPost/${this.$route.params.blogId}`,
                    this.blog
                )
                .then((res) => {
                    this.$router.push({ name: "Blogs" });
                });
        },
    },
};
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
