$(document).ready(function(){
    $('.list-reset.sidebar li a').each(function(){
        if ($(this).attr('href')===location.pathname || $(this).attr('href')===location.pathname+location.search) {
            $(this).removeClass('lg:hover:border-gray-400');
            $(this).addClass('lg:border-purple-500 lg:hover:border-purple-500');
        }
    })
});

$(document).ready(function(){
    $('.list-reset.sidebar.sidebar-profile li a').each(function(){
        if ($(this).attr('href')===location.pathname || $(this).attr('href')===location.pathname+location.search) {
            $(this).removeClass('lg:hover:border-gray-400');
            $(this).addClass('lg:border-purple-500 lg:hover:border-purple-500');
        }
    })
});

$(document).ready(function(){
    $('button.dropdown-mobile').on('click', function(){
        if ($('.dropdown-menu-mobile').hasClass('hidden')){
            $('.dropdown-menu-mobile').removeClass('hidden');
        } else {
            $('.dropdown-menu-mobile').addClass('hidden');
        }
    })
});
