<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Upload file</title>
</head>
<body>
    <div class=" container my-4">
        <header class="d-flex justify-content-between my-4">
            <h1>Select file to upload:</h1>
            <div>
                <a href="index.php" class="btn btn-primary">Back to Index</a>
            </div>

        </header>
        <form action="process.php" method="post"  enctype="multipart/form-data">
        <input type="file" name="fileToUpload" id="fileToUpload">
        <input type="submit" class="btn btn-success" value="Upload file" name="upload">
    </form>
    </div>
</body>
</html>