# SWE6733 Group 1 Repo

## [Click here to access Rovaly](http://ec2-18-222-1-62.us-east-2.compute.amazonaws.com:8080/Presentation/index.php) 

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

Below are the links to the project:

* [Jira & Confluence](https://swe6673.atlassian.net/jira/software/projects/SCRUM/boards/1?atlOrigin=eyJpIjoiZWFmYzIwZWMyZWFiNGMyNGEwNTEzYzVhY2U5MGZmNTQiLCJwIjoiaiJ9)
* [Canva Mockup](https://www.canva.com/design/DAGpbGsNqio/VnFCNnJ8-qeXsxw6DBTfpQ/view?utm_content=DAGpbGsNqio&utm_campaign=designshare&utm_medium=link2&utm_source=uniquelinks&utlId=hf5885327b1)

---

## Product Vision

<b>Near Vision (July 2025):</b> To serve the population of Kennesaw, GA by  creating social opportunity for outdoor adventurers that respects their preferences and interests. 

Within Georgia, the city of Kennesaw has been known for its monumental outdoor attractions such as Kennesaw Mountain, Lake Acworth, and Lake Allatoona. Therefore, it holds many opportunities for outdoor adventurers to plan their own outings and enjoy all that Kennesaw has to offer.

Since COVID (March 2020), the number of new and returning outdoor participants in the U.S. has increased by 26%. Georgia, in particular, resides in the South Atlantic region, which has been called home by one of the largest percentages of outdoor recreation participants in the U.S. [1]. The near vision for Rovaly is to create social opportunity for those who call Kennesaw home by taking advantage of both the city's vast opportunities for outdoor adventures and its large, growing number of outdoor participants. Unlike most people matching apps, ours allows users to set preferences on a per-activity basis (i.e., mark themselves as a novice in camping but an expert in fishing), giving users the choice to find similar outdoor partners for a wide range of activities at the same time. Our matching algorithm also finds matches with more "picky" criteria if a user is not finding suggestions that they like, ensuring that users find the kind of people they're looking for.
[1] - https://outdoorindustry.org/wp-content/uploads/2015/03/2022-Outdoor-Participation-Trends-Report-1.pdf

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

## Stakeholders:

* <ins>Outdoor Lovers & Adventurers</ins> - These are the individuals who are searching for partners who share a common interest in adventuring. As the primary user demographic and beneficiaries, their satisfaction will be the key factor in determining the application's success.
* <ins>Outdoor Organization & Guides</ins> - A third party may be interested in using Rovaly to find and connect with potential participants. This can include local community groups, organization operators, and professional guides.
* <ins>Investors</ins> - This party provides the funding and resources for the Rovaly team to carry out the application's development. The profit and growth to be gained will be contingent upon this product's success.
* <ins>Team Members</ins> - This includes us, the project managers and developers who are responsible for the development of the application. We want the project to succeed so that others can enjoy the benefits of our work.

---

## Continuous Integration: 

Our team is utilizing GitHub Actions for Continuous Integration for this project. 
GitHub Actions seemed to be the most natural fit because it integrates well with Git; we can simply create a pull request and have all of our unit tests execute to catch errors before merging rather than after. We considered Azure DevOps, but that seems more suitable for projects that are stored in an Azure or Microsoft environment. GitHub Actions also provides faster execution time:  [GitHub Actions vs. Azure DevOps](https://dev.to/hamzakhan/azure-devops-vs-github-actions-a-comprehensive-guide-with-examples-performance-metrics-46oc), which is convenient for a project with many pull requests. It also seemed easiest to set up compared to other options like CircleCI, and there are many tutorials, especially with adding a MySQL database to use in unit tests - and although incorporating a database into unit tests isn't ideal, it met our needs for this project. Finally, it allowed us to write our actions like code, which gives our GitHub Actions the opportunity to be version-controlled and included directly in our git repo code, keeping everything organized. 

Proof of our GitHub Actions can be found in .github > workflows > php.yml, and there are multiple successful executions in our Pull Requests > Completed section on this git repo.

---

## Project Backlog Ordering Rationale

Our team ordered the project backlog with a focus on logical workflow progression and intuitive development flow. We began by grouping related features and tasks according to the typical user journey and core functionality dependencies. This ensures foundational components were prioritized before non-required features. Next, we ordered user stories based on what we perceived as the most natural and efficient route to implementation, taking into account iterative building and feature dependencies. For example, we ordered saving user preferences before implementing the matching algorithm because the matching algorithm depends on the user being able to save their preferences. We took into account task complexity, team capacity, and cross-feature dependencies. This approach allowed us to maintain flexibility while ensuring that the overall development process remained coherent and streamlined.

---

## Definition of Ready

* The user story has a clear and descriptive title- Complete
* The description of each user story has the user story in the "As a __ I want to __ so that __" format. -Complete
* Acceptance criteria are in the description -Complete
* Dependencies are identified and addressed- Complete
* Story points are assigned for each item in the backlog- Complete
* UX/UI mockup is complete and approved by the team- Complete
* All sprint one items and their required time can fit in the allotted timeframe of the sprint- Complete
* The team has reviewed and approved the user stories, backlog order, and sprint plan- Complete

---

## Story Point Forecasting

Story point estimation criteria: 

* .5 = < 1 hour
* 1 = 2-6 hours
* 2 = 1 day
* 3 = 2-3 days
* 5 = 3-5 days
* 8 = 5-10 days
* 13 = > 10 days


For Sprint 1, we forecast that our team can complete 18 story points. The completion of these story points will take an estimated 21 days, which fits within our 23-day timeframe. 

For Sprint 2, the current estimation prior to the start of Sprint 2 is 21.5 story points. Sprint 2 is shorter than Sprint 1, at 11 days. Sprint 2 will be a stretch, but our team has a plan to modify the backlog during the pre-sprint backlog grooming to move some story points to Sprint 3. 

According to Yesterday's Weather, Sprint 2's estimated user story point completion is 18 points. That means that Sprint 2 is a high-risk sprint, and our team will have to stretch to complete the workload. This was a known issue going into Sprint 2, and our team has adjusted by starting a few work items for Sprint 2 earlier than the sprint's start date, as our team had completed Sprint 1 items prior to the end of Sprint 1. As it stands at the Sprint 2 start date, we now have 14.5 story points to complete for this sprint. Due to foresight, meeting the sprint goal is now within normal capabilities. 

For Sprint 3, the current estimation prior to the start of Sprint 3 is 14 story points. Sprint 3 is the shortest sprint, at 4 days. Most of this sprint's items have to do with documentation and presentation, and as such, will be the least technical sprint.

According to Yesterday's Weather, Sprint 3's estimated user story point completion is 21.5 points. Since we completed sprint 2 at 21.5 story points, Sprint 3's forecast is attainable. However, since Sprint 3 is not a technical sprint, and all of our user story points have to do with documentation, the actual story point count is only 14. This sprint will not be a stretch to complete, and as such, the team is expected to complete it without issue. 

Rationale: We used our experience from work and past school projects to estimate the points for each story. For example, login was given 2 story points because we are mostly familiar with the concept (i.e., fetching an existing user from the database with the entered username, and then comparing its password to the entered password). For stories that we have less past experience with, such as the matching feature, in-app messaging, and S3 photo uploads, we gave more generous story point estimates to allow for extra time to research and explore new concepts.

---

## Daily Scrum

Sprint 1:
* [Daily Scrum from 6/12](https://swe6673.atlassian.net/wiki/x/BAA9)
* [Daily Scrum from 6/17](https://swe6673.atlassian.net/wiki/x/AYAxAQ)
* [Daily Scrum from 6/20](https://swe6673.atlassian.net/wiki/x/AYBpAQ)

Sprint 2:
* [Daily Scrum from 7/7](https://swe6673.atlassian.net/wiki/spaces/~71202075d9ce1091214feabcdc57c93adc3785/pages/43614209/Daily+Scrum+7+7)
* [Daily Scrum from 7/9](https://swe6673.atlassian.net/wiki/spaces/~71202075d9ce1091214feabcdc57c93adc3785/pages/45383682/Daily+Scrum+7+9)
* [Daily Scrum from 7/11](https://swe6673.atlassian.net/wiki/spaces/~71202075d9ce1091214feabcdc57c93adc3785/pages/47153153/Daily+Scrum+7+11)

Sprint 3: 
* [Daily Scrum for 7/21](https://swe6673.atlassian.net/wiki/spaces/~71202075d9ce1091214feabcdc57c93adc3785/pages/54132737/Daily+Scrum+7+21?atlOrigin=eyJpIjoiNzc1OTM3MzE4ZjcyNDhjNDk1YzYzYmFiMTM0YTZkMTkiLCJwIjoiYyJ9)
* [Daily Scrum for 7/22](https://swe6673.atlassian.net/wiki/spaces/~71202075d9ce1091214feabcdc57c93adc3785/pages/54231041/Daily+Scrum+7+22?atlOrigin=eyJpIjoiMWE4ZmMzOTE3YWQ4NDk1MDk5MTQzZjYwMmZkMjNlNDMiLCJwIjoiYyJ9)
---

## Sprint Burndown Chart

[Jira Sprint 1 Burndown](https://swe6673.atlassian.net/jira/software/projects/SCRUM/boards/1/reports/burndown?source=overview)

Sprint 1 - The team showed a great overall performance in completing all the planned tasks ahead of schedule. The high productivity and effective execution provided a buffer period for the final two weeks of the sprint. Although the team encountered issues related to web service hosting, the team was able to resolve some of the problems and accelerate their work to complete the scope early. An important note: there is a discrepancy with the sprint burndown chart's visual representation. The graph shows a flat start during the initial week, followed by an acceleration during the midpoint. This does not truly reflect the team's consistent progress, as there were some delays in updating the stories on a continuous basis. Therefore, the acutal trajectory of work completion should have shown a consistent burndown instead a rapid acceleration midway through the sprint. The team discussed this issue during the Sprint Review, and corrections have been made for the next sprint. 

[Jira Sprint 2 Burndown](https://swe6673.atlassian.net/jira/software/projects/SCRUM/boards/1/reports/burndown?source=overview)

Sprint 2 - Building upon the previous sprint, the team once again delivered an excellent performance in completing the user story tasks well ahead of schedule. With the web service hosting issue resolved, the team was able to sustain a high level of productivity, which led to another buffer period for the final two weeks. A critical improvement this sprint was the accurate reflection and consistency of task execution shown on the burndown chart. Unlike the previous sprint, where the trajectory did not fully align with the team's performance, this time the team effectively tracked and updated the user stories upon their completion. As a result, the burndown chart displays an accurate reading where the initial week starts flat and is followed by a stead,y consistent progression towards the end of the sprint.

[Jira Sprint 3 Burndown](https://swe6673.atlassian.net/jira/software/projects/SCRUM/boards/1/reports/burndown?source=overview)

Sprint 3 - This sprint marked a successful completion of this project cycle and the team's overall performance. Due to the rapid deliveries in the previous sprints, the team was able to focus their efforts mainly on the documentations and the presentation. The burndown chart initially displays a flatline but for context, the remaining user stories consisted of a lot comprehensive child tasks. As the sprint progressed into its final days, the team was able to efficiently wrap-up the tasks. This led to a substantial drop in the trajectory after the final meeting where the user stories were reviewed and finalized. Overall, the project cycle resulted in success and displayed the team's diligent performance.

---

## Pair Programming

Sprint 1: 

* [Teams Meeting between Jessica, Joo, and Tarik](https://kennesawedu-my.sharepoint.com/:v:/g/personal/jbaum1_students_kennesaw_edu/Ea6kDxeRc1NMvSxsUUzRDegBYta0TGfuJFZzxu4NKPDOIw?e=unq1fw&nav=eyJyZWZlcnJhbEluZm8iOnsicmVmZXJyYWxBcHAiOiJTdHJlYW1XZWJBcHAiLCJyZWZlcnJhbFZpZXciOiJTaGFyZURpYWxvZy1MaW5rIiwicmVmZXJyYWxBcHBQbGF0Zm9ybSI6IldlYiIsInJlZmVycmFsTW9kZSI6InZpZXcifX0%3D)
* [Teams Meeting Between Megan and Jerry](https://kennesawedu-my.sharepoint.com/:v:/g/personal/mdollar8_students_kennesaw_edu/EfNC1A5nfqtDkZil589AB_QBfyn8kmRmQs941EzfIgMKDQ?e=wYSmnv&nav=eyJyZWZlcnJhbEluZm8iOnsicmVmZXJyYWxBcHAiOiJTdHJlYW1XZWJBcHAiLCJyZWZlcnJhbFZpZXciOiJTaGFyZURpYWxvZy1MaW5rIiwicmVmZXJyYWxBcHBQbGF0Zm9ybSI6IldlYiIsInJlZmVycmFsTW9kZSI6InZpZXcifX0%3D)

Sprint 2: 

* [Jessica, Joo, and Jerry](https://kennesawedu-my.sharepoint.com/:v:/r/personal/jbaum1_students_kennesaw_edu/Documents/Recordings/Team%20meeting%206673-20250709_163840-Meeting%20Recording.mp4?csf=1&web=1&e=qZy7N8&nav=eyJyZWZlcnJhbEluZm8iOnsicmVmZXJyYWxBcHAiOiJTdHJlYW1XZWJBcHAiLCJyZWZlcnJhbFZpZXciOiJTaGFyZURpYWxvZy1MaW5rIiwicmVmZXJyYWxBcHBQbGF0Zm9ybSI6IldlYiIsInJlZmVycmFsTW9kZSI6InZpZXcifX0%3D)
* [Megan and Jessica](https://kennesawedu-my.sharepoint.com/:v:/g/personal/jbaum1_students_kennesaw_edu/EV5MOlAKdulMq2tFCqhUC_kBlh3wx25uV9_3ZL72Gq6zyQ?e=ZbirG9&nav=eyJyZWZlcnJhbEluZm8iOnsicmVmZXJyYWxBcHAiOiJTdHJlYW1XZWJBcHAiLCJyZWZlcnJhbFZpZXciOiJTaGFyZURpYWxvZy1MaW5rIiwicmVmZXJyYWxBcHBQbGF0Zm9ybSI6IldlYiIsInJlZmVycmFsTW9kZSI6InZpZXcifX0%3D)
* [Jake and Tarik](https://kennesawedu-my.sharepoint.com/personal/tdavi192_students_kennesaw_edu/_layouts/15/stream.aspx?id=%2Fpersonal%2Ftdavi192%5Fstudents%5Fkennesaw%5Fedu%2FDocuments%2FRecordings%2FTeams%20Meeting%2D20250710%5F183601%2DMeeting%20Recording%2Emp4&referrer=StreamWebApp%2EWeb&referrerScenario=AddressBarCopied%2Eview%2E2eb1fc07%2Db78e%2D47a8%2D8d1f%2Da7326af8ac7e)

Sprint 3: 

* [Last paired coding session](https://kennesawedu-my.sharepoint.com/:v:/g/personal/mdollar8_students_kennesaw_edu/EavRoqHuOP1IoXeKXktrnd0BOGbdKbbOx4EQ8Y_n3EN7VQ)

## Unit Tests

All of our unit tests are located inside the \tests\Unit folder of our GitHub repository. 

Unit tests passing can be seen via GitHub Actions.

## TDD

Sprint 1: 

[TDD - Get Potential Matches](https://swe6673.atlassian.net/wiki/spaces/~71202075d9ce1091214feabcdc57c93adc3785/pages/42270743/TDD+-+GetPotentialMatches)

Sprint 2: 

[TDD - Improving Scalability with a Bulk Fetch Method](https://swe6673.atlassian.net/wiki/spaces/~71202075d9ce1091214feabcdc57c93adc3785/pages/50626561/TDD+Sprint+2+-+GetBulkAdventureDetailsArray)

Sprint 3:
[TDD- MessageServiceGetChatRoomKeyTest ](link here)

---

## Sprint Review

* [Sprint One Review](https://swe6673.atlassian.net/wiki/x/AoCDAg)
* [Sprint One Review Video](https://www.loom.com/share/57b74680baa145feaae35517580db5d0)
* [Sprint Two Review - Demo Video](https://www.loom.com/share/36ef0f4e4f4a40698583bfcdb6e04d16?sid=7a3f5087-7fd6-447b-b1bf-5b4057ef0709)
* [Sprint Two Review and Retrospective Document](https://swe6673.atlassian.net/wiki/spaces/~71202075d9ce1091214feabcdc57c93adc3785/pages/49217537/Sprint+2+Review+and+Retrospective)
* [Sprint Three Review Video](https://kennesawedu-my.sharepoint.com/:v:/g/personal/mdollar8_students_kennesaw_edu/EavRoqHuOP1IoXeKXktrnd0BOGbdKbbOx4EQ8Y_n3EN7VQ?e=kB4r0k)
* [Sprint Three Review Document](https://swe6673.atlassian.net/wiki/spaces/~71202075d9ce1091214feabcdc57c93adc3785/pages/55148545/Sprint+3+Review+and+Retrospective?atlOrigin=eyJpIjoiY2QxYWFiN2M1NzJlNDdhMjgzYjA4OTBmMmEyMzZmOTkiLCJwIjoiYyJ9)
