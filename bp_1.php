 <LINK href=/reynolds.css rel=stylesheet type=text/css>
  <script type=text/javascript src=/common.js></script>
  <script type=text/javascript src=/css.js></script>
  <script type=text/javascript src=/standardista-table-sorting.js></script>

<?php

# if($_SERVER["HTTPS"] != "on") {
#     $pageURL = "Location: https://";
#    if ($_SERVER["SERVER_PORT"] != "80") {
#      $pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
#     } else {
#       $pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
#    }
#       header($pageURL);
#    }

 require ('connect.php');

     echo "<form  action=bp_process.php method=post>";

     $bp_ind = 0;
     $sys = 0;
     $dia = 0;
     $pulse = 0;
     $arm_l = 'checked';
     $arm_r = ' ';
     $comment = ' ';
 
     $bp_ind = $_GET['bp_ind'];
     $action = $_GET['action'];

    if ($action == 'find')
      {
         $bp_ind = mysqli_real_escape_string($mydbh,$bp_ind);
        $result = mysqli_query($mydbh,"select * from blood_pressure where bp_ind ='$bp_ind'");
        if (!$result)
           {
            $error = 'Error!';
            include 'error.php';
            exit();
           }

         while ($row = $result->fetch_array(MYSQLI_BOTH))
           { 
            $bp_ind = $row['bp_ind'];
            $sys = $row['sys'];
            $dia = $row['dia'];
            $pulse = $row['pulse'];
            $arm = $row['arm']; 
              if ($arm = 'L'){
               $arm_l = 'checked';
               $arm_r = ' ';
             }else{
               $arm_l = '       ';
               $arm_r = 'checked';
              }
          
            $comment = $row['comment'];
         }
     } 
      echo "<table>";
      echo "<tr><th>KEY</th><td><input type=numeric name=key value=$bp_ind readonly></td></tr>\n";
      echo "<tr><th>SYS</th><td><input type=numeric name=sys value='$sys'></td></tr> \n";
      echo "<tr><th>DIA</th><td><input type=numeric name=dia value='$dia'></td></tr>\n";
      echo "<tr><th>Pulse</th><td><input type=numeric  name=pulse value='$pulse'></td></tr>\n";
      echo "<tr><th>Arm</th><td><input type=radio name='arm' value='L' $arm_l>Left<input type=radio name='arm' value='R' $arm_r>Right</td></th>\n";
      echo "<tr><th>Comment</th><td><input type=text  size='25' name=comment value='$comment'></td></tr>\n";

      echo "</table>\n";
      echo "<br>\n";
      echo "</select><br>\n";
      echo "<input type=hidden name=bp_ind value=$bp_ind>\n";
      echo "<input type=submit name=submit value=update>\n";
      echo "</form>\n";
      echo "</body></html>\n";

     mysqli_close($mydbh);
?>
