<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script> <!-- used for dropdown sorting list -->
    <title>Search list</title>
</head>
<body>
    <div class=" container my-4">
        <header class="d-flex justify-content-between my-4">
            <h1>Search list</h1>
            <div>
                <a href="index.php"class="btn btn-primary">Back to Index</a>
            </div>
        </header>

        <!-- dropdown fot sorting list -->
         <div class="dropdown">
            <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                Sort List
            </button>
            <ul class="dropdown-menu">
                <li>
                    <form action="" method="post">
                    <button class="dropdown-item" type="submit" name="byname">By Name</button>
                    </form>
                </li>
                <li>
                    <form action="" method="post">
                    <button class="dropdown-item" type="submit" name="bysize">By Size</button>
                    </form>
                </li>
                <li>
                    <form action="" method="post">
                    <button class="dropdown-item" type="submit" name="bydate">By Date</button>
                    </form>
                </li>
            </ul>
        </div>

        <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>File Name</th>
                <th>File Size (KB)</th>
                <th>Date created</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                include("connect.php");
                //if the search button is clicked
                if (isset($_POST['submit-search'])) {
                    $search = mysqli_real_escape_string($conn, $_POST['search']);
                    
                    // record $search in DB
                    $sql_search = "INSERT INTO search(search_exp) VALUES('$search')";
                    $conn -> query($sql_search);

                    //The main query
                    $sql = "SELECT * FROM files WHERE namefile LIKE '%$search%'";
                } 
                    // Get the latest search_exp from DB
                    $sql_lastsearch = "SELECT search_exp FROM search WHERE id= (SELECT MAX(id) FROM search)";
                    $results = $conn -> query($sql_lastsearch);
                    $lastsearch = mysqli_fetch_array($results)['search_exp'];

                    //For sorting, we need to adjust the query
                    if (isset($_POST['byname'])){   
                    $sql = "SELECT * FROM files WHERE namefile LIKE '%$lastsearch%' ORDER BY namefile";
                    };
                    if (isset($_POST['bysize'])){
                        $sql = "SELECT * FROM files WHERE namefile LIKE '%$lastsearch%' ORDER BY sizefile";
                        };
                    if (isset($_POST['bydate'])){
                            $sql = "SELECT * FROM files WHERE namefile LIKE '%$lastsearch%' ORDER BY datefile";
                         };

                 //Now display the results

                    $result = $conn->query($sql);
                    $num_result = mysqli_num_rows($result);
                if ($num_result > 0) {
                ?>        <div class="alert alert-success">
                            <?php echo $num_result ?> results found
                        </div>
                    <?php    $i = 1;
                        while($row = mysqli_fetch_array($result)) {
                    ?>  
                        
                        <tr>
                            <td><?php echo $i?></td>
                            <!--<td><?php //echo $row['id']?></td> -->
                            <td><?php echo $row['namefile']?></td>
                            <td><?php echo $row['sizefile']?></td>
                            <td><?php echo $row['datefile']?></td>
                            
                            <td><a href="download.php?id=<?= $row['id']?>&namefile=<?= $row['namefile']?>" class="btn btn-warning">Download</a></td>
                            <td><a href="delete.php?id=<?= $row['id'] ?>" class="btn btn-danger" onclick = "return confirm('Are you sure you want to delete ?');" >Delete</a></td>
                            
                        </tr>
                    <?php $i++;
                        }
                     } else {
                        ?> <div class="alert alert-success"> <!-- need to figure out a way to make this notification disappear after few seconds -->
                            No result matching the search
                        </div>
                        <?php
                            };
            ?>
        </tbody>
    </div>
</body>
</html>