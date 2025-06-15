<?php
    //start session 
    session_start();

    //initializing the variables for error and input 
    $fname = $lname = $order ="";
    $fnameErr = $lnameErr = $orderErr = "";

    //check of the form is submitted 
    if($_SERVER["REQUEST_METHOD"]== "POST"){

        if(isset($_POST["fname"])){
            if(empty($_POST["fname"])){
                $fnameErr = "First Name is required";
            }else{
                $fname = test_input($_POST["fname"]);
                if(!preg_match("/^[a-zA-Z ]*$/",$fname)){
                    $fnameErr ="Only letter sna spaces allowed";
                }
            }
        }

        
        if(isset($_POST["lname"])){
            if(empty($_POST["lname"])){
                $lnameErr="Last Name is required";
            }else{
                $lname=test_input($_POST["lname"]);
                if(!preg_match("/^[a-zA-Z ]*$/",$lname)){
                    $lnameErr="Only Letters and Spaces";
                }
            }
        }

        if(isset($_POST["order"])){
            if(empty($_POST["order"])){
                $orderErr ="Order is required";
            }else{
                $order=test_input($_POST["order"]);
                if(!preg_match("/^[a-zA-Z-0-9 ]*$/",$order)){
                    $orderErr="Only letters, numbers and spaces allowed";
                }
            }
        }

        if(empty ($fnameErr) && empty ($lnameErr) && empty($orderErr)){
            $_SESSION["fname"] = isset($_POST["fname"]) ? htmlspecialchars($_POST["fname"]) : "";
            $_SESSION["lname"] = isset($_POST["lname"]) ? htmlspecialchars($_POST["lname"]) : "";
            $_SESSION["order"] = isset($_POST["order"]) ? htmlspecialchars($_POST["order"]) : "";

            //redirects to the the order page
            header("Location: order.php");
            exit();
        }else{
            
            $_SESSION["fnameErr"] = $fnameErr;
            $_SESSION["lnameErr"] = $lnameErr;
            $_SESSION["orderErr"] = $orderErr;
            
            //redirects to the home page
            header("Location: about.html");
            exit();
        }

    }
    function test_input($data){
        $data = trim($data);
        $data = stripcslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

?>