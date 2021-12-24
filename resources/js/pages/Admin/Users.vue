<template>
    <div class="messages">
        <div class="container">
            <div class="content-title">
                <h3>Users List</h3>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <router-link
                            :to="{ name: 'Dashboard' }"
                            class="btn btn-primary btn-sm float-right mb-2"
                            >Back</router-link
                        >
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="user in users" v-bind:key="user.id">
                                    <td>{{ user.id }}</td>
                                    <td>{{ user.name }}</td>
                                    <td>{{ user.role }}</td>

                                    <td>
                                        <router-link
                                            class="btn btn-success btn-sm"
                                            @click="makeAdmin(user.id)"
                                            >Make Admin</router-link
                                        >
                                        <button
                                            class="btn btn-danger btn-sm"
                                            @click="deleteCategory(user.id)"
                                        >
                                            Delete
                                        </button>
                                    </td>
                                    <!-- <td></td> -->
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
            users: {},
        };
    },
    created() {
        this.getUsers();
    },
    methods: {
        getUsers() {
            this.axios
                .get("http://127.0.0.1:8000/api/users-list")
                .then((response) => {
                    this.users = response.data;
                    console.log(this.users);
                });
        },
        deleteUser(id) {
            if (confirm("Do you confirm removing this user?")) {
                this.axios
                    .delete(`/api/user/${id}`)
                    .then((response) => {
                        this.deleteUser();
                        this.$route.push("/users");
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
