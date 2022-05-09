<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./styles/index.css">
</head>
<script type="text/javascript">
    function hello(m_string)
    {
        alert (m_string);
    }
    function MoveToLogin()
    {
        window.location='login.php';
    }
    function MoveToCart()
    {
        window.location='cart.php';
    }
    function MoveToAboutUs()
    {
        window.location='aboutus.php';
    }
</script>
<body class="flex-box">
    <div class="top-bar">
        <div><img class="logo" src="./images/source/Logo.png" /></div>
        <div class="nav-element">
            Home Page
        </div>
        <div class="nav-element" onclick="MoveToAboutUs()">
            About Us
        </div>
        <div class="nav-element" onclick="MoveToCart()">
            Cart
        </div>
        <div class="nav-element log" onclick="MoveToLogin()">
            Staff side
        </div>
    </div>
    <div class="content">
        <div class="banner">
            <p style="font-size: 30px; color: white">About Mực Store</p>
            <br/>
            <p>Adipiscing elit pellentesque habitant morbi. Vel elit scelerisque mauris pellentesque pulvinar. Elit at imperdiet dui accumsan. Lobortis mattis aliquam faucibus purus in massa. Vestibulum sed arcu non odio. Eu ultrices vitae auctor eu. Bibendum ut tristique et egestas quis ipsum suspendisse ultrices.</p>
            <br/>
            <p>Velit egestas dui id ornare arcu odio ut sem. Montes nascetur ridiculus mus mauris vitae ultricies. Vitae ultricies leo integer malesuada nunc vel risus commodo. Faucibus in ornare quam viverra orci sagittis. Fermentum iaculis eu non diam phasellus vestibulum lorem. Netus et malesuada fames ac turpis egestas maecenas pharetra. Etiam sit amet nisl purus in mollis nunc sed id. Eu turpis egestas pretium aenean. Amet mauris commodo quis imperdiet. Eget magna fermentum iaculis eu non diam phasellus vestibulum lorem. Nibh sed pulvinar proin gravida hendrerit lectus. Cursus mattis molestie a iaculis at erat pellentesque adipiscing. Id ornare arcu odio ut sem nulla. Orci phasellus egestas tellus rutrum tellus pellentesque eu tincidunt. Metus dictum at tempor commodo ullamcorper a lacus.</p>
        </div>
        <div class="items">
        <?php
            function GetImageName($MSHH)
            {
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "quanlydathang";
                // Create connection
                $conn = new mysqli($servername, $username, $password, $dbname);
                // Check connection
                if ($conn->connect_error) 
                {
                    die("Connection failed: " . $conn->connect_error);
                }
                
                $sql = "SELECT TenHinh FROM hinhhh WHERE MSHH = ".$MSHH;
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // output data of each row
                    while($row = $result->fetch_assoc()) {
                      return $row["TenHinh"];
                    }
                } else {
                    echo "0 results";
                }
                $conn->close();
            }
            function InitRender()
            {
                $conn = new mysqli("localhost", "root", "", "quanlydathang");
                $sql = "SELECT MSHH, TenHH, Gia FROM hanghoa";
                $result = $conn->query($sql);
                
                if ($result->num_rows > 0) {
                  while($row = $result->fetch_assoc()) {
                    echo 
                    '<div class="item">
                      <img src="./images/'.GetImageName($row["MSHH"]).'.jpg"/>
                        <p>'.$row["TenHH"].'</p>
                        <p>'.$row["Gia"].'$</p>
                        <p class="add-button" onclick="hello('.$row["MSHH"].')">Add to cart</p>
                    </div>';
                  }
                } else {
                  echo "0 results";
                }
            }
            InitRender();
        ?>
        </div>
    </div>
</body>
</html>