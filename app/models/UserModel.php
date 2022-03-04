<?php

/**
 *  User model
 */
class UserModel extends Model
{
    protected $table = 'users';
    protected $allowed_columns = [
            'name',
            'username',
            'email',
            'role',
            'password',
            'image',
            'date',
            ];

    public function validate($data)
    {
        $errors = [];

        if (empty($data['name'])) {
            $errors['name'] = 'Name field cannot be empty!';
        } elseif (!preg_match('/[a-zA-Z ]/', $data['name'])) {
            $errors['name'] = 'Only letters are allowed in name field!';
        }

        if (empty($data['username'])) {
            $errors['username'] = 'Username is required!';
        } elseif (!preg_match('/[a-zA-Z0-9_]/', $data['username'])) {
            $errors['username'] = 'Spaces are not allowed in username!';
        }

        if (empty($data['email'])) {
            $errors['email'] = 'Email is required!';
        } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Email is not valid!';
        }

        if (empty($data['password'])) {
            $errors['password'] = 'Password is required!';
        } elseif ($data['password'] !== $data['repeat_pwd']) {
            $errors['repeat_pwd'] = 'Passwords do not match!';
        } elseif (strlen($data['password']) < 6) {
            $errors['password'] = 'Password must be at least 6 characters!';
        }

        return $errors;
    }
}
