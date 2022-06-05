import league from "../model/league";
import leagueTableRow from "../model/leagueTableRow";

export default {
    state: () => ({
        league: null,
        tableRows: [],
        leagueOver: false
    }),
    mutations: {
        initializeLeague(state, teams) {
            state.league = new league(teams);
            teams.forEach(team => state.tableRows.push(leagueTableRow(team.name)));
        },
        recordMatchResult(state, result) {
            state.tableRows.find(tableRow => tableRow.name === result.home.team)
                .addMatch(result.home.goals, result.visitor.goals);

            state.tableRows.find(tableRow => tableRow.name === result.visitor.team)
                .addMatch(result.visitor.goals, result.home.goals);

            state.league.getActualMatchDay().matches.find(match => {
                return match.home.name === result.home.team && match.visitor.name === result.visitor.team;
            })?.playMatch(result.home.goals, result.visitor.goals);


            if (state.league.getActualMatchDay().isFinished()) {
                state.league.nextMatchDay();
            }
            if (state.league.getActualMatchDay().isFinished() && state.league.getActualMatchDay().isLastMatchDay()) {
                state.leagueOver = true;
            }
        }
    },
    actions: {
      playNextWeek({ commit, dispatch, state }) {
          return Promise.all(state.league.getActualMatchDay().matches.map(match => {
              let teams = {home: match.home, visitor: match.visitor}
              return dispatch('playMatch',teams).then((response) =>{
                  commit('recordMatchResult', response.data)
              });
          }));
      }
    },
    getters: {
        getLeague: state => {
            return state.league;
        },
        getTableRows: state => {
            return state.tableRows.sort((tableRowA, tableRowB) => {
                if (tableRowA.points === tableRowB.points) {
                    return tableRowB.goalsDifference() - tableRowA.goalsDifference()
                }
                return tableRowB.points - tableRowA.points;
            });
        },
        isLeagueOver: state => {
            return state.leagueOver;
        }
    }
}
