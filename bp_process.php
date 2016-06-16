<?php

 require ('connect.php');

     $bp_ind = $_POST['bp_ind'];
     $sys = $_POST['sys'];
     $dia = $_POST['dia'];
     $pulse = $_POST['pulse'];
     $arm = $_POST['arm'];
     $comment = $_POST['comment'];

    
     $bp_ind = mysqli_real_escape_string($mydbh,$bp_ind);
     $sys = mysqli_real_escape_string($mydbh,$sys);
     $dia = mysqli_real_escape_string($mydbh,$dia);
     $pulse = mysqli_real_escape_string($mydbh,$pulse);
     $arm = mysqli_real_escape_string($mydbh,$arm);
     $comment = mysqli_real_escape_string($mydbh,$comment);

   if ($bp_ind <> 0)
      {
      mysqli_query($mydbh,"update blood_pressure set sys = '$sys', dia = '$dia', pulse = '$pulse', arm = '$arm', comment = '$comment' where bp_ind = '$bp_ind'") or die('Query failed: '. mysqli_error($mydbh));
      header("location:bp.php");
      }
     else
     {
       mysqli_query($mydbh,"insert into blood_pressure values(unix_timestamp(now()), '$sys', '$dia', '$pulse', '$arm', '$comment')")or die('Query failed: '. mysqli_error($mydbh));
         
      header("location:bp.php");
     }
    
    mysqli_close($mydbh);
?>
