<?php
require 'functions.php';
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
}

if ($_SESSION['type_user'] === 'Staff') {
    echo 'Akses Diblock Silahkan Hubungi Admin';
    die;
}

if (isset($_POST['add_account'])) {

    if (TambahAccount($_POST) > 0) {
        echo "<script>
        alert('data Berhasil di tambahkan ..')
        document.location.href = ''
        </script>";
    } else {
        echo "<script>
        alert('data Gagal di tambahkan ..')
        document.location.href = ''
        </script>";
    }
}

if (isset($_POST['import-account'])) {
    $file = importAccount($_FILES);
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
    <title>Setting | BOSS</title>
    <script src="https://kit.fontawesome.com/3e0bda294c.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="main flex justify-center bg-[#EEEFF0]">
        <div class="w-full lg:flex overflow-x-hidden relative">
            <!-- Side Bar -->
            <?php include('templates/Sidebar.php'); ?>
            <!-- End Sidebar -->
            <div class="lg:ml-[200px]  lg:w-[calc(100vw-220px)] w-full">
                <div class="min-h-[calc(100vh)] mx-4 lg:mx-10 py-5">
                    <div class="mt-[80px] lg:mt-2 mb-[20px] flex  flex-wrap  justify-between">
                        <div class="flex items-center">
                            <div class="">
                                <img src="img/Dashboard Icon.png" alt="Dashboard" class="mr-2 inline-block">
                            </div>
                            <div class="">
                                <span class="text-3xl lg:text-[40px] font-bold font-exo  text-[#0F56B3]">Setting
                                </span>
                            </div>
                        </div>
                        <div class="flex">
                            <div class=" font-semibold text-[#0F56B3]">
                                <p><b><span id="date_time"></span></b></p>
                            </div>
                            <div class="ml-4 hidden lg:block">
                                <i class="fa-solid fa-bell text-3xl hover:text-primary"></i>
                            </div>
                            <div class=" ml-4 hidden lg:block">
                                <a href="logout.php" class="hover:text-red-500">
                                    <i class="fa-solid fa-power-off flex justify-center"></i>
                                    <p class="mb-2">Logout</p>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white h-full mt-6 rounded-md p-10">
                        <div class="flex mb-7">
                            <div class="flex cursor-pointer mr-3">
                                <span class="text-[#9C9C9C] font-inter text-[11px]
                                hover:text-black mr-2" id="account-btn">ACCOUNT</span>
                            </div>
                            <div class="flex cursor-pointer">
                                <span class="mr-2 text-[#9C9C9C] font-inter text-[11px]
                                hover:text-black" id="team-btn">TEAM</span>
                            </div>
                        </div>

                        <div class="flex justify-between flex-wrap mb-4">
                            <div class="flex flex-wrap w-full md:w-6/12 md:flex-nowrap">
                                <input type="text" placeholder="Search" id="search-account" class="p-2 border-2  h-[34px] w-8/12 lg:w-[264px] rounded-md" autocomplete="off">
                                <input type="text" placeholder="Search" id="search-team" class="p-2 border-2  h-[34px] w-8/12 lg:w-[264px] rounded-md hidden" autocomplete="off">
                            </div>
                            <div class="lg:mr-10 mt-2 md:mt-0 lg:my-4 lg:mt-4 flex items-start">
                                <div class="grid grid-cols-2 gap-2 md:grid-cols-2 lg:grid-cols-4" id="import">
                                    <div class="flex cursor-pointer group" id="create_account-setting">
                                        <span class="text-[#9C9C9C] font-inter text-[11px]
                                        hover:text-black mr-2 group-hover:text-black">CREATE
                                            FORM</span>
                                        <i class="fa-solid fa-circle-plus group-hover:text-black  text-[#9C9C9C] mr-7"></i>
                                    </div>
                                    <div class="flex cursor-pointer group" id="import-setting">
                                        <span class="mr-2 text-[#9C9C9C] font-inter text-[11px]
                                        group-hover:text-black">IMPORT</span>
                                        <i class="fa-solid  group-hover:text-black fa-cloud-arrow-up text-[#9C9C9C] mr-7"></i>
                                    </div>
                                    <div class="flex cursor-pointer group">
                                        <a href="template/Template_upload_account.xlsx" class="mr-2 text-[#9C9C9C] font-inter text-[11px]
                                              group-hover:text-black">TEMPLATE</a>
                                        <i class="fa-solid fa-download group-hover:text-black text-[#9C9C9C] mr-7"></i>
                                    </div>
                                    <div class="flex cursor-pointer items-start">
                                        <i class="fa-solid fa-angle-down mr-5 cursor-pointer"></i>
                                        <p class="mr-5 font-bold hover:bg-slate-200 rounded-full cursor-pointer" id="sort">A-Z</p>
                                        <p class="flex text-[#778CA2]">SORT</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="ticketing-table-setting" class="w-full mt-6">


                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal Add Account -->

            <div class="bg-black bg-opacity-50  z-40 absolute inset-0 hidden justify-center items-center" id="overlay-setting">
                <div class="bg-white rounded shadow-xl text-gray-800 w-[600px] h-[900px] md:h-[600px] flex flex-col font-rubik p-5">
                    <form action="index.html" method="post" id="form-user">
                        <div class="flex justify-between items-center">
                            <svg class="h-8 w-8 cursor-pointer p-1 hover:bg-gray-300 rounded-full" id="close-modal-setting" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                            </svg>
                            <h4 class="text-2xl font-bold text-end font-rubik">Add Account</h4>
                        </div>
                        <div class="grid grid-cols-1 gap-4 md:grid-cols-2 mt-6">
                            <div class="grid justify-items-end w-full">
                                <label for="" class="font-semibold mb-2">Cust Account</label>
                                <input type="text" name="cust_account" id="cust_account" class="h-[40px] w-full border border-[#D1D1D1]  rounded-md text-right p-2" placeholder="Enter Your First Name">
                            </div>
                            <div class="grid justify-items-end w-full">
                                <label for="" class="font-semibold mb-2">Cust Name</label>
                                <input type="text" name="cust_name" id="cust_name" class="h-[40px] w-full border border-[#D1D1D1] rounded-md text-right p-2" placeholder="Enter Your Cust Name">
                            </div>
                            <div class="grid justify-items-end w-full">
                                <label for="" class="font-semibold mb-2">Cust Name Grouping</label>
                                <input type="text" name="Cust_name_grouping" id="Cust_name_grouping" class="h-[40px] w-full border border-[#D1D1D1]  rounded-md text-right p-2" placeholder="Enter Cust Name Grouping">
                            </div>
                            <div class="grid justify-items-end w-full">
                                <label for="" class="font-semibold mb-2">Cust Industry</label>
                                <input type="text" name="cust_industry" id="cust_industry" class="h-[40px] w-full border border-[#D1D1D1]  rounded-md text-right p-2" placeholder="Enter Cust Industry">
                            </div>
                            <div class="grid justify-items-end w-full">
                                <label for="" class="font-semibold mb-2">Cust Branch</label>
                                <input type="text" name="cust_branch" id="cust_branch" class="h-[40px] w-full border border-[#D1D1D1]  rounded-md text-right p-2" placeholder="Enter Cust Branch">
                            </div>
                            <div class="grid justify-items-end w-full">
                                <label for="" class="font-semibold mb-2">Payment Metode</label>
                                <select type=" text" name="payment_metode" id="payment_metode" class="h-[40px] w-full border border-[#D1D1D1]  rounded-md p-2">
                                    <option value="COD">COD</option>
                                    <option value="NON COD">NON COD</option>
                                </select>

                            </div>
                            <div class="grid justify-items-end w-full">
                                <label for="" class="font-semibold mb-2">Pic Frontline</label>
                                <input type="text" name="pic_frontline" id="pic_frontline" class="h-[40px] w-full border border-[#D1D1D1]  rounded-md text-right p-2" placeholder="Enter PIC Frontline">
                            </div>
                            <div class="grid justify-items-end w-full">
                                <label for="" class="font-semibold mb-2">Team FL</label>
                                <select type="text" name="team_fl" id="team_fl" class="h-[40px] w-full border border-[#D1D1D1]  rounded-md p-2">
                                    <option value="FL_1">Frontline 1</option>
                                    <option value="FL_2">Frontline 2</option>
                                    <option value="FL_3">Backline 1 </option>
                                </select>
                            </div>
                        </div>
                        <div class="flex justify-between mt-10 px-4">
                            <button type="submit" name="add_account" class="px-3 py-1 rounded hover:bg-opacity-50 w-[150px] h-[60px] bg-[#4D7CFE] text-white font-bold uppercase">Add
                                Account</button>
                            <button type="button" class="px-3 py-1 rounded hover:bg-slate-300 w-[150px] h-[60px] bg-[#F2F4F6] text-[#778CA2] font-bold" id="cancel-modal-setting">CANCEL</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- End Modal Add Account -->

            <!-- Modal Import -->
            <div class="bg-black bg-opacity-50  z-40 absolute inset-0 hidden justify-center items-center" id="overlay-import">
                <div class="w-[420px] h-[250px] rounded-md bg-white">
                    <svg class="h-6 w-6 cursor-pointer p-1 hover:bg-gray-300 rounded-full" fill=" currentColor" id="close-modal-import-setting" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                    <div class="m-auto px-6 w-full">
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="flex justify-end">
                                <button type="submit" name='import-account' class="mb-5 bg-[#C5DCFA] text-end p-2 rounded-full text-black hover:bg-blue-300"><i class="fa-solid fa-upload"></i></button>
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

            <!-- Modal Hasil Upload -->
            <?php if (isset($file)) : ?>
                <div class="bg-black bg-opacity-50 flex z-40 absolute inset-0 " id="overlay-hasil-upload">
                    <div class="w-full h-full rounded-md bg-white">
                        <div class="flex justify-between px-10">
                            <svg class="h-6 w-6 cursor-pointer p-1 hover:bg-gray-300 rounded-full close-modal" fill=" currentColor" id="close-hasil-upload" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                            </svg>
                            <div>
                                <p class="inline-block mr-5 bg-pink-400 p-2 rounded-lg text-white">Failed : <?= (isset($HasilStatus['Id Already Exists']) ? $HasilStatus['Id Already Exists'] : 0) ?></p>
                                <p class="inline-block mr-5 bg-blue-400 p-2 rounded-lg text-white">Successfuly : <?= (isset($HasilStatus['Successfuly']) ? $HasilStatus['Successfuly'] : 0) ?></p>
                            </div>
                        </div>
                        <div class="border-neutral-200 rounded-md w-full h-full overflow-x-auto overflow-y-auto">
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
                                                    Account
                                                </div>
                                            </div>
                                        </th>
                                        <th class="px-4 py-3 select-none cursor-pointer">
                                            <div class="">
                                                <div>
                                                    Cust Name Grouping
                                                </div>
                                            </div>
                                        </th>
                                        <th class="px-4 py-3 select-none cursor-pointer">
                                            <div class="">
                                                <div>
                                                    Industry
                                                </div>
                                            </div>
                                        </th>
                                        <th class="px-4 py-3 select-none cursor-pointer">
                                            <div class="">
                                                <div>
                                                    Team
                                                </div>
                                            </div>
                                        </th>
                                        <th class="px-4 py-3 select-none cursor-pointer">
                                            <div class="">
                                                <div>
                                                    Branch
                                                </div>
                                            </div>
                                        </th>
                                        <th class="px-4 py-3 select-none cursor-pointer">
                                            <div class="">
                                                <div>
                                                    Payment Metode
                                                </div>
                                            </div>
                                        </th>
                                        <th class="px-4 py-3 select-none cursor-pointer">
                                            <div class="">
                                                <div>
                                                    Pic Frontline
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
                                                    <?= $data['account'] ?>
                                                </div>
                                            </td>
                                            <td class="px-4 py-3 select-none cursor-pointer align-middle">
                                                <div>
                                                    <?= $data['custNameGrouping'] ?>
                                                </div>
                                            </td>
                                            <td class="px-4 py-3 select-none cursor-pointer align-middle">
                                                <div>
                                                    <?= $data['industry'] ?>
                                                </div>
                                            </td>
                                            <td class="px-4 py-3 select-none cursor-pointer align-middle">
                                                <div>
                                                    <?= $data['team'] ?>
                                                </div>
                                            </td>
                                            <td class="px-4 py-3 select-none cursor-pointer align-middle">
                                                <div>
                                                    <?= $data['branch'] ?>
                                                </div>
                                            </td>
                                            <td class="px-4 py-3 select-none cursor-pointer align-middle">
                                                <div>
                                                    <?= $data['payment'] ?>
                                                </div>
                                            </td>
                                            <td class="px-4 py-3 select-none cursor-pointer align-middle">
                                                <div>
                                                    <?= $data['picFrontline'] ?>
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
        </div>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="js/script-all.js"></script>
<script src="js/settingnew.js"></script>
<script type="text/javascript" src="js/datetime6.js"></script>
<script type="text/javascript">
    window.onload = date_time('date_time');
</script>

</html>
