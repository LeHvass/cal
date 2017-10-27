<?

$target_path = "/var/www/chvass.dk/uploads/";

$target_path = $target_path . basename($_FILES['uploadedfile']['name']);

if (move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) {
    echo "The file " . basename($_FILES['uploadedfile']['name']) .
    " has been uploaded<br>";
    echo "<a href='//uploads.chvass.dk/" . $_FILES['uploadedfile']['name'] . "'>Link</a>";
} else {
    echo "There was an error uploading the file, please try again!";
}
?>
