<?php
function encryptData($rawData){
    if (!defined('ENCRYPTION_KEY')) {
        die("Kunci enkripsi belum didefinisikan.");
    }
    $secret_key = ENCRYPTION_KEY;
    $cipher = ENCRYPTION_CIPHER;
    $iv_length = openssl_cipher_iv_length($cipher);
    $iv = openssl_random_pseudo_bytes($iv_length);
    $encrypted_data = openssl_encrypt($rawData, $cipher, $secret_key, 0, $iv);
    $output = base64_encode($iv . $encrypted_data);
    return $output;
}

function decryptData($encryptedData) {
    if (!defined('ENCRYPTION_KEY')) {
        die("Kunci enkripsi belum didefinisikan.");
    }
    $secret_key = ENCRYPTION_KEY;
    $cipher = ENCRYPTION_CIPHER;
    $data_binary = base64_decode($encryptedData);
    if ($data_binary === false) {
        return false;
    }
    $iv_length = openssl_cipher_iv_length($cipher);
    if (strlen($data_binary) < $iv_length) {
        return false;
    }
    $iv = substr($data_binary, 0, $iv_length);
    $encrypted_data = substr($data_binary, $iv_length);
    $decrypted_data = openssl_decrypt($encrypted_data, $cipher, $secret_key, 0, $iv);
    return $decrypted_data;
}
?>