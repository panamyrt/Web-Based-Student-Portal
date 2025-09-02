<!DOCTYPE html>
<html>
<head>
  <title>Επεξεργασία ανακοινώσεων</title>
  <meta charset="UTF-8">
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div class="header">
    <h2>Επεξεργασία ανακοινώσεων</h2>
  </div>

  <?php
    // Ο κώδικας που επιστρέφει τη φόρμα επεξεργασίας
$db = mysqli_connect('webpagesdb.it.auth.gr:3306t', 'panamyrt', 'password1!', 'student4057');
    if (!$db) {
        die("Η σύνδεση απέτυχε: " . mysqli_connect_error());
    }

    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        $announcement_id = $_GET['id'];
        $query = "SELECT * FROM announcement WHERE id = $announcement_id";
        $result = mysqli_query($db, $query);

        if (!$result) {
            echo "Σφάλμα στο ερώτημα: " . mysqli_error($db);
        } else {
            if (mysqli_num_rows($result) > 0) {
                $announcement = mysqli_fetch_assoc($result);
  ?>

  <form method="post" action="update_announcement.php">
    <div class="input-group">
      <label>Τίτλος:</label>
      <input type="text" name="title" value="<?php echo $announcement['title']; ?>">
    </div>
    <div class="input-group">
      <label>Περιεχόμενο:</label>
      <input type="text" name="content" value="<?php echo $announcement['content']; ?>">
    </div>
    <input type="hidden" name="announcement_id" value="<?php echo $announcement['id']; ?>">
    <div class="input-group">
      <button type="submit" class="btn" name="edit_announcement">Αποθήκευση</button>
    </div>
  </form>

  <?php
            } else {
                echo "Δεν βρέθηκε ανακοίνωση με αυτό το ID.";
            }
        }
    } else {
        echo "Μη έγκυρο ID ανακοίνωσης.";
    }

    mysqli_close($db);
  ?>

</body>
</html>
