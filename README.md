# About

This web site will represent a test pattern for 3 levels (beginner, intermediate, advanced) in programming C ++. 
It will contain a form where the user can login and answer the questions that are proposed. Upon completion of the test, the answers will be processed and compared with those in the database. If wrong answers, the user will be presented with the correct answer and a brief description argumentative. Besides this page will generate statistics that will display responses after the table name, group and number of correct answers. 

# Interface
The interface will be the usual: header, content and footer. The left side of the header will be the name of the page and on the right - LOGOUT. The menu bar will be located vertically below the header. On the menu bar are buttons description of that site statistics and access to the source of information that must pass the test. 

# PHP scope 
At the server level, the site will be done in PHP, MySQL and Java Script. PHP scripts will be responsible for receiving user input, processing and transmission in the database. When processing a query, the results will be as extracted from the database with PHP scripts. 

# Database MySQL
The database contains five tables: Table users who will retain data about registered users; table sessions that will contain data during the test; Table answers that will contain the user answers; Table contains questions that will be proposed user questions and argument and table variants response.
