<?php
declare (strict_types = 1);
namespace App\Helpers;

class File
{
    private const FILE_SIZE = 50000;
    /**
     * Theis function is responsible for validate whether the provided file is valie based on some specificaiton that predfeined
     * @param array $uploadedFile This will hold the file and it's specification
     * @param string $validateType This will accept the name of the function that is reponsible for validating the file type (ex:.pdf) 
     * @param array $errorMsg This will hold the array of eror messages, that will be showed to the user incase of invalid file uploaded
     */
    public static function validateFile(array $uploadedFile,  string $validateType, array &$errorMsg)
    {
        // echo "<br>";
        $isFileValid = false;
        if (!self::$validateType($uploadedFile["tmp_name"]))  $errorMsg["file"] = "please upload images only";
        elseif ($uploadedFile["error"]) $errorMsg["file"] = "error occured while uploading this file";
        elseif ($uploadedFile["size"] > self::FILE_SIZE) $errorMsg["file"] = "file is too large";
        else $isFileValid = true;
        return $isFileValid;
    }

    private static  function  validateImage(string $fileName): bool
    {
        return substr(mime_content_type($fileName), 0, 5) == "image";
    }
}
