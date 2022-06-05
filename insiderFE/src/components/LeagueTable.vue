<template>
  <div class="league-table">
    <div class="banner text-center">League Table</div>
    <table class="positions-table">
      <tr class="text-center">
        <th class="text-start">Teams</th>
        <th>PTS</th>
        <th>P</th>
        <th>W</th>
        <th>D</th>
        <th>L</th>
        <th>GD</th>
      </tr>
      <tr class="text-center" v-for="(leagueTableRow) in leagueTableRows">
        <td class="text-start">{{ leagueTableRow.name }}</td>
        <td>{{ leagueTableRow.points }}</td>
        <td>{{ leagueTableRow.plaid }}</td>
        <td>{{ leagueTableRow.win }}</td>
        <td>{{ leagueTableRow.withdraw }}</td>
        <td>{{ leagueTableRow.loses }}</td>
        <td>{{ leagueTableRow.goalsDifference() }}</td>
      </tr>
     </table>
  </div>
</template>

<script>

  export default {
    computed: {
      league() {
        return this.$store.getters.getLeague;
      },
      teams() {
        return this.$store.getters.getTeamList;
      },
      leagueTableRows() {
        return this.$store.getters.getTableRows;
      }
    }

  }
</script>
