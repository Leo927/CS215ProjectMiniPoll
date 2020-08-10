# CS215ProjectMiniPoll
Name: Songhao Li
Student Number: 200347094
Class number: CS215-072
URL: http://www2.cs.uregina.ca/~li725/CS215ProjectMiniPoll/

Description of files:
/css //contains all css files
/js
	-charCount.js //contains a js function the support input char count
	-createPoll.js //contains js functions for create.php 
	-formFunctions.js //contains js functions for general form validation
	-login.js 	//contains js functions for login 
	-signUp.js //contains js functions for sign up
/pages //contains all the pages
	-create.php
	-logout.php
	-management.php
	-result.php
	-signUp.php
	-vote.php
/php
	/reuse //contains all general php functions
		-db.php //contains database login info
		-dbaccess.php //contains all the functions that deal directly with database. 
		-debug.php //some functions used for debugging
		-exception_handling.php //contains hand_error() that handle user level error
		-form_fields.php //contains some general input validation functions
		-navbar.php //this is where navbar live
		-security.php //contains mysql html sanitizing functions
		-user_control.php //contains prevent_visitor() which redirect visitors if not logged in
/sql //contains my sql queries
/uploads //used to store user uploads
	/avator	//stores uploaded avators
-.htaccess //used to force prepend config.php to every php files
-config.php //contains website-wide configuration. it defines ROOT_PATH and ROOT_URI
-index.php //home page

