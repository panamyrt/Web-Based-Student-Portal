<?php
session_start();


$db = mysqli_connect('webpagesdb.it.auth.gr:3306t', 'panamyrt', 'password1!', 'student4057');


if (isset($_SESSION['loginName'])) {
    $loginName = $_SESSION['loginName'];
  
    $query = "SELECT role FROM users WHERE loginName='$loginName'";

    $result = mysqli_query($db, $query);

    if (!$result) {
        printf("Error: %s\n", mysqli_error($db));
        exit();
    }

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $userRole = $row['role'];
        
    }
}
?>



<!DOCTYPE html>
<html>
<head>
  <title>Εργασίες</title>
  <meta charset="UTF-8">
  <link rel="stylesheet" type="text/css" href="style2.css">
</head>
<body>
  <div class="header">
  <header><h1>Εργασίες</h1></header>
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


    <div class="document">
        
<?php

$conn =mysqli_connect('webpagesdb.it.auth.gr:3306t', 'panamyrt', 'password1!', 'student4057');



if ($conn->connect_error) {
    die("Αποτυχία σύνδεσης: " . $conn->connect_error);
}

$sql = "SELECT id, goals, name, deliverable, date FROM exercise";
$result = $conn->query($sql);
if ($userRole === 't'){
 echo '<a href="add_homework.php" class="button">Προσθήκη Νέας Εργασιας </a>';}
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<div class='document'>";
        echo '<h2>Εργασία ' . $row["id"] . '</h2>';
        echo '<h3>Στόχοι:</h3><ul>';
        echo '<li>' . $row["goals"] . '</li>';
        echo '</ul>';
		echo '<h3>Εκφώνηση:</h3><u1>';
        echo '<p>Κατεβάστε την εκφώνηση της εργασίας από <a href="uploads/' . $row["name"] . '"download>εδώ</a></p>';
		echo '</ul>';
		
        echo '<h3>Παραδοτέα:</h3><ul>';
        echo '<li>' . $row["deliverable"] . '</li>';
        echo '</ul>';
		
        echo '<p>Ημερομηνία παράδοσης: ' . $row["date"] . '</p>';
        echo '</div>';
		
		 if ($userRole === 't'){
           echo '<a href="edit_homework.php?id=' . $row['id'] . '" class="button">Τροποποίηση</a>';}
		
		if ($userRole === 't'){
           echo '<a href="delete_homework.php?id=' . $row['id'] . '" class="button">Διαγραφή</a>';}
    }
} else {
    echo "Δεν υπάρχουν εργασίες ακόμα.";
}
$conn->close();
?>

      </div>
    </div>
  </main>

  <footer></footer>
  <a href="#top" class="top-button">Πάνω</a>
</body>
</html>
