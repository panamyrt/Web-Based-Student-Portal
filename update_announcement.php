<?php
$db = mysqli_connect('webpagesdb.it.auth.gr:3306t', 'panamyrt', 'password1!', 'student4057');

if (!$db) {
    die("Η σύνδεση απέτυχε: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_title = $_POST['title'];
    $new_content = $_POST['content'];

    // Ελέγχουμε αν η μεταβλητή $_POST['announcement_id'] υπάρχει πριν τη χρησιμοποιήσουμε
    if (isset($_POST['announcement_id'])) {
        $announcement_id = $_POST['announcement_id'];
    } else {
        $announcement_id = ""; // Αρχικοποιούμε την μεταβλητή με κενή τιμή αν δεν υπάρχει
    }

    if (empty($announcement_id)) {
        // Αν δεν υπάρχει announcement_id, προσθέτουμε νέα ανακοίνωση
        $query = "INSERT INTO announcement (title, content) VALUES ('$new_title', '$new_content')";
    } else {
        // Αλλιώς, ενημερώνουμε την υπάρχουσα ανακοίνωση
        $query = "UPDATE announcement SET title='$new_title', content='$new_content' WHERE id=$announcement_id";
    }

    $result = mysqli_query($db, $query);

    if ($result) {
        if (empty($announcement_id)) {
            echo "Η ανακοίνωση προστέθηκε επιτυχώς!";
        } else {
            echo "Η ανακοίνωση ενημερώθηκε επιτυχώς!";
        }
    } else {
        echo "Κάτι πήγε στραβά κατά την επεξεργασία της ανακοίνωσης: " . mysqli_error($db);
    }
}
mysqli_close($db);
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <a href="index.php" class="btn">Επιστροφή στην αρχική σελίδα</a>
</body>
</html>


