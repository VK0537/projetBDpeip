<?php
// // switch($_SERVER['REQUEST_METHOD']){
// //     case 'GET':  $email=$_GET['email-nl'];
// //     case 'POST': $email=$_POST['email-nl'];
// // }
// if(isset($_POST['submit-nl'])){
//     $email=strtolower($_POST['email-nl']);
//     if(filter_var($email,FILTER_VALIDATE_EMAIL)){
//         $headers="Content-type: text/html; charset=utf-8"."\r\n".
//         "Return-Path: root@localhost.com"."\r\n".
//         "Reply-To: root@localhost.com"."\r\n".
//         "Errors-To: root@localhost.com"."\r\n".
//         "To: $email"."\r\n".
//         "From: root@localhost.com";
//         mail($email,"Merci de t'être inscrit...","blablabla",$headers);
//         // add email to database
//         echo "<script>alert('a verification email have been sent to $email.');</script>";
//     }else{
//         echo "<script>alert('bad email format');</script>";
//     }
// }
?>

<?php
// switch($_SERVER['REQUEST_METHOD']){
//     case 'GET':  $email=$_GET['email-nl'];
//     case 'POST': $email=$_POST['email-nl'];
// }
// echo("<p>{$_POST['submit-nl']}</p>");
if(isset($_POST['submit-nl'])){
    echo("<p>{$_POST['submit-nl']}</p>");
    $email=strtolower($_POST['email-nl']);
    if(filter_var($email,FILTER_VALIDATE_EMAIL)){
        $headers="Content-type: text/html; charset=utf-8"."\r\n".
        "Return-Path: root@localhost.com"."\r\n".
        "Reply-To: root@localhost.com"."\r\n".
        "Errors-To: root@localhost.com"."\r\n".
        "To: $email"."\r\n".
        "From: root@localhost.com";
        mail($email,"Merci de t'être inscrit...","hello",$headers);
        // add email to database
        // echo("<script>alert('a verification email have been sent to $email.');</script>");
        echo("<p>a</p>");
    }else{
        // echo("<script>alert('bad email format');</script>");
        echo("<p>b</p>");
    };
    unset($_POST['submit-nl']);
    echo("<p>{$_POST['submit-nl']}</p>");
}
?>