<?php
// Σύνδεση στη βάση δεδομένων
$db = mysqli_connect('webpagesdb.it.auth.gr:3306t', 'panamyrt', 'password1!', 'student4057');

// Έλεγχος για σφάλμα σύνδεσης
if (!$db) {
    die("Η σύνδεση απέτυχε: " . mysqli_connect_error());
}

// Έλεγχος αν υπάρχει παραμέτρος ID στο URL και αν είναι αριθμός
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $announcement_id = $_GET['id'];

    // Εκτέλεσε το query για διαγραφή
    $query = "DELETE FROM exercise WHERE id=$announcement_id";
    $result = mysqli_query($db, $query);

    if ($result) {
        echo "Η εργασία διαγράφηκε επιτυχώς!";
    } else {
        echo "Κάτι πήγε στραβά κατά τη διαγραφή της εργασλιας " . mysqli_error($db);
    }
} else {
    echo "Δεν παρέχθηκε έγκυρο αναγνωριστικό ανακοίνωσης.";
}

// Κλείσιμο της σύνδεσης με τη βάση δεδομένων
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
