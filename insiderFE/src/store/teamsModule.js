import team from '../model/team';

const teamList = [
    team('Manchester City', 80),
    team('Liverpool', 75),
    team('Chelsea', 70),
    team('Arsenal', 65)
]


export default {
    state: () => ({
        teams: teamList
    }),
    getters: {
        getTeamList: state => {
            return state.teams;
        }
    }
}