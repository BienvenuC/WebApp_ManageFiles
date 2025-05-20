# WebApp_ManageFiles
Place this folder it in your server directory.(With wampserver is it under "C:/wamp64/www/)
Make sure a folder named "uploads" is present, otherwise create it. 

Create a DB named: "files_db"
Create table named: "files" with columns: id (int, autoincrement),namefile (text), sizefile (decimal), pathfile (text), datefile(current timestamp)
Create a table named: "search" with 2 columns: id (int, autoincrement), search_exp (text). This table stores what users search. 

The index file is "index.php", run it in a browser.
