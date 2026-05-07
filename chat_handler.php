<?php
// This file handles the "Human-like" thinking
header('Content-Type: application/json');

$userInput = json_decode(file_get_contents('php://input'), true)['message'];

// 1. YOUR SALON DATA (This is what the AI "knows")
$salon_info = "You are the AI for Garenda Salon. Services: Charcoal Facial (₱500), Hair Spa, etc. Location: Getafe, Bohol. Policy: 24hr reschedule notice. Be helpful and friendly.";

// 2. THE API CALL (Example using a generic AI endpoint)
$apiKey = "YOUR_API_KEY_HERE";
$url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent?key=" . $apiKey;

$data = [
    "contents" => [[
        "parts" => [[
            "text" => "Context: $salon_info \n\n Customer says: $userInput"
        ]]
    ]]
];

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);

$response = curl_exec($ch);
$result = json_decode($response, true);

// Get the text from the AI's "thought"
$aiResponse = $result['candidates'][0]['content']['parts'][0]['text'] ?? "I'm a bit busy at the salon, can you try asking again?";

echo json_encode(['reply' => $aiResponse]);
?>