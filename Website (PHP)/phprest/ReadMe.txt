This folder contains all the files for the rest api for the database named 'project'

To run the api using postman to test the outputs in json format follow these steps:
1. Place 'phprest' folder with all the files inside the root directory of your server application.
   If youre using 'xampp' for example, the 'phprest' folder should be inside the 'htdocs' directory.
2. In phprest/api/config/config.php modify the database credentials as you have set on your device.
3. Download the 'project.sql' database file and import it to the server application.
   If youre using 'xampp' for example, then create a new database named project in 'phpmyadmin' and
   import the 'project.sql' file to it. Make sure to uncheck the 'Enable foreign key checks' and 
   'Allow the interruption of an import in case the script detects it is close to the PHP timeout limit'
   options.
4. Now make sure u have postman installed
5. Test the results of endpoints/ urls using the simple read from product_type command:
   GET http://localhost/phprest/api/product/read.php
   Where GET is the HTTP header and the rest is the url
   