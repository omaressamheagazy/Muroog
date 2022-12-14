<?php
declare (strict_types = 1);
namespace App\Helpers\Enums;
enum MessagesName : string {
    case LOCATION = "location_message";
    case CATEGORY = "category_message";
    case Building = "building_message";
    case ADMIN = "admin_message";
    case PASSWORD = "password_message";
    case ERROR = "error_message";
}
