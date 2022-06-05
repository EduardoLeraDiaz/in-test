import {apiBaseUrl} from "./store";
import axios from 'axios';

export default {
    actions: {
        playMatch({ commit, dispatch}, teams) {
            let url = apiBaseUrl+'/play-match';

            return axios.post(url, teams, {
                headers: {
                    'Content-Type': 'application/json'
                }
            }).then((fetchedData) =>{
               return fetchedData;
            });
        }
    }
}