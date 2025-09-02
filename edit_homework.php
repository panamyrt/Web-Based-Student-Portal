<?php
$db = mysqli_connect('webpagesdb.it.auth.gr:3306t', 'panamyrt', 'password1!', 'student4057');
if (!$db) {
    die("Η σύνδεση απέτυχε: " . mysqli_connect_error());
}

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $exercise_id = $_GET['id'];
    $query = "SELECT * FROM exercise WHERE id = $exercise_id";
    $result = mysqli_query($db, $query);

    if (!$result) {
        echo "Σφάλμα στο ερώτημα: " . mysqli_error($db);
    } else {
        if (mysqli_num_rows($result) > 0) {
            $exercise = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Επεξεργασία Εργασιών</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div class="header">
    <h2>Επεξεργασία Εργασιών</h2>
</div>

<form method="post" action="update_homework.php" enctype="multipart/form-data">
    <div class="input-group">
        <label>Στόχοι:</label>
       <textarea name="goals" rows="4"><?php echo $exercise['goals']; ?></textarea>
    </div>
    <div class="input-group">
        <label>Εκφώνηση:</label>
        <input type="file" name="name">
		<p>Τρέχον αρχείο: <?php echo $exercise['name']; ?></p>
    </div>
    <div class="input-group">
        <label>Παραδοτέα:</label>
        <input type="text" name="deliverable" value="<?php echo $exercise['deliverable']; ?>">

    </div>
    <div class="input-group">
        <label>Ημερομηνία παράδοσης:</label>
        <input type="text" name="date" value="<?php echo $exercise['date']; ?>">
    </div>
    <input type="hidden" name="exercise_id" value="<?php echo $exercise['id']; ?>">
    <div class="input-group">
        <button type="submit" class="btn" name="edit_exercise">Αποθήκευση</button>
    </div>
</form>

</body>
</html>
<?php
        } else {
            echo "Δεν βρέθηκε εργασία με αυτό το ID.";
        }
    }
} else {
    echo "Μη έγκυρο ID εργασίας.";
}

mysqli_close($db);
?>
