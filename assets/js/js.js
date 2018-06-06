function scrollToSection(id){
    $('html, body').animate({
        scrollTop: $("#section-" + id).offset().top - 100
    }, 600);
}
//scrolling for header
$(window).scroll(function () {
    if ($(window).scrollTop() > 0) {
        $("nav.menu").addClass("scrolled");
    } else {
        $("nav.menu").removeClass("scrolled");
    }
});