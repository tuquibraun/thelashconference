$(function(){
    var welcomeSection = $('.welcome-section');

    setTimeout(function(){
        welcomeSection.removeClass('content-hidden'),
        $('.nav').removeClass('content-hidden')
    }, 500);


    var navEl = $('.nav'),
        navToggleBtn = navEl.find('.icon.toggle-btn');
    
    navToggleBtn.on('click' , function(e) {
        navEl.toggleClass('active');
        navToggleBtn.toggleClass('active');

    })

    window.addEventListener('scroll', function(){
        var currScrollPos = $(document).scrollTop();
        if (currScrollPos > 300) {
            $('.people-section').removeClass('content-hidden');
        }else{
            $('.people-section').addClass('content-hidden');
        }
    })

    
})