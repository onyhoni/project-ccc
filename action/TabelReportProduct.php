<?php

$keyword = $_POST['keyword'];

require '../functions.php';

// $result = queryAll("SELECT user.USER_ID , user.USERNAME , team_tabel.TEAM , COUNT(user.USERNAME) as Total FROM `tiket_tabel` INNER JOIN user ON tiket_tabel.USER_ID = user.USER_ID INNER JOIN team_tabel ON user.TEAM=team_tabel.TEAM_ID WHERE user.USERNAME LIKE '%$keyword%' GROUP BY user.USERNAME ORDER BY user.USERNAME ASC
// ");
$result = queryAll("SELECT DISTINCT USER_ID, USERNAME ,team_tabel.TEAM FROM `user` INNER JOIN team_tabel ON user.TEAM = team_tabel.TEAM_ID WHERE user.USERNAME LIKE '%$keyword%' OR team_tabel.TEAM LIKE '%$keyword%' ");

$rowCount = mysqli_affected_rows($conn);



if ($rowCount > 0) {
    foreach ($result as $key => $data) {
        $user = $data['USER_ID'];
        $res[] = $data;

        $Progress = queryAll("SELECT COUNT(STATUS) as PROGRESS FROM tiket_tabel WHERE USER_ID ='$user' AND STATUS='PROGRESS' GROUP BY STATUS");
        array_push($res[$key], (isset($Progress[0]['PROGRESS']) ? $Progress[0]['PROGRESS'] : 0));

        $Open = queryAll("SELECT COUNT(STATUS) as OPEN FROM tiket_tabel WHERE USER_ID ='$user' AND STATUS='OPEN' GROUP BY STATUS");
        array_push($res[$key], (isset($Open[0]['OPEN']) ? $Open[0]['OPEN'] : 0));

        $Close = queryAll("SELECT COUNT(STATUS) as CLOSE FROM tiket_tabel WHERE USER_ID ='$user' AND STATUS='CLOSE' GROUP BY STATUS");
        array_push($res[$key], (isset($Close[0]['CLOSE']) ? $Close[0]['CLOSE'] : 0));

        $CloseTiket = queryAll("SELECT COUNT(USER_ID) as TOTALCLOSE FROM `respon_tabel` WHERE PESAN = 'Tiket Berhasil Ditutup' AND USER_ID ='$user' ");

        array_push($res[$key], (isset($CloseTiket[0]['TOTALCLOSE']) ? $CloseTiket[0]['TOTALCLOSE'] : 0));


        $total = queryAll("SELECT COUNT(tiket_tabel.USER_ID) as TOTAL FROM `tiket_tabel` WHERE USER_ID = '$user'");
        array_push($res[$key], (isset($total[0]['TOTAL']) ? $total[0]['TOTAL'] : 0));
    }
}
?>

