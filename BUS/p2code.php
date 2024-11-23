<?php
session_start();
$con = mysqli_connect("localhost","root","","");
$type = $_POST['type'];

if(isset($_POST['save']))
{
    

    

    if($type!=null)
    {
        $_SESSION['status'] = "Searching";
    
        
 if ($type==1) {
    header("Location:vdm-ttp-9-govt-rs.html");
    }  
elseif ($type==2 ) {
    header("Location:vdm-ttp-9-govt-loc.html");
     // code...
 }
 elseif ($type==3 ) {
    header("Location:vdm-ttp-9-govt-exp.html");
     // code...
 }  
    }
    else
    {
        echo "Wrong Credentials";
        $_SESSION['status'] = "From and To Address Are Same...";
        header("Location: page2.php");
    }

}



?>