<?php
require 'functions.php';
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
}

// if ($_SESSION['type_user'] === 'Staff') {
//     echo 'Akses Diblock Silahkan Hubungi Admin';
//     die;
// }

$custName = queryAll("SELECT DISTINCT RESPONSIBILITY FROM `tiket_tabel` ORDER BY RESPONSIBILITY ASC");

$actionDate = queryAll("SELECT DISTINCT ACTION_DATE FROM tiket_tabel");
$status = queryAll("SELECT DISTINCT STATUS FROM tiket_tabel");

$regionals = queryAll("SELECT DISTINCT kota_tabel.REGIONAL FROM `tiket_tabel` INNER JOIN kota_tabel ON tiket_tabel.DEST_CODE = kota_tabel.KOTA_ID ORDER BY REGIONAL ASC");



if (isset($_POST['import-activities'])) {
    $file = importActivites($_FILES);
}



?>

<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report | BOSS</title>
    <script src="https://kit.fontawesome.com/3e0bda294c.js" crossorigin="anonymous"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#4C70FF',
                    }
                }
            }
        }
    </script>

<body>
    <div class="main bg-[#EEEFF0] relative">
        <div class="w-full h-full">
            <!-- Side Bar -->
            <?php include('templates/Sidebar.php'); ?>
            <!-- End Sidebar -->
            <div class="lg:ml-[200px] lg:w-[calc(100vw-230px)]">
                <div class="min-h-[calc(100vh)] px-4 lg:px-10 py-5">
                    <form action="export/export-all.php" method="POST">
                        <div class="mt-[80px] lg:mt-2 mb-[15px] flex flex-warp justify-between">
                            <div class="flex flex-wrap">
                                <div class="">
                                    <img src="img/Dashboard Icon.png" alt="Dashboard" class="mr-2 inline-block">
                                </div>
                                <div class="">
                                    <span class="text-[40px] font-bold font-exo  text-[#0F56B3]">Report Management
                                    </span>
                                </div>
                            </div>
                            <div class="flex flex-warp">
                                <div class=" font-semibold text-[#0F56B3]">
                                    <p><b><span id="date_time"></span></b></p>
                                </div>
                                <div class="ml-4 hidden lg:block">
                                    <i class="fa-solid fa-bell text-3xl hover:text-primary"></i>
                                </div>
                                <div class="ml-4 hidden lg:block">
                                    <a href="logout.php" class="hover:text-red-500">
                                        <i class="fa-solid fa-power-off flex justify-center"></i>
                                        <p class="mb-2">Logout</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="bg-white grid gap-4 p-4 mb-4 grid-cols-1 md:grid-cols-2 lg:grid-cols-6">
                            <Select class="w-full h-[50px] p-3 border-2  rounded-lg my-auto mb-2 md:mr-5" name="input-customer" id="input-customer">
                                <option class="" value="">Responsibilty</option>
                                <?php foreach ($custName as $cName) : ?>
                                    <option class="" value="<?= $cName['RESPONSIBILITY'] ?>"><?= $cName['RESPONSIBILITY'] ?></option>
                                <?php endforeach; ?>
                            </Select>

                            <Select class="w-full h-[50px] p-3 border-2  rounded-lg my-auto mb-2 md:mr-5" name="input-status" id="input-status">
                                <option class="" value="" selected>Ticket Status</option>
                                <?php foreach ($status as $stat) : ?>
                                    <option class="" value="<?= $stat['STATUS'] ?>"><?= $stat['STATUS'] ?></option>
                                <?php endforeach; ?>
                            </Select>

                            <Select class="w-full h-[50px] p-3 border-2  rounded-lg my-auto mb-2 md:mr-5" name="input-regional" id="input-regional">
                                <option class="" value="" selected>Regional</option>
                                <?php foreach ($regionals as $reg) : ?>
                                    <option class="" value="<?= $reg['REGIONAL'] ?>"><?= $reg['REGIONAL'] ?></option>
                                <?php endforeach; ?>
                            </Select>

                            <Select class=" w-full h-[50px] p-3 border-2 rounded-lg my-auto mb-2 md:mr-5" name="input-action" id="input-action">
                                <option class="" value="" selected>Action Day</option>
                                <?php foreach ($actionDate as $adate) : ?>
                                    <option class="" value="<?= $adate['ACTION_DATE'] ?>"><?= $adate['ACTION_DATE'] ?></option>
                                <?php endforeach; ?>
                            </Select>
                            <input type="date" class="w-full h-[50px] p-3  rounded-lg my-auto border-2 mb-2" name="input-date-start" id="input-date-start" value="<?= date('Y-m-d', strtotime('-1 weeks')) ?>">
                            <input type="date" name="input-date-end" class="w-full h-[50px] p-3  rounded-lg my-auto border-2 mb-2" id="input-date-end" value="<?= date('Y-m-d') ?>">
                        </div>

                        <div class="bg-white h-full mt-6 rounded-md p-10 relative">
                            <div class="flex mb-7">
                                <div class="flex cursor-pointer mr-3">
                                    <span class="text-[#9C9C9C] font-inter text-[11px]
                                hover:text-black mr-2" id="btn-report-detail">REPORT DATA DETAIL</span>
                                </div>
                                <div class="flex cursor-pointer">
                                    <span class="mr-2 text-[#9C9C9C] font-inter text-[11px]
                                hover:text-black" id="btn-report-product">REPORT PRODUCTIVITY</span>
                                </div>
                            </div>
                            <div class="flex justify-between flex-wrap mb-4">
                                <div class="flex items-end">
                                    <input type="text" id="inputSearch" name="input-search" placeholder="Search Detail" class="p-2 border-2  h-[34px]    lg:w-[264px] rounded-md">
                                    <input type="text" id="inputSearchTeam" name="inputSearch" placeholder="Search Team" class="p-2 border-2  h-[34px]    lg:w-[264px] rounded-md hidden">
                                </div>
                                <div class="m-4">
                                    <button type="button" id="action" name="action" type="button" class="h-8 w-[202px] round-lg p-1 font-semibold border border-slate-500 text-slate-500 rounded-lg">Download</button>
                                    <nav id="action-menu" class="hidden absolute py-5 bg-white shadow-lg rounded-lg max-w-[250px] w-full right-4 top-13">
                                        <ul class="block">
                                            <li class="group">
                                                <button type="submit" class="text-base font-semibold text-slate-800 py-2 mx-8 flex group-hover:text-primary" id="download-all">Download All Pages</button>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                                <div id="ticketing-table-report" class="w-full mt-6">
                                </div>
                            </div>
                            <div class="flex jml-data justify-center">
                                <div class="flex">
                                    <p class="mt-5 flex items-center">Show</p>
                                    <Select class="w-[70px] h-[40px] p-1 border-2  rounded-lg my-auto mx-5 mt-5" id="input-data" name="input-data">
                                        <option class="" value="8">8</option>
                                        <option class="" value="15">15</option>
                                        <option class="" value="30">30</option>
                                        <option class="" value="50">50</option>
                                        <option class="" value="100">100</option>
                                        <option class="" value="500">500</option>
                                    </Select>
                                    <p class="mt-5 flex items-center">Per Page</p>
                                </div>
                            </div>

                    </form>
                </div>

            </div>
        </div>

</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<!-- <script src="js/script-all.js"></script> -->
<script src="js/Report2.js"></script>
<script type="text/javascript" src="js/datetime6.js"></script>
<script type="text/javascript">
    window.onload = date_time('date_time');
</script>

</html>