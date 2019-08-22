<?php

if(isset($_POST)) {
    $from = $_POST['ur__mail'];

    $to = $_POST['destination__mail'];
    $subject = 'Innocean File Sharing';
    $txt = $_POST['message__mail'];
    $headers = "From: $from";

    mail($to,$subject,$txt,$headers);
} else {
    echo 'not working';
}
