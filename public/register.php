<?php
  require_once('../private/initialize.php');

  // Set default values for all variables the page needs.

  // if this is a POST request, process the form
  // Hint: private/functions.php can help

    // Confirm that POST values are present before accessing them.

    // Perform Validations
    // Hint: Write these in private/validation_functions.php

    // if there were no errors, submit data to database

      // Write SQL INSERT statement
      // $sql = "";

      // For INSERT statments, $result is just true/false
      // $result = db_query($db, $sql);
      // if($result) {
      //   db_close($db);

      //   TODO redirect user to success page

      // } else {
      //   // The SQL INSERT statement failed.
      //   // Just show the error, not the form
      //   echo db_error($db);
      //   db_close($db);
      //   exit;
      // }
	
	$fName = NULL;
	$lName = NULL;
	$email = NULL;
	$uName = NULL;
	$errors=array();
	if (isset($_POST['submit'])) {
		$fName = $_POST['fName'];
		$lName = $_POST['lName'];
		$email = $_POST['email'];
		$uName = $_POST['uName'];
		
		if ($fName == NULL) {
		    $errors[] = "First name cannot be blank.";	
		} else if (has_length($fName, [2, 255]) == false) {
			$errors[] = "First name must be between 2 and 255 characters";
		}
		
		if ($lName == NULL) {
		    $errors[] = "Last name cannot be blank.";	
		} else if (has_length($fName, [2, 255]) == false) {
			$errors[] = "Last name must be between 2 and 255 characters";
		}
		
		if (has_valid_email_format($email) == false) {
		    $errors[] = "Email must be a valid format";	
		} 
		
		if ($uName == NULL) {
		    $errors[] = "Last name cannot be blank.";	
		} else if (has_length($uName, [8, 255]) == false) {
			$errors[] = "Username must be between 8 and 255 characters";
		}
		
		if (empty($errors)) {
			$sql = "SELECT * FROM users WHERE username = '".$uName."'";
			$result = mysqli_query($db, $sql);
			if(mysqli_num_rows($result)>=1)
			{
				$errors[] = "Username already exists.";
			} else {
				$sql = "INSERT INTO users (first_name, last_name, email, username) 
				VALUES ('$fName', '$lName', '$email', '$uName')";
				$db->query($sql);
				header("Location: registration_success.php"); /* Redirect browser */
				exit();
			}
		}
	}

?>

<?php $page_title = 'Register'; ?>
<?php include(SHARED_PATH . '/header.php'); ?>

<div id="main-content">
  <h1>Register</h1>
  <p>Register to become a Globitek Partner.</p>

  <?php
    // TODO: display any form errors here
    // Hint: private/functions.php can help
	echo display_errors($errors);
  ?>

  <!-- TODO: HTML form goes here -->
  <form action="" method="post">
	First name:<br>
	<input type="text" name="fName" value="<?php echo h($fName); ?>">
	<br>
	Last name:<br>
	<input type="text" name="lName" value="<?php echo h($lName); ?>">
	<br>
	Email:<br>
	<input type="text" name="email" value="<?php echo h($email); ?>">
	<br>
	Username:<br>
	<input type="text" name="uName" value="<?php echo h($uName); ?>">
	<br><br>
	<input type="submit" name="submit" value="Submit">
  </form>
</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
