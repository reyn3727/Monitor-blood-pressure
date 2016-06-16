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

 echo "<form  action=bp.php method=post>\n";
 echo "<br>\n";
 echo "<input type=button value='Add New Record' onclick= location='bp_1.php?bp_ind=0&action=add'>\n";
 echo "<br>\n";
 echo "<br>\n";
 echo "<table class=sortable>
 <thead>
 <tr>
 <th>Date - Time</th>
 <th>SYS</th>
 <th>DIA</th>
 <th>Pulse</th>
 <th>Arm</th>
 <th>Comment</th>
 <th>    </th>
 </tr></thead><tbody>";

  require "connect.php";

      $chkdate = strtotime('2016-01-01 00:00:00');
      $chkdate = mysqli_real_escape_string($mydbh,$chkdate);
      $query="select blood_pressure.*, from_unixtime(bp_ind, '%y-%m-%d') as date from blood_pressure where bp_ind >= $chkdate order by bp_ind desc";
      $result = $mydbh->query($query);
      if (!$result) {
       printf("Query failed: %s\n", $mysqli->error);
      exit;
     }
      $row_cnt = mysqli_num_rows($result);
      # echo "<h1>$row_cnt</h1>\n";

      while($row = $result->fetch_array(MYSQLI_BOTH))
      {
        $bp_ind = $row['bp_ind'];
        $format = "m-d-Y h:i:s A";
       
    #    $date = $row['date'];         
    #    if ((($date >= '15-11-01') && ($date <= '16-03-07')) || 
    #      (($date >= '16-11-06') && ($date <= '17-03-12')) ||
    #      (($date >= '17-11-05') && ($date <= '18-03-11')) ||
    #      (($date >= '18-11-04') && ($date <= '19-03-10'))) {
    #      $unixdt = date(($bp_ind)-21600);
    #     }else{
    #      $unixdt = date(($bp_ind)-18000);
    #     }

         echo "<tr>";
         echo "<td class='number'>" . date($format, $bp_ind). "</td>\n";
      #  echo "<td>" . $row['date'] . "</td>\n";
         echo "<td>" . $row['sys'] . "</td>\n";
         echo "<td>" . $row['dia'] . "</td>\n";
         echo "<td>" . $row['pulse'] . "</td>\n";
         echo "<td>" . $row['arm'] . "</td>\n";
         echo "<td>" . $row['comment'] . "</td>\n";

         $_POST['action'] = 'find';
         $_POST['bp_ind'] = $bp_ind;
         echo "<td><input type=button value=Update onclick= location='bp_1.php?bp_ind=$bp_ind&action=find'></td>\n";
         echo "</tr>\n";
       }
 
  echo "</tbody></table>\n";
  echo "<br>\n";
  echo "<input type=button value='Add New Record' onclick= location='bp_1.php?bp_ind=0&action=add'>\n";
  echo "<br>\n";
  echo "<input type=button value='Menu' onclick= location='index.php'>\n";
  echo "<br>\n";
  echo "</select><br>\n";
  echo "</form>\n";
  echo "</body></html>\n";

 mysqli_close($mydbh);
?> 
