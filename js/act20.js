function SearchLive(index = 1) {

    let keyword = $('#inputSearch').val()
    let statusVal = $('#input-status').val()
    let CustomerVal = $('#input-customer').val()
    let CountData = $('#input-data').val()
    let dateStart = $('#input-date-start').val()
    let dateEnd = $('#input-date-end').val()
    let dateAction = $('#input-action').val()
    let regionals = $('#input-regional').val()



    $.ajax({
        url: 'action/tabelActivities.php',
        method: 'post',
        data: { keyword: keyword, statusVal: statusVal, CustomerVal: CustomerVal, CountData: CountData, index: index, dateStart: dateStart, dateEnd: dateEnd, dateAction: dateAction, regionals:regionals },
        success: (result) => {
            $('#ticketing-table-activities').html(result);
        }
    })



}
$('#ticketing-table-activities').html(SearchLive())

$('#inputSearch').on('keyup', () => {
    SearchLive();
})

$('#input-status , #input-customer , #input-action , #input-date-start , input-date-end , #input-data, #input-regional').on('change', () => {
    SearchLive();
})

$('#ticketing-table-activities').on('click', '.page-item', function () {
    index = $(this).data('index')
    SearchLive(index);
    $(this).addClass('bg=black')
})

// Action Take
$("#take").on("click", function () {
    var id = [];

    $(":checkbox:checked").each(function (i) {
        id[i] = $(this).val();
        console.log(id);
    });

    if (id.length === 0) {
        //tell you if the array is empty
        alert("Belum ada yang terceklist");
    } else {
        $.ajax({
            url: "action/Take.php",
            method: "POST",
            data: { id: id },
            success: function () {
                alert(" Ticket Berhasil Diambil");
                window.location.href = "Activites2.php";
            },
        });
    }
});
// End Action 
$('#import-file').on('click', function () {
    $('#overlay-import-fl').toggleClass('hidden')
    $('#overlay-import-fl').toggleClass('flex')
})
$('#import-file1').on('click', function () {
    $('#overlay-import-bl').toggleClass('hidden')
    $('#overlay-import-bl').toggleClass('flex')
})

$('#close-modal-import-fl').on('click', function () {
    $('#overlay-import-fl').toggleClass('hidden')
    $('#overlay-import-fl').toggleClass('flex')
})
$('#close-modal-import-bl').on('click', function () {
    $('#overlay-import-bl').toggleClass('hidden')
    $('#overlay-import-bl').toggleClass('flex')
})


$('.detail-ticket').on('click', function () {
    $('#overlay-detail-ticket').toggleClass('hidden')
    $('#overlay-detail-ticket').toggleClass('flex')
})

$('#close-modal-detail').on('click', function () {
    $('#overlay-detail-ticket').toggleClass('hidden')
    $('#overlay-detail-ticket').toggleClass('flex')
})

var LINKFOTO = ""

$('#popup-foto').on('click', function () {
    $('#overlay-popup-foto').toggleClass('hidden')
    $('#overlay-popup-foto').toggleClass('flex')

    LINKFOTO = $(this).data('id');
    console.log(LINKFOTO);

    $('#foto-overlay img').attr('src', LINKFOTO)
})

$('#close-popup-foto').on('click', function () {
    $('#overlay-popup-foto').toggleClass('hidden')
    $('#overlay-popup-foto').toggleClass('flex')
    $('#foto-overlay').removeClass("bg-[url(" + LINKFOTO + ")]")
})


$('#bgfile').on('change', function () {

    var file_name = $("#bgfile")[0].files[0].name;
    $('#upload-name').html(file_name)
})
$('#bgfile1').on('change', function () {

    var file_name = $("#bgfile1")[0].files[0].name;
    $('#upload-name1').html(file_name)
})

$('#lampiran').on('change', function () {

    var file_name = $("#lampiran")[0].files[0].name;
    $('#lampiran-label').html(file_name)
})


$('#ticketing-table-activities').on('change', '#check-all', function () {
    const status = $('#ticketing-table-activities .status')
    const box = $('#ticketing-table-activities .check')

    const boxAll = document.querySelector('#ticketing-table-activities #check-all')
    if(boxAll.checked == true ) {
        for (let i = 0; i < status.length; i++) {
            const element = status[i].value;
            if (element !== "CLOSE") {
                box[i].checked = true
            }
        }
    } else {
        for (let i = 0; i < status.length; i++) {
            box[i].checked = false
        }
    }


   
})

$("#delete").on("click", function () {
    if(confirm('Apakah Yakin hapus')) {
        var id = [];
        $(":checkbox:checked").each(function (i) {
            id[i] = $(this).val();
            console.log(id);
        });
    
        if (id.length === 0) {
            //tell you if the array is empty
            alert("Belum ada yang terceklist");
        } else {
            $.ajax({
                url: "action/delete.php",
                method: "POST",
                data: { id: id },
                success: function () {
                    alert(" Tiket Berhasil Dihapus");
                    window.location.href = "Activites2.php";
                },
            });
        }
    } else {

        return false;
    }
    
});

$("#close").on("click", function () {

    if(confirm('Apakah yakin tiket sudah close ?')) {
        var id = [];
        $(":checkbox:checked").each(function (i) {
            id[i] = $(this).val();
            console.log(id);
        });
    
        if (id.length === 0) {
            //tell you if the array is empty
            alert("Belum ada yang terceklist");
        } else {
            $.ajax({
                url: "action/close.php",
                method: "POST",
                data: { id: id },
                success: function () {
                    alert(" Tiket Berhasil ditutup");
                    window.location.href = "Activites2.php";
                },
            });
        }
    } else {
        return false ;
    }
    
});



// End Activities