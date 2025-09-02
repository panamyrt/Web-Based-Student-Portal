<?php
session_start();

// Σύνδεση στη βάση δεδομένων
$db = mysqli_connect('webpagesdb.it.auth.gr:3306t', 'panamyrt', 'password1!', 'student4057');


//var_dump($_SESSION['loginName']);
if (isset($_SESSION['loginName'])) {
    $loginName = $_SESSION['loginName'];
  //  var_dump($loginName); 
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
      //  var_dump($userRole); 
    }
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Έγγραφα μαθήματος</title>
  <meta charset="UTF-8">
  <link rel="stylesheet" type="text/css" href="style2.css">
</head>
<body>



<div class="header">
  <header><h1>Έγγραφα μαθήματος</h1></header>
</div>

<main></main>

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


 <div class="document">
    <?php

// Σύνδεση στη βάση δεδομένων
$db = mysqli_connect('webpagesdb.it.auth.gr:3306t', 'panamyrt', 'password1!', 'student4057');

// Έλεγχος σύνδεσης
if ($db->connect_error) {
  die("Αποτυχία σύνδεσης: " . $db->connect_error);
}

// Ερώτημα για ανάκτηση υπαρχόντων εγγράφων
$sql = "SELECT id, title, description, name FROM documents";
$result = $db->query($sql);
if ($userRole === 't'){
 echo '<a href="add_document.php" class="button">Προσθήκη Νέου Εγγράφου</a>';}

if ($result->num_rows > 0) {
  // Εμφάνιση εγγράφων ως λίστα
  while($row = $result->fetch_assoc()) {
    echo "<div class='document'>";
	echo '<h2>'.$row["title"]. '</h2>';
    echo "<p>Περιγραφή: " . $row["description"] . "</p>";
    echo '<a href="uploads/' . $row['name'] . '" download>Λήψη αρχείου</a>';
   if ($userRole === 't'){
   echo '<a href="edit_document.php?id=' . $row['id'] . '" class="button">Τροποπoίηση</a>';}
    if ($userRole === 't'){
           echo '<a href="delete_document.php?id=' . $row['id'] . '" class="button">Διαγραφή</a>';}



    echo "</div>";
  }
} else {
  echo "Δεν υπάρχουν εγγράφα.";

}
$db->close();
?>

  
  </div>
</div>

  <footer></footer>
  <a href="#top" class="top-button">Πάνω</a>
</body>
</html>
