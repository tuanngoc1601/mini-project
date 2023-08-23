<?php

class Validation {
    public static function validateProductName($productName) {
        $namePattern = '/^[a-zA-Z0-9\s]{1,255}$/';
        return preg_match($namePattern, $productName);
    }

    public static function validateProductPrice($productPrice) {
        return is_numeric($productPrice) && floatval($productPrice) >= 0;
    }
}