<?php

/**
 * Product class
 */
class SaleModel extends Model
{
    protected $table = 'sales';

    protected $allowed_columns = [
        'description',
        'barcode',
        'qty',
        'amount',
        'user_id',
        'receipt_num',
        'total',
        'date',
    ];

    // add $id for editing sales
    public function validate($data, $id = null)
    {
        $errors = [];

        if (empty($data['description'])) {
            $errors['description'] = 'Sale description is required!';
        } elseif (!preg_match('/[a-zA-Z0-9 ]/', $data['description'])) {
            $errors['description'] = 'Only letters are allowed!';
        }

        if (empty($data['qty'])) {
            $errors['qty'] = 'Sale quantity is required!';
        } elseif (!preg_match('/^[0-9]+$/', $data['qty'])) {
            $errors['qty'] = 'Only digits are not allowed!';
        }

        if (empty($data['amount'])) {
            $errors['amount'] = 'Sale price is required!';
        } elseif (!preg_match('/^[0-9.]+$/', $data['amount'])) {
            $errors['amount'] = 'Only numbers are allowed!';
        }

        return $errors;
    }
}