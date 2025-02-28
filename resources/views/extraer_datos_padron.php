<?php

function base32Decode($input) {
    $alphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ234567';
    $input = strtoupper($input);
    $output = '';
    $buffer = 0;
    $bitsLeft = 0;

    foreach (str_split($input) as $char) {
        if ($char === '=') break;
        $buffer = ($buffer << 5) | strpos($alphabet, $char);
        $bitsLeft += 5;
        if ($bitsLeft >= 8) {
            $output .= chr(($buffer >> ($bitsLeft - 8)) & 0xFF);
            $bitsLeft -= 8;
        }
    }

    return $output;
}

function generateOTP($secret, $timestamp, $digits = 10, $interval = 120) {
    $counter = floor($timestamp / $interval);
    $key = base32Decode($secret);
    $counterBin = pack('N*', 0) . pack('N*', $counter);
    $hash = hash_hmac('sha1', $counterBin, $key, true);
    
    $offset = ord($hash[strlen($hash) - 1]) & 0x0F;
    $otp = (
        ((ord($hash[$offset]) & 0x7F) << 24) |
        ((ord($hash[$offset + 1]) & 0xFF) << 16) |
        ((ord($hash[$offset + 2]) & 0xFF) << 8) |
        (ord($hash[$offset + 3]) & 0xFF)
    ) % pow(10, $digits);

    return str_pad($otp, $digits, '0', STR_PAD_LEFT);
}

// Valores obtenidos del JS

// Secreto en Base32
$inicioCod = "INQWIQZQNZZXINDOOQZQ===="; 
// Simulamos la fecha del servidor
$timestamp = time(); 
// Intervalo de tiempo
$interval = 120; 

$cod_verif = generateOTP($inicioCod, $timestamp, 10, $interval);
//echo "cod_verif: " . $cod_verif;




$url = "https://swyoparticipo.oep.org.bo/api/v1//persona";

// Datos que se envian en la solicitud
$data = [
    "docidentidad" => "3899963",
    "fechanac" => "08/10/1973",
    "cod_verif" => "$cod_verif"
];

// Convertir el array a JSON
$jsonData = json_encode($data);

// Inicializar cURL
$ch = curl_init($url);

// Configurar las opciones de cURL
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Content-Type: application/json",
    "Accept: application/json",
    "Origin: https://yoparticipo.oep.org.bo",
    "Referer: https://yoparticipo.oep.org.bo/"
]);

// Ejecutar la solicitud y obtener la respuesta
$response = curl_exec($ch);

// Verificar si hubo errores
if (curl_errno($ch)) {
    echo "Error en cURL: " . curl_error($ch);
}

// Cerrar cURL
curl_close($ch);

// Mostrar la respuesta
echo $response;
?>
