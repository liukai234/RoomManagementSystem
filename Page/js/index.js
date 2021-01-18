$(function () {

    $('a[href*="#"]:not([href="#"])').click(function () {
        if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
            var target = $(this.hash);
            target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
            if (target.length) {
                $('html, body').animate({
                    scrollTop: target.offset().top
                }, "slow");
                return false;
            }
        }
    });


    // $(window).scroll(function(){
    //     var scrollY = $(document).scrollTop();
    //     if(scrollY > 500) {
    //         $('.navBar').animate({position: 'fixed'}, "slow")
    //     }

    // });
});

