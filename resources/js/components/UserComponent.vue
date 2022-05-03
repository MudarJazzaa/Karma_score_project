<template>
    <div class="row justify-content-center">
        <div class="text-center my-50">
            <table class="table table-striped">
                <tr>
                    <th>Id</th>
                    <th>Karma rank</th>
                    <th>Position</th>
                    <th>Image</th>
                </tr>
                <tr
                    v-for="user in users.data"
                    :key="user.id"
                    :class="userId == user.id ? 'bg-success text-white' : ''"
                >
                    <td>{{ user.id }}</td>
                    <td>{{ user.karma_score }}</td>
                    <td>{{ user.position }}</td>
                    <td>
                        <img
                            :src="user.image_url"
                            style="width: 4rem; height: 4rem"
                            class="rounded-circle"
                        />
                    </td>
                </tr>
            </table>
        </div>
    </div>
</template>
<script>
// import "bootstrap-vue/dist/bootstrap-vue.css";
export default {
    name: "UserComponent",
    props: {
        userId: {
            type: Number,
            default: 1,
        },
        amount: {
            type: Number,
            default: 5,
        },
    },
    watch: {
        userId() {
            this.getUsers();
        },
        amount() {
            this.getUsers();
        },
    },
    data() {
        return {
            users: [],
        };
    },
    methods: {
        getUsers() {
            var url =
                "/api/v1/user/" +
                this.userId +
                "/karma-position?num=" +
                this.amount;
            axios
                .get(url)
                .then((response) => {
                    this.users = response.data;
                })
                .catch((error) => console.log(error));
        },
    },
    computed: {},
    mounted() {
        this.getUsers();
    },
    created() {},
};
</script>
