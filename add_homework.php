<!DOCTYPE html>
<html>
<head>
  <title>Προσθήκη Νέας Εργασίας</title>
  <meta charset="UTF-8">
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div class="header">
    <h2>Προσθήκη Νέας Εργασίας</h2>
  </div>

  <form method="post" action="update_homework.php" enctype="multipart/form-data">
 <label for="goals">Στόχοι:</label>
<textarea id="goals" name="goals" ></textarea><br><br>

<label for="name">Εκφώνηση:</label>
<input type="file" id="name" name="name"><br><br>

<label for="deliverables">Παραδοτέα:</label>
<textarea id="deliverable" name="deliverable" ></textarea><br><br>

<label for="date">Ημερομηνία παράδοσης:</label>
<input type="text" id="date" name="date"><br><br>


    <input type="submit" value="Υποβολή">
  </form>

  <a href="index.php" class="btn">Επιστροφή στην αρχική σελίδα</a>
</body>
</html>
