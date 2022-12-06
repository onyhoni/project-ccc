<?php
require 'functions.php';
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
}

$custName = queryAll("SELECT DISTINCT RESPONSIBILITY FROM `tiket_tabel` ORDER BY RESPONSIBILITY ASC");

$actionDate = queryAll("SELECT DISTINCT ACTION_DATE FROM tiket_tabel");
$status = queryAll("SELECT DISTINCT STATUS FROM tiket_tabel");
$regionals = queryAll("SELECT DISTINCT kota_tabel.REGIONAL FROM `tiket_tabel` INNER JOIN kota_tabel ON tiket_tabel.DEST_CODE = kota_tabel.KOTA_ID ORDER BY REGIONAL ASC");

if (isset($_POST['import-activities'])) {
    $file = importActivites($_FILES);
}

if (isset($_POST['import-bl'])) {
    if (importBL($_FILES) > 0) {
        echo "<script>
            alert('Data Berhasil Diupload');
        </script>";
    } else {
        echo "<script>
            alert('Data Gagal Diupload');
        </script>";
    }
}


if (isset($file)) {
    foreach ($file as $files) {
        $HasilStatus[] = $files['status'];
    }
    $HasilStatus = array_count_values($HasilStatus);
}






?>

<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Activities | BOSS</title>
    <script src="https://kit.fontawesome.com/3e0bda294c.js" crossorigin="anonymous"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#4C70FF',
                        second: '#E5EBF4',
                    },
                    fontFamily: {
                        inter: ['Inter', 'sans-serif'],
                        roboto: ['Roboto', 'sans-serif'],
                        exo: ['Exo', 'sans-serif'],
                        rubix: ['Rubik', 'sans-serif']
                    },
                    letterSpacing: {
                        lebar: '.25em',
                    }
                },
            },
        }
    </script>

