function SearchAccount(sort = 'ASC' , index = 1) {
    let keyword = $('#search-account').val()

    $.ajax({
        url : 'action/TabelAccountSetting.php',
        method : 'post',
        data: {keyword:keyword , index:index , sort:sort},
        success : function(data){
            $('#ticketing-table-setting').html(data);
        }
    })
}

function SearchTeam() {
    let keyword = $('#search-team').val()
    $.ajax({
        url :'action/TabelAccountUser.php',
        data : {keyword},
        method:'post',
        success : function(data){
            $('#ticketing-table-setting').html(data);
        }
    })
}

SearchAccount()

$('#search-account').on('keyup', function (){
    SearchAccount()
})

$('#search-team').on('keyup', function (){
    SearchTeam()
})

$('#sort').on('click' , function(){
    val = $('#sort').html();
    if (val === 'A-Z') {
        $('#sort').html('Z-A');
        SearchAccount('DESC')
    } else{
        $('#sort').html('A-Z');
        SearchAccount('ASC')
    }
})

$('#ticketing-table-setting').on('click' ,'.page-item', function(){
    const index = $(this).data('index');
    val = $('#sort').html();
    if(val === 'A-Z') {
        val = 'ASC'
    } else {
        val = 'DESC'
    }
    SearchAccount(val,index)
})




$('#account-btn').on('click', function () {
    $('#import').addClass('flex').removeClass('hidden')
    $('#search-team').addClass('hidden')
    $('#search-account').removeClass('hidden')
    SearchAccount();
})

$('#team-btn').on('click', function () {
    $('#import').removeClass('flex').addClass('hidden')
    SearchTeam();
    $('#search-account').addClass('hidden')
    $('#search-team').removeClass('hidden')
})
// End Tampilan data setting

// Tombol Edit
$('#ticketing-table-setting').on('click', '.edit-btn', function () {
    $('#overlay-setting').toggleClass('hidden')
    $('#overlay-setting').toggleClass('flex')
    $('h4').html('Revisi Data Customer')
    $('form#form-user button[type=submit]').html('SAVE')
    $('form#form-user').attr('action', 'action/editSetting.php')

    const id = $(this).data('id');

    $.ajax({
        url : 'action/dataEditAccount.php',
        data : {id},
        method : 'post',
        dataType : 'json',
        success : function (data){
            console.log(data);
            $('#cust_account').val(data.ACCOUNT);
            $('#cust_name').val(data.BIG_GROUPING_CUST);
            $('#Cust_name_grouping').val(data.BIG_GROUPING_CUST);
            $('#cust_branch').val(data.CUST_BRANCH);
            $('#cust_industry').val(data.CUST_INDUSTRY_NEW);
            $('#payment_metode').val(data.PAYMENT_METODE);
            $('#pic_frontline').val(data.PIC_FRONTLINE);
            $('#team_fl').val(data.TEAM);
        }
    })


})
// End Tombol Edit  
// Tombol Create
$('#create_account-setting').on('click', function () {
    $('#overlay-setting').toggleClass('hidden')
    $('#overlay-setting').toggleClass('flex')
    $('h4').html('Add Account')
    $('form#form-user').attr('action', '')
    $('form#form-user button[type=submit]').html('ADD ACCOUNT')
    $('form#form-user input[type=text]').val('')
})

$('#close-modal-setting , #cancel-modal-setting').on('click', function () {
    $('#overlay-setting').toggleClass('hidden')
    $('#overlay-setting').toggleClass('flex')
})
// Tombol Create
// Tombol Import
$('#import-setting').on('click', function () {
    $('#overlay-import').toggleClass('hidden')
    $('#overlay-import').toggleClass('flex')
})

$('#close-modal-import-setting').on('click', function () {
    $('#overlay-import').toggleClass('hidden')
    $('#overlay-import').toggleClass('flex')
})
