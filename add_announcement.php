<!DOCTYPE html>
<html>
<head>
  <title>Προσθήκη Νέας Ανακοίνωσης</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div class="header">
    <h2>Προσθήκη Νέας Ανακοίνωσης</h2>
  </div>

  <form method="post" action="update_announcement.php">
    <div class="input-group">
      <label>Τίτλος:</label>
      <input type="text" name="title">
    </div>
    <div class="input-group">
      <label>Περιεχόμενο:</label>
	  <input type="text" name="content">
    </div>
    <div class="input-group">
      <button type="submit" class="btn" name="add_announcement">Προσθήκη</button>
    </div>
  </form>

  <a href="index.php" class="btn">Επιστροφή στην αρχική σελίδα</a>
</body>
</html>
