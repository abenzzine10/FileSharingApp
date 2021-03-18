<?php
    session_start();

    $usr = "";
    $pwd1 = "";
    $pwd2 = "";
    $error_msg = "";

    //Check if user entered username and password twice
    if (isset($_POST['s_usr']) && isset($_POST['s_pwd1']) && isset($_POST['s_pwd2'])) {
        //get all usernames, and see if the usernames exists
        $users = fopen(".users.txt", "r");
        $usr = htmlentities($_POST['s_usr']);
        $usr_exists = false;
        while(!feof($users)){
            $temp_usr = trim(fgets($users));
            if(strcmp($usr, $temp_usr) == 0) {
                $usr_exists = true;
                break;
            }
        }
        fclose($users);

        //get passwords, and compare them to each other
        $pwd1 = htmlentities($_POST['s_pwd1']);
        $pwd2 = htmlentities($_POST['s_pwd2']);
        $same_pwds = false;
        if (strcmp($pwd1, $pwd2) == 0){
            $same_pwds = true;
        }
    }

    //assign the appropriate error message if any
    if (strcmp($usr, "") == 0) {
        $error_msg = "The username is requiered";
    } elseif (strcmp($pwd1, "") == 0) {
        $error_msg = "The password is requiered"; 
    } elseif (strcmp($pwd2, "") == 0) {
        $error_msg = "The password is requiered"; 
    } elseif ($usr_exists == true) {
        $error_msg = "The username already exists";
    } elseif (!preg_match('/^[\w_\-]+$/', $usr)) {
        $error_msg = "Can't use special characters";
    } elseif ($same_pwds == false) {
        $error_msg = "The passwords didn't match";
    } else {
        //update the file with username and password if no error
        $users = fopen(".users.txt", "a");
        fwrite($users, $usr."\n");
        fclose($users);
        $passwords = fopen(".passwords.txt", "a");
        fwrite($passwords, $pwd1."\n");
        fclose($passwords);
        $_SESSION['usr'] = $usr;
        $_SESSION['pwd'] = $pwd1;
    }

    //Sign the user up and log them in if there is no error
    if (Strcmp($error_msg, "") == 0 && isset($_SESSION['usr'])) {
        header("Location: main.php");
        exit;
    } else {
        $_SESSION['s_error'] = $error_msg;
        header("Location: index.php");
        exit;
    }
?>
