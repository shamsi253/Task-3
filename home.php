<!DOCTYPE html>
<html lang="en">
<head>
    <title>home</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <SCRIPT src="http://code.jquery.com/jquery-2.1.1.js"></SCRIPT>
        <style>
            .border {
                background-color: lightgrey;

                border: 10px solid #03011f;
                padding: 25px;
                margin: 25px;
            }
            table,th,td {
                border: 2px solid black;

                border-collapse: collapse;
            }
            td,th
            {
                padding: 14px;
            }
            .design
            {
              font-style: italic;
              font-size:40px;
            }
            .col {
                float:left;
                border: 1px solid grey;
                padding-left: 10px;
                background-color:#03011f;
                box-shadow: -webkit-box-shadow: 10px 6px 38px 7px rgba(0,0,0,0.75);
                -moz-box-shadow: 10px 6px 38px 7px rgba(0,0,0,0.75);
                box-shadow: 10px 6px 38px 7px rgba(0,0,0,0.75);
                margin-right: 5px;
                color:white;
            }
            .value
            {
            	font-weight: bold;
            }
            body
            {
            	background-image: url("images.jpeg");
            }


        </style>
</head>
<body>
	<div class="design text-center" >
		BUILD YOUR RESUME
    </div>
    <div class="container-fluid">

        <div class="col-sm-6 ">
	        <form action="resume.php">
	        	<input class="border value" type="submit" value="CREATE RESUME" name="submit">
	        </form>
        </div>
        <div class="col-sm-6 border" >
        	<h2>RESUME LIST</h2>
               <?php
include "connect.php";
$sql = "SELECT id,name,email,phone FROM users ";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
	echo "<table><tr><th>Name</th><th>Phone</th><th>Email</th><th>Click</th></tr>";
	while ($row = $result->fetch_assoc()) {
		echo "<tr><td>" . $row["name"] . "</td><td>" . $row["phone"] . "</td><td> " . $row["email"] . "</td>";
		$id = $row[id];
		echo "<td><a href=view.php?id=" . $id . ">click here to generate resume</td></tr>";
	}
	echo "</table>";
} else {
	echo "0 results";
}
?>
        </div>


    </div>
</body>
</html>
