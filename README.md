# SWE6733 Group 1 Repo

## Group Members

* Jessica Baum- Scrum Master, UX/UI designer, and frontend developer
* Tarik Davis- Backend Developer
* Megan Dollar- Frontend Lead
* Joo Kang- Product Owner and frontend developer
* Jerry Santiago- QA Tester and backend developer
* Jake Schramm- Backend Lead

---

## Project Overview

The goal of this project is to build Rovaly, an outdoor app for adventure seekers. Whether they're into hiking, kayaking, rock climbing, or just exploring new trails, the app matches them with like-minded adventurers who share their passion for the great outdoors. By collecting various preferences such as budget, trip length, attitude, and skill level for different adventures, the app ensures people find a partner who truly gets their love for adventure. 
This app is designed specifically to connect users within the Kennesaw, GA area.


## Product Vision

<b>Near Vision (July 2025):</b> To serve the population of Kennesaw, GA by  creating social opportunity for outdoor adventurers that respects their preferences and interests. 

Within Georgia, the city of Kennesaw has been known for its monumental outdoor attractions such as Kennesaw Mountain, Lake Acworth, and Lake Allatoona. Therefore, it holds many opportunities for outdoor adventurers to plan their own outings and enjoy all that Kennesaw has to offer.

Since COVID (March 2020), the number of new and returning outdoor participants in the U.S. has increased by 26%. Georgia, in particular, resides in the South Atlantic region, which has been called home by one of the largest percentages of outdoor recreation participants in the U.S. The near vision for Rovaly is to create social opportunity for those who call Kennesaw home by taking advantage of both the city's vast opportunities for outdoor adventures and its large, growing number of outdoor participants. Unlike most people matching apps, ours allows users to set preferences on a per-activity basis (i.e., mark themselves as a novice in camping but an expert in fishing), giving users the choice to find similar outdoor partners for a wide range of activities at the same time. Our matching algorithm also finds matches with more "picky" criteria if a user is not finding suggestions that they like, ensuring that users find the kind of people they're looking for.


Our MVP as part of this Near Vision would be a working product with: 
* Sign-up/login
* User profile creation and interest questionnaire
* Swipe-to-match interface
* Matches view
* Use Agile methods and Scrum ceremonies throughout development
* Implement the core functionality using GitHub, Jira, and Firebase
* Present a polished, cohesive MVP at the final project showcase
* Implement a basic match scoring algorithm
* Add in-app messaging between matches
* Host via AWS EC2 and S3


<b>Far Vision</b>: To create a national expansion of outdoor adventure, enriching people's lives with meaningful connections and memories.

In the process of matching outdoor adventurers, we hope to catalyze the formation of adventure plans and to fill outdoor parks and recreational centers with flourishing activity. We hope that this app will be adapted to other cities as well to make the same impact across the U.S., facilitating 100K matched outings across 50 U.S. cities within 10 years. 
As the user base expands and time progresses, we hope to implement AI into our matching algorithm to find smarter matches and to even suggest specific locations for adventures based on preferences, so that more of the workload of creating adventure opportunities is taken off of users.

This far vision can only be achieved by creating a polished, scalable version of our app so that future developers can further maintain it and add these additional features. Our part in this involves the following goals:

* Enhance profile filtering
* UI polish and accessibility improvements
* Refactor the codebase for clarity, scalability, and portfolio use
* Updating user profiles and additional photo storage

---

## Continuous Integration: 

Our team is utilizing GitHub Actions for Continuous Integration for this project. 
GitHub Actions seemed to be the most natural fit because it integrates well with Git; we can simply create a pull request and have all of our unit tests execute to catch errors before merging rather than after. It also seemed easiest to set up compared to other options like CircleCI, and there are many tutorials, especially with adding a MySQL database to use in unit tests - and although incorporating a database into unit tests isn't ideal, it met our needs for this project. Finally, it allowed us to write our actions like code, which gives our GitHub Actions the opportunity to be version-controlled and included directly in our git repo code, keeping everything organized. 

Proof of our GitHub Actions can be found in .github > workflows > php.yml, and there are multiple successful executions in our Pull Requests > Completed section on this git repo.

---

## Unit Tests

All of our unit tests are located inside the \tests\Unit folder of our GitHub repository. 

Unit tests passing can be seen via GitHub Actions.
