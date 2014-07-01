function checkradio($id) {
    $('#' + $id).trigger('click');
}

function myTrim(x) {
    return x.replace(/^\s+|\s+$/gm, '');
}

$('document').ready(function() {
    $('.Rainbow_A input[type=radio]:first').attr('checked', 'checked');

    $('#designer_options_font_colour span').click(function() {
        $('#designer_options_font_colour span').removeClass('selected');
        $(this).addClass('selected');

        var font_class_str = $(this).attr('class');
        var font_class = font_class_str.replace("selected", "");
        font_class = myTrim(font_class);

        switch (font_class) {
            case 'font_colour_white':
                $('.preview_text').css('color', '#ffffff');
                $('#font_colour').val('2');
                break;
            default:
                $('.preview_text').css('color', '#000000');
                $('#font_colour').val('1');
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

        /* update form element*/
        $('#background_colour').val('9');
    });

    /* activate rain bow b*/
    $('#designer_options_colours .Rainbow_B').click(function() {
        $('#designer_preview').removeClass('individual_preivew');
        $('#designer_preview').removeClass('designer_preview_rainbow_a');
        $('#designer_preview').addClass('designer_preview_rainbow_b');
        $('#designer_preview').css('background', 'url(images/pencil/rainbow-b.png) no-repeat scroll 0% 0% transparent');

        /* update form element*/
        $('#background_colour').val('10');
    });

    /* activate individual color*/
    $('#designer_options_colours .Individual span').click(function() {
        $('#designer_preview').removeClass('designer_preview_rainbow_a');
        $('#designer_preview').removeClass('designer_preview_rainbow_b');
        $('#designer_preview').addClass('individual_preivew');

        var span_class_string = $(this).attr('class');
        var span_class = span_class_string.split(" ");
        var individual_color = span_class[0];
        var image_name = $.inArray( individual_color, _colourArray);
        image_no = image_name.toString();

        $('#designer_preview').css('background', 'url(images/pencil/' + image_name + '.png) no-repeat 30px 54px');

        /* update form element*/
        $('#background_colour').val(image_name);
    });


    /* update text on key up*/

    $('.details_text_name').keyup(function() {
        var content = $(this).val();

        $('p.error-msg').html('');

        if (content.length > 23) {
            content = content.substr(0, 24);
            $('p.error-msg').html('Maximum 24 character allowed !');
        }

        $(this).val(content);

        $('.preview_text').html(content);

        //update hidden element
        $('#text1').val(content);
    });

    


    $('#order_quantity').change(function() {
        $('#quantdesc').val($(this).val());
        var price = _price * $(this).val();
        $('#price').val(price);
    });

    // make default color white
    $('span.font_colour_white').trigger('click');

    // make default background blue
    $("span.029ae1").trigger('click');

    $('#pencil_labels input').click(function(){
       $(this).removeClass('required-field');
    });

    $('#pencil_labels').submit(function(e){
        $('.details_text_name').removeClass('required-field');
        
        var line1 = $('.details_text_name').val();

        if(line1.length<=0) {
            $('.details_text_name').addClass('required-field');
            $('.details_text_name').focus();
            e.preventDefault();
        }
    });
});
