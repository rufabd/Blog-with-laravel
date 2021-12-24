<template>
    <div class="messages">
        <EditorSidebar />
        <div class="content-title">
            <h3>Welcome To Blog Writer Dashboard</h3>
        </div>
    </div>
</template>

<script>
import EditorSidebar from "../../components/EditorSidebar.vue";
export default {
    data() {
        return {};
    },
    components: {
        EditorSidebar,
    },
};
</script>

<style scoped>
.messages {
    display: grid;
    grid-template-columns: 1fr 5fr;
}

.content-title {
    margin-left: 40%;
    color: rgba(0, 0, 0, 0.6);
    margin-top: 2%;
}
</style>
