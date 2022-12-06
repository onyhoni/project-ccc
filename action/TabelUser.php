<?php
require '../functions.php';

$index = $_POST['index'];
$sort = $_POST['sort'];
$jumlahDataPerhalaman = 10;

$halamanAktif = $index;
$awalData = ($jumlahDataPerhalaman * $halamanAktif) - $jumlahDataPerhalaman;

$keyword = $_POST['input'];

$result = queryAll("SELECT * FROM user INNER JOIN team_tabel ON user.TEAM = team_tabel.TEAM_ID WHERE USERNAME  LIKE '%$keyword%' OR USER_ID LIKE '%$keyword%' OR team_tabel.TEAM LIKE '%$keyword%' ORDER BY CREATE_DATE $sort LIMIT $awalData,$jumlahDataPerhalaman");

$hasil = queryAll("SELECT * FROM user INNER JOIN team_tabel ON user.TEAM = team_tabel.TEAM_ID WHERE USERNAME  LIKE '%$keyword%' OR USER_ID LIKE '%$keyword%' OR team_tabel.TEAM LIKE '%$keyword%' ORDER BY CREATE_DATE ASC");

$jmlHasil = count($hasil);

if (isset($result)) {
    $rowCount  = mysqli_affected_rows($conn);
}
$jumlahhalaman = ceil($jmlHasil / $jumlahDataPerhalaman);
?>


<div class="border-neutral-200 rounded-md w-full h-full overflow-x-auto ">
    <table class="table-fixed bg-white min-w-full overflow-x-auto font-inter text-center border-separate border-spacing-y-3">
        <thead class="border-b-2 border-neutral-200">
            <tr class="uppercase text-xs font-bold text-black ">
                <th class="px-4 py-3 select-none cursor-pointer" style="width: 150px;min-width: 150px;">
                    <div class="">
                        <div>
                            Actions
                        </div>
                    </div>
                </th>
                <th class="px-4 py-3 select-none cursor-pointer" style="width:160px;min-width:160px;">
                    <div class="">
                        <div class="text-primary-700 cursor-pointer">
                            Created Date
                        </div>
                    </div>
                </th>
                <th class="px-4 py-3 select-none cursor-pointer" style="width:150px;min-width:150px;">
                    <div class="">
                        <div>
                            Last Edited
                        </div>
                    </div>
                </th>
                <th class="px-4 py-3 select-none cursor-pointer" style="width:150px;min-width:150px;">
                    <div class="">
                        <div>
                            User Name
                        </div>
                    </div>
                </th>
                <th class="px-4 py-3 select-none cursor-pointer" style="width:100px;min-width:100px;">
                    <div class="">
                        <div>
                            Email ID
                        </div>
                    </div>
                </th>
                <th class="px-4 py-3 select-none cursor-pointer" style="width:150px;min-width:150px;">
                    <div class="">
                        <div>
                            Phone Number
                        </div>
                    </div>
                </th>
                <th class="px-4 py-3 select-none cursor-pointer" style="width:150px;min-width:150px;">
                    <div class="">
                        <div>
                            ID
                        </div>
                    </div>
                </th>
                <th class="px-4 py-3 select-none cursor-pointer" style="width:160px;min-width:160px;">
                    <div class="">
                        <div>
                            Team
                        </div>
                    </div>
                </th>
                <th class="px-4 py-3 select-none cursor-pointer" style="width: 100px;min-width: 100px;">
                    <div class="">
                        <div>
                            Type User
                        </div>
                    </div>
                </th>
                <th class="px-4 py-3 select-none cursor-pointer" style="width:250px;min-width:250px;">
                    <div class="">
                        <div>
                            Password
                        </div>
                    </div>
                </th>
            </tr>
        </thead>
        <tbody class="align-top">
            <?php foreach ($result as $data) : ?>
                <tr class="uppercase text-xs text-neutral-500 shadow-md hover:bg-slate-100">
                    <td class="px-4 py-3 select-none cursor-pointer align-middle" style="height: 72px; min-height: 72px;">
                        <div>
                            <button><i class="fa-solid fa-eye mr-5 text-xl hover:bg-slate-300 rounded-full"></i></button>
                            <button class="edit-btn" data-id="<?= $data['USER_ID'] ?>"><i class=" fa-solid fa-pen mr-5 text-xl
                                                        hover:bg-slate-300 rounded-full"></i></button>
                            <a href="action/delUser.php?id=<?= $data['USER_ID'] ?>" onclick="return confirm('Apakah yakin dihapus ?')"><i class="fa-solid fa-trash text-xl hover:bg-slate-300 rounded-full"></i></a>
                        </div>
                    </td>
                    <td class="px-4 py-3 select-none cursor-pointer align-middle" style="height: 72px; min-height: 72px;">
                        <div>
                            <?= $data['CREATE_DATE'] ?>
                        </div>
                    </td>
                    <td class="px-4 py-3 select-none cursor-pointer align-middle" style="height: 72px; min-height: 72px;">
                        <div>
                            <?= $data['UPDATE_DATE'] ?>
                        </div>
                    </td>
                    <td class="px-4 py-3 select-none cursor-pointer align-middle" style="height: 72px; min-height: 72px;">
                        <div>
                            <?= $data['USERNAME'] ?>
                        </div>
                    </td>
                    <td class="px-4 py-3 select-none cursor-pointer align-middle" style="height: 72px; min-height: 72px;">
                        <div>
                            <?= $data['EMAIL'] ?>
                        </div>
                    </td>
                    <td class="px-4 py-3 select-none cursor-pointer align-middle" style="height: 72px; min-height: 72px;">
                        <div>
                            <?= $data['MOBILE_NO'] ?>
                        </div>
                    </td>
                    <td class="px-4 py-3 select-none cursor-pointer align-middle" style="height: 72px; min-height: 72px;">
                        <div>
                            <?= $data['USER_ID'] ?>
                        </div>
                    </td>
                    <td class="px-4 py-3 select-none cursor-pointer align-middle" style="height: 72px; min-height: 72px;">
                        <div>
                            <?= $data['TEAM'] ?>
                        </div>
                    </td>
                    <td class="px-4 py-3 select-none cursor-pointer align-middle" style="height: 72px; min-height: 72px;">
                        <div>
                            <?= $data['TYPE_USER'] ?>
                        </div>
                    </td>
                    <td class="px-4 py-3 select-none cursor-pointer align-middle" style="height: 72px; min-height: 72px;">
                        <div>
                            <?= $data['PASSWORD'] ?>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<div class="text-gray-300 flex items-center space-x-2 select-none mt-5" id="pagination">
    <button type="button" class="h-8 w-8 p-1 hover:bg-gray-700 rounded page-control" data-action="minus"><svg fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"></path>
        </svg>
    </button>
    <div class="space-x-1">
        <?php for ($i = 1; $i <= $jumlahhalaman; $i++) : ?>
            <?php if ($i == $index) : ?>
                <button type="button" class="hover:bg-gray-700 bg-gray-700 px-2 rounded page-item" data-index="<?= $i ?>"><?= $i ?></button>
            <?php else : ?>
                <button type="button" class="hover:bg-gray-700  px-2 rounded page-item" data-index="<?= $i ?>"><?= $i ?></button>
            <?php endif; ?>
            <?php if ($i == 6) {
                break;
            } ?>
        <?php endfor ?>
    </div>
    <button type="button" class="h-8 w-8 p-1 hover:bg-gray-700 rounded page-control" data-action="plus">
        <svg fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
        </svg>
    </button>
    <p class="text-black font-inter">Hasil <span class="font-bold"><?= $jmlHasil ?></span></p>
</div>