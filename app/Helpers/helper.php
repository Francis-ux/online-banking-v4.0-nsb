<?php

use App\Models\User;
use Illuminate\Support\Facades\Http;

function getAccountNumber()
{
    $fixedPrefix = "300";

    // Generate random 7-digit suffix
    $suffix = rand(0, 9999999);
    $suffix = str_pad($suffix, 7, '0', STR_PAD_LEFT);

    // Concatenate prefix and suffix to form the account number
    $accountNumber = $fixedPrefix . $suffix;

    return $accountNumber;
}
function generateTransferCode($length, $isAlphanumeric = true)
{
    // Define the character set based on the code type
    if ($isAlphanumeric) {
        // If the code type is alphanumeric
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    } else {
        // If the code type is numeric only
        $characters = '0123456789';
    }

    // Define an empty string to store the generated code
    $code = '';

    // Calculate the length of the character set
    $charLength = strlen($characters);

    // Generate the code by selecting random characters from the character set
    for ($i = 0; $i < $length; $i++) {
        // Select a random index within the character set
        $randomIndex = rand(0, $charLength - 1);

        // Get the character at the random index from the character set
        $randomCharacter = $characters[$randomIndex];

        // Append the random character to the code string
        $code .= $randomCharacter;
    }

    return $code;
}
function getMaskedAccountNumber($accountNumber)
{
    // Pad the asterisks with the account number and return the masked account number
    return str_pad(substr($accountNumber, 0, 3) . str_repeat('*', 5) . substr($accountNumber, -4), strlen($accountNumber), "*", STR_PAD_LEFT);
    // return str_pad(substr($accountNumber, -5), strlen($accountNumber), "*", STR_PAD_LEFT);
}
function getRandomNumber($length = 2)
{
    // Define the characters to be used in the random number
    $characters = '0123456789';
    // Initialize an empty string to store the random number
    $randomNumber = '';
    // Loop to generate each digit of the random number
    for ($i = 0; $i < $length; $i++) {
        // Append a random digit to the random number
        $randomNumber .= $characters[rand(0, strlen($characters) - 1)];
    }
    // Return the generated random number
    return $randomNumber;
}
function getRegistrationToken($bankName)
{
    // Explode the bank name into an array of words
    $words = explode(" ", $bankName);
    // Initialize an empty string to store the acronym
    $acronym = '';
    // Loop through each word to extract the first letter and concatenate it to the acronym
    foreach ($words as $word) {
        // Convert the first letter to uppercase and append it to the acronym
        $acronym .= strtoupper(substr($word, 0, 1));
    }

    // Appending a random number
    // Call the generateRandomNumber function to get a random number
    $randomNumber = getRandomNumber();
    // Concatenate the acronym and the random number with a hyphen
    $result = $acronym . '-' . $randomNumber;

    return $result;
}
function currency($currency, $type = 'symbol')
{

    $explodeCurrency = explode('-', $currency);

    switch ($type) {
        case 'name':
            return $explodeCurrency[0];
            break;
        case 'code':
            return $explodeCurrency[1];
        case 'symbol':
            return $explodeCurrency[2];
        default:
            return $explodeCurrency[2];
            break;
    }
}

function formatAmount($amount)
{
    return number_format($amount, 2);
}

function getUserCountry()
{
    $ip = request()->ip() === '127.0.0.1' || request()->ip() === '::1' ? '8.8.8.8' : request()->ip();

    $response = Http::get("http://ip-api.com/json/{$ip}");

    if ($response->successful()) {
        $data = $response->json();
        return $data['country'] ?? 'Unknown';
    }

    return 'Unknown';
}

function getUserCountryTest($testIp = null)
{
    // Use the test IP if provided; otherwise, get the user's IP
    $ip = $testIp ?? (request()->ip() === '127.0.0.1' || request()->ip() === '::1' ? '8.8.8.8' : request()->ip());

    $response = Http::get("http://ip-api.com/json/{$ip}");

    if ($response->successful()) {
        $data = $response->json();
        return $data['country'] ?? 'Unknown';
    }

    return 'Unknown';
}

