<?php
session_start();

$filename = 'messages.json';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $message = $_POST['message'];
    if (!empty($message)) {
        $messages = json_decode(file_get_contents($filename), true);
        $messages[] = ['message' => $message, 'time' => date('Y-m-d H:i:s')];
        file_put_contents($filename, json_encode($messages));
    }
    exit;
}

// GET messages
if (file_exists($filename)) {
    $messages = json_decode(file_get_contents($filename), true);
    foreach ($messages as $msg) {
        echo "<div class='message'><strong>{$msg['time']}:</strong> {$msg['message']}</div>";
    }
}
?>
