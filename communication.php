<?php
session_start();

 
$db = mysqli_connect('webpagesdb.it.auth.gr:3306t', 'panamyrt', 'password1!', 'student4057');


if (isset($_SESSION['loginName'])) {
    $loginName = $_SESSION['loginName'];
   // var_dump($loginName); 
    $query = "SELECT role FROM users WHERE loginName='$loginName'";
    //echo $query;
    $result = mysqli_query($db, $query);

    if (!$result) {
        printf("Error: %s\n", mysqli_error($db));
        exit();
    }

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $userRole = $row['role'];
       // var_dump($userRole); 
    }
}
?>


<!DOCTYPE html>
<html>
<head>
  <title>Επικοινωνία</title>
  <meta charset="UTF-8">
  <link rel="stylesheet" type="text/css" href="style2.css">
</head>
<body>

<div class="header">
  <header><h1>Επικοινωνία</h1></header>
</div>

<main>
  <div class="box">
    <div class="sidebar"> 
 <ul>
   <a href="index.php" class="button">Αρχική σελίδα</a>
    <a href="announcement.php" class="button">Ανακοινώσεις</a>
    <a href="communication.php" class="button">Επικοινωνία</a>
    <a href="documents.php" class="button">Έγραφα μαθήματος</a>
    <a href="homework.php" class="button">Εργασίες</a>
    <?php if ($userRole === 't') : ?>
      <a href="users.php" class="button">Χρήστες</a>
    <?php endif; ?>
   <a href="login.php" class="button">Log Out</a>
 </ul>
    </div>

    <div class="secondpart">
      <h2>Μέσω Web Φόρμας</h2>
      <form action="send_email.php" method="post">
        <strong>Αποστολέας:</strong>  <input type="text" name="sender"><br>
        <strong>Θέμα:</strong> <input type="text" name="subject"><br>
        <strong>Κείμενο:</strong>  <textarea name="body"></textarea><br>
        <input type="submit" value="Αποστολή">
      </form>

      <h2>Με Χρήση Email Διεύθυνσης</h2>
      <p>Εναλλακτικά μπορείτε να αποστείλετε email στην παρακάτω διεύθυνση ηλεκτρονικού ταχυδρομείου:</p>
      <p><a href="mailto:tutor@csd.auth.test.gr">tutor@csd.auth.test.gr</a></p>
 
    </div>
  </div>
</main>

<footer></footer>
<a href="#top" class="top-button">Πάνω</a>
</body>
</html>

