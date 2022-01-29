<?php
    session_start();
    include_once "config.php";
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    
    if(!empty($email) && !empty($password)){
        $sql12 = mysqli_query($conn, "SELECT * FROM users WHERE email ='{$email}'");
        if(mysqli_num_rows($sql12) > 0){
            $sql = mysqli_query($conn, "SELECT * FROM users WHERE email ='{$email}' AND password = '{$password}' ");
            if(mysqli_num_rows($sql) > 0){
                $row = mysqli_fetch_assoc($sql);
                $status = "Active now";
                $sql3 = mysqli_query($conn, "UPDATE users SET status = '{$status}' where unique_id = {$row['unique_id']}");
                if($sql3){
                    $_SESSION['unique_id'] = $row['unique_id'];
                    echo "success";
                }
               
            }else{
                echo "Password is incorrect!";
            }
        }else{
            echo "Email does not exist!";
        }
        
    }
    else{
        echo "All input fields are required";
    }
?>