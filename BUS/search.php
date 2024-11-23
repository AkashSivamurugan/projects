
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

<!DOCTYPE html>
<html>
    <head>
        <title>PHP HTML TABLE DATA SEARCH</title>
                 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
        <style>

            table{
            },tr,th,td
            {
                border: 1px solid black;
            }
            .field{
                padding: 2%;
                border: 1px solid black
            }
            .search{
                padding: 1%;
                position: relative;left:40%;
            }
            .butn{
                position: fixed;
                padding-top: 1%;
                padding-bottom: 1%;
                margin: 10px;

                box-shadow: rgb(204, 219, 232) 3px 3px 6px 0px inset, rgba(255, 255, 255, 0.5) -3px -3px 6px 1px inset;
                position:absolute;right:30%;left:60%;top:3%;


      
                background: lightblue;

            }
        </style>
    </head>
    <body>
                                   
        
        <form action="search.php" method="post">
            <div class="field">
            <input class="search" type="text" name="valueToSearch" placeholder="Value To Search"><br><br>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
            <style>
                .btn-primary{
                    position: absolute;left:45%;
                   padding-left: 2%;

                  padding-right: 2%;
                }
            </style>
            <input class=" btn btn-primary"type="submit" name="search" value="Filter"><br><br>
        </div>
   
            <table class="table">
                <tr>
                    <th>Sno</th>
                    <th>FROM</th>
                    <th>TO</th>
                    <th>TIME</th>
                    <th><i >SEE DIRECTIONS </i></th>
                </tr>

      <!-- populate table from mysql database -->
                <?php while($row = mysqli_fetch_array($search_result)):?>
                <tr>
                    <td><?php echo $row['sno'];?></td>

                    <td><?php echo $row['from'];?></td>
                    <td><?php echo $row['to'];?></td>
                    <td><?php echo $row['time'];?></td>
                    <td><a href="<?php echo $row['link'];?>">Click Here...</a></td>
           
                </tr>
                <?php endwhile;?>
            </table>
        </form>
        
    </body>
</html>
