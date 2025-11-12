<?php
// r.php - simple affiliate redirect & click logger
// Usage: /r.php?to=https%3A%2F%2Fwww.merchant.com%2Fproduct%2F1
$to = isset($_GET['to']) ? $_GET['to'] : '';
if ($to && filter_var($to, FILTER_VALIDATE_URL)) {
    // OPTIONAL: append affiliate id or tracking parameters here if your affiliate network requires it.
    // Example (pseudo): if (strpos($to, 'aff_id=')===false) { $to .= (strpos($to,'?')===false ? '?' : '&') . 'aff_id=YOUR_AFFILIATE_ID'; }

    // Log click (very simple file log). For production use DB or proper logging.
    $logline = date('c') . " " . $_SERVER['REMOTE_ADDR'] . " -> " . $to . PHP_EOL;
    @file_put_contents(__DIR__ . '/clicks.log', $logline, FILE_APPEND);

    header("Location: $to");
    exit;
}
http_response_code(400);
echo "Bad request";
?>