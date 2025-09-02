<?php
session_start();

// initializing variables
$firstName = "";
$lastName = "";
$loginName = "";
$errors = array(); 

// connect to the database
$db = mysqli_connect('webpagesdb.it.auth.gr:3306t', 'panamyrt', 'password1!', 'student4057');

// REGISTER USER
if (isset($_POST['reg_user'])) {
    $firstName = mysqli_real_escape_string($db, $_POST['firstName']);
    $lastName = mysqli_real_escape_string($db, $_POST['lastName']);
    $loginName = mysqli_real_escape_string($db, $_POST['loginName']);
    $password = mysqli_real_escape_string($db, $_POST['password']);
    $role = mysqli_real_escape_string($db, $_POST['role']);

    if (empty($loginName)) { array_push($errors, "Username is required"); }
    if (empty($password)) { array_push($errors, "Password is required"); }
    if (empty($firstName)) { array_push($errors, "First name is required"); }
    if (empty($lastName)) { array_push($errors, "Last name is required"); }

    $user_check_query = "SELECT * FROM users WHERE loginName='$loginName' LIMIT 1";
    $result = mysqli_query($db, $user_check_query);
    $user = mysqli_fetch_assoc($result);

    if ($user) {
        if ($user['loginName'] === $loginName) {
            array_push($errors, "Username already exists");
        }
    }

    if (count($errors) == 0) {
        //$hashed_password = password_hash($password, PASSWORD_DEFAULT); // Κρυπτογράφηση κωδικού

        $query = "INSERT INTO users (firstName, lastName, loginName, password, role) VALUES('$firstName', '$lastName', '$loginName', '$password', '$role')";
        mysqli_query($db, $query);

        $_SESSION['loginName'] = $loginName;
        $_SESSION['success'] = "You are now logged in";
		$_SESSION['role'] = $user['role'];
        header('location: index.php');
    }
}

// LOGIN USER
if (isset($_POST['login_user'])) {
    $loginName = mysqli_real_escape_string($db, $_POST['loginName']);
    $password = mysqli_real_escape_string($db, $_POST['password']);
	//$role=mysqli_real_escape_string($db, $_POST['role']);
	
	
    if (empty($loginName)) {
        array_push($errors, "Username is required");
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    }

    if (count($errors) == 0) {
        $query = "SELECT * FROM users WHERE loginName='$loginName'";
        $results = mysqli_query($db, $query);
        
        if (mysqli_num_rows($results) == 1) {
    $user = mysqli_fetch_assoc($results);

   if ($user['loginName'] === $loginName && $user['password'] === $password) {
    $_SESSION['loginName'] = $loginName;
    $_SESSION['success'] = "You are now logged in";

    // Θέτουμε τον ρόλο του χρήστη στη συνεδρία ανάλογα με τον τιμή από τη βάση
    $_SESSION['role'] = $user['role']; // Ορίζετε τον ρόλο εδώ
    header('location: index.php');
} else {
    array_push($errors, "Wrong username/password combination");
}

} else {
    array_push($errors, "No user found");
}
        } else {
            array_push($errors, "No user found");
        }
    
}

?>
