export default function (home, visitor) {
    return {
        home,
        visitor,
        goalsHome: null,
        goalsVisitor: null,
        plaid: false,

        playMatch(goalsHome, goalsVisitor){
            this.plaid = true;
            this.goalsHome = goalsHome;
            this.goalsVisitor = goalsVisitor;
        },
    }
}
