<?php
declare(strict_types = 1);
namespace App\Helpers;
use App\Helpers\Enums\MessagesName;
use App\Helpers\Enums\MessageType;

class MessageReporting {

    /** a function that resposible for displying alert messages in a div, using bootstap classes
     * @param  string $message  mesage to be displayd to the user --> ex: password is wrong
     * @param string $messageType type of message -> ex: warrning
     */
    public static function alert(string $message = "", string $class ): void {
        if(!empty($message)) {
            echo "
                <div class=' ". $class . " ' role='alert'>
                {$message}
                </div>
            ";
        }
    }
    /**
     * registered a message in a session to dispaly to prepare to display it in another page
     */
    private static function registerFlash(string $name, string $message, string $class  ) {
        $_SESSION[$name] = $message;
        $_SESSION["{$name}_class"] = $class ;
    }

    /**
     *  display a flash message based on registered message
     */

    public static function flash(MessagesName $name , string $message = '', MessageType $class = MessageType::SUCCESS  ) {

        if(!empty($message)) { // register new flash
            self::registerFlash($name->value, $message, $class->value);
        } elseif(!empty($_SESSION[$name->value])) { // getFlash message
            self::alert($_SESSION[$name->value], $_SESSION["{$name->value}_class"]);
            self::destroyRegisteredFlash($name->value);
        }
    }
    private static function destroyRegisteredFlash(string $name) {
            unset($_SESSION[$name]);
            unset($_SESSION["{$name}_class"]);
    }
}