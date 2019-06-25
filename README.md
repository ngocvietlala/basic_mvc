## Basic PHP MVC todo web application

- Authhor: Ngo Ngoc Viet.

### Plans:
- [x] Create basic MVC
- [x] Create a view with to show the works on a calendar view with: Date, Week, Month
- [x] Functions to Add. A work includes information of “Work Name”, “Starting Date”, “Ending Date” and “Status” (Planning, Doing, Complete)
- [ ] Functions to Edit, Delete Work
- [ ] Apply UNIT TEST to test your functions

### Git flow
* Branch Master: Used for production. After accept pull request from staging, we gonna make a tag to mark the deploy versions then deploy.
* Branch Staging: Used for customers. After customer confirmed and everything ok we gonna make a pull request to master branch.
* Branch development: Used for developer to implement features in current sprint. In the end of sprint we gonna make a pull request to staging branch for customer confirm.

### How to start
* Create table in MySql.
    * todos

        | NAME       	| TYPE            	| DEFAULT        	|
        |------------	|-----------------	|----------------	|
        | id         	| INT primary key 	| auto increment 	|
        | start_at   	| DATETIME        	| NOT NULL       	|
        | end_at     	| DATETIME        	| NOT NULL       	|
        | event_name 	| VARCHAR(255)    	|                	|
        | status     	| TINYINT         	| DEFAULT 1      	|
* Setting apache2/nginx point to `public` directory.
* Setting app url, database in `config/app`.
* Go to url: {your_domain}/todo/index to view calendar.
* Hold and drag on calendar to add job.