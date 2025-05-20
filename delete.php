<?php
    include("connect.php");
    if (isset($_GET['id']))
    {
    
        $id = $_GET['id'];
        $sql1 = "SELECT pathfile FROM files WHERE id = $id";
        $filepath = mysqli_fetch_array($conn->query($sql1))[0]; //we know this is a string

            // Check if the file exists
            if (file_exists($filepath)) {

                // Delete the file
                unlink($filepath);
                // Remove record from DB
                $sql = "DELETE FROM files WHERE id = $id";
                    if ($conn -> query($sql) == true) {
                        session_start();
                        $_SESSION["delete"] = "File deleted successfully";
                        header("Location: index.php"); //index.php is the main page where we list all records
                    } else {
                        session_start();
                        $_SESSION["delete"] = "Error deleting record";
                        header("Location: index.php");
                    }
            } else {
            session_start();
            $_SESSION["delete"] = 'File not found.';
            header("Location: index.php");
            } 
    };
    $conn -> close();
?>