<?php
   $myuser='bpuser'; 
   $mypass='open'; 
   $mydb = 'blood_pressure'; 
   $mydbh = mysqli_connect ("localhost", $myuser, $mypass, $mydb)
     or die ("<h1>Could not connect to database: please try again later</h1>");
 ?> 

