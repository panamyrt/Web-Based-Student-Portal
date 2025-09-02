<?php
session_start();

// Σύνδεση στη βάση δεδομένων
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
  <title>Ανακοινώσεις</title>
  <meta charset="UTF-8">
  <link rel="stylesheet" type="text/css" href="style2.css">
</head>
<body>

<div class="header">
  <header><h1>Ανακοινώσεις</h1></header>
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
    <!-- Εδώ θα εμφανιστούν δυναμικά οι ανακοινώσεις -->
    <?php
      // Σύνδεση στη βάση δεδομένων
   $db = mysqli_connect('webpagesdb.it.auth.gr:3306t', 'panamyrt', 'password1!', 'student4057');

      // Ερώτημα για την ανάκτηση των ανακοινώσεων
      $query = "SELECT * FROM announcement";
      $result = mysqli_query($db, $query);
	  if ($userRole === 't'){
	  echo '<a href="add_announcement.php" class="button">Προσθήκη Νέας Ανακοίνωσης</a>';}
      // Έλεγχος αν υπάρχουν αποτελέσματα
      if (mysqli_num_rows($result) > 0) {
        // Εμφάνιση των ανακοινώσεων
        while ($row = mysqli_fetch_assoc($result)) {
		 

           echo '<div class="announcement2">';
           echo '<h2>Aνακοίνωση ' . $row['id'] . '</h2>';
           echo '<p><strong>Ημερομηνία:</strong> ' . $row['date'] . '</p>';
           echo  '<p><strong>Θέμα:</strong> ' . $row['title'] . '</p>';
           echo '<p>' . $row['content'] . '</p>';

           // Σύνδεσμος για τροποποίηση με το κατάλληλο ID
		   if ($userRole === 't'){
           echo '<a href="edit_announcement.php?id=' . $row['id'] . '" class="button">Τροποποίηση</a>';}

           // Σύνδεσμος για διαγραφή με το κατάλληλο ID
		   if ($userRole === 't'){
           echo '<a href="delete_announcement.php?id=' . $row['id'] . '" class="button">Διαγραφή</a>';}

          echo '</div>';
        }
    }
       else {
        echo 'Δεν υπάρχουν ανακοινώσεις αυτή τη στιγμή.';
      }

      // Κλείσιμο της σύνδεσης με τη βάση δεδομένων
      mysqli_close($db);
    ?>
  </div>
 
</div>

<footer></footer>
<a href="#top" class="top-button">Πάνω</a>
</body>
</html>
