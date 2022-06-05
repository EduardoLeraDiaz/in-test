import { createStore } from 'vuex';
import teamsModule from './teamsModule';
import leagueModule from "./leagueModule";
import matchModule from "./matchModule";

export default createStore({
    modules: {
        teams: teamsModule,
        league: leagueModule,
        match: matchModule
    }
});

export const apiBaseUrl = 'http://localhost:80/api/v1';
