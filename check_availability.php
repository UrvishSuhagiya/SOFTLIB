<?php 
require_once("includes/config.php");

// Check if email is provided
if (!empty($_POST["email"])) {
    $email = $_POST["email"];

    if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
        echo "error : You did not enter a valid email.";
    } else {
        $sql = "SELECT EmailId FROM tblstudents WHERE EmailId = :email";
        $query = $dbh->prepare($sql);
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->execute();

        if ($query->rowCount() > 0) {
            echo "<span style='color:red'> Email already exists.</span>";
            echo "<script>$('#submit').prop('disabled',true);</script>";
        } else {
            echo "<span style='color:green'> Email available for Registration.</span>";
            echo "<script>$('#submit').prop('disabled',false);</script>";
        }
    }
}
?>
