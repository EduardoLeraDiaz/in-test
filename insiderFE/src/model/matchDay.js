export default function (matchDayNumber, matchDayTotal, matches) {
    return {
        matchDayNumber,
        matchDayTotal,
        matches,
        isFinished() {
            return matches.find((match => match.plaid === false)) === undefined;
        },
        isLastMatchDay() {
            return matchDayNumber === matchDayTotal;
        }
    }
}