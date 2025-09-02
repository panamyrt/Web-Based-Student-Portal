<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>Registration system PHP and MySQL</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div class="header">
  	<h2>Register</h2>
  </div>
	
  <form method="post" action="register.php">
  	<?php include('errors.php'); ?>
	<div class="input-group">
  	  <label>First Name</label>
  	  <input type="text" name="firstName" value="<?php echo $firstName; ?>">
  	</div>
	<div class="input-group">
  	  <label>Last Name</label>
  	  <input type="text" name="lastName" value="<?php echo $lastName; ?>">
  	</div>
  	<div class="input-group">
  	  <label>Username-Email</label>
  	  <input type="text" name="loginName" value="<?php echo $loginName; ?>">
  	</div>
  	<div class="input-group">
  	  <label>Password</label>
  	  <input type="password" name="password">
  	</div>
  	<div class="input-group">
  	  <label for="role">Role:</label>
<select name="role" id="role">
  <option value="t">Tutor</option>
  <option value="s">Student</option>
</select>

  	</div>
  	<div class="input-group">
  	  <button type="submit" class="btn" name="reg_user">Register</button>
  	</div>
  	<p>
  		Already a member? <a href="login.php">Login</a>
  	</p>
  </form>
</body>
</html>
