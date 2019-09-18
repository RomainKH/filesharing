<?php

include 'setup.php';

$to = $_POST['destination__mail'];
$subject = 'Vos fichiers sont disponibles !';
$content = str_replace('"', '',json_encode(htmlentities($_POST['message__mail'])));
$url = str_replace('\\', '',str_replace('"', '',json_encode($_POST['url'])));

$txt = '
<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
    <head>
        <meta charset="utf-8"><meta name="viewport" content="width=device-width">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="x-apple-disable-message-reformatting">
        <title>Téléchargez vos fichiers !</title>
    </head>
    <body width="100%" style="margin: 0; padding: 0 !important; background-color: #F2F8FA;">
        <main style="width: 100%; background-color: #F2F8FA;">
            <div style="max-width: 600px; margin: 5vh auto 0;" class="email-container">
            <table role="presentation" cellspacing="0" cellpadding="0" width="100%" style="margin: auto;">
            <tbody>
            <tr>
            <td class="bg_white" style="padding: 1em 2.5em; text-align: center">
            <h1><a style="color:#000" href="'.$domain.'">File Sharing Tool</a></h1>
            </td>
            </tr>
            <tr>
            <td valign="middle" class="hero" style="background: rgba(14, 160, 208, 0.523); background-size: cover; height: 500px;">
            <table>
            <tbody><tr><td><div class="text" style="padding: 0 3em; text-align: center;">
            <h2>Quelqu&apos;un vous a partagé des fichiers !</h2>
            <br/>
            <p>'.$content.'</p>
            <br/>
            <a href="'.$url.'" class="btn btn-primary">Download</a>
            </div>
            </td>
            </tr>
            </tbody>
            </table>
            </td>
            </tr>
            <table role="presentation" cellspacing="0" cellpadding="0" width="100%">
            </table>
            </div>
        </main>
    </body>
</html>
';
$headers = "MIME-Version: 1.0" . "\r\n"; 
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

$headers .= 'From: File Sharing Tool'.'<'.'noreply@filesharing.tool'.'>';
mail($to,$subject,$txt,$headers);