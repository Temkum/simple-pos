<?php

class Auth
{
    public static function getUserData($column)
    {
        if (!empty($_SESSION['user'][$column])) {
            return $_SESSION['user'][$column];
        }
        return 'Guest';
    }

    public static function loggedIn()
    {

        if (!empty($_SESSION['user'])) {
            $db = new Database;

            if ($db->query("SELECT * FROM users WHERE username = :username LIMIT 1", ['username' => $_SESSION['user']['username']])) {
                return true;
            }
        }

        return false;
    }

    public static function access($role)
    {
        $access['super_admin'] = ['super_admin'];
        $access['admin'] = ['admin'];
        $access['supervisor'] = ['admin', 'supervisor'];
        $access['cashier'] = ['admin', 'supervisor', 'cashier'];
        $access['accountant'] = ['admin', 'accountant'];
        $access['worker'] = ['admin', 'supervisor', 'cashier', 'worker'];

        $my_role = self::getUserData('role');

        if (in_array($my_role, $access[$role])) {
            # code...
            return true;
        }
        return false;
    }

    public static function setMessage($msg)
    {
        $_SESSION['message'] = $msg;
    }

    public static function getMessage()
    {
        # code...
        if (!empty($_SESSION['message'])) {

            $message = $_SESSION['message'];
            unset($_SESSION['message']);

            return $message;
        }
    }
}