<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Where is My Bus....</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
     <style>

  </style>
    <style>
        .body{
            background: black;
        }
    </style>
</head>
<body>
    
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">

                <?php 
                    if(isset($_SESSION['status']))
                    {
                        ?>
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>Hey!</strong> <?php echo $_SESSION['status']; ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php
                         unset($_SESSION['status']);
                    }
                ?>

                <div class="card mt-5">
                    <div class="card-header">
                        <h4>---WHERE IS MY BUS---</h4>
                    </div>
                    <div class="card-body">

                        <form action="code.php" method="POST">
                            <div class="from-group mb-3">
                                <label for="">From</label>
                                <select name="from" class="form-control" required="">
                                    <option value="">--FROM--</option>
                                    <option value="1">Thiruthuraipoondi</option>
                                    <option value="2">Vedaraniyam</option>
                                    <option value="3">Nagapattinam</option>
                                </select>
                            </div>
                            <div class="from-group mb-3">
                                <label for="">To</label>
                                <select name="to" class="form-control" required="">
                                    <option value="">--FROM--</option>
                                    <option value="1">Thiruthuraipoondi</option>
                                    <option value="2">Vedaraniyam</option>
                                    <option value="3">Nagapattinam</option>
                                </select>
                            </div>
                            <div class="from-group mb-3">
                                <label for="">Time</label>
                                <select name="time" class="form-control" required="">
                                    <option value="">--TIME--</option>
                                    <option value="1">9:00</option>
                                    <option value="2">10:00</option>
                                </select>
                            </div>
                            <div class="from-group mb-3">
                                <button type="submit" name="save" class="btn btn-primary">Search</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php

if(isset($_POST['search']))
{
    $valueToSearch = $_POST['valueToSearch'];
    // search in all table columns
    // using concat mysql function
    $query = "SELECT * FROM `dest` WHERE CONCAT(`from`, `to`, `time`, `sno`) LIKE '%".$valueToSearch."%'";
    $search_result = filterTable($query);
    
}
 else {
    $query = "SELECT * FROM `dest`";
    $search_result = filterTable($query);
}

// function to connect and execute the query
function filterTable($query)
{
    $connect = mysqli_connect("localhost", "root", "", "bus");
    $filter_Result = mysqli_query($connect, $query);
    return $filter_Result;
}

?>
    </body>
</html>
