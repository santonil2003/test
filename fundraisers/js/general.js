function r(data) {
    console.log(data);
}

function reload() {
    location.replace(document.URL);
}


$('documet').ready(function() {
    // hide system notification msg
    $('.notification-message span').click(function() {
        $(this).parent().fadeOut('slow');
    });

});