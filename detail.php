<?php
require 'functions.php';
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
}
$id = $_GET['id'];

$data = query("SELECT * FROM tiket_tabel INNER JOIN case_tabel ON tiket_tabel.CASE_TYPE = case_tabel.CASE_TYPE_ID INNER JOIN kota_tabel ON tiket_tabel.dest_code = kota_tabel.KOTA_ID INNER JOIN category_case ON case_tabel.CATEGORY_ID=category_case.CATEGORY_ID INNER JOIN account_tabel ON tiket_tabel.CUSTOMER_NAME = account_tabel.ACCOUNT WHERE TIKET_ID = '$id'");

$datarespon = query("SELECT * FROM respon_tabel INNER JOIN user ON respon_tabel.USER_ID = user.USER_ID WHERE respon_tabel.TIKET_ID = '$id' ORDER BY CREATE_TIME DESC LIMIT 1 ");






$respon = queryAll("SELECT * FROM team_tabel");

// $ref = $data['TASK_REF_ID'];

// $result2 = getApi($ref);


$pesan = queryAll("SELECT * FROM respon_tabel INNER JOIN user ON respon_tabel.USER_ID = user.USER_ID WHERE respon_tabel.TIKET_ID = '$id'");

if (isset($_POST['submit'])) {

    if (Tambah($_POST) > 0) {
        echo "<script>
            document.location.href = ''
        </script>";
    } else {
        echo "<script>
            alert('data berhasil diinput');
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
    <title>Detail | BOSS</title>
    <script src="https://kit.fontawesome.com/3e0bda294c.js" crossorigin="anonymous"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#4C70FF',
                        'primary-800': '#1e40af',
                        'primary-100': '#bfdbfe',
                    }
                }
            }
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
                                <span class="text-[40px] font-bold font-exo  text-[#0F56B3]">Ticket Detail
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
                    <div class="flex justify-between items-center">
                        <div class="flex items-center">
                            <div class="text-neutral-400 ml-2 mt-1">
                                <?= $data['TIKET_ID'] ?>
                            </div>
                            <?php if ($data['STATUS'] == 'CLOSE') : ?>
                                <div class="uppercase py-1 px-2 rounded-md text-xs font-semibold ml-2 mt-1 bg-[#E8FFF7] text-[#04B49F]">
                                    <?= $data['STATUS'] ?>
                                </div>
                            <?php elseif ($data['STATUS'] == 'OPEN') : ?>
                                <div class="uppercase py-1 px-2 rounded-md text-xs font-semibold ml-2 mt-1 bg-[#f5dcd8] text-[#b44a04]">
                                    <?= $data['STATUS'] ?>
                                </div>
                            <?php else : ?>
                                <div class="uppercase py-1 px-2 rounded-md text-xs font-semibold ml-2 mt-1 bg-[#FFD572] text-[#a38a4f]">
                                    <?= $data['STATUS'] ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 gap-4 lg:grid-cols-2 mt-4">
                        <div class="">
                            <div class="bg-white p-5 rounded-md border border-neutral-200 self-start mb-5">
                                <h3 class="mb-3 text-lg justify-between"><span class="font-semibold">Ticket Detail</span>
                                    <!---->
                                </h3>
                                <div class="grid grid-cols-[200px,1fr] text-neutral-900 border-b border-dashed border-neutral-200 last:border-0 py-2">
                                    <div class="font-semibold">No Connote</div>
                                    <div class="flex items-center">
                                        <?= $data['AWB'] ?>
                                    </div>
                                    <!---->
                                </div>
                                <div class="grid grid-cols-[200px,1fr] text-neutral-900 border-b border-dashed border-neutral-200 last:border-0 py-2">
                                    <div class="font-semibold">Customer Name</div>
                                    <div><?= $data['BIG_GROUPING_CUST'] ?></div>
                                </div>
                                <div class="grid grid-cols-[200px,1fr] text-neutral-900 border-b border-dashed border-neutral-200 last:border-0 py-2">
                                    <div class="font-semibold">Shipper Name</div>
                                    <div><?= $data['SHIPPER_NAME'] ?></div>
                                </div>
                                <div class="grid grid-cols-[200px,1fr] text-neutral-900 border-b border-dashed border-neutral-200 last:border-0 py-2">
                                    <div class="font-semibold">Regional</div>
                                    <div><?= $data['REGIONAL'] ?></div>
                                </div>
                                <div class="grid grid-cols-[200px,1fr] text-neutral-900 border-b border-dashed border-neutral-200 last:border-0 py-2">
                                    <div class="font-semibold">Dest code</div>
                                    <div><?= $data['CODE_3LC'] ?>-<?= $data['DEST_CODE'] ?></div>
                                </div>
                                <div class="grid grid-cols-[200px,1fr] text-neutral-900 border-b border-dashed border-neutral-200 last:border-0 py-2">
                                    <div class="font-semibold">Case Type</div>
                                    <div><?= $data['CATEGORY_CASE'] ?></div>
                                </div>
                                <div class="grid grid-cols-[200px,1fr] text-neutral-900 border-b border-dashed border-neutral-200 last:border-0 py-2">
                                    <div class="font-semibold">Sub Case Type</div>
                                    <div><?= $data['CASE'] ?></div>
                                </div>
                                <div class="grid grid-cols-[200px,1fr] text-neutral-900 border-b border-dashed border-neutral-200 last:border-0 py-2">
                                    <div class="font-semibold">Zona</div>
                                    <div><?= $data['ZONA'] ?></div>
                                </div>
                                <div class="grid grid-cols-[200px,1fr] text-neutral-900 border-b border-dashed border-neutral-200 last:border-0 py-2">
                                    <div class="font-semibold">Action Folow Up</div>
                                    <div><?= $data['ACTION_DATE'] ?> - day</div>
                                </div>
                                <div class="grid grid-cols-[200px,1fr] text-neutral-900 border-b border-dashed border-neutral-200 last:border-0 py-2">
                                    <div class="font-semibold">Create Time</div>
                                    <div><?= date('d-M-Y H:i', strtotime($data['CREATE_TIME']))  ?></div>
                                </div>
                                <div class="grid grid-cols-[200px,1fr] text-neutral-900 border-b border-dashed border-neutral-200 last:border-0 py-2">
                                    <div class="font-semibold">Closed Time</div>
                                    <div><?= ($data['CLOSE_TIME']) ? date('d-M-Y H:i', strtotime($data['CLOSE_TIME'])) : '' ?></div>
                                </div>
                                <div class="grid grid-cols-[200px,1fr] text-neutral-900 border-b border-dashed border-neutral-200 last:border-0 py-2">
                                    <div class="font-semibold">Results SLA</div>
                                    <div><?= $data['HASIL_SLA'] ?></div>
                                </div>
                            </div>
                        </div>
                        <div class="grid">
                            <div class="bg-white h-full p-5 rounded-md border border-neutral-200  self-start">
                                <!---->
                                <div>
                                    <?php if ($data['HASIL_SLA'] == 'SLA') : ?>
                                        <h3 class="font-semibold text-lg uppercase"><?= $data['CASE'] ?> | <span class="uppercase py-1 px-2 rounded-md  font-semibold ml-2 mt-1 bg-[#FF9363] text-white"><?= $data['HASIL_SLA'] ?></span> </h3>
                                    <?php else : ?>
                                        <h3 class="font-semibold text-lg uppercase"><?= $data['CASE'] ?> | <span class="uppercase py-1 px-2 rounded-md  font-semibold ml-2 mt-1 bg-[#FECA58] text-white"><?= $data['HASIL_SLA'] ?></span> </h3>

                                    <?php endif; ?>
                                </div>
                                <hr class="border-t border-neutral-200 mt-3">
                                <div id="messages-wrapper" class="max-h-[50vh] overflow-y-auto py-3 pr-3">
                                    <!-- Pesan -->
                                    <?php foreach ($pesan as $psn) : ?>
                                        <?php if ($psn['USER_ID'] == $_SESSION['id']) : ?>
                                            <div class="mb-4 last:mb-0">
                                                <div class="text-neutral-400 text-xs font-light flex justify-end uppercase">
                                                    <p><?= $psn['BRANCH'] . "-" . $psn['USERNAME'] . "-" . $psn['CREATE_TIME']; ?></p>
                                                </div>
                                                <?php if (!empty($psn['FOTO'])) : ?>
                                                    <div class="flex justify-end">
                                                        <a target="_blank" class="w-1/3 rounded-md border border-neutral-300 mt-1 cursor-pointer" href="<?= (in_array($psn['FOTO'], scandir('./img'))) ? "./img/" . $psn['FOTO'] : $psn['FOTO']  ?>">
                                                            <?php if (in_array($psn['FOTO'], scandir('./img'))) : ?>
                                                                <img src="./img/<?= $psn['FOTO'] ?>">
                                                            <?php else : ?>
                                                                <img src="<?= $psn['FOTO'] ?>">
                                                            <?php endif; ?>
                                                        </a>
                                                    </div>
                                                <?php endif; ?>
                                                <?php if (!empty($psn['PESAN'])) : ?>
                                                    <div class="flex justify-end">
                                                        <div class="rounded-md p-2.5 mt-1 inline-flex max-w-[60%] text-sm bg-neutral-100 bg-primary-100 text-primary-800">
                                                            <?= $psn['PESAN']; ?>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        <?php else : ?>
                                            <div class="mb-4 last:mb-0">
                                                <div class="text-neutral-400 text-xs font-light flex uppercase">
                                                    <p><?= $psn['BRANCH'] . "-" . $psn['USERNAME'] . "-" . $psn['CREATE_TIME']; ?></p>
                                                </div>
                                                <div class="flex"><img src="" class="w-1/3 rounded-md border border-neutral-300 mt-1 cursor-pointer">
                                                </div>
                                                <div class="flex">
                                                    <div class="rounded-md p-2.5 mt-1 inline-flex max-w-[60%] text-sm  bg-white text-primary-800">
                                                        <?= $psn['PESAN'] ?>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                    <!-- End tampilPesan -->
                                </div>
                                <hr class="border-t border-neutral-200 mb-3">
                                <form method="post" action="" enctype="multipart/form-data">
                                    <input type="hidden" name="tiket_id" value="<?= $data['TIKET_ID'] ?>"></input>
                                    <div rows="5" class="input">
                                        <label for="input-l5tor3mdn6grk2p2h" class="text-sm font-semibold text-neutral-700">Pesan</label>
                                        <div class="flex items-center text-sm rounded-[5px] border-[0.6px] border-neutral-300 w-full focus-within:ring-2 focus-within:ring-primary-500 bg-white mt-[5px] ">
                                            <textarea type="textarea" id="input-l5tor3mde4frcbncon" placeholder="" name="pesan" rows="5" class="flex-1 placeholder-neutral-400 focus-visible:outline-none  p-2.5 bg-transparent border-transparent" required></textarea>
                                        </div>
                                        <!-- <div class="text-xs mt-[5px] h-4"></div> -->
                                    </div>
                                    <?php if ($data['STATUS'] == 'CLOSE') : ?>
                                        <div class="p-4 mt-4 rounded-md flex flex-col items-center gap-2 text-sm bg-[#E8FFF7] text-[#04B49F]"><svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M15 0C6.72 0 0 6.72 0 15C0 23.28 6.72 30 15 30C23.28 30 30 23.28 30 15C30 6.72 23.28 0 15 0ZM12 22.5L4.5 15L6.615 12.885L12 18.255L23.385 6.87L25.5 9L12 22.5Z" fill="currentColor"></path>
                                            </svg>
                                            <div class="text-center">
                                                Tiket sudah selesai. Tiket sudah ditutup oleh <?= $datarespon['USERNAME'] ?> pada tanggal <?= $datarespon['CREATE_TIME'] ?>.
                                            </div>
                                        </div>

                                    <?php else : ?>
                                        <div class="flex flex-col text-sm">
                                            <label class="text-sm font-semibold text-neutral-900">
                                                Attachment
                                            </label>
                                            <div class="flex">
                                                <div class="flex items-center" data-v-24c4facf>
                                                    <button to="" class="flex items-center font-semibold rounded-[4px] py-2.5 mt-[5px] relative px-4 bg-neutral-50 text-neutral-500 border-[0.6px] border-neutral-300 hover:bg-neutral-100 max-w-max" data-v-24c4facf>
                                                        <!---->
                                                        <div class="text-sm">
                                                            <div class="flex items-center justify-between" data-v-24c4facf>
                                                                <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg" class="scale-150" data-v-24c4facf>
                                                                    <path d="M10.0833 1.91667V10.0833H1.91667V1.91667H10.0833ZM10.0833 0.75H1.91667C1.275 0.75 0.75 1.275 0.75 1.91667V10.0833C0.75 10.725 1.275 11.25 1.91667 11.25H10.0833C10.725 11.25 11.25 10.725 11.25 10.0833V1.91667C11.25 1.275 10.725 0.75 10.0833 0.75ZM7.24833 5.91833L5.49833 8.17583L4.25 6.665L2.5 8.91667H9.5L7.24833 5.91833Z" fill="currentColor"></path>
                                                                </svg> <span class="text-neutral-500 text-xs ml-2" data-v-24c4facf> Pilih File </span>
                                                                <input type="file" name="gambar" accept=".jpg,.jpeg,.png" class="absolute top-0 left-0 opacity-0 h-full w-full z-10" data-v-24c4facf>
                                                            </div>
                                                        </div>

                                                        <!---->
                                                    </button>
                                                    <!---->
                                                </div>
                                                <div class="ml-4">
                                                    <select name="respon" id="" class="flex items-center font-semibold rounded-[4px] py-2.5 mt-[5px] relative px-4 bg-neutral-50 text-neutral-500 border-[0.6px] border-neutral-300 hover:bg-neutral-100 max-w-max">
                                                        <!-- <option selected value="<?= $data['RESPONSIBILITY'] ?>"><?= $data['RESPONSIBILITY'] ?></option> -->
                                                        <option value="FRONTLINE">FRONTLINE</option>
                                                        <option value="BACKLINE">BACKLINE</option>
                                                    </select>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="flex items-center gap-2 mt-2">
                                            <button to="" type="submit" name="submit" class="flex items-center font-semibold rounded-[4px] py-2.5 px-8  text-white bg-[#76A9FF] hover:bg-opacity-80 max-w-max">
                                                <div class="text-sm">
                                                    Kirim Pesan
                                                </div>
                                            </button>
                                        </div>
                                    <?php endif; ?>
                                </form>


                                <!---->
                                <!---->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<script src="js/script-all.js"></script>
<!-- <script src="js/Activities.js"></script> -->
<script type="text/javascript" src="js/datetime6.js"></script>
<script type="text/javascript">
    window.onload = date_time('date_time');
</script>

</html>