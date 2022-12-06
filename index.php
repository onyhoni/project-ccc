<?php
require 'functions.php';

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
}

$custName = queryAllUniqe("SELECT account_tabel.BIG_GROUPING_CUST FROM `tiket_tabel` INNER JOIN account_tabel ON tiket_tabel.CUSTOMER_NAME = account_tabel.ACCOUNT
ORDER BY BIG_GROUPING_CUST ASC");
$regName = queryAllUniqe("SELECT kota_tabel.REGIONAL FROM `tiket_tabel` INNER JOIN kota_tabel ON tiket_tabel.DEST_CODE = kota_tabel.KOTA_ID ORDER BY REGIONAL ASC");

?>
<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | BOSS</title>
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
</head>

<body>
    <div class="main bg-[#EEEFF0] relative">
        <div class="w-full h-full lg:flex">
            <!-- Side Bar -->
            <?php include('templates/Sidebar.php'); ?>
            <!-- End Sidebar -->
            <div class="lg:ml-[200px] lg:w-[calc(100vw-450px)]">
                <div class="min-h-[calc(100vh-70px)] px-4 py-5">
                    <div class="mt-[80px] md:mt-32 lg:mt-0 mb-[15px] flex flex-warp justify-between">
                        <div class="flex flex-wrap">
                            <div class="">
                                <img src="img/Dashboard Icon.png" alt="Dashboard" class="mr-2 inline-block">
                            </div>
                            <div class="">
                                <span class="text-[40px] font-bold font-exo  text-[#0F56B3]">Ticketing Dashboard
                                </span>
                            </div>
                        </div>
                        <div class="flex flex-warp">
                            <div class=" font-semibold text-[#0F56B3]">
                                <p><b><span id="date_time"></span></b></p>
                            </div>
                        </div>
                    </div>
                    <!-- Section Logout & User Ketika layar Hp  -->
                    <div class="bg-white h-48 lg:hidden p-4">
                        <div class="flex justify-between">
                            <div class="flex flex-col md:text-3xl text-5xl">
                                <div class="flex">
                                    <a href="logout.php" class="hover:text-red-500 mr-2">
                                        <i class="fa-solid fa-power-off"></i>
                                    </a>
                                    <a>
                                        <i class="fa-solid fa-bell  hover:text-primary"></i>
                                    </a>
                                </div>
                                <div class="mt-4">
                                    <h2 class="text-3xl md:text-2xl font-semibold font-exo">Hello BOSS</h2>
                                    <h1 class="text-3xl md:text-3xl font-semibold font-exo text-primary uppercase"><?= $_SESSION['user'] ?>
                                    </h1>
                                </div>
                            </div>

                            <div class="mt-2">
                                <img src="img/AVATAR (1).png" alt="AVATAR" class="ml-1 md:w-24">
                            </div>
                        </div>

                    </div>
                    <!-- End Section Layar Hp -->
                    <div class="bg-white  rounded-md flex  flex-wrap md:flex-nowrap justify-start mb-4 mt-6 p-3 shadow-lg">
                        <Select class="md:w-6/12 w-full h-[50px] p-3 border-2  rounded-lg my-auto mb-2 md:mr-5" id="customer">
                            <option class="" value="">All Customer Name</option>
                            <?php foreach ($custName as $cust) : ?>
                                <option class="" value="<?= $cust ?>"><?= $cust ?></option>
                            <?php endforeach; ?>
                        </Select>
                        <Select class="md:w-6/12 w-full h-[50px] p-3 border-2  rounded-lg my-auto mb-2 md:mr-5" id="regional">
                            <option class="" value="">All Regional</option>
                            <?php foreach ($regName as $reg) : ?>
                                <option class="" value="<?= $reg ?>"><?= $reg ?></option>
                            <?php endforeach; ?>
                        </Select>
                        <div class="flex  flex-wrap md:flex-nowrap w-full">
                            <input type="date" class="w-full md:w-4/12 lg:w-6/12 h-[50px] p-3  rounded-lg my-auto border-2 mb-2 md:mr-3" value="<?= date('Y-m-d', strtotime('-1 weeks')) ?>" id="date-start">
                            <input type="date" class="w-full md:w-4/12 lg:w-6/12 h-[50px] p-3  rounded-lg my-auto border-2 mb-2 md:mr-3" value="<?= date('Y-m-d') ?>" id="date-end">
                        </div>
                    </div>
                    <section id="content-dashboard">
                        <div class="grid md:gap-4 grid-cols-1 md:grid-cols-5 mb-5">
                            <div class="grid gap-4  md:grid-cols-2 md:col-span-2">
                                <div class="bg-white h-[128px] rounded-md p-2 flex shadow-lg">
                                    <div class="m-auto text-center">
                                        <p class="font-inter text-xl  m-auto">All Ticket</p>
                                        <p class="text-4xl font-exo font-bold mt-5" id="total-tiket"></p>
                                    </div>
                                </div>
                                <div class="bg-white h-[128px] rounded-md p-2 flex shadow-lg">
                                    <div class="m-auto text-center">
                                        <p class=" font-inter text-xl text-primary tracking-widest">Solved</p>
                                        <p class="text-4xl font-exo font-bold  text-primary mt-5" id="total-solved"></p>
                                    </div>
                                </div>
                                <div class="bg-white h-[128px] rounded-md p-2 flex shadow-lg">
                                    <div class="m-auto text-center">
                                        <p class=" font-inter text-xl text-[#FFB800] tracking-lebar">In-Progress</p>
                                        <p class="text-4xl font-exo font-bold  text-[#FFB800] mt-5" id="total-progress"></p>
                                    </div>
                                </div>
                                <div class="bg-white h-[128px] rounded-md p-2 flex shadow-lg">
                                    <div class="m-auto text-center">
                                        <p class="font-inter text-xl text-[#FF0000] tracking-lebar">Open</p>
                                        <p class="text-4xl font-exo font-bold  text-[#FF0000] mt-5" id="total-open"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="grid gap-4 col-span-3 mt-4 md:mt-0">
                                <div class=" bg-white h-[270px] rounded-md p-2 flex shadow-lg">
                                    <div class="w-8/12">
                                        <div class="h-full">
                                            <canvas id="chart-action" data-id='<?php echo json_encode($dataAction); ?>'></canvas>
                                        </div>
                                    </div>
                                    <div class="w-4/12">
                                        <div class="h-full">
                                            <p class="m-5 font-inter tracking-widest text-xl"> Action Follow</p>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="grid md:gap-4 grid-cols-1 md:grid-cols-5">
                            <div class="col-span-2 mb-4 md:mb-0">
                                <div class="bg-white h-full rounded-md p-2 shadow-lg">
                                    <p class="m-5 font-inter tracking-widest text-sm"> Ticket By Regional</p>
                                    <div class="h-[600px] p-5">
                                        <canvas id="chart-regional" data-id='<?php echo json_encode($dataRegional); ?>'></canvas>
                                    </div>
                                </div>
                            </div>
                            <div class="grid gap-4 col-span-3">
                                <div class="grid gap-4 md:grid-cols-2">
                                    <div class="flex flex-col">
                                        <div class="h-[250px] lg:p-4  bg-white shadow-lg rounded-lg">
                                            <div class="h-full p-5">
                                                <p class="font-inter tracking-widest text-sm">SLA</p>
                                                <canvas id="chart-sla" data-id='<?php echo json_encode($dataSLA); ?>'></canvas>
                                            </div>
                                        </div>
                                        <div class="h-full mt-4 bg-white shadow-lg rounded-lg">
                                            <p class="m-5 font-inter tracking-widest text-xs">Ticket By
                                                Category Case
                                            </p>
                                            <div class="p-5">
                                                <canvas id="chart-category" data-id='<?php echo json_encode($dataAction); ?>'></canvas>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex flex-col">
                                        <div class="h-[250px] lg:p-4  bg-white shadow-lg rounded-lg">
                                            <p class="font-inter tracking-widest text-sm">Ticket By Zona
                                            </p>
                                            <div class="h-full p-5">
                                                <canvas id="chart-zona" data-id='<?php echo json_encode($dataZona); ?>'></canvas>
                                            </div>
                                        </div>
                                        <div class="h-full  mt-4 bg-white shadow-lg rounded-lg">
                                            <p class="m-5 font-inter tracking-widest text-sm">Ticket By
                                                Industry</p>
                                            <div class=" h-[300px]">
                                                <canvas id="chart-industry" data-id='<?php echo json_encode($dataIndustry); ?>'></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
            <!-- Aside Right  -->
            <div class="lg:w-[250px] bottom-0 right-0 top-0  md:flex lg:flex-col px-4 lg:px-0">
                <div class="bg-white h-48 hidden lg:block p-4">
                    <div class="flex justify-between">
                        <div class="flex flex-col lg:text-3xl text-5xl">
                            <div class="flex lg:px-4">
                                <a href="logout.php" class="hover:text-red-500 mr-2">
                                    <i class="fa-solid fa-power-off"></i>
                                </a>
                                <a>
                                    <i class="fa-solid fa-bell  hover:text-primary"></i>
                                </a>
                            </div>
                            <div class="mt-1 lg:px-1">
                                <h2 class="text-3xl md:text-2xl font-semibold font-exo">Hello BOSS</h2>
                                <h1 class="text-5xl md:text-3xl font-semibold font-exo text-primary uppercase"><?= $_SESSION['user'] ?></h1>
                            </div>
                        </div>

                        <div class="mt-2">
                            <img src="img/AVATAR (1).png" alt="AVATAR" class="ml-1 lg:w-24">
                        </div>
                    </div>

                </div>
                <div class="bg-white w-full lg:pl-2 md:w-1/2 lg:w-full mt-4 mr-4 lg:mr-0">
                    <div class="h-[400px]">
                        <canvas id="chart-customer" data-id='<?php echo json_encode($dataCustomer); ?>'></canvas>
                    </div>
                </div>
                <div class="bg-white w-full lg:pl-2 md:w-1/2 lg:w-full mt-4 lg:h-full">
                    <div class="h-[400px]">
                        <canvas id="chart-branch" data-id='<?php echo json_encode($dataBranch); ?>'></canvas>
                    </div>
                </div>
            </div>
            <!-- End Aside Right -->
        </div>
    </div>
</body>
<script src=" https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="js/script-all.js"></script>
<script src="js/Index5.js"></script>
<script type="text/javascript" src="js/datetime6.js"></script>
<script type="text/javascript">
    window.onload = date_time('date_time');
</script>


</html>
