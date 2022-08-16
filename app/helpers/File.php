<?php
declare (strict_types = 1);
namespace App\Helpers;

class File
{
    private const FILE_SIZE = 15_000_000;
    /**
     * Theis function is responsible for validate whether the provided file is valie based on some specificaiton that predfeined
     * @param array $uploadedFile This will hold the file and it's specification
     * @param string $validateType This will accept the name of the function that is reponsible for validating the file type (ex:.pdf) 
     * @param array $errorMsg This will hold the array of eror messages, that will be showed to the user incase of invalid file uploaded
     */
    public static function checkFileError(array $uploadedFile,  string $validateType, string &$errorMsg): bool
    {
        $isFileValid = false;
        if (!self::$validateType($uploadedFile["tmp_name"]))  $errorMsg = "please upload images only";
        elseif ($uploadedFile["error"]) $errorMsg = "error occured while uploading this file";
        elseif ($uploadedFile["size"] > self::FILE_SIZE) $errorMsg = "file is too large";
        else $isFileValid = true;
        return $isFileValid;
    }

    private static  function  validateImage(string $fileName): bool
    {   
        return substr(mime_content_type($fileName), 0, 5) == "image";
    }
    /**
     *  This function validate the passed file, and return an error message if found, else it will return empty string
     */
    public static function validateFiles(array &$uploadedFiles,  string $validateType): string {
        $uploadedFiles = File::reArrayFiles($uploadedFiles);
        $errorMsg = "";
        foreach($uploadedFiles as $file) {
            if(empty($file["name"])) continue; // make sure that no empty file is passed
            if(!self::checkFileError($file, $validateType, $errorMsg)) break; // in case any error found, stope
        }
        return $errorMsg;
    }
    /**
     * This function return a string that contain all the image/s path as string to be stored in the database
     * @param array $validFiles a valid file that has no error
     * @param string a folder path in whihc where the uploaded image should be stored
     */
    public static function handleValidatedFiles(array $validFiles, string $folderPath): string {
        $filesName = "";
        foreach($validFiles  as $file) {
            $fileName = File::generateUniqueFileName($file["name"]);
            $filesName .= $fileName . " ";
            $fileDest = $folderPath. "/". $fileName;
            move_uploaded_file($file["tmp_name"], $fileDest);
        }
        return trim($filesName);
    }
    public static function reArrayFiles(&$file_post): array
    {
        $isMulti    = is_array($file_post['name']);
        $file_count    = $isMulti?count($file_post['name']):1;
        $file_keys    = array_keys($file_post);
        $file_ary    = [];    //Итоговый массив
        for($i=0; $i<$file_count; $i++)
            foreach($file_keys as $key)
                if($isMulti)
                    $file_ary[$i][$key] = $file_post[$key][$i];
                else
                    $file_ary[$i][$key]    = $file_post[$key];
        return $file_ary;
    }

    public static function generateUniqueFileName(string $fileName): string {
        $extractedFileExt = explode(".", $fileName);
        $fileExtension = strtolower(end($extractedFileExt)); // make sure that it's lowercase
        return uniqid() . ".{$fileExtension}";
    }
    


}
