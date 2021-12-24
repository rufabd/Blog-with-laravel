<template>
    <div class="messages">
        <Sidebar />
        <div class="content-title"><h3>Welcome To Admin Dashboard</h3></div>
    </div>
</template>

<script>
import Sidebar from "../../components/Sidebar.vue";
export default {
    data() {
        return {};
    },
    components: {
        Sidebar,
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
