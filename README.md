### Todo List API
Developed fully in PHP, a REST API to allow client consume date i.e. read and write to server.

### Tools
Postman to see the flow of data
mySQL
XAMPP

### Usage
The sql file(todoApi) has been provided to help store data, **this contains the structure only not the data**.

Install Postman to be able to view output i.e. GET and POST data to the server.

To read to do list set the request to GET and insert this into the url: http://localhost/`pathToFile`/todoList/read.php
  
To read items set the request to GET and insert this into the url: http://localhost/`pathToFile`/todoItem/read.php
  
To insert new to do list set the request to POST and insert this into the url: http://localhost/`pathToFile`/todoList/insert.php. You will need to provide JSON values e.g.

{
    
      "name" : "value"
    
}
  
To insert item set the request to POST and insert this into the url: http://localhost/<pathToFile>/todoItem/insert.php. As before you would need to provide JSON values for this in Postman.
  
The others include the update and delete which follows the same pattern. Once an list is deleted, all its items will be too, but an item being deleted will not affect the list.

### Miscellaneous

DataTypes for Items are:
id => INT(11)
description => varchar(256)
dueDate => DATETIME,
isCompleted => varchar()
