# TechDumpHelper
TechDumpHelper is an online inventory management system for Rensselaer's tech dumps, also containing helpful guides.

## Deployment Instructions
1. Use a server with PHP 7 and MySQL.
1. Import the provided SQL file into MySQL to create the proper table structure.
1. Ensure that the webserver has sufficient permissions to create and write to files so file uploads will work properly.
1. Create a file named techdumpsdb.json that has the following three items:
```
{
  "dsn":"mysql:host=<WEBSERVER_IP>;dbname=<DB_NAME>",
  "username":"<MYSQL_USERNAME>",
  "password":"<MYSQL_PASSWORD>"
}
```
Place the json file one directory above the project contents (e.g. if the repository is in `C:/xampp/htdocs/techdumphelper`, make the file at `C:/xampp/htdocs/techdumpsdb.json`, although preferably in a place where it won't be accessible).
