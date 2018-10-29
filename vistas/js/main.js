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

        var people = $('.people-section').offset();
        people = people.top - 450;

        var sponsor = $('.sponsor-section').offset();
        sponsor  = sponsor.top - 500;

        var socialMedia = $('.social-section').offset();
        socialMedia = socialMedia.top - 500;

        if (currScrollPos > people) {
            $('.people-section').removeClass('content-hidden');
        }else{
            $('.people-section').addClass('content-hidden');
        }

        if (currScrollPos > sponsor) {
            $('.sponsor-section').removeClass('content-hidden');
        }else{
            $('.sponsor-section').addClass('content-hidden');
        }

        if (currScrollPos > socialMedia) {
            $('.social-section').removeClass('content-hidden');
        }else{
            $('.people-section').addClass('content-hidden');
        }
    })

    
})