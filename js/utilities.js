/* Includes header and footer*/

$(document).ready(function() {

    $(function() {
        var includes = $('[data-include]');
        jQuery.each(includes, function() {
            var file = '../html/' + $(this).data('include') + '.html';
            $(this).load(file);
        });
    });

});

/* Scroll Top */

window.onscroll = function() {
    scrollFunction()
};

function scrollFunction() {
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        document.getElementById("btnDownTop").style.display = "block";
    } else {
        document.getElementById("btnDownTop").style.display = "none";
    }
}