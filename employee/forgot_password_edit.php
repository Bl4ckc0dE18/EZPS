<?php
    session_start();
    include 'includes/conn.php';

        if(isset($_POST['edit_passowrd'])){
            //Loop search from verivication code in forgot passowrd
            $_SESSION['error'] = 'Cannot find account with the employee idqqqq';
            //header('location: forgot_password');
        

        }	
        else{
            $_SESSION['error'] = 'Fill up add form first';
        }

            //$_SESSION['error'] = 'Cannot find account with the employee idaaaaa';

            header('location: forgot_password');


?>