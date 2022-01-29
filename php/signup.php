<?php
session_start();
    include_once "config.php";
    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
    $lname = mysqli_real_escape_string($conn, $_POST['lname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    if(!empty($fname) && !empty($lname) && !empty($email) && !empty($password)){
        // let's check user if email is valid
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            // lets check if the email already exists
            $sql = mysqli_query($conn, "SELECT email FROM users WHERE email = '{$email}'");
            if(mysqli_num_rows($sql) > 0){
                echo "$email - already exists!";
            }
            else{
                //let's check if user uploads file or not
                if(isset($_FILES['image'])){
                    $img_name = $_FILES['image']['name'];//getting user uploaded image name
                    $img_type = $_FILES['image']['type'];//getting user image type
                    $tmp_name = $_FILES['image']['tmp_name']; //this temporay name is used to save/move file in our folder

                    //let's explode image and get the last extension like jpg png
                    $img_explode = explode('.', $img_name);
                    $img_ext = end($img_explode); //here we get the extension of our user uploaded image
                    $extensions = ['png', 'jpeg', 'jpg', 'jfif'];
                    if(in_array($img_ext, $extensions) === true){
                        $time = time();
                        $new_img_name = $time.$img_name;
                        if(move_uploaded_file($tmp_name, "user_images/".$new_img_name)){
                            $status = "Active now";
                            $random_id = rand(time(), 10000000);

                            $sql2 = mysqli_query($conn, "INSERT INTO users (unique_id, fname, lname, email, password, img, status)
                                                Values ({$random_id}, '{$fname}', '{$lname}', '{$email}', '{$password}','{$new_img_name}','{$status}')");
                            if($sql2){
                                $sql3 = mysqli_query($conn, "SELECT * FROM users Where email = '{$email}'");
                                if(mysqli_num_rows($sql3) > 0){
                                    $row = mysqli_fetch_assoc($sql3);
                                    $_SESSION['unique_id'] = $row['unique_id'];
                                    echo "success";
                                }
                            }
                            else{
                                echo "Something went wrong!";
                            }                    
                        }
                    }
                    else{
                        echo "Please select a valid image file - jpeg, jpg, png!";
                    }
                }
                else{
                    echo "Please upload an Image!";
                }
            }
        }
        else{
            echo "$email - this is an invalid email!";
        }
    }
    else{
        echo "All input files are required!";
    }
?>