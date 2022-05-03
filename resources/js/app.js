require("./bootstrap");

// require("alpinejs");

import { createApp } from "vue";
// import router from "./router";

import App from "./App.vue";
import "bootstrap/dist/css/bootstrap.min.css";
import UserComponent from "./components/UserComponent.vue";

createApp({
    components: {
        App,
        UserComponent,
    },
})
    // .use(router)
    .mount("#app");
