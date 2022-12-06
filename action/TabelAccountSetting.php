<?php
require '../functions.php';

$index = $_POST['index'];
$keyword = $_POST['keyword'];
$sort = $_POST['sort'];

$jumlahDataPerhalaman = 10;
$halamanAktif = $index;
$awalData = ($jumlahDataPerhalaman * $halamanAktif) - $jumlahDataPerhalaman;

$result = queryAll("SELECT * FROM account_tabel WHERE BIG_GROUPING_CUST LIKE '%$keyword%' OR ACCOUNT LIKE '%$keyword%' ORDER BY BIG_GROUPING_CUST $sort LIMIT $awalData , $jumlahDataPerhalaman");
$hasil  = queryAll("SELECT * FROM account_tabel WHERE BIG_GROUPING_CUST LIKE '%$keyword%' OR ACCOUNT LIKE '%$keyword%' ORDER BY BIG_GROUPING_CUST $sort");

$jmlHasil = count($hasil);
if (isset($result)) {
    $rowCount  = mysqli_affected_rows($conn);
}
$jumlahhalaman = ceil($jmlHasil / $jumlahDataPerhalaman);

?>

<div class="border-neutral-200 rounded-md w-full overflow-x-auto">
    <table class="table-fixed bg-white min-w-full overflow-x-auto font-inter text-center border-separate border-spacing-y-3 whitespace-nowrap">
        <thead class="border-b-2 border-neutral-200">
            <tr class="uppercase text-md font-bold text-black ">
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
                            Account
                        </div>
                    </div>
                </th>
                <th class="px-4 py-3 select-none cursor-pointer" style="width:150px;min-width:150px;">
                    <div class="">
                        <div>
                            Cust Name
                        </div>
                    </div>
                </th>
                <th class="px-4 py-3 select-none cursor-pointer" style="width:150px;min-width:150px;">
                    <div class="">
                        <div>
                            Cust Name Grouping
                        </div>
                    </div>
                </th>
                <th class="px-4 py-3 select-none cursor-pointer" style="width:100px;min-width:100px;">
                    <div class="">
                        <div>
                            Cust Industry
                        </div>
                    </div>
                </th>
                <th class="px-4 py-3 select-none cursor-pointer" style="width:150px;min-width:150px;">
                    <div class="">
                        <div>
                            Cust Branch
                        </div>
                    </div>
                </th>
                <th class="px-4 py-3 select-none cursor-pointer" style="width:150px;min-width:150px;">
                    <div class="">
                        <div>
                            Payment Metode
                        </div>
                    </div>
                </th>
                <th class="px-4 py-3 select-none cursor-pointer" style="width:160px;min-width:160px;">
                    <div class="">
                        <div>
                            PIC Frontline
                        </div>
                    </div>
                </th>
                <th class="px-4 py-3 select-none cursor-pointer" style="width: 100px;min-width: 100px;">
                    <div class="">
                        <div>
                            Team FL
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
                            <button class="edit-btn" data-id="<?= $data['ACCOUNT'] ?>"><i class=" fa-solid fa-pen mr-5 text-xl
                        hover:bg-slate-300 rounded-full"></i></button>
                            <a href="action/delAccount.php?id=<?= $data['ACCOUNT'] ?>" onclick="return confirm('Apakah Yakin dihapus ?')"><i class="fa-solid fa-trash text-xl hover:bg-slate-300 rounded-full"></i></a>
                        </div>
                    </td>
                    <td class="px-4 py-3 select-none cursor-pointer align-middle" style="height: 72px; min-height: 72px;">
                        <div>
                            <?= $data['ACCOUNT'] ?>
                        </div>
                    </td>
                    <td class="px-4 py-3 select-none cursor-pointer align-middle" style="height: 72px; min-height: 72px;">
                        <div>
                            <?= $data['BIG_GROUPING_CUST'] ?>
                        </div>
                    </td>
                    <td class="px-4 py-3 select-none cursor-pointer align-middle" style="height: 72px; min-height: 72px;">
                        <div>
                            <?= $data['BIG_GROUPING_CUST'] ?>
                        </div>
                    </td>
                    <td class="px-4 py-3 select-none cursor-pointer align-middle" style="height: 72px; min-height: 72px;">
                        <div>
                            <?= $data['CUST_INDUSTRY_NEW'] ?>
                        </div>
                    </td>
                    <td class="px-4 py-3 select-none cursor-pointer align-middle" style="height: 72px; min-height: 72px;">
                        <div>
                            <?= $data['CUST_BRANCH'] ?>
                        </div>
                    </td>
                    <td class="px-4 py-3 select-none cursor-pointer align-middle" style="height: 72px; min-height: 72px;">
                        <div>
                            <?= $data['PAYMENT_METODE'] ?>
                        </div>
                    </td>
                    <td class="px-4 py-3 select-none cursor-pointer align-middle" style="height: 72px; min-height: 72px;">
                        <div>
                            <?= $data['TEAM'] ?>
                        </div>
                    </td>
                    <td class="px-4 py-3 select-none cursor-pointer align-middle" style="height: 72px; min-height: 72px;">
                        <div>
                            <?= $data['PIC_FRONTLINE'] ?>
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