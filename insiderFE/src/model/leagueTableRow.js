export default function(name) {
    return {
        name,
        points: 0,
        plaid: 0,
        win: 0,
        withdraw: 0,
        loses: 0,
        goalsFavor: 0,
        goalsContra: 0,
        goalsDifference() {
            return this.goalsFavor - this.goalsContra;
        },
        addMatch(goalsFavor, goalsContra) {
            if (goalsFavor > goalsContra) {
                this.win++;
                this.points = this.points+3;
            }

            if (goalsFavor === goalsContra) {
                this.withdraw++;
                this.points++
            }

            if (goalsFavor < goalsContra) {
                this.loses++;
            }

            this.plaid++;
            this.goalsFavor = this.goalsFavor + goalsFavor;
            this.goalsContra = this.goalsContra + goalsContra;

        }
        
    }
}