function scrollToSection(id){
    $('html, body').animate({
        scrollTop: $("#section-" + id).offset().top - 100
    }, 600);
}