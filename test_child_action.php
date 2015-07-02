<!DOCTYPE html>
<html>
<head>
    <title>DisneyWorld</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
 <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
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
        $sql = "SELECT *,count(*) as cont FROM `day_harvest` WHERE `startdate` >= '$checkin' and `enddate` <= '$checkout' and `noAdults` = '$numberOfAdults' and `noChilds` = '$numberOfChildren' and `accessibility` = '$accessible' group by resort_id " ;
    }
    //select *,count(*) as cont from (SELECT * FROM `day_harvest` WHERE `startdate` >= '2015-07-01' and `enddate` <= '2015-07-03' and `noAdults` = '1' and `noChilds` = '0' and `accessibility` = '0' group by resort_id ) as t group by t.resort_id having cont=2
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
            <td> Room title </td>
            <td> Details </td>
            <td> Price </td>
            <td> Final Price </td>
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
                <td> {$room_title}</td>
                <td> {$details} </td>
                <td> {$price}</td>
                <td> <button type='button' class='btn btn-primary btn-lg' data-toggle='modal' data-target='#myModal'> Select this
</button> </td>
                ";

                echo "</tr>";
            }
        }  
}
?>

</table>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
      </div>
      <div class="modal-body" >
        <div id="info">
        </div>
        <table class="table table-striped">
            <thead>
                <th> No. Of Adult </th>
                <th> No. Of Child </th>
                <th> No. Of Days </th>
                <th> Price per day</th>
                <th> Total price</th>
            </thead>
            <tbody id="mymodalbody">

                
            </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
       
      </div>
    </div>
  </div>
</div>

<script>

$(document).ready(function(){
    $('table').on('click','.btn-lg',function(event,ui) {
     
 
        var from = $(this).closest('tr').index();
     
        console.log(from);
        var resort = $(this).closest('tr').first().children().html().replace('-',' ');
        var room = $(this).closest('tr').first().children().next().html();
        var price = $(this).closest('tr').first().children().next().next().next().html();
        //console.log(head);
        $('#myModalLabel').html('DisneyWorld Resort Booking');

        var html = 'You are here for <strong>'+room+ '</strong> from <strong>'+resort+'</strong>';
        html += '<p>Price Summary</p>';
        html += '<table><tr>';
        html += '<td>'+<?php echo $Adults ?>+' Adults and '+<?php echo $Childrens ?>+ ' childrens &times; '+<?php echo $diff1 ?>+'</td>';
        html += '<td class:"text-right">'+'price'+'</td></tr>' ;
        html += '</table>';
        var no_day = "<?php echo $diff1; ?>";

        $('#info').html(html);
        //price = parseInt(price, 10);
        var number = parseInt(price.match(/\d+/)[0], 10);
        var tr = '<tr>';
        tr += '<td>'+<?php echo $Adults ?>+'</td><td>'+<?php echo $Childrens ?>+ '</td><td> '+<?php echo $diff1 ?>+'</td><td>$ '+number +'</td><td>$'+ number*no_day + '</td>';



        tr += '</tr>';
        $('#mymodalbody').html(tr);


        
  });
});
  
</script>
</html>