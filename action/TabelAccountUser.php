<?php
require '../functions.php';

$keyword = $_POST['keyword'];
$result = mysqli_query($conn, "SELECT user.TEAM as id , user.TYPE_USER , team_tabel.TEAM FROM `user` INNER JOIN team_tabel ON team_tabel.TEAM_ID = user.TEAM WHERE team_tabel.TEAM LIKE '%$keyword%' OR user.TYPE_USER LIKE '%$keyword%'");

if (isset($result)) {
    $rowCount  = mysqli_affected_rows($conn);
}

if ($rowCount > 0) {
    while ($rtl = mysqli_fetch_assoc($result)) {
        $inds[$rtl['TEAM'] . $rtl['TYPE_USER']] = [
            "user" => $rtl['TYPE_USER'],
            "team" => $rtl['TEAM'],
            "id" => $rtl['id'],
        ];

        $total[$rtl['TEAM'] . $rtl['TYPE_USER']][] = $rtl['TEAM'] . $rtl['TYPE_USER'];
    }


    foreach ($total as $key => $value) {
        $total[$key] = array_count_values($value);
        array_push($inds[$key],  $total[$key][$key]);
    }
}

if (isset($result)) {
    $rowCount  = mysqli_affected_rows($conn);
}

?>

<?php if ($rowCount > 0) : ?>

    <div class="border-neutral-200 rounded-md w-full h-[660px] overflow-x-auto overflow-y-auto  ">
        <table class="table-fixed bg-white min-w-full overflow-x-auto font-inter border-separate border-spacing-y-3 whitespace-nowrap">
            <thead class="border-b-2 border-neutral-200">
                <tr class="uppercase text-md font-bold text-black ">
                    <th class="px-4 py-3 select-none cursor-pointer" style="width: 150px;min-width: 150px;">
                        <div class="flex items-start">
                            <div>
                                Actions
                            </div>
                        </div>
                    </th>
                    <th class="px-4 py-3 select-none cursor-pointer" style="width:160px;min-width:160px;">
                        <div class=" flex items-start">
                            <div class="text-primary-700 cursor-pointer">
                                Team
                            </div>
                        </div>
                    </th>
                    <th class="px-4 py-3 select-none cursor-pointer" style="width:150px;min-width:150px;">
                        <div class="flex items-start">
                            <div>
                                Type User
                            </div>
                        </div>
                    </th>
                    <th class="px-4 py-3 select-none cursor-pointer" style="width:150px;min-width:150px;">
                        <div class="flex items-start">
                            <div>
                                Total User
                            </div>
                        </div>
                    </th>
                </tr>
            </thead>
            <tbody class="align-top">
                <?php foreach ($inds as $i => $data) : ?>
                    <tr class="uppercase  text-neutral-500 shadow-md hover:bg-slate-100">
                        <td class="px-4 py-3 select-none cursor-pointer align-middle" style="height: 72px; min-height: 72px;">
                            <div>
                                <a href="action/delSettingTeam.php?team=<?= $data['id'] ?>&type=<?= $data['user'] ?>" class="uppercase py-1 px-2 rounded-md  font-semibold ml-2 mt-1  bg-[#ffefe8] text-[#b42a04]" onclick="return confirm('Apakah Yakin dihapus ?')">Delete</a>
                            </div>
                        </td>
                        <td class="px-4 py-3 select-none cursor-pointer align-middle" style="height: 72px; min-height: 72px;">
                            <div>
                                <?= $data['team'] ?>
                            </div>
                        </td>
                        <td class="px-4 py-3 select-none cursor-pointer align-middle" style="height: 72px; min-height: 72px;">
                            <div>
                                <?= $data['user'] ?>
                            </div>
                        </td>
                        <td class="px-4 py-3 select-none cursor-pointer align-middle" style="height: 72px; min-height: 72px;">
                            <div>
                                <?= $data[0] ?>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

<?php else : ?>

    <div class="border-neutral-200 rounded-md w-full h-[660px] overflow-x-auto overflow-y-auto  ">
        <table class="table-fixed bg-white min-w-full overflow-x-auto font-inter border-separate border-spacing-y-3 whitespace-nowrap">
            <thead class="border-b-2 border-neutral-200">
                <tr class="uppercase text-md font-bold text-black ">
                    <th class="px-4 py-3 select-none cursor-pointer" style="width: 150px;min-width: 150px;">
                        <div class="flex items-start">
                            <div>
                                Actions
                            </div>
                        </div>
                    </th>
                    <th class="px-4 py-3 select-none cursor-pointer" style="width:160px;min-width:160px;">
                        <div class=" flex items-start">
                            <div class="text-primary-700 cursor-pointer">
                                Team
                            </div>
                        </div>
                    </th>
                    <th class="px-4 py-3 select-none cursor-pointer" style="width:150px;min-width:150px;">
                        <div class="flex items-start">
                            <div>
                                Type User
                            </div>
                        </div>
                    </th>
                    <th class="px-4 py-3 select-none cursor-pointer" style="width:150px;min-width:150px;">
                        <div class="flex items-start">
                            <div>
                                Total User
                            </div>
                        </div>
                    </th>
                </tr>
            </thead>
            <tbody class="align-top">
                <tr class="uppercase text-xs text-neutral-500 text-center">
                    <td class="px-4 select-none cursor-pointer" colspan="4">
                        <div>
                            <p class="text-primary text-sm font-bold">Data Tidak Ditemukan...</p>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
<?php endif; ?>