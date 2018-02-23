<!DOCTYPE html>
 <html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <meta charset="utf-8">
        <title>Resume</title>
        <script>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
        </script>

    </head>
    <body>
        <div class="col-3 ">

            <?php
include "connect.php";
$id = $_GET['id'];
$sql = "SELECT * FROM users ORDER BY id DESC LIMIT 1";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
	$row = $result->fetch_assoc();
	?>
    <img src="images/<?php echo $row['Upload']; ?>" style='height:100px'><br>
    <?php
} else {
	echo "0 results <br>";}
$sql = "SELECT name FROM users where id=$id";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
	// output data of each row
	$row = $result->fetch_assoc();
	echo $row["name"];
} else {
	echo "0 results";}
?>
             <br>
            <br>

            <i class="fa fa-phone z">
            <?php
$sql1 = "SELECT phone FROM users where id=$id";
$result = $conn->query($sql1);
if ($result->num_rows > 0) {
	// output data of each row
	$row = $result->fetch_assoc();
	echo $row["phone"];
} else {
	echo "0 results";
}
?>
            </i>
            <br>
            <br>
            <i class="fa fa-envelope-square">
                <?php
$sql1 = "SELECT email FROM users where id=$id";
$result = $conn->query($sql1);
if ($result->num_rows > 0) {
	// output data of each row
	$row = $result->fetch_assoc();
	echo $row["email"];
} else {
	echo "0 results";
}
?>
            </i>
            <br>
            <br>
            <i class="fa fa-home z">
            <?php
$sql1 = "SELECT place FROM users where id=$id";
$result = $conn->query($sql1);
if ($result->num_rows > 0) {
	// output data of each row
	$row = $result->fetch_assoc();
	echo $row["place"];
} else {
	echo "0 results";
}
?>
            </i>
            <br><br>
            <i class="fa fa-briefcase z ">
<?php
$sql1 = "SELECT designation FROM users where id=$id";
$result = $conn->query($sql1);
if ($result->num_rows > 0) {
	// output data of each row
	$row = $result->fetch_assoc();
	echo $row["designation"];
} else {
	echo "0 results";
}
?>
            </i>
            <br>
            <br>
            <i class="fa fa-globe z">Languages Known</i>
            <br>
            <ul>
                <li>

                    <?php

$sql4 = " SELECT languages
FROM languages,users where languages.user_id=users.id and languages.user_id= $id";
$result = $conn->query($sql4);
if ($result->num_rows > 0) {
	// output data of each row
	while ($row = $result->fetch_assoc()) {
		echo $row["languages"] . "<br>";
	}
} else {
	echo "0 results";
}
?>

                </li>
            </ul>
            <i class="fa fa-calendar z">
               <?php
$sql1 = "SELECT dob FROM users where id=$id";
$result = $conn->query($sql1);
if ($result->num_rows > 0) {
	// output data of each row
	$row = $result->fetch_assoc();
	echo $row["dob"];
} else {
	echo "0 results";
}
?>
            </i>
            <br><br>
            <i class="fa fa-star z">Hobbies:</i>
            <br> <br>

            <?php

$sql3 = " SELECT hobbies
FROM hobbies,users where hobbies.user_id=users.id and hobbies.user_id= $id";
$result = $conn->query($sql3);
if ($result->num_rows > 0) {
	// output data of each row
	while ($row = $result->fetch_assoc()) {
		echo $row["hobbies"] . "<br>";
	}
} else {
	echo "0 results";
}
?>

        </div>
        <div class="col-9 ">
            <h3 >
                <i class="fa fa-star "></i>  Objective
            </h3>
            <div class="shad">
                <p> T<?php
$sql1 = "SELECT objective FROM users where id=$id";
$result = $conn->query($sql1);
if ($result->num_rows > 0) {
	// output data of each row
	$row = $result->fetch_assoc();
	echo $row["objective"];
} else {
	echo "0 results";
}
?>
                </p>
            </div>
            <h3 >
                <i class="fa fa-graduation-cap "></i> Education
            </h3>

            <div class="shad">
                <p class="font">
                    <?php
$sql = "SELECT qualification,mark,year,university FROM education where id=$id";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
	echo "<table><tr><th>Qualification</th><th>Mark</th><th>University</th><th>Year</th></tr>";
	while ($row = $result->fetch_assoc()) {
		echo "<tr><td>" . $row["qualification"] . "</td><td>" . $row["mark"] . "</td><td> " . $row["university"] . "</td><td>" . $row["year"] . "</td></tr>";
	}
	echo "</table>";
} else {
	echo "0 results";
}
?></p>

            </div>
            <h3 >
                <i class="fa fa-laptop "></i> Technical Skills
            </h3>
            <div class="shad">
                <ul>
                    <?php

$sql6 = " SELECT technical_skills
FROM technicalskills,users where technicalskills.user_id=users.id and technicalskills.user_id= $id";
$result = $conn->query($sql6);
if ($result->num_rows > 0) {
	// output data of each row
	while ($row = $result->fetch_assoc()) {
		echo $row["technical_skills"] . "<br>";
	}
} else {
	echo "0 results";
}
?>

                </ul>
            </div>
            <h3 >
                <img src="index.png" width="25" height="25">
                Personal Skills
            </h3>
            <div class="shad">
                <ul>
                    <li><?php

$sql5 = " SELECT personal_skills
FROM personalskills,users where personalskills.user_id=users.id and personalskills.user_id= $id";
$result = $conn->query($sql5);
if ($result->num_rows > 0) {
	// output data of each row
	while ($row = $result->fetch_assoc()) {
		echo $row["personal_skills"] . "<br>";
	}
} else {
	echo "0 results";
}
?></li>

                </ul>
            </div>
        </div>
        <?php $conn->close();?>
    </body>
</html>
