<?php 
    require_once('./config/dbconfig.php');
    $db = new operations();
    
   
        global $db;
        if($db->logout())
        {
            $db->set_messsage('<div class="alert alert-danger"> Logout Successfully </div>');
            header("location:index.php");
        }
        else
        {
            $db->set_messsage('<div class="alert alert-danger">  Something Wrong to Delete the Record </div>'); 
        }
    

  
?>