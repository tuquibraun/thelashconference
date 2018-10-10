$(function(){
    var welcomeSection = $('.welcome-section');

    setTimeout(function(){
        welcomeSection.removeClass('content-hidden'),
        $('.nav').removeClass('content-hidden')
    }, 500);

    $('.icon').click(function() {
        $('.icon').toggleClass('active');
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