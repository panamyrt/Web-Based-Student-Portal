<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sender = $_POST['sender'];
    $subject = $_POST['subject'];
    $body = $_POST['body'];
    

    if (filter_var($sender, FILTER_VALIDATE_EMAIL)) {
        $to = 'myrtopanagio1@gmail.com'; 
        
        $headers = "From: $sender\r\n";
        $headers .= "Reply-To: $sender\r\n";
      
        if (mail($to, $subject, $body, $headers)) {
            echo "<p>Το email στάλθηκε με επιτυχία!</p>";
        } else {
            echo "<p>Υπήρξε κάποιο πρόβλημα κατά την αποστολή του email.</p>";
        }
    } else {
        echo "<p>Παρακαλώ εισάγετε μια έγκυρη διεύθυνση email.</p>";
    }
}
?>
