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
    $('.bg-white .tabs button.tab').on('click', function(){
        $(this).prevAll().toggleClass('text-blue-500 border-b-2 font-medium border-blue-500 active',false);
        $(this).nextAll().toggleClass('text-blue-500 border-b-2 font-medium border-blue-500 active',false);
        $(this).addClass('text-blue-500 border-b-2 font-medium border-blue-500 active');
    });

    const tabs = document.querySelectorAll(".tabs");
    const tab = document.querySelectorAll(".tab");
    const panel = document.querySelectorAll(".tab-content");

    function onTabClick(event) {

        // deactivate existing active tabs and panel

        for (let i = 0; i < tab.length; i++) {tab[i].classList.remove("active");}

        for (let i = 0; i < panel.length; i++) {panel[i].classList.remove("active");}

        // activate new tabs and panel
        event.target.classList.add('active');
        let classString = event.target.getAttribute('data-target');
        console.log(classString);
        document.getElementById('panels').getElementsByClassName(classString)[0].classList.add("active");
    }

    for (let i = 0; i < tab.length; i++) {
        tab[i].addEventListener('click', onTabClick, false);
    }
});

$(document).ready(function(){
    $('button.dropdown-mobile').on('click', function(){
        if ($('.dropdown-menu-mobile').hasClass('hidden')){$('.dropdown-menu-mobile').removeClass('hidden');
        } else {$('.dropdown-menu-mobile').addClass('hidden');}
    })
});

$(document).ready(function(){
    $('.profile.group a.dropdown-menu-lk').mouseout(function(){$('.profile.group .origin-top-right-menu').css({"display":"none"});});
    $('.profile.group a.dropdown-menu-lk').mouseover(function(){$('.profile.group .origin-top-right-menu').css({"display":"block"});});
    $('.profile.group .origin-top-right-menu').mouseover(function(){$(this).css({"display":"block"});});
    $('.profile.group .origin-top-right-menu').mouseout(function(){$(this).css({"display":"none"});});
    $('.profile.group a.ur-faces').mouseout(function(){$('.profile.group .origin-top-right-menu').css({"display":"none"});});
    $('.profile.group a.ur-faces').mouseover(function(){$('.profile.group .origin-top-right-menu').css({"display":"none"});});

});
