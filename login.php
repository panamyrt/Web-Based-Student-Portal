<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>Registration system PHP and MySQL</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div class="header">
  	<h2>Login</h2>
  </div>
	 
  <form method="post" action="login.php">
  	<?php include('errors.php'); ?>
  	<div class="input-group">
  		<label>Username-Email</label>
  		<input type="text" name="loginName" >
  	</div>
  	<div class="input-group">
  		<label>Password</label>
  		<input type="password" name="password">
  	</div>
  	<div class="input-group">
  		<button type="submit" class="btn" name="login_user">Login</button>
  	</div>
  	<p>
  		Not yet a member? <a href="register.php">Sign up</a>
  	</p>
  </form>

  <?php
  // Ελέγξτε εάν ο χρήστης συνδέθηκε επιτυχώς
  if (isset($_SESSION['loginName'])) {
    $loginName = $_SESSION['loginName'];
    $query = "SELECT role FROM users WHERE loginName='$loginName'";
    $result = mysqli_query($db, $query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $userRole = $row['role'];
    } else {
        // Αν κάτι πάει στραβά με το query, ορίζετε έναν προκαθορισμένο ρόλο
        $userRole = 't'; // Προκαθορισμένος ρόλος
    }
    $_SESSION['role'] = $userRole; // Αποθηκεύστε τον ρόλο στη συνεδρία
  }
  ?>

</body>
</html>
