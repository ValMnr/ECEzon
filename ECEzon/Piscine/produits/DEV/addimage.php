<?php
 if (isset($_FILES['Photo'])) {
   // code...
   $dirpath = realpath(dirname(getcwd()))."/images/";
   // chemin relatif au répertoire courant
   // gestion des erreurs
   $phpFileUploadErrors = array(
    0 => 'There is no error, the file uploaded with success',
    1 => 'The uploaded file exceeds the upload_max_filesize directive in php.ini',
    2 => 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form',
    3 => 'The uploaded file was only partially uploaded',
    4 => 'No file was uploaded',
    6 => 'Missing a temporary folder',
    7 => 'Failed to write file to disk.',
    8 => 'A PHP extension stopped the file upload.',
  );
   // pre_r($_FILES);


   // verification du format de l'upload des images
   $ext_error = false;
   $extensions = array('jpg', 'jpeg' , 'gif', 'png' );
   $file_ext = explode('.',$_FILES['Photo']['name']);
   $file_ext = end($file_ext);

   if (!in_array($file_ext,$extensions)) {
     $ext_error = true;
   }

   // gestion des erreurs
   if ($_FILES['Photo']['error']) {
     echo $phpFileUploadErrors[$_FILES['Photo']['error']];
   }
   elseif ($ext_error) {
     echo "Invalid file extension";
   }
   else {
     echo "Image successfully uploaded";
   }

   move_uploaded_file($_FILES['Photo']['tmp_name'], $dirpath.$_FILES['Photo']['name']);
 }
   function pre_r($array){
     echo "<pre>";
     print_r($array);
     echo "</pre>";
   }
 ?>
