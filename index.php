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
  <title>Αρχική Σελίδα</title>
   <meta charset="UTF-8">
  <link rel="stylesheet" type="text/css" href="style2.css">

</head>
<body>

<div class="header">
  <header><h1>Αρχική Σελίδα</h1></header>
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


<div class="paragraph">
  <h2> Περιεχομενα Ιστοσελιδας </h2>
  <p> Καλώς ήρθατε στον ιστότοπο μας για εκμάθηση HTML! Στόχος μας είναι να παρέχουμε έναν πλήρη πόρο για την εκμάθηση και κατανόηση της HTML. Ανάμεσα στα περιεχόμενα του ιστότοπου μας θα βρείτε ανακοινώσεις, επικοινωνία, έγγραφα μαθήματος και εργασίες. Καλώς να επισκεφθείτε και να αρχίσετε το ταξίδι σας στον κόσμο του HTML! </p>
</div>

</div>


<div class="image">
    <img src="image2.jpg">
 </div>
 

<footer></footer>

</body>
</html>
