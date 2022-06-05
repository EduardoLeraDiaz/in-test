import matchDay from "./matchDay";
import match from "./match";

export default function(teams) {
    let totalMatchDays = (teams.length-1)*2;

    function shuffle(teams) {
        let shuffledTeams = [...teams];
        shuffledTeams.sort(() => Math.random() - 0.5);
        return shuffledTeams;
    }

    function getFirstMatchDay(teams) {
        let shuffleTeams = shuffle(teams);
        let matches=[];

        for (let i=0; i < Math.ceil(teams.length); i=i+2) {
            matches.push(match(shuffleTeams[i], shuffleTeams[i+1]));
        }

        return matchDay(1, totalMatchDays, matches);
    }

    function getNextFirstRoundMatchDay(previousMatchDay) {
        let matchDayNumber = previousMatchDay.matchDayNumber+1;

        return matchDayNumber % 2 === 0
            ? getEvenFirstHalfMatchDay(previousMatchDay)
            : getOddFirstHalfMatchDay(previousMatchDay);
    }

    function getEvenFirstHalfMatchDay(previousMatchDay) {
        let matches=[], matchDayNumber = previousMatchDay.matchDayNumber+1;

        for (let i=0; i < previousMatchDay.matches.length; i++) {
            let home, visitor;
            let visitorIndex = i === 0 ? previousMatchDay.matches.length-1 : i-1;
            home = previousMatchDay.matches[i].visitor;
            visitor = previousMatchDay.matches[visitorIndex].home;
            matches.push(match(home, visitor));
        }

        return matchDay(matchDayNumber, totalMatchDays, matches);
    }

    function getOddFirstHalfMatchDay(previousMatchDay) {
        let matches=[], matchDayNumber = previousMatchDay.matchDayNumber+1;

        for (let i=0; i < previousMatchDay.matches.length; i++) {
            let home, visitor;

            if (i===0) {
                home = previousMatchDay.matches[0].home;
                visitor = previousMatchDay.matches[1].home;
            }

            if (i > 0 || i < previousMatchDay.matches.length-2) {
                home = previousMatchDay.matches[i].visitor;
                visitor = previousMatchDay.matches[i-1].home;
            }

            if (i === previousMatchDay.matches.length-1) {
                home = previousMatchDay.matches[0].visitor;
                visitor = previousMatchDay.matches[i].visitor;
            }

            matches.push(match(home, visitor));
        }

        return matchDay(matchDayNumber, totalMatchDays, matches);
    }

    function getSecondRoundMatchDay(firstRoundMatchDay) {
        let matches=[], matchDayNumber = firstRoundMatchDay.matchDayNumber + totalMatchDays/2;

        firstRoundMatchDay.matches.forEach(firstRoundMatch => {
           matches.push(match(firstRoundMatch.visitor, firstRoundMatch.home))
        });

        return matchDay(matchDayNumber, totalMatchDays, matches);
    }

    function getMatchDays(teams) {
        let firstRound = [], secondRound = [];
        firstRound.push(getFirstMatchDay(teams));
        secondRound.push(getSecondRoundMatchDay(firstRound[0]))

        for (let i=0; i < totalMatchDays/2-1; i++) {
            firstRound.push(getNextFirstRoundMatchDay(firstRound[i]));
            secondRound.push(getSecondRoundMatchDay(firstRound[i+1]))
        }

        return firstRound.concat(secondRound);
    }

    return {
        actualMatchDayNumber: 1,
        totalMatchDays,
        matchDays: getMatchDays(teams),
        nextMatchDay() {
          if (this.actualMatchDayNumber < totalMatchDays) {
              this.actualMatchDayNumber++;
          }
        },
        getActualMatchDay() {
            return this.matchDays[this.actualMatchDayNumber-1];
        },

    }
}



