<?php
    
session_start();
$connect = new mysqli("localhost","root","","quanlydathang");

if(!empty($_SESSION['username']))
{
    echo"<script>alert(`Đã đăng nhập rồi`)</script>";
    echo"<script>window.location='admin.php'</script>";
}

if(isset($_POST['login'])){
    $username   = addslashes($_POST['username']);
    $password   = addslashes($_POST['password']);
    $query = "SELECT MSNV, password FROM nhanvien WHERE MSNV='$username'";
    $result_login=mysqli_query($connect,$query);
    $data = mysqli_fetch_array($result_login);
    if (mysqli_num_rows($result_login) == 0) {
        echo"<script>alert(`Tài khoản không tồn tại`)</script>";
        echo"<script>window.location='login.php' </script>";
    }
    if($password != $data['password']){
        echo"<script>alert(`Sai mật khẩu`)</script>";
        echo"<script>window.location='login.php' </script>";
    }
    else{
    $_SESSION['username'] = $username;
    $_SESSION['password'] = $password;
    echo"<script>window.location='admin.php'</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="wrapper">
        <h1>Muc Store's Admin Login</h1>
        <form class="login_menu" id="login_form" method="POST" action="login.php">
            <input type="text" id="username" name="username"><br>
            <input type="text" id="password" name="password"><br>
            <button type="submit" name="login">Login</button>
        </form>
    </div>
    <script>
        function loginValidation(){
            let usr = document.getElementById("username").value;
            let pwd = document.getElementById("password").value;
            let err ="";
            if(usr.length<=0){
                error="Vui lòng điền tên đăng nhập";
            }
            if(error!=""){
                alert(error);
                return false;   
            }
        }
        document.getElementById('login_form').onsubmit = function(e) {
            return loginValidation();
        };
    </script>
</body>
</html>