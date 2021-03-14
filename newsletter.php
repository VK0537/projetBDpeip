<?php
session_start();
if(isset($_POST['nl-submit'])){
    $_SESSION['email']=strtolower($_POST['nl-email']);
    header('Location:index.html#newsletter');
    exit;
};
if(isset($_SESSION['email'])){
    $email=$_SESSION['email'];
    if(!empty($email)){
        $headers="Content-type: text/html; charset=utf-8"."\r\n".
        "Return-Path: root@localhost.com"."\r\n".
        "Reply-To: root@localhost.com"."\r\n".
        "Errors-To: root@localhost.com"."\r\n".
        "To: {$email}"."\r\n".
        "From: root@localhost.com";
        mail($email,"Merci de t'être inscrit...","hello",$headers);
        // add email to database
        // echo("<script>alert('a verification email have been sent to $email.');</script>");
    }
    // else{
    //     echo("<script>alert('empty');</script>");
    // };
    unset($_SESSION['email']);
}
?>