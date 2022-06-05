import { createApp } from "vue";
import Vuex from "vuex";
import App from "./App.vue";
import router from "./router";
import store from "./store/store"

const app = createApp(App);

store.commit('initializeLeague', store.getters.getTeamList);

app.use(router);
app.use(Vuex);
app.use(store);

app.mount("#app");
