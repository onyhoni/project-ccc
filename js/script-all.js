
window.addEventListener('DOMContentLoaded', () => {
// Navigasi
    // Navbar Fixed 


    window.onscroll = function() {
        const header = document.querySelector('.header');
        const fixedNav = header.offsetTop;

        if(window.pageYOffset > fixedNav) {
            header.classList.add('navbar-fixed');
        }else{
            header.classList.remove('navbar-fixed');
        }
    }

    $('#hamburger').on('click', function(){
        $('#hamburger').toggleClass('hamburger-active');
        $('#nav-menu').toggleClass('hidden');   
    })

    $('#action').on('click', function(){
        $('#action-menu').toggleClass('hidden');   
    })

    $('#close-hasil-upload').on('click', function(){
        document.location.href = ''
    })

// Activities


// User Main

// Setting




//Tampilan data setting

    
    // End Tombol Import
    // End Setting

    

    })


    


