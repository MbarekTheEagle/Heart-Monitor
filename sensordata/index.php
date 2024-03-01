<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="refresh" content="2" >
    <link rel="stylesheet" type="text/css" href="style.css" media="screen"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
	<title> Sensor Data </title>

</head>

<body>
<h1>SENSOR DATA Line Chart</h1>
<div id="chart"></div>
    <h1>SENSOR DATA</h1>



<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mytectutor";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id, sensor, location, value1, value2, value3, reading_time FROM sensordata ORDER BY id DESC"; /*select items to display from the sensordata table in the data base*/

echo '<table cellspacing="5" cellpadding="5">
      <tr> 
        <th>ID</th> 
        <th>Date $ Time</th> 
        <th>Sensor</thh> 
   
      </tr>';
 
if ($result = $conn->query($sql)) {
    while ($row = $result->fetch_assoc()) {
        $row_id = $row["id"];
        $row_reading_time = $row["reading_time"];
        $row_sensor = $row["sensor"];
        $row_location = $row["location"];
        $row_value1 = $row["value1"];
        $row_value2 = $row["value2"]; 
        $row_value3 = $row["value3"]; 
        $name = "Hello World";
        // Uncomment to set timezone to - 1 hour (you can change 1 to any number)
       // $row_reading_time = date("Y-m-d H:i:s", strtotime("$row_reading_time - 1 hours"));
      
        // Uncomment to set timezone to + 4 hours (you can change 4 to any number)
        //$row_reading_time = date("Y-m-d H:i:s", strtotime("$row_reading_time + 4 hours"));
      
        echo '<tr> 
                <td>' . $row_id . '</td> 
                <td>' . $row_reading_time . '</td> 
                <td>' . $row_sensor . '</td>  
              </tr>';
    }
    $result->free();
}


$connect = mysqli_connect("localhost", "root", "", "mytectutor");
$query = "SELECT sensor,reading_time FROM sensordata";
$result = mysqli_query($connect, $query);
$chart_data = '';
while($row = mysqli_fetch_array($result))
{
 $chart_data .= "{ reading_time:'".$row["reading_time"]."', sensor:".$row["sensor"]."}, ";
}
$chart_data = substr($chart_data, 0, -2);


$conn->close();

?> 

</table>

<script>
Morris.Line({
 element : 'chart',
 data:[<?php echo $chart_data; ?>],
 xkey:'reading_time',
 ykeys:[ 'sensor'],
 labels:['Profit', 'Purchase', 'Sale'],
 hideHover:'auto',
 stacked:true
});
</script>

</body>
</html>

</body>
</html>