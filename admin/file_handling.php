<?php
/*
example
HTML:
<form enctype="multipart/form-data" action="uploader.php" method="POST">
<input type="hidden" name="MAX_FILE_SIZE" value="100000" />
Choose a file to upload: <input name="file" type="file" /><br />
<input type="submit" value="Upload File" />
</form>

PHP:
file_upload("file","/var/www/roosters/ouders.csv")
*/
function file_upload($name,$to_file){
$target_path = realpath(dirname($_SERVER['SCRIPT_FILENAME'])) . "/" .$to_file;
if(move_uploaded_file($_FILES[$name]['tmp_name'], $target_path)) {
    echo "Succesvol geuploaded";
} else{
   	echo "fout" . error_get_last();
}
}