<body>
    <div class="main bg-[#EEEFF0] relative">
        <div class="w-full h-full">
            <!-- Side Bar -->
            <?php include('templates/Sidebar.php') ?>
            <!-- End Sidebar -->
            <div class="lg:ml-[200px] lg:w-[calc(100vw-230px)]">
                <div class="min-h-[calc(100vh)] px-4 lg:px-10 py-5">
                    <div class="mt-[80px] lg:mt-2 mb-[15px] flex flex-warp justify-between">
                        <div class="flex flex-wrap">
                            <div class="">
                                <img src="img/Dashboard Icon.png" alt="Dashboard" class="mr-2 inline-block">
                            </div>
                            <div class="">
                                <span class="text-[40px] font-bold font-exo  text-[#0F56B3]">Activities
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

                        <Select class="w-full h-[50px] p-3 border-2  rounded-lg my-auto mb-2 md:mr-5" name="input-regioanal" id="input-regional">
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
                    <div class="bg-white h-full rounded-md p-10">
                        <div class="flex justify-between mb-5 items-center relative">
                            <div class="flex">
                                <p class="mt-5 flex items-center">Show</p>
                                <Select class="w-[70px] h-[40px] p-1 border-2  rounded-lg my-auto mx-5 mt-5" id="input-data" name="input-data">
                                    <option class="" value="8">8</option>
                                    <option class="" value="15">15</option>
                                    <option class="" value="30">30</option>
                                    <option class="" value="50">50</option>
                                    <option class="" value="100">100</option>
                                    <option class="" value="1000">1000</option>
                                </Select>
                                <p class="mt-5 flex items-center">Per Page</p>
                            </div>
                            <div class="m-4">
                                <button type="button" id="action" name="action" type="button" class="block bg-[#76A9FF] text-white rounded-xl p-3 right-4">Action</button>
                                <nav id="action-menu" class=" hidden absolute py-5 bg-white shadow-lg rounded-lg max-w-[250px] w-full right-4 top-13">
                                    <ul class="block">
                                        <li class="group">
                                            <button type="button" class="text-base font-semibold text-slate-800 py-2 mx-8 flex group-hover:text-primary" id="take">Take</button>
                                        </li>
                                        <li class="group">
                                            <button type="button" class="text-base font-semibold text-slate-800 py-2 mx-8 flex group-hover:text-primary" id="delete">Delete</button>
                                        </li>
                                        <li class="group">
                                            <button type="button" class="text-base font-semibold text-slate-800 py-2 mx-8 flex group-hover:text-primary" id="close">Close</button>
                                        </li>
                                        <?php if ($_SESSION['team'] == 1) : ?>

                                            <!-- <li class="group">
                                                <button type="button" class="text-base font-semibold text-slate-800 py-2 mx-8 flex group-hover:text-primary" id="download">download</button>
                                            </li> -->
                                        <?php endif; ?>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                        <div class="flex  flex-wrap md:flex-none justify-between mb-4">
                            <div class="flex flex-wrap w-full md:w-6/12 md:flex-nowrap">
                                <input type="text" placeholder="Search" id="inputSearch" class="p-2 border-2  h-[40px] w-8/12 lg:w-[264px] rounded-md" autocomplete="off">
                            </div>
                            <div class="flex mt-2 md:mt-0">
                                <div class="group">
                                    <button type="button" class="mr-4 text-[#9C9C9C] text-[11px] font-rubix font-bold group-hover:text-black" id="import-file"><i class="fa-solid fa-cloud-arrow-up mr-2 group-hover:text-black"></i>IMPORT TICKET</button>
                                </div>
                                <div class="group">
                                    <a href="template/create.ticket.xlsx" class="mr-4 text-[#9C9C9C] text-[11px] font-rubix font-bold group-hover:text-black"><i class="fa-solid fa-download mr-2 group-hover:text-black"></i>TEMPLATE TICKET</a>
                                </div>
                                <div class="group">
                                    <button type="button" class="mr-4 text-[#9C9C9C] text-[11px] font-rubix font-bold group-hover:text-black" id="import-file1"><i class="fa-solid fa-cloud-arrow-up mr-2 group-hover:text-black"></i>IMPORT FEEDBACK</button>
                                </div>
                                <div class="group">
                                    <a href="template/Template.feed.back.xlsx" class="mr-4 text-[#9C9C9C] text-[11px] font-rubix font-bold group-hover:text-black"><i class="fa-solid fa-download mr-2 group-hover:text-black"></i>TEMPLATE FEEDBACK</a>
                                </div>
                                <div class="group">
                                    <a href="template/code.of.cases.xlsx" class="mr-4 text-[#9C9C9C] text-[11px] font-rubix font-bold group-hover:text-black"><i class="fa-solid fa-download mr-2 group-hover:text-black"></i>CODE OF CASE</a>
                                </div>
                            </div>
                        </div>

                        <div id="ticketing-table-activities" class="w-full mt-6">
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal Import FL  -->
            <div class="bg-black bg-opacity-50 z-40 absolute inset-0 hidden justify-center items-center" id="overlay-import-fl">
                <div class="w-[420px] h-[250px] rounded-md bg-white">
                    <svg class="h-6 w-6 cursor-pointer p-1 hover:bg-gray-300 rounded-full close-modal" fill=" currentColor" id="close-modal-import-fl" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                    <div class="m-auto px-6 w-full">
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="flex justify-end">
                                <button type="submit" name="import-activities" class="mb-5 bg-[#C5DCFA] text-end p-2 rounded-full text-black hover:bg-blue-300"><i class="fa-solid fa-upload"></i></button>
                            </div>
                            <div class="relative group w-full h-[140px] flex justify-center items-center">
                                <div class="absolute inset-0 w-full h-full rounded-xl bg-[#C5DCFA] bg-opacity-80 shadow-2xl backdrop-blur-xl group-hover:bg-opacity-70">
                                </div>
                                <input accept=".xls, .xlsx" class="relative z-10 opacity-0 h-full w-full cursor-pointer" type="file" name="bgfile" id="bgfile">
                                <div class="absolute top-0 right-0 bottom-0 left-0 w-full h-full m-auo flex items-center justify-center">
                                    <div class="space-y-6 text-center">
                                        <i class="fa-solid fa-cloud-arrow-up text-5xl opacity-60"></i>
                                        <p class="text-gray-700 text-lg font-semibold" id="upload-name">Upload a csv or
                                            excel<label for="dragOver" title="Upload a file" class="relative z-20 cursor-pointer text-xs text-[#98989B] block">drag
                                                &
                                                drop or browser file</label> </p>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- End Modal  Import-->
            <!-- Modal Import bl -->
            <div class="bg-black bg-opacity-50 z-40 absolute inset-0 hidden justify-center items-center" id="overlay-import-bl">
                <div class="w-[420px] h-[250px] rounded-md bg-white">
                    <svg class="h-6 w-6 cursor-pointer p-1 hover:bg-gray-300 rounded-full close-modal" fill=" currentColor" id="close-modal-import-bl" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                    <div class="m-auto px-6 w-full">
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="flex justify-end">
                                <button type="submit" name="import-bl" class="mb-5 bg-[#C5DCFA] text-end p-2 rounded-full text-black hover:bg-blue-300"><i class="fa-solid fa-upload"></i></button>
                            </div>
                            <div class="relative group w-full h-[140px] flex justify-center items-center">
                                <div class="absolute inset-0 w-full h-full rounded-xl bg-[#C5DCFA] bg-opacity-80 shadow-2xl backdrop-blur-xl group-hover:bg-opacity-70">
                                </div>
                                <input accept=".xls, .xlsx" class="relative z-10 opacity-0 h-full w-full cursor-pointer" type="file" name="bgfile1" id="bgfile1">
                                <div class="absolute top-0 right-0 bottom-0 left-0 w-full h-full m-auo flex items-center justify-center">
                                    <div class="space-y-6 text-center">
                                        <i class="fa-solid fa-cloud-arrow-up text-5xl opacity-60"></i>
                                        <p class="text-gray-700 text-lg font-semibold" id="upload-name1">Upload a csv or
                                            excel<label for="dragOver" title="Upload a file" class="relative z-20 cursor-pointer text-xs text-[#98989B] block">drag
                                                &
                                                drop or browser file</label> </p>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- End Modal  Import bl-->
            <!-- Modal Hasil Upload fl-->
            <?php if (isset($file)) : ?>
                <div class="bg-black bg-opacity-50 flex z-40 absolute inset-0 " id="overlay-hasil-upload">
                    <div class="w-full h-full rounded-md bg-white">
                        <div class="flex justify-between px-10 py-4">
                            <svg class="h-6 w-6 cursor-pointer p-1 hover:bg-gray-300 rounded-full close-modal" fill=" currentColor" id="close-hasil-upload" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                            </svg>
                            <div>
                                <p class="inline-block mr-5 bg-pink-400 p-2 rounded-lg text-white">Failed : <?= (isset($HasilStatus['Id Already Exists']) ? $HasilStatus['Id Already Exists'] : 0) ?></p>
                                <p class="inline-block mr-5 bg-blue-400 p-2 rounded-lg text-white">Successfuly : <?= (isset($HasilStatus['Successfuly']) ? $HasilStatus['Successfuly'] : 0) ?></p>
                            </div>
                        </div>
                        <div class="border-neutral-200 rounded-md w-full h-full overflow-x-auto overflow-y-auto  ">
                            <table class="table-fixed bg-white min-w-full overflow-x-auto font-inter text-center border-separate border-spacing-y-3">
                                <thead class="border-b-2 border-neutral-200">
                                    <tr class="uppercase text-xs font-bold text-black ">
                                        <th class="px-4 py-3 select-none cursor-pointer">
                                            <div class="">
                                                <div>
                                                    NO
                                                </div>
                                            </div>
                                        </th>
                                        <th class="px-4 py-3 select-none cursor-pointer">
                                            <div class="">
                                                <div>
                                                    No Tiket
                                                </div>
                                            </div>
                                        </th>
                                        <th class="px-4 py-3 select-none cursor-pointer">
                                            <div class="">
                                                <div>
                                                    No Connote
                                                </div>
                                            </div>
                                        </th>
                                        <th class="px-4 py-3 select-none cursor-pointer">
                                            <div class="">
                                                <div>
                                                    Case Type
                                                </div>
                                            </div>
                                        </th>
                                        <th class="px-4 py-3 select-none cursor-pointer">
                                            <div class="">
                                                <div>
                                                    Account
                                                </div>
                                            </div>
                                        </th>
                                        <th class="px-4 py-3 select-none cursor-pointer">
                                            <div class="">
                                                <div>
                                                    Seller Name
                                                </div>
                                            </div>
                                        </th>
                                        <th class="px-4 py-3 select-none cursor-pointer">
                                            <div class="">
                                                <div>
                                                    origin
                                                </div>
                                            </div>
                                        </th>
                                        <th class="px-4 py-3 select-none cursor-pointer">
                                            <div class="">
                                                <div>
                                                    Status POD
                                                </div>
                                            </div>
                                        </th>
                                        <th class="px-4 py-3 select-none cursor-pointer">
                                            <div class="">
                                                <div>
                                                    Status
                                                </div>
                                            </div>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="align-top">
                                    <?php $i = 1 ?>
                                    <?php foreach ($file as $data) : ?>
                                        <tr class="uppercase text-xs text-neutral-500 shadow-md hover:bg-slate-100">
                                            <td class="px-4 py-3 select-none cursor-pointer align-middle">
                                                <div>
                                                    <?= $i++ ?>
                                                </div>
                                            </td>
                                            <td class="px-4 py-3 select-none cursor-pointer align-middle">
                                                <div>
                                                    <?= $data['noTiket'] ?>
                                                </div>
                                            </td>
                                            <td class="px-4 py-3 select-none cursor-pointer align-middle">
                                                <div>
                                                    <?= $data['awb'] ?>
                                                </div>
                                            </td>
                                            <td class="px-4 py-3 select-none cursor-pointer align-middle">
                                                <div>
                                                    <?= $data['typeCase'] ?>
                                                </div>
                                            </td>
                                            <td class="px-4 py-3 select-none cursor-pointer align-middle">
                                                <div>
                                                    <?= $data['account'] ?>
                                                </div>
                                            </td>
                                            <td class="px-4 py-3 select-none cursor-pointer align-middle">
                                                <div>
                                                    <?= $data['sellerName'] ?>
                                                </div>
                                            </td>
                                            <td class="px-4 py-3 select-none cursor-pointer align-middle">
                                                <div>
                                                    <?= $data['dest_code'] ?>
                                                </div>
                                            </td>
                                            <td class="px-4 py-3 select-none cursor-pointer align-middle">
                                                <div>
                                                    <?= $data['statusPod'] ?>
                                                </div>
                                            </td>
                                            <td class="px-4 py-3 select-none cursor-pointer align-middle">
                                                <div>
                                                    <?= $data['status'] ?>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <!-- End Hasil Upload -->
</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<script src="js/script-all.js"></script>
<script src="js/act20.js"></script>
<!-- <script src="js/Report.js"></script> -->
<script type="text/javascript" src="js/datetime6.js"></script>
<script type="text/javascript">
    window.onload = date_time('date_time');
</script>

</html>