<?php if ($rowCount > 0) : ?>
    <div class="border-neutral-200 rounded-md w-full h-[660px] overflow-x-auto overflow-y-auto  ">
        <table class="table-fixed bg-white min-w-full overflow-x-auto font-inter text-center border-separate border-spacing-y-3">
            <thead class="border-b-2 border-neutral-200">
                <tr class="uppercase font-bold text-black ">
                    <th class="px-4 py-3 select-none cursor-pointer" style="width: 150px;min-width: 150px;" colspan="10">
                        <div class="text-base flex items-end justify-center">
                            <div>
                                Status Ticket
                            </div>
                        </div>
                    </th>
                </tr>
                <tr class="uppercase font-bold text-black ">
                    <th class="px-4 elect-none cursor-pointer" style="width: 150px;min-width: 150px;">
                        <div class="flex justify-center  h-16">
                            <div>
                                Name
                            </div>
                        </div>
                    </th>
                    <th class="px-4 py-3 select-none cursor-pointer" style="width:160px;min-width:160px;">
                        <div class="flex justify-center h-16">
                            <div class=" text-primary-700 cursor-pointer">
                                Team
                            </div>
                        </div>
                    </th>
                    <th class="px-4 py-3 select-none cursor-pointer" style="width: 100px;min-width: 100px;">
                        <div class="flex justify-center items-center h-16">
                            <div>
                                Total Ticket
                            </div>
                        </div>
                    </th>
                    <th class="px-4 py-3 select-none cursor-pointer" style="width:150px;min-width:150px;">
                        <div class="flex justify-center items-center h-16">
                            <div>
                                Open
                            </div>
                        </div>
                    </th>
                    <th class="px-4 py-3 select-none cursor-pointer" style="width:160px;min-width:160px;">
                        <div class="flex justify-center items-center h-16">
                            <div>
                                %
                            </div>
                        </div>
                    </th>
                   
                    <th class="px-4 py-3 select-none cursor-pointer" style="width:100px;min-width:100px;">
                        <div class="flex justify-center items-center h-16">
                            <div>
                                in-Progress
                            </div>
                        </div>
                    </th>
                    <th class="px-4 py-3 select-none cursor-pointer" style="width:150px;min-width:150px;">
                        <div class="flex justify-center items-center h-16">
                            <div>
                                %
                            </div>
                        </div>
                    </th>
                    <th class="px-4 py-3 select-none cursor-pointer" style="width:150px;min-width:150px;">
                        <div class="flex justify-center items-center h-16">
                            <div>
                                Solved
                            </div>
                        </div>
                    </th>
                    <th class="px-4 py-3 select-none cursor-pointer" style="width:150px;min-width:150px;">
                        <div class="flex justify-center items-center h-16">
                            <div>
                                %
                            </div>
                        </div>
                    </th>
                    <th class="px-4 py-3 select-none cursor-pointer" style="width: 100px;min-width: 100px;">
                        <div class="flex justify-center items-center h-16">
                            <div>
                                Close Tiket
                            </div>
                        </div>
                    </th>
                    <th class="px-4 py-3 select-none cursor-pointer" style="width:250px;min-width:250px;">
                        <div class="flex justify-center items-center h-16">
                            <div>
                                Respon Time
                            </div>
                        </div>
                    </th>
                </tr>
            </thead>
            <tbody class="align-top">
                <?php foreach ($res as $data) : ?>
                    <tr class="uppercase  text-neutral-500 shadow-md hover:bg-slate-100">
                        <td class="px-4 py-3 select-none cursor-pointer align-middle" style="height: 72px; min-height: 72px;">
                            <div>
                                <?= $data['USERNAME'] ?>
                            </div>
                        </td>
                        <td class="px-4 py-3 select-none cursor-pointer align-middle" style="height: 72px; min-height: 72px;">
                            <div>
                                <?= $data['TEAM'] ?>
                            </div>
                        </td>

                        <td class="px-4 py-3 select-none cursor-pointer align-middle" style="height: 72px; min-height: 72px;">
                            <div>
                                <?= $data[4] ?>
                            </div>
                        </td>
                       <td class="px-4 py-3 select-none cursor-pointer align-middle" style="height: 72px; min-height: 72px;">
                            <div>
                                <?= $data[1] ?>
                            </div>
                        </td>
                        <td class="px-4 py-3 select-none cursor-pointer align-middle" style="height: 72px; min-height: 72px;">
                            <div>
                                <?php if ($data[4] > 0) :  ?>
                                    <?= number_format(($data[1] * 100) / $data[4], 2, ",", ".") . " %"  ?>
                                <?php else : ?>
                                    <?= number_format(0, 2, ",", ".") . " %"  ?>
                                <?php endif; ?>
                            </div>
                        </td>
                       
                        <td class="px-4 py-3 select-none cursor-pointer align-middle" style="height: 72px; min-height: 72px;">
                            <div>
                                <?= $data[0] ?>
                            </div>
                        </td>
                        <td class="px-4 py-3 select-none cursor-pointer align-middle" style="height: 72px; min-height: 72px;">
                            <div>
                                <?php if ($data[4] > 0) :  ?>
                                    <?= number_format(($data[0] * 100) / $data[4], 2, ",", ".") . " %"  ?>
                                <?php else : ?>
                                    <?= number_format(0, 2, ",", ".") . " %"  ?>
                                <?php endif; ?>
                            </div>
                        </td>
                         <td class="px-4 py-3 select-none cursor-pointer align-middle" style="height: 72px; min-height: 72px;">
                            <div>
                                <?= $data[2] ?>
                            </div>
                        </td>
                        <td class="px-4 py-3 select-none cursor-pointer align-middle" style="height: 72px; min-height: 72px;">
                            <div>
                                <?php if ($data[4] > 0) :  ?>
                                    <?= number_format(($data[2] * 100) / $data[4], 2, ",", ".") . " %"  ?>
                                <?php else : ?>
                                    <?= number_format(0, 2, ",", ".") . " %"  ?>
                                <?php endif; ?>
                            </div>
                        </td>
                       
                        <td class="px-4 py-3 select-none cursor-pointer align-middle" style="height: 72px; min-height: 72px;">
                            <div>
                                <?= $data[3] ?>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php else : ?>
    <div class="border-neutral-200 rounded-md w-full h-[660px] overflow-x-auto overflow-y-auto  ">
        <table class="table-fixed bg-white min-w-full overflow-x-auto font-inter text-center border-separate border-spacing-y-3">
            <thead class="border-b-2 border-neutral-200">
                <tr class="uppercase font-bold text-black ">
                    <th class="px-4 py-3 select-none cursor-pointer" style="width: 150px;min-width: 150px;" colspan="10">
                        <div class="text-base flex items-end justify-center">
                            <div>
                                Status Ticket
                            </div>
                        </div>
                    </th>
                </tr>
                <tr class="uppercase font-bold text-black ">
                    <th class="px-4 elect-none cursor-pointer" style="width: 150px;min-width: 150px;">
                        <div class="flex justify-center  h-16">
                            <div>
                                Name
                            </div>
                        </div>
                    </th>
                    <th class="px-4 py-3 select-none cursor-pointer" style="width:160px;min-width:160px;">
                        <div class="flex justify-center h-16">
                            <div class=" text-primary-700 cursor-pointer">
                                Team
                            </div>
                        </div>
                    </th>
                    <th class="px-4 py-3 select-none cursor-pointer" style="width:150px;min-width:150px;">
                        <div class="flex justify-center items-center h-16">
                            <div>
                                Solved
                            </div>
                        </div>
                    </th>
                    <th class="px-4 py-3 select-none cursor-pointer" style="width:150px;min-width:150px;">
                        <div class="flex justify-center items-center h-16">
                            <div>
                                %
                            </div>
                        </div>
                    </th>
                    <th class="px-4 py-3 select-none cursor-pointer" style="width:100px;min-width:100px;">
                        <div class="flex justify-center items-center h-16">
                            <div>
                                in-Progress
                            </div>
                        </div>
                    </th>
                    <th class="px-4 py-3 select-none cursor-pointer" style="width:150px;min-width:150px;">
                        <div class="flex justify-center items-center h-16">
                            <div>
                                %
                            </div>
                        </div>
                    </th>
                    <th class="px-4 py-3 select-none cursor-pointer" style="width:150px;min-width:150px;">
                        <div class="flex justify-center items-center h-16">
                            <div>
                                Open
                            </div>
                        </div>
                    </th>
                    <th class="px-4 py-3 select-none cursor-pointer" style="width:160px;min-width:160px;">
                        <div class="flex justify-center items-center h-16">
                            <div>
                                %
                            </div>
                        </div>
                    </th>
                    <th class="px-4 py-3 select-none cursor-pointer" style="width: 100px;min-width: 100px;">
                        <div class="flex justify-center items-center h-16">
                            <div>
                                Total Ticket
                            </div>
                        </div>
                    </th>
                    <th class="px-4 py-3 select-none cursor-pointer" style="width:250px;min-width:250px;">
                        <div class="flex justify-center items-center h-16">
                            <div>
                                Respon Time
                            </div>
                        </div>
                    </th>
                </tr>
            </thead>
            <tbody class="align-top">
                <tr class="uppercase text-xs text-neutral-500">
                    <td class="px-4 select-none cursor-pointer" colspan="10">
                        <div>
                            <p class="text-primary text-sm font-bold">Data Tidak Ditemukan...</p>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
<?php endif; ?>