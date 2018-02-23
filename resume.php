<!DOCTYPE html>
<html lang="en">
<head>
  <title>Resume Generator</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <SCRIPT src="http://code.jquery.com/jquery-2.1.1.js"></SCRIPT>
</head>

<style>
  .error {
  color: red;
}
.border {
    border-style: solid;
    border-width: 5px;
}
.header
{
  font-style: italic;
  font-size:50px;
  background-color: #9f7b7b;
}
.background
{
  background-color: #e9eae5;
}
body
{
  background-image: url("images1.jpeg");
}
</style>


<?php

include "connect.php";
session_start();
$nameErr = $phoneErr = $emailErr = "";
$name = $designation = $dob = $place = $phone = $email = $objective = $hobbies = $personal_skills =
$technical_skills = $qualification = $languages = $university = $year = $marks = $user_id = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$valid = true;

	if (empty($_POST["name"])) {
		$nameErr = "First Name is required";
		$valid = false;
	} else {
		$name = test_input($_POST["name"]);

		if (!preg_match("/^[a-zA-Z ]*$/ ", $name)) {
			$nameErr = "First Name is  Invalid";
			$valid = false;
		}

	}

	if (empty($_POST["phone"])) {
		$phoneErr = "Mobile Number is required";
		$valid = false;
	} else {
		$phone = test_input($_POST["phone"]);
		if (!preg_match('/^[0-9]*$/', $phone)) {
			$phoneErr = "invalid Mobile Number";
			$valid = false;
		}
	}

	if (empty($_POST["email"])) {
		$emailErr = "Email is required";
		$valid = false;
	} else {
		$email = test_input($_POST["email"]);
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$emailErr = "Invalid email format";
			$valid = false;
		}
	}

	if ($valid) {

		$qualification = $_POST['qualification'];
		$university = $_POST['university'];
		$mark = $_POST['mark'];
		$place = $_POST['place'];
		$year = $_POST['year'];
		$designation = $_POST['designation'];
		$dob = $_POST['dob'];
		$objective = $_POST['objective'];
		$declaration = $_POST['declaration'];
		$hobbies = $_POST['hobby'];
		$languages = $_POST['language'];
		$file = $_FILES['Upload']['name'];
		$personal_skills = $_POST['personalskill'];
		$technical_skills = $_POST['technicalskill'];

		$new_filename = '';
		if ($file != '') {
			// echo "here";die;
			$allowedExts = array("gif", "jpeg", "jpg", "png");
			foreach ($allowedExts as $item) {
				$flag = 0;
				if (preg_match("/$item$/", $_FILES['Upload']['name'])) {
					$pos = strrpos($file, '.');
					if ($pos === false) {
						$ext = "";
					}

					$ext = substr($file, $pos);
					$dt = date("d-m-Y"); //." ".date("h:i:sa");
					$new_filename = $name . "" . $dt . "" . $file;
					$uploaddir = 'images/';
					$uploadfile = $uploaddir . $new_filename;
					if (move_uploaded_file($_FILES['Upload']['tmp_name'], $uploadfile)) {
						$flag2 = 2;
					} else {
						$flag = 1;
					}

				} else {
					$flag = 2;
				}

			}
			if ($flag2 == 2) {
				echo "File is valid, and was successfully uploaded.";
			} else if ($flag == 1) {
				echo "File Uploading Failed!.";
			} else if ($flag == 2) {
				echo "File Uploading Failed!.\nInvalid file format!.";
			}

		}
		// exit();
		$sql = "INSERT INTO users (name,designation,dob,place,phone,email,objective,Upload)
                  VALUES ('$name','$designation','$dob','$place','$phone','$email','$objective','$new_filename')";

		// echo $last_id;

		if ($conn->query($sql) === TRUE) {
			$id = mysqli_insert_id($conn);
			$_SESSION['id'] = $id;
			$sql2 = "INSERT INTO education (qualification,university,year,mark,user_id)
                  VALUES ('$qualification','$university','$year','$mark','$id')";
			$conn->query($sql2);
			$count = count($hobbies);
			for ($i = 0; $i < $count; $i++) {

				$sql3 = "INSERT INTO hobbies (hobbies,user_id) VALUES ('$hobbies[$i]','$id')";
				$conn->query($sql3);
			}

			$count = count($languages);
			for ($i = 0; $i < $count; $i++) {

				$sql4 = "INSERT INTO languages (languages,user_id) VALUES ('$languages[$i]','$id')";
				$conn->query($sql4);
			}

			$count = count($personal_skills);
			for ($i = 0; $i < $count; $i++) {

				$sql5 = "INSERT INTO personalskills (personal_skills,user_id) VALUES ('$personal_skills[$i]','$id')";
				$conn->query($sql5);
			}

			$count = count($technical_skills);
			for ($i = 0; $i < $count; $i++) {

				$sql6 = "INSERT INTO technicalskills (technical_skills,user_id) VALUES ('$technical_skills[$i]','$id')";
				$conn->query($sql6);
			}

			echo "New record created successfully";
			header('Location: http://localhost/task-3/resume1.php');
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}

		$conn->close();

	}
}

function test_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

?>


