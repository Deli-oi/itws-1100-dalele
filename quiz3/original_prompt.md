Our goal is to create a Quiz game for random flower facts. I want a clean, not complex design for the frontend, and a heavier focus on a backend in php and mysql that I'll explain further below. 

Basic high level: 
Questions stored in MySQL, served by PHP, answered interactively in the browser with JavaScript. Tracks and displays the user’s score.

Stack:
JS,Jquery, css, html, mySQL, php(phpmyadmin), azure, 

technical reuirements:
1.	At least one MySQL table you designed (show your CREATE TABLE statement)
2.	PHP server-side logic that reads from AND writes to the database
3.	Prepared statements for ALL database queries that include user input
4.	Client-side interactivity — JavaScript or jQuery that enhances the user experience (not just a plain HTML form)
5.	Deployed to Azure — working at your FQDN URL (dalelerpi.eastus.cloudapp.azure.com)
6.	Proper file organization — quiz3 folder with clean IA (information architecture)

You should know:
I have my azure instance linked to this iit directory already, and phpmyadmin already works for lab09(this can be a reference for you), and hosts backend for my restora app. If you need a reference for doing the linking with my azure instance, ask for view access to my restora folder, which lies in team06 folder as a sibling of this iit folder.(I dont expect you to need it, as all that you need to link it is set up once i ssh into dalele@dalelerpi.eastus.cloudapp.azure.com and go into /var/www/html/iit/ and use the commands I know to properly git pull and all that with www-data)
The flower facts dont matter much, just make them factual and fun. 


Final Instruction:
The biggest part of this project is seemless connection of backend to server to frontend to client. the frontend needs to be barebones clean, and I don't want anything extra - I should be able to understand all of this code like I understand my labs. 

