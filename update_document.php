<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $db = mysqli_connect('webpagesdb.it.auth.gr:3306t', 'panamyrt', 'password1!', 'student4057');

    if ($db->connect_error) {
        die("Αποτυχία σύνδεσης: " . $db->connect_error);
    }

    $title = $_POST['title'];
    $description = $_POST['description'];
	
    if(isset($_FILES['name']) && $_FILES['name']['error'] === UPLOAD_ERR_OK) {
       $new_name = $_FILES['name']['name'];
        $file_tmp = $_FILES['name']['tmp_name'];
        move_uploaded_file($file_tmp, "uploads/" . $new_name);
    } else {
		 $new_name = $_POST['current_file'] ?? '';
		// echo "Υπήρξε κάποιο πρόβλημα με το ανέβασμα του αρχείου.";
      //  exit;
        
    }

    if (!empty($_POST['announcement_id'])) {
        $announcement_id = $_POST['announcement_id']; 
         $query = "UPDATE documents SET title='$title', description='$description', name='$new_name' WHERE id=$announcement_id";
    } else {
       $query = "INSERT INTO documents (title, description, name) VALUES ('$title', '$description', '$new_name')";
    }

    $result = mysqli_query($db, $query);

    if ($result) {
        if (empty($_POST['announcement_id'])) {
            echo "Η ανακοίνωση προστέθηκε επιτυχώς!";
        } else {
            echo "Η ανακοίνωση ενημερώθηκε επιτυχώς!";
        }
    } else {
        echo "Κάτι πήγε στραβά κατά την επεξεργασία της ανακοίνωσης: " . mysqli_error($db);
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


