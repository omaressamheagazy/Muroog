<?php
declare (strict_types = 1);
namespace App\Helpers\Enums;

enum MessageType:string  {
case SUCCESS = "alert alert-success";
case FAIL = "alert alert-danger";
case WARNING = "alert alert-warning";
case INFO = "alert alert-info";

}
