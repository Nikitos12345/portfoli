<?

?>
    <form action="<?= $_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data">
        <input type="file" name="file">
        <input type="submit" name="up">
    </form>
<?php
if ($_POST['up']){
    $file = new Upload();
    $file->UploadFile();
}

//
//
//var_dump($_FILES);
//    $file['error'] = array();
//    $file['name']= $_FILES['file']['name'];
//    $file['size'] = $_FILES['file']['size'];
//    $file['tmp'] = $_FILES['file']['tmp_name'];
//    $file['type'] = $_FILES['file']['type'];
//    $file['ext'] = strtolower(end(explode('.', $file['name'])));
//    if (empty($file['error'])){
//        move_uploaded_file($file['tmp'], "upload/".$file['name']);
//        echo "Success";
//    }
//    var_dump($file);
//    echo "<br><a href='index.php'>Return</a>";
