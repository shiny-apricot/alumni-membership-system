<?php
$connect = mysqli_connect("localhost", "root", "124895781", "testing");
$query = "SELECT dep_name, count(*) as number FROM det_table GROUP BY dep_name";
$result = mysqli_query($connect, $query);
?>
<!DOCTYPE html>  
 <html>  
      <head>  
           <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>  
           <script type="text/javascript">  
           google.charts.load('current', {'packages':['corechart']});  
           google.charts.setOnLoadCallback(drawChart);  
           function drawChart()  
           {  
                var data = google.visualization.arrayToDataTable([  
                          ['Department', 'Number'],  
                          <?php  
                          while($row = mysqli_fetch_array($result))  
                          {  
                               echo "['".$row["dep_name"]."', ".$row["number"]."],";  
                          }  
                          ?>  
                     ]);  
                var options = {
                      width: 500,
                      height: 500,  
                      pieHole: 0.6,
                      pieSliceText: 'label',
                      pieSliceTextStyle: {
                         color: 'black',
                         
                         },
                         textStyle: {
                         fontSize: 4
                         },
                         chartArea:{
                              left:0,
                              top:0,
                              width:"65%",
                              height:"65%"
                         }
                     };  
                     
                var chart = new google.visualization.PieChart(document.getElementById('piechart'));  
                chart.draw(data, options);  
           }
           </script>  
      </head>  
      <body>  
           <br /><br />  
           <div style="width:200px;">  
                <h3 align="center"></h3>  
                <br />  
                <div id="piechart" style="width: 900px; height:500px;"></div>  
           </div>  
      </body>  
 </html>  