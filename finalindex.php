<!DOCTYPE html>
<html>
<head>

 <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dis Calculator</title>

    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
<script src="http://code.jquery.com/jquery-latest.min.js"
        type="text/javascript"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

<link href="./date_dependencies/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="./date_dependencies/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">

<style type="text/css">
    
    body{
        background-image: url("background_1.png");
        //padding-bottom: 70px; 
    }
    /*#back{
        background-image: url("background_1.png");
    }*/
    #footer{
        margin-bottom: 0px; 
    }
    @media (max-width: 767px) {
  .container-fluid, .row {
    padding:0px;
  }
  .navbar-header {
    margin:0px;
  }

      .navbar-fixed-bottom{
      position: relative;
      right: 0;
      bottom: 0;
      z-index: 1;
    }
    #form_contain{
        width:80%;
        padding-bottom: 2%;
    }


}

@media (min-width: 768px) {
    #form_contain{
        width:40%;

    }
}
</style>


</head>

<body   style="overflow-x: hidden;">

<div class="row">
    <div class="row">
        <nav class="navbar" style="background-color:#2c3d51;">

            <div class="row" style="width:50%;margin:0 auto;">
                  <div class="container-fluid">
                <!-- <div class="navbar-header"> -->
                  <a class="navbar-brand" href="#"><img src="logo.png"  class="img-responsive"  style="  width: 179px;margin-top: -20px;" / ></a>
                   <!-- <ul class="nav navbar-nav" class="pull-right" style="margin-left:300px"> -->
                    
                    <li class="pull-right"><a href="#"><img src="menu.png" style="margin-top: -20px;" class="img-responsive"  alt="Menu" ></a></li>
                  <!-- </ul> -->
                <!-- </div> -->
               
              </div>
            </div>

     </nav>
    </div>


    


    <div class="row">
        <div class="container" style="z-index:999">

        <div class="row" id="form_contain" style="margin:0 auto; margin-top:-2%" >

            <div class="row" style="text-align:center; color:white">
            <h2> <font face="Arial Black">The Quickest Way to Price</font></h2>
            <h4><font face="Lucida Console">Your Walt Disney World Vacation !</font> </h4>
            </div>

            <form action="test_child_action.php" method="get" style="background-color:#d6d7d9;
                padding: 30px 20px;border-radius:3px;border-top: 5px;  border-top-color: #f2c510;  border-top-style: solid;">

              <div class="form-group">
                
                <div class="row">
                    <div class="col-sm-6">
                    <label for="exampleInputEmail1">Check In </label>
                    <input name="checkIn" class="form-control" id="checkin" min="<?php echo date("Y-m-d"); ?>" value="<?php echo date("Y-m-d"); ?>" type="date" required> 
<!-- ashish -->
<!-- <div class="form-group">
                
                <div class="input-group date form_date " data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                    <input class="form-control" size="16" type="text" name="checkIn" id="checkin" min="<?php echo date("Y-m-d"); ?>" value="<?php echo date("Y-m-d"); ?>"  readonly>
                    
                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                </div>
                
            </div> -->
<!-- ashish -->


                    </div>
                    <div class="col-sm-6">
                    <label for="exampleInputEmail1">Check Out</label>
                    <input name="checkOut" class="form-control" id="checkout" min="<?php echo date("Y-m-d",strtotime("+1 day")); ?>" value="<?php echo date("Y-m-d",strtotime("+7 day")); ?>" max="<?php echo date("Y-m-d",strtotime("+10 day")); ?>" type="date" required>
<!-- ashish -->
<!-- <div class="form-group">
                
                <div class="input-group date form_date " data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                    <input class="form-control" size="16" type="text" name="checkOut" id="checkout" min="<?php echo date("Y-m-d",strtotime("+1 day")); ?>" value="<?php echo date("Y-m-d",strtotime("+7 day")); ?>" max="<?php echo date("Y-m-d",strtotime("+10 day")); ?>" readonly>
                    
                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                </div>
                
            </div> -->
