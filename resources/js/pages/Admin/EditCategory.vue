<template>
    <div class="messages">
        <div class="container">
            <div class="content-title">
                <h3>Update selected category</h3>
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
                            <div class="form-group">
                                <label>Title</label>
                                <input
                                    type="text"
                                    placeholder="Insert new title"
                                    class="form-control"
                                    v-model="category.title"
                                />
                            </div>
                            <button
                                type="button"
                                class="btn btn-primary"
                                @click="updateCategory()"
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
            category: {},
        };
    },
    mounted() {
        this.editCategory(this.$route.params.categoryId);
    },
    methods: {
        editCategory(categoryId) {
            this.axios
                .get(`http://127.0.0.1:8000/api/category/${categoryId}`)
                .then((res) => {
                    this.category = res.data;
                });
        },
        updateCategory() {
            this.axios
                .put(
                    `http://127.0.0.1:8000/api/category/${this.$route.params.categoryId}`,
                    this.category
                )
                .then((res) => {
                    this.$router.push({ name: "Categories" });
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
