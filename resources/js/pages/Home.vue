<template style>
    <div>
        <Navigation />
        <!-- <button v-if="isLoggedIn" class="btn btn-danger" @click="logout">
            Logout
        </button> -->
        <div class="row justify-content-center">
            <div style="margin-top: 100px; width: 100%; padding-bottom: 20px">
                <h4 style="margin-left: 13%; font-size: 30px">
                    WELCOME TO MY BLOG {{ currentUser.name }}
                </h4>
            </div>
            <hr />
        </div>

        <!-- <div class="row">
            <div class="col-md-4">
                <div class="card" style="margin-top: 200px">
                    <div class="card-header">
                        REGISTER FOR POSSIBILITY OF USING MORE FEATURES
                    </div>
                    <div class="card-body"></div>
                </div>
            </div>
        </div> -->

        <div
            class="containerr"
            style="
                display: inline-block;
                justify-content: center;
                align-items: center;
                margin-left: 15%;
                width: 100%;
                margin-bottom: 10%;
            "
        >
            <h2 style="margin-bottom: 50px; margin-top: 50px">
                Popular Posts of This Week
            </h2>
            <div
                class="card"
                style="
                    width: 18rem;
                    display: inline-block;
                    width: 400px;
                    height: 400px;
                    margin-right: 2%;
                    margin-bottom: 3%;
                "
            >
                <img src="#" class="card-img-top" alt="blogImage" />
                <div
                    class="card-body"
                    v-for="blog in blog_posts"
                    v-bind:key="blog.id"
                >
                    <!-- <h5 class="card-title">Card title</h5> -->
                    <p class="card-text" v-text="blog.title"></p>
                    <!-- <a href="" class="btn btn-primary" style="margin-top: 60%"
                        >Read More</a
                    > -->
                    <router-link
                        class="btn btn-primary"
                        style="margin-top: 60%"
                        :to="{
                            name: 'ShowSpecificBlog',
                            params: {
                                blogId: blog.id,
                            },
                        }"
                    >
                        Read More
                    </router-link>
                </div>
            </div>
            <div
                class="card"
                style="
                    width: 18rem;
                    display: inline-block;
                    width: 400px;
                    height: 400px;
                    margin-right: 2%;
                    margin-bottom: 3%;
                "
            >
                <img src="#" class="card-img-top" alt="blogImage" />
                <div
                    class="card-body"
                    v-for="blog in blog_posts"
                    v-bind:key="blog.id"
                >
                    <!-- <h5 class="card-title">Card title</h5> -->
                    <p class="card-text" v-text="blog.title"></p>
                    <!-- <a href="" class="btn btn-primary" style="margin-top: 60%"
                        >Read More</a
                    > -->
                    <router-link
                        class="btn btn-primary"
                        style="margin-top: 60%"
                        :to="{
                            name: 'ShowSpecificBlog',
                            params: {
                                blogId: blog.id,
                            },
                        }"
                    >
                        Read More
                    </router-link>
                </div>
            </div>
        </div>
        <Footer />
    </div>
</template>

<script>
import axios from "axios";
import Navigation from "../components/Navigation.vue";
import Footer from "../components/Footer.vue";
export default {
    data() {
        return {
            currentUser: {},
            token: localStorage.getItem("token"),
            isLoggedIn: false,
            blog_posts: {},
        };
    },
    components: {
        Navigation,
        Footer,
    },
    methods: {
        getBlogs() {
            this.axios.get("/api/blogPosts").then((response) => {
                this.blog_posts = response.data;
                console.log(this.blog_posts);
            });
        },
    },
    mounted() {
        //  axios.defaults.headers.common['Authorization'] = `Bearer ${this.token}`
        // this.checkLoginStatus();
    },
    updated() {
        console.log(this.isLoggedIn);
    },

    // checkLoginStatus() {
    //     this.loading = true;
    //     // this.loading = true
    //     axios
    //         .get("/api/user", {
    //             headers: {
    //                 Authorization: "Bearer " + this.token,
    //             },
    //         })
    //         .then((response) => {
    //             this.currentUser = response.data;
    //             // localStorage.setItem("authUser", [...response.data]);
    //             console.log("LOGGED IN");
    //             var status = this.currentUser.role;
    //             this.isLoggedIn = true;
    //             // console.log(this.currentUser.id);
    //         })
    //         .catch((errors) => {
    //             console.log(errors);
    //             this.isLoggedIn = false;
    //         })
    //         .finally(() => {
    //             this.loading = false;
    //         });
    // },
    // logout() {
    //     axios
    //         .post(
    //             "api/logout",
    //             {},
    //             {
    //                 headers: {
    //                     Authorization: "Bearer " + this.token,
    //                 },
    //             }
    //         )
    //         .then((response) => {
    //             console.log(response);
    //             localStorage.removeItem("token");
    //             this.isLoggedIn = false;
    //             this.$router.push("/");
    //         })
    //         .catch((errors) => {
    //             console.log("it is not working");
    //             console.log(errors);
    //         });
    // },
};
</script>

<style lang="scss" scoped></style>
