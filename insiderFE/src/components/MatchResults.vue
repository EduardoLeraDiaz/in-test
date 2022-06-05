<template>
  <div class="match-results row">
    <div class="banner text-center">Match Results</div>
    <div class="content text-center">
      <div> {{ lastMatchDayPlayed.matchDayNumber }}º Week Match Result</div>
      <div class="row" v-for="(match) in lastMatchDayPlayed.matches">
        <div class="col text-start">
          {{ match.home.name }}
        </div>
        <div class="col text-center">
          <template v-if="match.plaid"> {{match.goalsHome}}-{{match.goalsVisitor}}</template>
        </div>
        <div class="col text-end">
          {{ match.visitor.name }}
        </div>
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
    }
  }
}
</script>

<style lang="less">
  .content {
    background: #ffffff;

  }

</style>