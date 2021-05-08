<?php
session_start();
if(isset($_POST['nl-submit'])){
    $_SESSION['email']=strtolower($_POST['nl-email']);
    header('Location:/#newsletter');
    exit;
};
if(isset($_SESSION['email'])){
    echo 'a';
    $email=$_SESSION['email'];
    if(!empty($email) and filter_var($email, FILTER_VALIDATE_EMAIL)){
        $headers='Content-type: text/html; charset=utf-8'.'\r\n'.
        'Return-Path: ptitipsfr@gmail.com'.'\r\n'.
        'Reply-To: ptitipsfr@gmail.com'.'\r\n'.
        'Errors-To: ptitipsfr@gmail.com'.'\r\n'.
        "To: {$email}".'\r\n'.
        'From: ptitipsfr@gmail.com';
        mail($email,"Merci de t'être inscrit...",'hello',$headers);
        // add email to database and change special chars to &;
        echo '<script>alert("a verification email have been sent to {$email}.");</script>';
    }
    else{
        echo("<script>alert('empty');</script>");
    };
    unset($_SESSION['email']);
}
?>