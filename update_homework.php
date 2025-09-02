<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $db = mysqli_connect('webpagesdb.it.auth.gr:3306t', 'panamyrt', 'password1!', 'student4057');

    if ($db->connect_error) {
        die("Αποτυχία σύνδεσης: " . $db->connect_error);
    }
    $new_goals = $_POST['goals'];
    $new_date = $_POST['date'];
    $new_deliverable = $_POST['deliverable'];
	
	$new_content = "Η ημερομηνία παράδοσης εργασίας είναι {$new_date}";



    // Ελέγχος ανέβασμα αρχείου
    if(isset($_FILES['name']) && $_FILES['name']['error'] === UPLOAD_ERR_OK) {
        $new_name = $_FILES['name']['name'];
        $file_tmp = $_FILES['name']['tmp_name'];
        move_uploaded_file($file_tmp, "uploads/" . $new_name);
    } else {
		 $new_name = $_POST['name'] ?? '';
       // exit;
    }

    // Έλεγχος για το πεδίο "exercise_id"
    if (!empty($_POST['exercise_id'])) {
        $exercise_id = $_POST['exercise_id']; 
       $query = "UPDATE exercise SET goals='$new_goals', name='$new_name', date='$new_date', deliverable='$new_deliverable' WHERE id='$exercise_id'";
    } else {
        $query = "INSERT INTO exercise (goals,name , deliverable, date) VALUES ('$new_goals','$new_name', '$new_deliverable', '$new_date')";
		$query_announcement = "INSERT INTO announcement (title, content) VALUES ('$new_title', '$new_content')";

    }

    $result = mysqli_query($db, $query);
	 $result_exercise = mysqli_query($db, $query_exercise);

  
        // Ανακτήστε το ID που ανατίθεται αυτόματα στην τελευταία εισαγωγή
        $exercise_id = mysqli_insert_id($db);

        // Χρησιμοποιήστε το ID ως τίτλο στον πίνακα announcement
        $new_title = "Ανακοινώθηκε εργασία με ID: $exercise_id";

        // Εκτέλεση ερωτήματος INSERT στον πίνακα announcement
        $query_announcement = "INSERT INTO announcement (title, content) VALUES ('$new_title', '$new_content')";
	$result_announcement = mysqli_query($db, $query_announcement);


    if ($result) {
        if (empty($_POST['exercise_id'])) {
            echo "Η εργασία προστέθηκε επιτυχώς!";
        } else {
            echo "Η εργασία ενημερώθηκε επιτυχώς!";
        }
    } else {
        echo "Κάτι πήγε στραβά κατά την επεξεργασία της εργασίας: " . mysqli_error($db);
    }
    $db->close();
}
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
