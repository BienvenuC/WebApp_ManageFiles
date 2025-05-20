<?php
// Specify the folder where your files are stored
$target_dir = "./uploads/";
// Get the file name from the query parameter
if (isset($_GET['namefile'])) {  // namefile is the column name in the database
    $fileName = basename($_GET['namefile']);
    $filePath = $target_dir . $fileName;

    // Check if the file exists
    if (file_exists($filePath)) {
        // Set headers for download
        
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . $fileName . '"');
        header('Expires: 1');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filePath));

        // Read the file and output it to the browser
        readfile($filePath);

        session_start();
        $_SESSION["download"] = "File downloaded successfully.";
        header("Location: index.php");

    } else {
        session_start();
        $_SESSION["download"] = "File not found.";
        header("Location: index.php");
    }
} else {
     session_start();
    $_SESSION["download"] = "File parameter missing.";
    header("Location: index.php");
}
?>