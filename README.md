# FA tester API

## Backend DB
   
   mySQL is used for a backend and data storage. 
   
   PDO is used to prepare the statements for data input.
   
   All DB connection is managed by the DBConnect class.
   
   please set the parameters for you db system
           ```
               private $host = "localhost";
               private $db_name = "fs_db";
               private $username = "root";
               private $password = "root";
               public $conn;
           ```
   If tables do not exist in the DB the DBConnect creates them if required.     

## Address
    
   Address is the class that handles all the operations for the API.
   It has a three methods: 
            ```
                read()
                search_term($search_term)
                readOne()
            ```
   Those retrieve data from the DB as follows: all, search term exists in name, email or address, find GUID
   Only readOne() will retrieve all data for the from the DB tables. 
   
   There is a list of properties as follows in addition to the methods listed:
            ```
                public $conn;
                    public $table_name = "addresses";
                    private $names_table = "names";
                    private $personal_table = "personal";
                    public $id;
                    public $guid;
                    public $name;//
                    public $gender;//
                    public $company;//
                    public $phone;//
                    public $address;//
                    public $latitude;
                    public $longitude;
                    public $picture;//
                    public $age;//
                    public $eyeColor;//
                    public $about;//
                    public $email;//
                    public $balance;
                    public $isActive;//
                    Public $registered;//
            ```

## index.php

   This is the landing page for the FS tester. On the document completion a API call is triggered depending on the parameter contained:
   no parameter => read all records
   guid => retrieve single record
   search => retrieve searched term
   
## read.php

   Retrives all records in the addresses table
   
## read_single.php
    
   Finds full record data for a valid GUID.
   
## search.php

   Finds search term in name, address or email. If any of the fields contain the term records are retrieved.

## script.js

   ajax call for data
   
## Additional files
    addressess.csv, 
    names.csv,
    personal.csv,
    test_data.csv
   
   Those files demonstrate the split of the database tables. 
   