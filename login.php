<?php
    session_start();

    $usr = "";
    $pwd = "";
    $error_msg = "";

    //Check if user entered username and password
    if (isset($_POST['l_usr']) && isset($_POST['l_pwd'])) {
        //get all usernames, and see if the usernames exists
        $users = fopen(".users.txt", "r");
        $usr = htmlentities($_POST['l_usr']);
        $usr_exists = false;
        $usr_num = 0;
        while(!feof($users)){
            $temp_usr = trim(fgets($users));
            if(strcmp($usr, $temp_usr) == 0){
                $usr_exists = true;
                break;
            }
            $usr_num++;
        }
        fclose($users);

        //get password, and see if its correct
        $pwd = htmlentities($_POST['l_pwd']);
        $passwords = fopen(".passwords.txt", "r");
        $correct_pwd = false;
        for($i = 0; $i < $usr_num; $i++){
            fgets($passwords);
        }
       
        $temp_pwd = trim(fgets($passwords));
        if(strcmp($pwd, $temp_pwd) == 0){
            $correct_pwd = true;
        }
        fclose($passwords);
    }

    //assign the appropriate error message if any
    if (strcmp($usr, "") == 0) {
        $error_msg = "The username is requiered";
    } elseif (strcmp($pwd, "") == 0) {
        $error_msg = "The password is requiered";
    } elseif ($usr_exists == false || $correct_pwd == false) {
        $error_msg = "Wrong username or password";
    } else {
        $_SESSION['usr'] = $usr;
        $_SESSION['pwd'] = $pwd;
    }

    //Log the user in if there is no error
    if(Strcmp($error_msg, "") == 0 && isset($_SESSION['usr'])) {
        header("Location: main.php");
        exit;
    } else {
        $_SESSION['l_error'] = $error_msg;
        header("Location: index.php");
        exit;
    }
?>