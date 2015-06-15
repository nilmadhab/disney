<!DOCTYPE html>
<html>
<head>
    <title>DisneyWorld</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
</head>

<?php

if(isset($_GET)){
    //print_r($_GET);
    ini_set('display_errors', true); 
    require_once ("includes/simple_html_dom.php");
    require_once ("includes/db_conn.php");
    $conn = db_connect();

    $checkin = $_GET['checkIn'];
    $checkout = $_GET['checkOut'];
    $numberOfChildren = $_GET['numberOfChildren'];
    $resort = $_GET['resort'];
    $accessible = $_GET['accessible'];
    $numberOfAdults = $_GET['numberOfAdults'];

    //echo $resort ;
    $resort = explode(";", $resort)[0];

    $table = '`cron_day_1`';
    $sql = "SELECT * FROM $table WHERE `resort_id` = '$resort' and `accessibility` = '$accessible' and `noAdults` = '$numberOfAdults' and `noChilds` = '$numberOfChildren'";

    //echo "Query: ".$sql."  ||  ";
}
?>


<?php 
if($result = mysqli_query($conn,$sql)){
    $rowcount=mysqli_num_rows($result);
    if($rowcount == 0)
        echo "No records found or data is not avilable" ;
    else
    {
        echo "<strong>Total Results: ".$rowcount."</strong>" ;
        echo "<table class='table table-striped'>
            <tr>
            <td> Resort Name </td>
            <td> Price </td>
            <td> Room title </td>
            <td> Details </td>
            </tr>" ;

        while($row = mysqli_fetch_array($result)){
                echo "<tr>";
            
                $resort_name = $row['resort_name'];

                $price = $row['price'];

                $details = $row['details'];

                $room_title = $row['room_title'];

                //echo $resort_name."-- > ".$price." --- > ".$details." -- > ".$room_title."<br />";

                echo "
                <td> {$resort_name} </td>
                <td> {$price}</td>
                <td> {$room_title}</td>

                <td> {$details} </td>
                ";

                echo "</tr>";
            }
        }  
}
?>

</table>
</html>