<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script> <!-- used for dropdown sorting list -->
    <title>File list</title>
</head>
<body>
    <div class=" container my-4">
        <header class="d-flex justify-content-between my-4">
            <h1>File list</h1>
            <div>
                <a href="upload.php"class="btn btn-primary">Upload a file</a>
            </div>
            <div>
                <form action="search.php" method="post">
                    <input type="text" name="search" placeholder="Search">
                    <button class="btn btn-secondary" type="submit" name="submit-search">Search</button>
                </form>
            </div>

        </header>
        <?php 
            /*Manage sessions*/
            session_start();
            if (isset($_SESSION["upload"])) {
        ?>   
        <div class="alert alert-success">
                <?php
                echo $_SESSION["upload"];
                unset($_SESSION["upload"]);
                ?>
        </div>
            <?php 
            }
        ?>
       <?php 
            /*Manage sessions*/
            if (isset($_SESSION["delete"])) {
        ?> 
        <div class="alert alert-success">
                <?php
                echo $_SESSION["delete"];
                unset($_SESSION["delete"]);
                ?>
        </div>
            <?php 
            }
        ?>
        <?php 
            /*Manage sessions*/
            if (isset($_SESSION["download"])) {
        ?>
        <div class="alert alert-success">
                <?php
                echo $_SESSION["download"];
                unset($_SESSION["download"]);
                ?>
        </div>
            <?php 
            }
        ?>

        <!-- dropdown fot sorting list -->
         <div class="dropdown">
            <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                Sort List
            </button>
            <ul class="dropdown-menu">
                <!--<li><button class="dropdown-item" type="button">By File Name</button></li>
                <li><button class="dropdown-item" type="button">By File Size</button></li>
                <li><button class="dropdown-item" type="button">By Date created</button></li>-->
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
                <!--<th>Id</th>  -->
                <th>File Name</th>
                <th>File Size (KB)</th>
                <th>Date Created</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                include("connect.php");
                if (isset($_POST['byname'])){
                    $sql = "SELECT * FROM files ORDER BY namefile";
                } else if (isset($_POST['bysize'])){
                        $sql = "SELECT * FROM files ORDER BY sizefile";
                    } else if (isset($_POST['bydate'])){
                        $sql = "SELECT * FROM files ORDER BY datefile";
                        } else {
                    $sql = "SELECT * FROM files ";
                }

                //$sql = "SELECT * FROM files ";
                $result = $conn->query($sql);
                $i = 1;
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
            <?php $i++; //$i lists the total number of files
            } 
               
            ?>
        </tbody>
        
    </div>

    
</body>
</html>