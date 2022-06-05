# insider test
This repo has the solution for the test.

## How to run it
Docker and docker-composer are needed to run the prepared dev environment. It was only tested on ubuntu so I am not sure if it will work on a different linux distribution or another OS.
After cloning the repo we have to
 - make dev
 - make composer
 - make build-fe

that should be enought to try localhost on a browser and see the results.

## Considerations
### Backend
I saw that the test was big, so I tried to make something as small as possible. So there is only one call to the api who is for play a match.
That call just take the number and power of two teams and send a randomized goals amount for both teams based on the power sent on the request.
I used a DDD Hexagonal design so improve and add functionalities should be easy. I added some unit test. It would be nice to have functional test and postman and swagger colletions for a improve on the documentation and the testing but I was out of time. 
You will see some TODOS for improves on the code. Even if that improvements are not done it's posible to see my idea about how should be further developements.


### Frontend
I used the project starter of Vue instead of create by myself a webpack config or similar. The idea to show how I would solve the development issues not to create an APP who really should go to production.
There is a lot of improvements here that they can to be done. The css can be improved to fit a real design and the bootstrap should no be directly downloaded to the assets.
As I used the store for take some hardcoded data it would be easy to change that to pick that data thought an api.
The system creates a random "round robin" league with the teams that they can be found on the file 'insiderFE/src/store/teamsModule.js'
It should work with that for or any another even amount of teams that are greater than now. So the 20 teams of the premier league can be added and the system should handle them without problems.

### Other
It is posible to run the command "npm run dev" on the insiderFE folder to create a FE server on the localhost:3000.
I used to develp the FE thing that forced me to handle the CORS problem in the BE. Some TODO in the BE are about them. 

