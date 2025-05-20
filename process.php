<?php
include("connect.php");


    //the directory where the file is going to be placed
    $target_dir = "C:/wamp64/www/Assignments/Intern1/uploads/"; //relative path didn't work, this is why I chose absolute path

    // check if the file was uploaded
    if (isset($_FILES['fileToUpload']) && $_FILES['fileToUpload']['error'] == 0) {
        $fileName = basename($_FILES["fileToUpload"]["name"]);
        $target_file = $target_dir . $fileName; //the path of the file to be uploaded
        //$size_file = filesize($target_file);
        $size_file = $_FILES['fileToUpload']["size"] / 1024; // size in bytes

         session_start();

        // Check if file already exists
        if (file_exists($target_file)) {
           
            $_SESSION["upload"] = "Sorry, file already exists.";
            header("Location: index.php");
        } else {
            //move file to target
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file )){ //it is first saved to a temporary dir
                // if moved successfull, write details to db ) ";
                $sql = "INSERT INTO files (namefile, sizefile, pathfile) VALUES ('$fileName','$size_file', '$target_file')";
            /*    $sql = "INSERT INTO files (namefile, sizefile, pathfile) 
                    SELECT 
                        CASE WHEN $target_file < 1000000 THEN ('$fileName','$size_file',CONCAT('$target_file'/1024, 'KB')"; */
                
                if ($conn -> query($sql) == true) {
                    //session_start(); 
                    $_SESSION["upload"] = " File uploaded successfully.";
                    header("Location: index.php");
                    
                }
                else {
                    //session_start();
                    $_SESSION["upload"] = "Error: ".$sql." Error Details: ".$conn ->error;
                    header("Location: index.php");
                    
                }
                
            } 
            else{
                session_start();
                $_SESSION["upload"] = "Error moving file.";
                header("Location: index.php");
              }
            }
        
    }
    else{
        session_start();
        $_SESSION["upload"] = "File not uploaded.";
        header("Location: index.php");
    }
    $conn -> close();
?>