
    $('#create-user').on('click', function () {
        $('#overlay-user').toggleClass('hidden')
        $('#overlay-user').toggleClass('flex')
        $('#overlay-user h4').html('Create User')
        $('.not-edit').addClass('flex')

        $('form#form-user').attr('action', '')
        $('form#form-user button[type=submit]').html('ADD USER')
        $('form#form-user input[type=text]').val('')
        $('form#form-user input[type=email]').val('')
        $('.not-edit').removeClass('hidden')

    })

    $('#close-modal-user , #cancel-modal').on('click', function () {
        $('#overlay-user').toggleClass('hidden')
        $('#overlay-user').toggleClass('flex')
    })

    $('#ticketing-table-user').on('click', '.edit-btn',function () {
        const id = $(this).data('id');
        $('#overlay-user').toggleClass('hidden')
        $('#overlay-user').toggleClass('flex')

        $('#overlay-user h4').html('Revisi Data User')
        $('.not-edit').addClass('hidden')

        $('form#form-user').attr('action', 'action/editUser.php')
        $('form#form-user button[type=submit]').html('SAVE')

        $.ajax({
            url : 'action/dataEditUser.php',
            method : 'post',
            dataType:'json',
            data: {id},
            success : function(data){
                $('#first_name').val(data.FIRST_NAME);
                $('#last_name').val(data.LAST_NAME);
                $('#mobile_no').val(data.MOBILE_NO);
                $('#email_id').val(data.EMAIL);
                $('#id').val(data.USER_ID);
                $('#Team').val(data.TEAM);
                $('#branch').val(data.BRANCH);
            }
        })
    })


    $('#import-user').on('click', function () {
        $('#overlay-import').toggleClass('hidden')
        $('#overlay-import').toggleClass('flex')

    })
    $('#close-modal-import').on('click', function () {
        $('#overlay-import').toggleClass('hidden')
        $('#overlay-import').toggleClass('flex')
    })

    

    function UserSearch(sort ='ASC' , index=1 ) {
        const input = $('#search-user').val()
        $.ajax({
            url: 'action/TabelUser.php',
            data : {input : input , sort : sort , index:index},
            method:'post',
            success : function(data){
                $('#ticketing-table-user').html(data)
            }
        })

    }

    UserSearch();

    $('#search-user').on('keyup', function(){
        UserSearch();
    })

    let val = ''

    $('#sort').on('click' , function(){
        val = $('#sort').html();
        if (val === 'A-Z') {
            $('#sort').html('Z-A');
            UserSearch('DESC')
        } else{
            $('#sort').html('A-Z');
            UserSearch('ASC')
        }
    })

    $('#ticketing-table-user').on('click', '.page-item', function(){
        const index = $(this).data('index');
        val = $('#sort').html();
        if(val === 'A-Z') {
            val = 'ASC'
        } else {
            val = 'DESC'
        }
        UserSearch(val,index)
    })

// End User Main