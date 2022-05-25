<?php

/**
 * Product class
 */
class ProductModel extends Model
{
    protected $table = 'products';

    protected $allowed_columns = [
        'description',
        'barcode',
        'qty',
        'amount',
        'user_id',
        'image',
        'views',
        'date',
    ];

    // add $id for editing products
    public function validate($data, $id = null)
    {
        $errors = [];

        if (empty($data['description'])) {
            $errors['description'] = 'Product description is required!';
        } elseif (!preg_match('/[a-zA-Z0-9 ]/', $data['description'])) {
            $errors['description'] = 'Only letters are allowed!';
        }

        if (empty($data['qty'])) {
            $errors['qty'] = 'Product quantity is required!';
        } elseif (!preg_match('/^[0-9]+$/', $data['qty'])) {
            $errors['qty'] = 'Only digits are not allowed!';
        }

        if (empty($data['amount'])) {
            $errors['amount'] = 'Product price is required!';
        } elseif (!preg_match('/^[0-9.]+$/', $data['amount'])) {
            $errors['amount'] = 'Only numbers are allowed!';
        }

        // validate img
        $max_size = 4;
        $img_size = $max_size * (1024 * 1024);

        // check if prod is present
        if (!$id || ($id && !empty($data['image']))) {
            # code...
            if (empty($data['image'])) {
                $errors['image'] = 'Product image is required!';
            } elseif (!($data['image']['type'] == 'image/jpeg' || $data['image']['type'] == 'image/jpg' || $data['image']['type'] == 'image/png')) {
                $errors['image'] = 'Image must be a valid JPEG or PNG!';
            } elseif ($data['image']['error'] > 0) {
                $errors['image'] = 'Image upload failed. Error -' . $data['image']['error'];
            } elseif ($data['image']['size'] > $img_size) {
                $errors['image'] = 'Image size must be lower than' . $max_size . 'MB';
            }
        }

        return $errors;
    }

    public function generateBarcode()
    {
        return rand(1000, 9999999);
    }

    public function generateFilename($ext = 'jpg')
    {
        return hash('sha1', rand(1000, 9999999)) . '_' . rand(100, 999) . '.' . $ext;
    }
}