<!-- ashish -->
                    </span>
                    </div>
                    <script type="text/javascript">
                    $(document).ready(function(){

                          function formatDate(x) {
                        y = 'yyyy-MM-dd';
                                        var z = {
                            M: x.getMonth() + 1,
                            d: x.getDate(),
                            h: x.getHours(),
                            m: x.getMinutes(),
                            s: x.getSeconds()
                        };
                        y = y.replace(/(M+|d+|h+|m+|s+)/g, function(v) {
                            return ((v.length > 1 ? "0" : "") + eval('z.' + v.slice(-1))).slice(-2)
                        });

                        return y.replace(/(y+)/g, function(v) {
                            return x.getFullYear().toString().slice(-v.length)
                        });
                      }
                        $( "#checkin" ).change(function() {
                            //alert( "Handler for .change() called." );
                            var startDate = new Date($('#checkin').val());
                            var endDate = new Date($('#checkin').val());
                            console.log("start date "+startDate);
                           // var currentTime = new Date();
                            endDate.setDate(startDate.getDate()+7);

                             console.log("selected date "+endDate);

                            var max_date = new Date($('#checkin').val());

                             max_date.setDate(startDate.getDate()+10);
                             console.log("max_date  "+max_date);
                             //startDate.setDate(startDate.getDate()+1);
                            $("#checkout").attr("min",formatDate(startDate));
                            $("#checkout").attr("value",formatDate(endDate) ) ;
                             $("#checkout").attr("max",formatDate(max_date) ) ;
                            //console.log(startDate);
                            //console.log(endDate);
                            });
                        
                        $( "#checkout" ).change(function() {
                            //alert("nil ");
                            var endDate = new Date($('#checkout').val());

                             $("#checkout").attr("value",formatDate(endDate) ) ;

                        });
                        
                    });
                  
                    </script>
                </div>
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Disney World Hotel</label>
                <select class="form-control" name="resort">
                
                                        <option label=
                                        "All resort"
                                        value="-1;entityType=resort">
                                            ALL
                                        </option>

                                        <option label=
                                        "Disney's Animal Kingdom Villas - Jambo House"
                                        value="5;entityType=resort">
                                            Disney's Animal Kingdom Villas - Jambo
                                            House
                                        </option>

                                        <option label=
                                        "Disney's Animal Kingdom Villas - Kidani Village"
                                        value="273239;entityType=resort">
                                            Disney's Animal Kingdom Villas - Kidani
                                            Village
                                        </option>

                                        <option label=
                                        "Bay Lake Tower at Disney's Contemporary Resort"
                                        value="1;entityType=resort">
                                            Bay Lake Tower at Disney's Contemporary
                                            Resort
                                        </option>

                                        <option label="Disney's Beach Club Villas"
                                        value="80010407;entityType=resort">
                                            Disney's Beach Club Villas
                                        </option>

                                        <option label="Disney's BoardWalk Villas"
                                        value="80010391;entityType=resort">
                                            Disney's BoardWalk Villas
                                        </option>

                                        <option label=
                                        "Disney's Old Key West Resort" value=
                                        "80010387;entityType=resort">
                                            Disney's Old Key West Resort
                                        </option>

                                        <option label=
                                        "Disney's Polynesian Villas &amp; Bungalows"
                                        value="17797842;entityType=resort">
                                            Disney's Polynesian Villas &amp;
                                            Bungalows
                                        </option>

                                        <option label=
                                        "Disney's Saratoga Springs Resort &amp; Spa"
                                        value="80010383;entityType=resort">
                                            Disney's Saratoga Springs Resort &amp;
                                            Spa
                                        </option>

                                        <option label=
                                        "The Villas at Disney's Wilderness Lodge"
                                        value="80010393;entityType=resort">
                                            The Villas at Disney's Wilderness Lodge
                                        </option>

                                        <option label=
                                        "The Villas at Disney's Grand Floridian Resort &amp; Spa"
                                        value="16491822;entityType=resort">
                                            The Villas at Disney's Grand Floridian
                                            Resort &amp; Spa
                                        </option>

                                        <option label=
                                        "Disney's Animal Kingdom Lodge" value=
                                        "80010395;entityType=resort">
                                            Disney's Animal Kingdom Lodge
                                        </option>

                                        <option label="Disney's Beach Club Resort"
                                        value="80010389;entityType=resort">
                                            Disney's Beach Club Resort
                                        </option>

                                        <option label="Disney's BoardWalk Inn"
                                        value="80010386;entityType=resort">
                                            Disney's BoardWalk Inn
                                        </option>

                                        <option label=
                                        "Disney's Contemporary Resort" value=
                                        "80010385;entityType=resort">
                                            Disney's Contemporary Resort
                                        </option>

                                        <option label=
                                        "Disney's Grand Floridian Resort &amp; Spa"
                                        value="80010384;entityType=resort">
                                            Disney's Grand Floridian Resort &amp;
                                            Spa
                                        </option>

                                        <option label=
                                        "Disney's Polynesian Village Resort" value=
                                        "80010388;entityType=resort">
                                            Disney's Polynesian Village Resort
                                        </option>

                                        <option label="Disney's Wilderness Lodge"
                                        value="80010394;entityType=resort">
                                            Disney's Wilderness Lodge
                                        </option>

                                        <option label="Disney's Yacht Club Resort"
                                        value="80010390;entityType=resort">
                                            Disney's Yacht Club Resort
                                        </option>

                                       

                                        <option label=
                                        "The Cabins at Disney's Fort Wilderness Resort"
                                        value="80010408;entityType=resort">
                                            The Cabins at Disney's Fort Wilderness
                                            Resort
                                        </option>

                                        <option label=
                                        "Disney's Caribbean Beach Resort" value=
                                        "80010399;entityType=resort">
                                            Disney's Caribbean Beach Resort
                                        </option>

                                        <option label=
                                        "Disney's Coronado Springs Resort" value=
                                        "80010396;entityType=resort">
                                            Disney's Coronado Springs Resort
                                        </option>

                                        <option label=
                                        "Disney's Port Orleans Resort - French Quarter"
                                        value="80010398;entityType=resort">
                                            Disney's Port Orleans Resort - French
                                            Quarter
                                        </option>

                                        <option label=
                                        "Disney's Port Orleans Resort - Riverside"
                                        value="80010397;entityType=resort">
                                            Disney's Port Orleans Resort -
                                            Riverside
                                        </option>

                                        

                                        <option label=
                                        "Disney's All-Star Movies Resort" value=
                                        "80010402;entityType=resort">
                                            Disney's All-Star Movies Resort
                                        </option>

                                        <option label=
                                        "Disney's All-Star Music Resort" value=
                                        "80010400;entityType=resort">
                                            Disney's All-Star Music Resort
                                        </option>

                                        <option label=
                                        "Disney's All-Star Sports Resort" value=
                                        "80010401;entityType=resort">
                                            Disney's All-Star Sports Resort
                                        </option>

                                        <option label=
                                        "Disney's Art of Animation Resort" value=
                                        "80010404;entityType=resort">
                                            Disney's Art of Animation Resort
                                        </option>

                                        <option label="Disney's Pop Century Resort"
                                        value="80010403;entityType=resort">
                                            Disney's Pop Century Resort
                                        </option>


                                        <option label=
                                        "The Campsites at Disney's Fort Wilderness Resort"
                                        value="80010392;entityType=resort">
                                            The Campsites at Disney's Fort
                                            Wilderness Resort
                                        </option>

                                    

                                        <option label=
                                        "Walt Disney World Dolphin Hotel" value=
                                        "80069788;entityType=resort">
                                            Walt Disney World Dolphin Hotel
                                        </option>

                                        <option label=
                                        "Walt Disney World Swan Hotel" value=
                                        "80069789;entityType=resort">
                                            Walt Disney World Swan Hotel
                                        </option>
                                    </select>
              </div>
        
              <div class="form-group">
              <div class="row">
              <div class="col-sm-6">
              <label for="">Adults(+18)</label>
              <select class="form-control" name="numberOfAdults">
              <option>1</option>
              <option>2</option>
              <option>3</option>
              <option>4</option>
              <option>5</option>
              <option>6</option>
              <option>7</option>
              <option>8</option>
              <option>9</option>
                </select>
              </div>
              <div class="col-sm-6">
              <label for="">Chilren</label>
              <select class="form-control" id="child" name="numberOfChildren">
              <option>0</option>
              <option>1</option>
              <option>2</option>
              <option>3</option>
              <option>4</option>
              <option>5</option>
              <option>6</option>
                </select>
              </div>
            </div>
            </div>
            <div class="form-group">
            
               <div id="dynamic" class="row"></div>
            </div>
          
          
           <script>
               $(document).ready(function(){

             $('#child').on('change', function() {
                 var no = this.value ; 
                 var str = '';
                  
                 for (i = 0; i < no ; i++) {
                    var txt1 = '<div class="col-sm-4"  ><select class="form-control" name="child_'+i+ '"><option >infant</option><option  >1</option><option  >2</option><option  >3</option><option >4</option><option  >5</option><option  >6</option><option  >7</option><option   >8</option><option  >9</option><option >2</option><option >10</option></select></div>';
                     str +=txt1;
                     
                         
                 }
                $("#dynamic").html(str);
                });
                });
               </script>

              
              <div class="formInputElement short accessible">
                <span class="pepRichCheckbox">
                <input name="accessible" type="hidden" value="0">
                <input id="accessible_5573d56a1cb90" name="accessible" tabindex="0" type="checkbox"
                value="1"></span> 
                <label class="optional" for="accessible_5573d56a1cb90">
                <span class="labelValue">Accessible Rooms</span></label>
                </div>
            <div style="text-align: center;" >
              <input type="submit" class="btn" style="background-color:#2c3d51;color:#FFF; width:200px;"  value="Find Prices " />
            </div>
            </form>
        </div>
        </div>
    </div>

    <div class="row">
        <div class="navbar navbar-fixed-bottom" id="footer" role="navigation" data-toggle="collapse" 
        style="font-size:0.6em;background-color:#2c3d51;text-align:center;color:white; padding-top:1%;line-height: 70%;" >
    
    <p>Disclamier: Price listed on this site should be considered approximate and used for planning purpose only. </p>
    <p>Pricing and availibility data is retrived and refrshed in every 30 minutes</p>

     <img src="logo.png" style="  width: 179px;margin-top: -27px;" / >


    <p  style="margin-top: -10px;">Copyright @2015 Discalc. All rights Reserved </p>


    </div>
       
    </div>

    <script type="text/javascript">
       $(window).on('load resize', function() {
    if($(window).width() >= 768) {
        $('#footer').addClass('navbar-fixed-bottom');
        } else {
            $('#footer').removeClass('navbar-fixed-bottom');
        }
    });
        

    </script>

<script type="text/javascript" src="./date_dependencies/jquery-1.8.3.min.js" charset="UTF-8"></script>
<script type="text/javascript" src="./date_dependencies/bootstrap.min.js"></script>
<script type="text/javascript" src="./date_dependencies/bootstrap-datetimepicker.js" charset="UTF-8"></script>
<script type="text/javascript" src="./date_dependencies/bootstrap-datetimepicker.uk.js" charset="UTF-8"></script>
<script type="text/javascript">
   
    $('.form_date').datetimepicker({
        language:  'en',
        weekStart: 1,
        todayBtn:  1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 2,
        minView: 2,
        forceParse: 0
    });
</script>
    
</div>
</body>
</html>


