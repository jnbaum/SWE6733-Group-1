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

Stakeholders:

* <ins>Outdoor Lovers & Adventurers</ins> - These are the individuals who are searching for partners who share a common interest in adventuring. As the primary user demographic and beneficiaries, their satisfaction will be the key factor in determining the application's success.
* <ins>Outdoor Organization & Guides</ins> - A third party may be interested in using Rovaly application to find and connect with potential participants. This can include local community groups, organization operators, and professional guides.
* <ins>Investors</ins> - This party provides the funding and resources for the Rovaly team to carry out the application's development. The profit and growth to be gained will be contingent upon this product's success.
* <ins>Team Members</ins> - This includes us, the project managers and developers who are responsible for the development of the application. We want the project to succeed so that others can enjoy the benefits of our work.

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


+ For Sprint 1, we forecast that our team can complete 18 story points. The completion of these story points will take an estimated 21 days, which fits within our 23-day timeframe. 
+ For Sprint 2, the current estimation prior to the start of Sprint 2 is 24.5 story points. Sprint 2 is shorter than Sprint 1, at 11 days. Sprint 2 will be a stretch, but our team has a plan to modify the backlog during the pre-sprint backlog grooming to move some story points to Sprint 3.
+ For Sprint 3, the current estimation prior to the start of Sprint 3 is 4 story points. Sprint 3 is the shortest sprint, at 4 days. Most of this sprint's items have to do with documentation and presentation, and as such, will be the least technical sprint.

+ Rationale: We used our experience from work and past school projects to estimate the points for each story. For example, login was given 2 story points because we are mostly familiar with the concept (i.e. fetching an existing user from the database with the entered username, and then comparing its password to the entered password). For stories that we have less past experience with, such as the matching feature, in-app messaging, and S3 photo uploads, we gave more generous story point estimates to allow for extra time to research and explore new concepts.

---

## Daily Scrum

* [Daily Scrum from 6/12](https://swe6673.atlassian.net/wiki/x/BAA9)
* [Daily Scrum from 6/17](https://swe6673.atlassian.net/wiki/x/AYAxAQ)
* [Daily Scrum from 6/20](https://swe6673.atlassian.net/wiki/x/AYBpAQ)

---

## Sprint Burndown Chart

[Jira Sprint 1 Burndown](https://swe6673.atlassian.net/jira/software/projects/SCRUM/boards/1/reports/burndown?source=overview)

Sprint 1 - The team showed a great overall performance in completing all the planned tasks ahead of schedule. The high productivity and effective execution provided a buffer period for the final two weeks of the sprint. Although the team encountered issues related to web service hosting, the team was able to resolve some of the problems and accelerate their work to complete the scope early. An important note, there is discrepancy with the sprint burndown chart's visual representation. The graph shows a flat start during the initial week followed by an acceleration during midpoint. This actually does not truly reflect the team's consistent progress as there were some delay in updating the stories on a continuous basis. Therefore, the acutal trajectory of work completion should have shown a consistent burndown instead a rapid acceleration midway through the sprint.

---

#Pair Programming

* [Teams Meeting between Jessica, Joo, and Tarik](https://kennesawedu-my.sharepoint.com/:v:/g/personal/jbaum1_students_kennesaw_edu/Ea6kDxeRc1NMvSxsUUzRDegBYta0TGfuJFZzxu4NKPDOIw?e=unq1fw&nav=eyJyZWZlcnJhbEluZm8iOnsicmVmZXJyYWxBcHAiOiJTdHJlYW1XZWJBcHAiLCJyZWZlcnJhbFZpZXciOiJTaGFyZURpYWxvZy1MaW5rIiwicmVmZXJyYWxBcHBQbGF0Zm9ybSI6IldlYiIsInJlZmVycmFsTW9kZSI6InZpZXcifX0%3D)
* [Teams Meeting Between Megan and Jerry](https://kennesawedu-my.sharepoint.com/:v:/g/personal/mdollar8_students_kennesaw_edu/EfNC1A5nfqtDkZil589AB_QBfyn8kmRmQs941EzfIgMKDQ?e=wYSmnv&nav=eyJyZWZlcnJhbEluZm8iOnsicmVmZXJyYWxBcHAiOiJTdHJlYW1XZWJBcHAiLCJyZWZlcnJhbFZpZXciOiJTaGFyZURpYWxvZy1MaW5rIiwicmVmZXJyYWxBcHBQbGF0Zm9ybSI6IldlYiIsInJlZmVycmFsTW9kZSI6InZpZXcifX0%3D)

---

