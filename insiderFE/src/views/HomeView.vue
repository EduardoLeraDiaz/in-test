<template>
  <div class="row journey">
    <div class="col-8">
      <div class="row">
        <div class="col">
          <league-table/>
        </div>

        <div class="col">
          <match-results/>
        </div>
      </div>
      <div class="row buttons-banner g-0">
        <div class="col">
          <button type="button" class="btn btn-secondary" :disabled="loading || isLeagueOver" v-on:click.stop.prevent="loading=true;playAll()">Play All</button>
        </div>
        <div class="col text-center">
          <div v-if="loading" class="spinner-border" role="status"><span class="sr-only"></span></div>
        </div>
        <div class="col text-end">
          <button type="button" class="btn btn-secondary" :disabled="loading || isLeagueOver" v-on:click.stop.prevent="loading=true;playNextWeek()">Next Week</button>
        </div>
      </div>
    </div>
    <div class="col">
      <div class="predictions-wrapper">
        <predictions/>
      </div>
    </div>
  </div>
</template>

<script>
import LeagueTable from "../components/LeagueTable.vue";
import MatchResults from "../components/MatchResults.vue";
import Predictions from "../components/Predictions.vue";

  export default {
    components: {
      'league-table': LeagueTable,
      'match-results': MatchResults,
      'predictions': Predictions
    },
    data() {
      return {
        loading: false
      }
    },
    computed: {
      league() {
        return this.$store.getters.getLeague;
      },
      isLeagueOver() {
        return this.$store.getters.isLeagueOver;
      }
    },
    methods:  {
      playNextWeek() {
        this.$store.dispatch('playNextWeek').then(()=>{this.loading=false});
      },
      playAll() {
        this.$store.dispatch('playNextWeek').then(()=>{
          if (this.isLeagueOver) {
            this.loading = false;
            return;
          }
          this.playAll();
        })
      }
    }
  }

</script>
<style lang="less">
  .journey {
    padding: 15px 25px 10px 10px;
    background-color: #d3d3d3;
    background-image: linear-gradient(315deg, #d3d3d3 0%, #7f8c8d 74%);

    .buttons-banner {
      background-color: #ffffff;
      margin-top: 3px;
      padding: 3px;
    }

    .banner {
      background: #ffffff;
      margin-bottom: 2px;
    }

    .positions-table  {
      background: #ffffff;
      width: 100%;
      &table, th, td {
        border: 1px solid black;
        border-collapse: collapse;
      }
    }
    .predictions-wrapper {
      margin: 10px;
    }
  }
</style>