<template>
    <div class="sidebar">
        <div class="title">
            <h4>BlogWriter Panel</h4>
            <h2></h2>
        </div>
        <div class="menu-items">
            <router-link to="/categories-list">
                <div class="link-container">Categories</div>
            </router-link>
            <router-link to="/blogs-list">
                <div class="link-container">Blogs</div>
            </router-link>
            <router-link to="">
                <div class="link-container">
                    <button class="btn btn-danger" @click="Logout()">
                        Logout
                    </button>
                </div>
            </router-link>
        </div>
    </div>
</template>

<script>
export default {
    name: "sidebar",
    data() {
        return;
    },
    methods: {
        Logout() {
            axios
                .post(
                    "/api/logout",
                    {},
                    {
                        headers: {
                            Authentication: "Bearer " + this.token,
                        },
                    }
                )
                .then((response) => {
                    localStorage.removeItem("token");
                    this.isLoggedIn = false;
                    console.log(localStorage);
                    console.log(this.isLoggedIn);

                    this.$router.push("/login");
                })
                .catch((errors) => {
                    console.log(errors);
                })
                .finally(() => {
                    localStorage.removeItem("token");
                });
        },
    },
};
</script>

<style scoped>
.sidebar {
    display: grid;
    grid-template-rows: 1fr 5fr;
    background-color: teal;
    height: 100vh;
    width: 30vh;
    justify-content: center;
}

.link-container {
    color: white;
    margin-top: 20px;
    font-size: 15px;
}

.link-container:hover {
    color: black;
    padding-left: 10px;
    transition: 0.5s;
    background-color: white;
}

.title {
    color: white;
    font-size: 50px;
    margin-top: 30px;
}
</style>
