<template>
  <div class="predictions">
    <div class="text-center">{{ lastMatchDayPlayed.matchDayNumber }}º Week Match Result</div>
    <div class="row prediction-wrapper" v-for="(prediction) in teamsAndPredictions">
      <div class="col">
        {{ prediction.name }}
      </div>
      <div class="col text-end">
        {{ prediction.prediction }}%
      </div>
    </div>
  </div>
</template>

<script>
export default {
  computed: {
    league() {
      return this.$store.getters.getLeague;
    },
    lastMatchDayPlayed() {
      return this.$store.getters.isLeagueOver
          ? this.league.getActualMatchDay()
          : this.league.matchDays[Math.max(this.league.actualMatchDayNumber-2, 0)]
    },
    leagueTableRows() {
      return this.$store.getters.getTableRows;
    },
    teamsAndPredictions() {
        let remainingMatches = this.league.totalMatchDays-this.leagueTableRows[0].plaid
        let teamsWithoutPossibilities = []
        console.log('remainingMatches', remainingMatches);
        return this.leagueTableRows
          .filter(tableRow =>{
              let differencePointsWithLeader = this.leagueTableRows[0].points-tableRow.points;
              if (differencePointsWithLeader > remainingMatches * 3) {
                teamsWithoutPossibilities.push({name:tableRow.name, prediction: 0})
                return false;
              }
              return true
            })
          .map((tableRow, index, remainingTeams) =>{
              let teamsAmount = remainingTeams.length;

              let totalPoints=0;
              remainingTeams.forEach(tableRow => totalPoints = totalPoints+tableRow.points+remainingMatches);

              let prediction = ((tableRow.points+remainingMatches)/Math.max(totalPoints,0.1)) * 100;
              return {name:tableRow.name, prediction: Math.round(prediction) }
          }).sort((predictionA, predictionB) => {
            return predictionB.prediction - predictionA.prediction;
          }).concat(teamsWithoutPossibilities);
    }
  }
}
</script>

<style lang="less">
  .predictions {
    background: #ffffff;
    .prediction-wrapper {
      margin: 0 10px;
    }
  }
</style>