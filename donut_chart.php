<?php
include('server.php');

$query = "SELECT d.department_name d_name, count(*) as number FROM Member m 
                    INNER JOIN Department d ON m.department = d.department_code GROUP BY d_name";
$result = pg_query($db, $query);
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
                          while($row = pg_fetch_array($result))  
                          {  
                               echo "['".$row["d_name"]."', ".$row["number"]."],";  
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
           <div style="width:200px;">  
                <h3 align="center"></h3>  
                <br/>  
                <div id="piechart" class="pie"></div>
           </div>  
      </body>  
 </html>  