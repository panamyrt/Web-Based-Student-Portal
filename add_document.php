<!-- add_document.php -->
<!DOCTYPE html>
<html>
<head>
  <title>Προσθήκη Νέου Εγγράφου</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div class="header">
    <h2>Προσθήκη Νέου Εγγράφου</h2>
  </div>

  <form method="post" action="update_document.php" enctype="multipart/form-data">
    <div class="input-group">
      <label>Τίτλος:</label>
      <input type="text" name="title">
    </div>
    <div class="input-group">
      <label>Περιγραφή:</label>
      <input type="text" name="description">
    </div>
    <div class="input-group">
      <label>Αρχείο:</label>
      <input type="file" name="name">
    </div>
    <div class="input-group">
      <button type="submit" class="btn" name="add_document">Προσθήκη</button>
    </div>
  </form>

  <a href="index.php" class="btn">Επιστροφή στην αρχική σελίδα</a>
</body>
</html>
