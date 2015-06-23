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
  
    ini_set('display_errors', true); 
    require_once ("includes/simple_html_dom.php");
    require_once ("includes/db_conn.php");
    $conn = db_connect();

    $checkin = $_GET['checkIn'];
    $checkout = $_GET['checkOut'];
    $Childrens = $_GET['numberOfChildren'];
    $resort = $_GET['resort'];
    $accessible = $_GET['accessible'];
    $Adults = $_GET['numberOfAdults'];

    $numberOfChildren = 0 ;
    for($i = 0 ; $i < $Childrens ;$i++ )
    {
        if($_GET['child_'.$i] < 4 || $_GET['child_'.$i] == 'infant')
            $numberOfChildren++ ;
    }
    $numberOfAdults = $Adults + $Childrens - $numberOfChildren ;


    //echo $resort ;
    $resort = explode(";", $resort)[0];
    $diff1 = date_diff(date_create($checkout),date_create($checkin))->d;
    //echo "datediff ".$diff1."<br>" ; 
    if($resort != '-1')
    {
        //specific resort
        $sql = "SELECT *,count(*) as cont FROM `day_harvest` WHERE `startdate` >= '$checkin' and `enddate` <= '$checkout' and `noAdults` = '$numberOfAdults' and `noChilds` = '$numberOfChildren' and `accessibility` = '$accessible' and `resort_id`= '$resort' group by room_title HAVING cont = '$diff1'" ;
    }
    else
    {
        //all resorts
        $sql = "SELECT *,count(*) as cont FROM `day_harvest` WHERE `startdate` >= '$checkin' and `enddate` <= '$checkout' and `noAdults` = '$numberOfAdults' and `noChilds` = '$numberOfChildren' and `accessibility` = '$accessible' group by resort_id,room_title HAVING cont = '$diff1'" ;
    }

    echo "Query: ".$sql."  ||  ";
}
?>


<?php 
if($result = mysqli_query($conn,$sql)){
    $rowcount=mysqli_num_rows($result);
    if($rowcount == 0)
        echo "<br><h1><strong>Sorry !!<br>No data available.</strong></h1>" ;
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