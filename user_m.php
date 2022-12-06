<?php
require 'functions.php';
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
}
if ($_SESSION['type_user'] === 'Staff') {
    echo 'Akses Diblock Silahkan Hubungi Admin';
    die;
}

if (isset($_POST['import-user'])) {
    $file = import($_FILES);
}

if (isset($file)) {
    foreach ($file as $files) {
        $HasilStatus[] = $files['status'];
    }
    $HasilStatus = array_count_values($HasilStatus);
}


$team = queryAll("SELECT * FROM team_tabel");

if (isset($_POST['add-user'])) {

    if (TambahUser($_POST) > 0) {
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

?>


<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Maintenance | BOSS</title>
    <script src="https://kit.fontawesome.com/3e0bda294c.js" crossorigin="anonymous"></script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="relative">
    <div class="main flex justify-center bg-[#EEEFF0]">
        <div class="w-full rounded-3xl flex">
            <!-- Side Bar -->
            <?php include('templates/Sidebar.php'); ?>
            <!-- End Sidebar -->
            <div class="lg:ml-[200px] w-full  lg:w-[calc(100vw-220px)]">
                <div class="min-h-[calc(100vh)] mx-2 lg:mx-0 lg:px-10 py-5">
                    <div class="mt-[80px] lg:mt-2 mb-[20px] flex justify-between">
                        <div class="flex items-center">
                            <div class="">
                                <img src="img/Dashboard Icon.png" alt="Dashboard" class="mr-2 inline-block">
                            </div>
                            <div class="">
                                <span class="text-3xl font-bold font-exo  text-[#0F56B3]">User
                                    Maintenance
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
                            <div class="ml-4 hidden lg:block">
                                <a href="logout.php" class="hover:text-red-500">
                                    <i class="fa-solid fa-power-off flex justify-center"></i>
                                    <p class="mb-2">Logout</p>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white h-full mt-6 rounded-md p-10">
                        <div class="grid grid-cols-2 md:grid-cols-4 mb-7 lg:w-5/12">
                            <div class="flex cursor-pointer  group" id="create-user">
                                <span class="text-[#9C9C9C] group-hover:text-black font-inter text-[11px]
                                 mr-2">CREATE
                                    FORM</span>
                                <i class="fa-solid fa-circle-plus  group-hover:text-black text-[#9C9C9C] mr-7"></i>
                            </div>
                            <div class="flex cursor-pointer group" id="import-user">
                                <span class="mr-2 text-[#9C9C9C] group-hover:text-black font-inter text-[11px]
                                hover:text-black">IMPORT</span>
                                <i class="fa-solid fa-cloud-arrow-up group-hover:text-black text-[#9C9C9C] mr-7"></i>
                            </div>
                            <div class="flex cursor-pointer group">
                                <a href="template/Template_upload.users.xlsx" class="mr-2 text-[#9C9C9C] font-inter text-[11px]
                                      group-hover:text-black">TEMPLATE</a>
                                <i class="fa-solid fa-download group-hover:text-black text-[#9C9C9C] mr-7"></i>
                            </div>
                            <div class="flex cursor-pointer group">
                                <a href="export/export-user-all.php" class="mr-2 text-[#9C9C9C] font-inter text-[11px]
                                      group-hover:text-black ">DOWNLOAD</a>
                                <i class="fa-solid fa-download group-hover:text-black text-[#9C9C9C]"></i>
                            </div>
                        </div>

                        <div class="flex  flex-wrap justify-between mb-4">
                            <div class="flex flex-wrap w-full md:w-6/12 md:flex-nowrap">
                                <input type="text" id="search-user" placeholder="Search" class="p-2 border-2  h-[40px] w-8/12 lg:w-[264px] rounded-md">
                            </div>
                            <div class="mr-10 flex items-center mt-2">
                                <i class="fa-solid fa-angle-down mr-5 cursor-pointer"></i>
                                <p class="mr-5 font-bold hover:bg-slate-200 rounded-full cursor-pointer sort" id="sort">A-Z</p>
                                <p class="text-[#778CA2]">SORT</p>
                            </div>
                        </div>

                        <div id="ticketing-table-user" class="w-full mt-6">

                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>

    <!-- Modal Create & Edit -->
    <div class="bg-black bg-opacity-50  z-40 absolute inset-0 hidden justify-center items-center" id="overlay-user">
        <div class="bg-white rounded shadow-xl text-gray-800 w-[600px] h-[1000px] md:h-[700px] flex flex-col font-rubik p-5">
            <form action="" method="post" id="form-user">
                <div class="flex justify-between items-center">
                    <svg class="h-6 w-6 cursor-pointer p-1 hover:bg-gray-300 rounded-full" id="close-modal-user" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                    <h4 class="text-2xl font-bold text-end font-rubik">Create User</h4>

                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-3 mt-6 justify-items-end">
                    <div class="grid justify-items-end w-full">
                        <label for="" class="font-semibold block">First Name</label>
                        <input type="text" name="first_name" id="first_name" class="h-[40px] w-full border border-[#D1D1D1] mt-2 rounded-md text-right p-2" placeholder="Enter Your First Name" autocomplete="off" required>
                    </div>
                    <div class="grid justify-items-end w-full">
                        <label for="" class="font-semibold">Last Name</label>
                        <input type="text" name="last_name" id="last_name" class="h-[40px] w-full border border-[#D1D1D1] mt-2 rounded-md text-right p-2" placeholder="Enter Your Last Name" autocomplete="off" required>
                    </div>
                    <div class="grid justify-items-end  w-full">
                        <label for="" class="font-semibold">Mobile No</label>
                        <input type="text" name="mobile_no" id="mobile_no" class="h-[40px] w-full border border-[#D1D1D1] mt-2 rounded-md text-right p-2" placeholder="Enter Your Mobile No" autocomplete="off" required>
                    </div>
                    <div class="grid justify-items-end w-full">
                        <label for="" class="font-semibold">Email ID</label>
                        <input type="email" name="email_id" id="email_id" class="h-[40px] w-full border border-[#D1D1D1] mt-2 rounded-md text-right p-2" placeholder="Enter Your Email ID" autocomplete="off" required>
                    </div>
                    <div class="grid justify-items-end w-full not-edit">
                        <label for="" class="font-semibold block">ID</label>
                        <input type="text" name="id" id="id" class="h-[40px] w-full border border-[#D1D1D1] mt-2 rounded-md text-right p-2" placeholder="Enter ID" required>
                    </div>
                    <div class="grid justify-items-end w-full">
                        <label for="" class="font-semibold">Team</label>
                        <select type="text" name="Team" id="Team" class="h-[40px] w-full border border-[#D1D1D1] mt-2 rounded-md p-2">
                            <?php foreach ($team as $teams) : ?>
                                <option value="<?= $teams['TEAM_ID'] ?>"><?= $teams['TEAM'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="grid justify-items-end w-full not-edit">
                        <label for="" class="font-semibold">Password</label>
                        <input type="password" name="password" id="password" class="h-[40px] w-full border border-[#D1D1D1] mt-2 rounded-md text-right p-2" placeholder="Enter Password" autocomplete="off" required>
                    </div>
                    <div class="grid justify-items-end w-full not-edit">
                        <label for="" class="font-semibold">Type Of User</label>
                        <select type="text" name="type_user" id="type_user" class="h-[40px] w-full border border-[#D1D1D1] mt-2 rounded-md p-2">
                            <option value="Staff">Staff</option>
                            <option value="Koordinator">Koordinator</option>
                            <option value="SuperVisor">SuperVisor</option>
                            <option value="Manager">Manager</option>
                        </select>
                    </div>
                    <div class="grid justify-items-end w-full">
                        <label for="" class="font-semibold">Branch</label>
                        <select type="text" name="branch" id="branch" class="h-[40px] w-full border border-[#D1D1D1] mt-2 rounded-md p-2">
                            <option value="CGK">CGK</option>
                            <option value="BDO">BDO</option>
                        </select>
                    </div>
                </div>
                <div class="flex justify-between mt-20 md:mt-28 px-4">
                    <button type="submit" name="add-user" class="px-3 py-1 rounded hover:bg-opacity-50 w-[150px] h-[60px] bg-[#4D7CFE] text-white font-bold uppercase">Add
                        user</button>
                    <button type="button" class="px-3 py-1 rounded hover:bg-slate-300 w-[150px] h-[60px] bg-[#F2F4F6] text-[#778CA2] font-bold" id="cancel-modal">CANCEL</button>
                </div>
            </form>
        </div>
    </div>
    <!-- End Modal Create & Edit -->

    <!-- Modal Import -->
    <div class="bg-black bg-opacity-50  z-40 absolute inset-0 hidden justify-center items-center" id="overlay-import">
        <div class="w-[420px] h-[250px] rounded-md bg-white">
            <svg class="h-6 w-6 cursor-pointer p-1 hover:bg-gray-300 rounded-full close-modal" fill=" currentColor" id="close-modal-import" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
            </svg>
            <div class="m-auto px-6 w-full">
                <form action="" method="post" enctype="multipart/form-data">

                    <div class="flex justify-end">
                        <button type="submit" name="import-user" class="mb-5 bg-[#C5DCFA] text-end p-2 rounded-full text-black hover:bg-blue-300"><i class="fa-solid fa-upload"></i></button>
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
                <div class="flex justify-between px-10 py-4">
                    <svg class="h-6 w-6 cursor-pointer p-1 hover:bg-gray-300 rounded-full close-modal" fill=" currentColor" id="close-hasil-upload" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                    <div>
                        <p class="inline-block mr-5 bg-pink-400 p-2 rounded-lg text-white">Failed : <?= (isset($HasilStatus['Id Already Exists']) ? $HasilStatus['Id Already Exists'] : 0) ?></p>
                        <p class="inline-block mr-5 bg-blue-400 p-2 rounded-lg text-white">Successfuly : <?= (isset($HasilStatus['Successfuly']) ? $HasilStatus['Successfuly'] : 0) ?></p>
                    </div>
                </div>
                <div class="border-neutral-200 rounded-md w-full h-full">
                    <table class="table-fixed bg-white min-w-full font-inter text-center border-separate border-spacing-y-3">
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
                                            USER ID
                                        </div>
                                    </div>
                                </th>
                                <th class="px-4 py-3 select-none cursor-pointer">
                                    <div class="">
                                        <div>
                                            First Name
                                        </div>
                                    </div>
                                </th>
                                <th class="px-4 py-3 select-none cursor-pointer">
                                    <div class="">
                                        <div>
                                            Last Name
                                        </div>
                                    </div>
                                </th>
                                <th class="px-4 py-3 select-none cursor-pointer">
                                    <div class="">
                                        <div>
                                            Username
                                        </div>
                                    </div>
                                </th>
                                <th class="px-4 py-3 select-none cursor-pointer">
                                    <div class="">
                                        <div>
                                            Password
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
                                            Type user
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
                                            Mobile No
                                        </div>
                                    </div>
                                </th>
                                <th class="px-4 py-3 select-none cursor-pointer">
                                    <div class="">
                                        <div>
                                            Email
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
                                            <?= $data['userid'] ?>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 select-none cursor-pointer align-middle">
                                        <div>
                                            <?= $data['firstname'] ?>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 select-none cursor-pointer align-middle">
                                        <div>
                                            <?= $data['lastname'] ?>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 select-none cursor-pointer align-middle">
                                        <div>
                                            <?= $data['username'] ?>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 select-none cursor-pointer align-middle">
                                        <div>
                                            <?= $data['password'] ?>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 select-none cursor-pointer align-middle">
                                        <div>
                                            <?= $data['branch'] ?>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 select-none cursor-pointer align-middle">
                                        <div>
                                            <?= $data['typeUser'] ?>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 select-none cursor-pointer align-middle">
                                        <div>
                                            <?= $data['team'] ?>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 select-none cursor-pointer align-middle">
                                        <div>
                                            <?= $data['mobile'] ?>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 select-none cursor-pointer align-middle">
                                        <div>
                                            <?= $data['email'] ?>
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
<script src="js/usermain.js"></script>
<script type="text/javascript" src="js/datetime6.js"></script>
<script type="text/javascript">
    window.onload = date_time('date_time');
</script>

</html>