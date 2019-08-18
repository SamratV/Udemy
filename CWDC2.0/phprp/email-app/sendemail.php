<?php
  $to      = $_GET['to'];
  $subject = $_GET['subject'];
  $message = $_GET['message'];
  $headers = 'From: '.$_GET['from'] . "\r\n" .
    'Reply-To: '.$_GET['from']. "\r\n" .
    'X-Mailer: PHP/' . phpversion();
  $result = array();
  $result['success'] = mail($to, $subject, $message, $headers);
  $fp = fopen('results.json', 'w');
  fwrite($fp, json_encode($result));
  fclose($fp);
?>