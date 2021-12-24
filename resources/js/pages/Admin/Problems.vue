<template>
    <div class="messages">
        <div class="container">
            <div class="content-title">
                <h3>Here are reported problems by users</h3>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <router-link
                            :to="{ name: 'Dashboard' }"
                            class="btn btn-primary btn-sm float-right mb-2"
                            >Back</router-link
                        >
                        <!-- <router-link
                            to="/categories/create"
                            class="btn btn-primary btn-sm float-right mb-2"
                            ></router-link -->
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Reporter Name</th>
                                    <th>Reporter Email</th>
                                    <th>Problem</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="problem in problems"
                                    v-bind:key="problem.id"
                                >
                                    <td>{{ problem.id }}</td>
                                    <td>{{ problem.name }}</td>
                                    <td>{{ problem.email }}</td>
                                    <td>{{ problem.body }}</td>

                                    <td>
                                        <button
                                            class="btn btn-danger btn-sm"
                                            @click="deleteProblem(problem.id)"
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
            problems: {},
        };
    },
    created() {
        this.getProblems();
    },
    methods: {
        getProblems() {
            this.axios
                .get("http://127.0.0.1:8000/api/problems-list")
                .then((response) => {
                    this.problems = response.data;
                    console.log(this.problems);
                });
        },
        deleteProblem(id) {
            if (confirm("Do you confirm removing this record?")) {
                this.axios
                    .delete(`/api/reported-problem/${id}`)
                    .then((response) => {
                        this.deleteProblem();
                        this.$route.push("/dashboard");
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
