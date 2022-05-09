<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./styles/admin.css">
</head>
<?php
    session_start();
    $conn = new mysqli("localhost","root","","quanlydathang");
    $username = $_SESSION['username'];
    $userdisplayname = "Defaul User";
    if(isset($_SESSION['username']) && $_SESSION['username']){
        $query = "SELECT HoTenNhanVien FROM nhanvien WHERE MSNV='$username'";
        $result = $conn->query($query);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $userdisplayname = $row["HoTenNhanVien"];
            }
        }
    }
    else{
    echo"<script>alert(`Vui lòng đăng nhập`)</script>";
    echo"<script>window.location='login.php' </script>";
    }

    if(isset($_POST['logout'])){
        $_SESSION['username'] = "";
        $_SESSION['password'] = "";
        echo"<script>window.location='login.php'</script>";
    }

    if(isset($_GET['create'])){
        if($_SESSION['created'])
        {
            $itemName = addslashes($_GET['itemname']);
            $itemDes = addslashes($_GET['itemdes']);
            $itemCost = addslashes($_GET['itemcost']);
            $itemQuan = addslashes($_GET['itemquan']);
            $itemNote = addslashes($_GET['itemnote']);
    
            $sql = "INSERT INTO hanghoa (TenHH, MoTaHH, Gia, SoLuongHang, GhiChu) VALUES ('$itemName', '$itemDes','$itemCost', '$itemQuan', '$itemNote')";
            // $result = $conn->query($sql);
            $result_login=mysqli_query($conn,$sql);
        }
    }
?>
<body>
    <div class="top-bar">
        <div class="top-bar-item">Hello <?php echo $userdisplayname; ?></div>
        <form class="login_menu top-bar-item" id="login_form" method="POST" action="admin.php">
            <button class="logout" name="logout">Logout</p>
        </form>
    </div>
    <div class="contents">
        <div class="left-contents">
            <div class="left-content">Employee</div>
            <div class="left-content">Items</div>
        </div>
        <div class="right-contents">
            <div class="items">
                <?php
                function GetImageName($MSHH)
                {
                    $conn = new mysqli("localhost", "root", "", "quanlydathang");
                    $sql = "SELECT TenHinh FROM hinhhh WHERE MSHH = ".$MSHH;
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        // output data of each row
                        while($row = $result->fetch_assoc()) {
                        return $row["TenHinh"];
                        }
                    }
                    $conn->close();
                }
                function InitRender()
                {
                    $conn = new mysqli("localhost", "root", "", "quanlydathang");
                    $sql = "SELECT MSHH, TenHH, Gia, SoLuongHang FROM hanghoa";
                    $result = $conn->query($sql);
                    
                    if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo 
                        '<div class="item">
                            <img src="./images/'.GetImageName($row["MSHH"]).'.jpg"/>
                            <p style="margin: 0;">'.$row["TenHH"].'</p>
                            <p style="margin: 0;">'.$row["Gia"].'$ / '.$row["SoLuongHang"].' Remain</p>
                            <p class="add-button" onclick="hello('.$row["MSHH"].')">Update</p>
                            <p class="add-button" onclick="hello('.$row["MSHH"].')">Delete</p>
                        </div>';
                    }
                    } else {
                    echo "0 results";
                    }
                    $conn->close();
                }
                InitRender();
                ?>
            </div>
        </div>
    </div>
    <div class="float-button">
        Add
    </div>
    <div class="float-form">
        <form class="create-item-form" id="create_form" action="admin.php" method="GET">
            <h2>CREATE NEW ITEM</h2>
            <label for="itemname">Item name</label>
            <input type="text" id="itemname" name="itemname"></input>
            <label for="itemdes">Item description</label>
            <input type="text" id="itemdes" name="itemdes"></input>
            <label for="itemcost">Item cost</label>
            <input type="text" id="itemcost" name="itemcost"></input>
            <label for="itemquan">Item quantity</label>
            <input type="text" id="itemquan" name="itemquan"></input>
            <label for="itemnote">Item note</label>
            <input type="text" id="itemnote" name="itemnote"></input>
            <button type="submit" name="create">CREATE</button>
        </form>
    </div>
</body>
<script>
        function createValidation(){
            // let usr = document.getElementById("username").value;
            // let pwd = document.getElementById("password").value;
            // let err ="";
            // if(usr.length<=0){
            //     error="Vui lòng điền tên đăng nhập";
            // }
            // if(error!=""){
            //     alert(error);
            //     return false;   
            // }
            // else
            // alert("Submit called");
            // 
            // $connect = new mysqli("localhost","root","","quanlydathang");
            // $sql = 'INSERT INTO hanghoa (TenHH, MoTaHH, Gia, SoLuongHang, GhiChu) VALUES ('.$_GET['itemname'].', '.$_GET['itemdes'].','.$_GET['itemcost'].', '.$_GET['itemquan'].', '.$_GET['itemnote'].')';
            // $result = $conn->query($sql);
            // 
        }
        document.getElementById('create_form').onsubmit = function(e) {
            // alert("Submit");
            <?php
                $_SESSION['created'] = true;
            ?>
            return createValidation();
        };
    </script>
</html>