<body>
  <div class="container-fluid">
    <div class="header text-center" style='height:100px'>
      BUILD YOUR RESUME
    </div>
    <div class="col-sm-6 border background">
      <h2>Personal Details</h2>
      <form  action="" method="post" enctype="multipart/form-data"  >
        <div class="form-group">
          <label class="control-label " for="name">Name:</label>
          <input type="text" class="form-control" id="name"  name="name">
          <?php if ($nameErr) {?><span class="error">* <?php echo $nameErr; ?></span> <?php }?>
        </div>

        <div class="form-group">
          <label class="control-label" for="phone">Phone No:</label>
          <input type="text" class="form-control" id="phone"  name="phone">
          <?php if ($phoneErr) {?><span class="error">* <?php echo $phoneErr; ?></span> <?php }?>
        </div>

        <div class="form-group">
          <label class="control-label" for="email">Email:</label>
          <input type="text" class="form-control" id="email" name="email">
          <?php if ($emailErr) {?><span class="error">* <?php echo $emailErr; ?></span> <?php }?>
        </div>
        <div class="form-group">
          <label for="Upload">SELECT IMAGE</label>
          <input type="file" name="Upload" id="Upload">
        </div>
        <div class="form-group">
          <label class="control-label" for="designation">Designation:</label>
          <input type="text" class="form-control" id="designation"  name="designation">
        </div>

        <div class="form-group">
          <label class="control-label" for="dob">Date Of Birth:</label>
          <input type="text" class="form-control" id="dob"  name="dob">
        </div>

        <div class="form-group">
          <label class="control-label" for="place">Place:</label>
          <input type="text" class="form-control" id="place"  name="place">
        </div>

        <div class="form-group">
          <label for="personal_skills">Personal skills:</label>
           <DIV id="product2">
                  <DIV class="float-left"><input type="text" name="personalskill[]"  />
                  <input type="button" name="add_item" value="+" onClick="addMore2();" />
                  <input type="button" name="del_item" value="-" onClick="deleteRow2();" />

          </DIV>
        </div>

        <div class="form-group">
          <label for="hobbies">Hobbies:</label>
          <DIV id="product">
                  <DIV class="float-left"><input type="text" name="hobby[]"  />
                  <input type="button" name="add_item" value="+" onClick="addMore();" />
                  <input type="button" name="del_item" value="-" onClick="deleteRow();" />

          </DIV>
        </div>
        <div class="form-group">
          <label class="control-label" for="languages">Languages:</label>
          <DIV id="product1">
                  <DIV class="float-left"><input type="text" name="language[]"  />
                  <input type="button" name="add_item" value="+" onClick="addMore1();" />
                  <input type="button" name="del_item" value="-" onClick="deleteRow1();" />

          </DIV>
        </div>

        <div class="form-group">
          <label for="objective">Objective:</label>
          <textarea name="objective" class="form-control" id="objective"" rows="4" cols="25">
          </textarea>
        </div>



        <h2>Education Details</h2>

        <div class="form-group">
          <label class="control-label " for="qualification">Highest Qualification:</label>
            <input type="text" class="form-control" id="qualification"  name="qualification" >
        </div>

        <div class="form-group">
          <label class="control-label" for="university">University:</label>
          <input type="text" class="form-control" id="university"  name="university">

        </div>

        <div class="form-group">
          <label class="control-label" for="mark">Marks:</label>
          <input type="text" class="form-control" id="mark" name="mark">

        </div>

        <div class="form-group">
          <label class="control-label" for="year">Passout Year</label>
          <input type="text" class="form-control" id="year"  name="year">
        </div>

        <div class="form-group">
          <label for="technical_skills">Technical skills:</label>
           <DIV id="product3">
                  <DIV class="float-left"><input type="text" name="technicalskill[]"  />
                  <input type="button" name="add_item" value="+" onClick="addMore3();" />
                  <input type="button" name="del_item" value="-" onClick="deleteRow3();" />

          </DIV>
        </div>
           <div class="form-group">
            <button type="submit" name="submit" class="btn btn-default">Submit</button>
          </div>
        </form>

      </div>
      <div class="col-sm-6"> </div>
    </div>

</body>
  <SCRIPT>
    function addMore() {
      $("<DIV>").load("input.php", function() {
        $("#product").append($(this).html());
      });
    }
    function deleteRow() {
      $('DIV.product-item').each(function(index, item){
        jQuery(':checkbox', this).each(function () {
            if ($(this).is(':checked')) {
              $(item).remove();
            }
        });
      });
    }
    function addMore1() {
      $("<DIV>").load("input1.php", function() {
        $("#product1").append($(this).html());
      });
    }
    function deleteRow1() {
      $('DIV.product-item').each(function(index, item){
        jQuery(':checkbox', this).each(function () {
            if ($(this).is(':checked')) {
              $(item).remove();
            }
        });
      });
    }
    function addMore2() {
      $("<DIV>").load("input2.php", function() {
        $("#product2").append($(this).html());
      });
    }
    function deleteRow2() {
      $('DIV.product-item').each(function(index, item){
        jQuery(':checkbox', this).each(function () {
            if ($(this).is(':checked')) {
              $(item).remove();
            }
        });
      });
    }
    function addMore3() {
      $("<DIV>").load("input3.php", function() {
        $("#product3").append($(this).html());
      });
    }
    function deleteRow3() {
      $('DIV.product-item').each(function(index, item){
        jQuery(':checkbox', this).each(function () {
            if ($(this).is(':checked')) {
              $(item).remove();
            }
        });
      });
    }
  </SCRIPT>
</html>
