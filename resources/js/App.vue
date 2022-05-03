<template>
    <div class="flex justify-center w-100">
        <div class="container mt-10 mb-10">
            <h1 class="mt-5 text-center fw-bolder text-success">User List</h1>
            <div class="flex">
                <div class="form-group">
                    <label for="userId">User id</label>
                    <input
                        type="text"
                        class="form-control"
                        name="userId"
                        required
                        v-model="userId"
                    />
                </div>
                <div class="form-group">
                    <label for="amount">number of Users</label>
                    <input
                        type="text"
                        class="form-control"
                        name="amount"
                        v-model="amount"
                    />
                </div>
            </div>

            <user-component :amount="amount" :userId="userId" />
        </div>
    </div>
</template>
<script>
// import "bootstrap/dist/css/bootstrap.min.css";

import UserComponent from "./components/UserComponent.vue";
export default {
    name: "App",
    components: {
        UserComponent,
    },
    data() {
        return {
            userId: 1,
            amount: 5,
        };
    },
    setup() {},

    methods: {},
    mounted() {},
};
</script>
