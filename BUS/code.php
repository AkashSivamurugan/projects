<?php
session_start();
$con = mysqli_connect("localhost","root","","phpt");
$from = $_POST['from'];
$to = $_POST['to'];
$time=$_POST['time'];

if(isset($_POST['save']))
{
    

    

    if($from!=$to)
    {
        $_SESSION['status'] = "Searching";
        if ($from==1 && $to==2 && $time==1) {
            header("Location:page3.php");
        }
            elseif($from==1 && $to==2 && $time==2) {
            header("Location:page2.php");
         }
        }
          
        }
    
         
 
    
    else
    {
        $_SESSION['status'] = "From and To Address Are Same...";
        header("Location: home.php");
    }




?>