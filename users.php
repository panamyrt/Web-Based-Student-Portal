<?php
session_start();

// Σύνδεση στη βάση δεδομένων
$db = mysqli_connect('webpagesdb.it.auth.gr:3306t', 'panamyrt', 'password1!', 'student4057');

// Έλεγχος σύνδεσης
if ($db->connect_error) {
  die("Αποτυχία σύνδεσης: " . $db->connect_error);
}

// Έλεγχος ρόλου χρήστη
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
  <title>Χρήστες</title>
  <meta charset="UTF-8">
  <link rel="stylesheet" type="text/css" href="style2.css">
</head>
<body>

<div class="header">
  <header><h1>Χρήστες</h1></header>
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
    <div class="users">
      <table>
        <tr>
          <th>Όνομα</th>
          <th>Επώνυμο</th>
          <th>Username</th>

        </tr>

        <?php
        // Ερώτημα για ανάκτηση των χρηστών
        $query_users = "SELECT firstName, lastName, loginName, role FROM users";
        $result_users = mysqli_query($db, $query_users);

        if ($result_users->num_rows > 0) {
  while ($row = $result_users->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $row["firstName"] . "</td>";
    echo "<td>" . $row["lastName"] . "</td>";
    echo "<td>" . $row["loginName"] . "</td>";
   // echo "<td>" . $row["role"] . "</td>";
    echo "</tr>";
    
    echo '<tr>';
    echo '<td colspan="3"></td>'; // Κενός χώρος για τη στήλη Διαγραφής
    echo '<td><a href="delete_user.php?loginName=' . $row['loginName'] . '" class="button">Διαγραφή</a></td>';
    echo '</tr>';
  }
} else {
  echo "<tr><td colspan='4'>Δεν υπάρχουν χρήστες.</td></tr>";
}
        ?>

      </table>
    </div>
  </div>
</div>

<footer></footer>
<a href="#top" class="top-button">Πάνω</a>
</body>
</html>
