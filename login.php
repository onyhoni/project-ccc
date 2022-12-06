<?php
require 'functions.php';

if (isset($_SESSION['user'])) {
    header('Location: index.php');
}

if (isset($_POST['login'])) {

    $error = login($_POST);
}
?>



<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | CT BOSS</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Exo:wght@400;600;800&family=Inter:wght@300;500;600;700;800;900&family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/style.css">
</head>

<body class="relative">
    <div class="main grid grid-cols-1 md:grid-cols-2">
        <div class="w-full rounded-l-2xl my-5">
            <div class="text-center">
                <p class="text-6xl  text-[#A3C7EB] font-bold font-exo">Welcome ... </p>
                <img class="inline-block" src="img/1.png" alt="Login">
                <p class="text-[32px] font-bold text-[#0097DA] mt-5 font-inter">CORPORATE CARE CENTER
                </p>
                <p class="text-[24px] font-bold text-[#0B2D50] font-inter">TICKETING DASHBOARD</p>
            </div>
        </div>
        <form action="" method="post">
            <div class="w-full bg-white rounded-r-2xl text-center font-roboto">
                <div>
                    <p class="mt-4 md:mt-24 text-[22px] font-bold text-[#0B2D50]">Log In
                    <p>
                    <p class="mt-[13px] text-[16px] text-[#7B809A]">Enter your email and password to Log in
                    <p>
                </div>
                <?php if (isset($error)) : ?>
                    <p style="color: red;">Username/ Password Salah</p>
                <?php endif; ?>
                <div>
                    <input class="w-[361px] h-[42px] p-3 border-2 mt-6" type="text" name="username" id="username" placeholder="Username">
                </div>
                <div>
                    <input class="w-[361px] h-[42px] p-3 border-2 mt-[14px] rounded-lg" type="password" name="password" id="password" placeholder="Current password">
                </div>
                <div class="mt-7 ml-4 inline-block -translate-x-3/4">
                    <div class="flex">
                        <input type="checkbox" id="toggle" hidden>
                        <label for="toggle" class="mt-1">
                            <div class="w-9 h-5 bg-[#C7CCD0] rounded-full flex items-center p-1 cursor-pointer">
                                <div class="w-4 h-4 bg-white rounded-full toggle-circel"></div>
                            </div>
                        </label>
                        <label for="toggle">
                            <div class="ml-2">Remember me</div>
                        </label>
                    </div>
                </div>
                <div>
                    <button type="submit" name="login" id="login" class="w-[361px] h-[40px] border-2 mt-[42px] rounded-lg bg-[#0097DA] text-white text-[12px]">Log In</button>
                </div>

            </div>
        </form>
    </div>
    <div class="font-bold text-sm text-center mt-5">
        <p>Copyright 2022 - Corporate Care Center Dept. All Rights Reserved</p>
    </div>
</body>

</html>