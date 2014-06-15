function checkradio($id) {
    $('#' + $id).trigger('click');
}

$('document').ready(function() {
    $('.Rainbow_A input[type=radio]:first').attr('checked', 'checked');

    $('#designer_options_font_colour span').click(function() {
        $('#designer_options_font_colour span').removeClass('selected');
        $(this).addClass('selected');

        font_class_str = $(this).attr('class');
        font_class = font_class_str.replace("selected", "");
        font_class = font_class.trim();

        switch (font_class) {
            case 'font_colour_white':
                $('.preview_text').css('color', '#ffffff');
                break;
            default:
                $('.preview_text').css('color', '#000000');
                break;
        }
    });

    $('#designer_options_colours span').click(function() {
        $('#designer_options_colours span').removeClass('selected');
        $(this).addClass('selected');
    });

    /* activate rain bow a*/
    $('#designer_options_colours .Rainbow_A').click(function() {
        $('#designer_preview').removeClass('individual_preivew');
        $('#designer_preview').removeClass('designer_preview_rainbow_b');
        $('#designer_preview').addClass('designer_preview_rainbow_a');
        $('#designer_preview').css('background', 'url(images/pencil/rainbow-a.png) no-repeat scroll 0% 0% transparent');
    });

    /* activate rain bow b*/
    $('#designer_options_colours .Rainbow_B').click(function() {
        $('#designer_preview').removeClass('individual_preivew');
        $('#designer_preview').removeClass('designer_preview_rainbow_a');
        $('#designer_preview').addClass('designer_preview_rainbow_b');
        $('#designer_preview').css('background', 'url(images/pencil/rainbow-b.png) no-repeat scroll 0% 0% transparent');
    });

    /* activate individual color*/
    $('#designer_options_colours .Individual span').click(function() {
        $('#designer_preview').removeClass('designer_preview_rainbow_a');
        $('#designer_preview').removeClass('designer_preview_rainbow_b');
        $('#designer_preview').addClass('individual_preivew');

        var span_class_string = $(this).attr('class');
        var span_class = span_class_string.split(" ");
        var image_name = _colourArray.indexOf(span_class[0]);
        $('#designer_preview').css('background', 'url(images/pencil/' + image_name + '.png) no-repeat 30px 54px rgba(0, 0, 0, 0)');
    });


    /* update text on key up*/

    $('.details_text_name').keyup(function() {
        $('.preview_text').html($(this).val());
    });

});
