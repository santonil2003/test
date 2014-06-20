function checkradio($id) {
    $('#' + $id).trigger('click');
}

function myTrim(x) {
    return x.replace(/^\s+|\s+$/gm, '');
}

var white_images_folder_path = 'bwl2';
var black_images_folder_path = 'bwl';
var line1 = "";
var line2 = "";
var pic = '1';
var font = '3';

imgfol = black_images_folder_path;


$('document').ready(function() {

    $('.Rainbow_A input[type=radio]:first').attr('checked', 'checked');

    $('#designer_options_font_colour span').click(function() {
        $('#designer_options_font_colour span').removeClass('selected');
        $(this).addClass('selected');

        var font_class_str = $(this).attr('class');
        var font_class = font_class_str.replace("selected", "");
        font_class = myTrim(font_class);

        pic = $('#pic').val();

        switch (font_class) {
            case 'font_colour_white':
                imgfol = white_images_folder_path;
                $('.preview_text, .preview_phone').css('color', '#ffffff');
                $('#font_colour').val('2');
                break;
            default:
                imgfol = black_images_folder_path;
                $('.preview_text, .preview_phone').css('color', '#000000');
                $('#font_colour').val('1');
                break;
        }

        update_preview_image(pic, imgfol)
    });

    $('#designer_options_colours span').click(function() {
        $('#designer_options_colours span').removeClass('selected');
        $(this).addClass('selected');
    });


    $('#designer_options_font ol li').click(function() {
        $('#designer_options_font ol li').removeClass('selected');
        font = myTrim($(this).attr('class'));
        $('#font').val(font);
        $(this).addClass('selected');
        font_family = $(this).attr('data');
        $('.preview_text').css('font-family', font_family);
        $('.preview_phone').css('font-family', font_family);
    });

    /* activate rain bow a*/
    $('#designer_options_colours .Rainbow_A').click(function() {
        $('#designer_preview').removeClass('individual_preivew');
        $('#designer_preview').removeClass('designer_preview_rainbow_b');
        $('#designer_preview').addClass('designer_preview_rainbow_a');
        $('#designer_preview').css('background', 'url(images/mini_vinyls/9.png) no-repeat scroll 0% 0% transparent');

        /* update form element*/
        $('#background_colour').val('9');

        // reset css property
        $('.details_checkbox_phone').click();
        $('.details_checkbox_phone').click();
    });

    /* activate rain bow b*/
    $('#designer_options_colours .Rainbow_B').click(function() {
        $('#designer_preview').removeClass('individual_preivew');
        $('#designer_preview').removeClass('designer_preview_rainbow_a');
        $('#designer_preview').addClass('designer_preview_rainbow_b');
        $('#designer_preview').css('background', 'url(images/mini_vinyls/10.png) no-repeat scroll 0% 0% transparent');

        /* update form element*/
        $('#background_colour').val('10');

        // reset css property
        $('.details_checkbox_phone').click();
        $('.details_checkbox_phone').click();
    });

    /* activate individual color*/
    $('#designer_options_colours .Individual span').click(function() {
        $('#designer_preview').removeClass('designer_preview_rainbow_a');
        $('#designer_preview').removeClass('designer_preview_rainbow_b');
        $('#designer_preview').addClass('individual_preivew');

        var span_class_string = $(this).attr('class');
        var span_class = span_class_string.split(" ");
        var image_name = _colourArray.indexOf(span_class[0]);
        $('#designer_preview').css('background', 'url(images/mini_vinyls/' + image_name + '.png) no-repeat 30px 54px rgba(0, 0, 0, 0)');

        /* update form element*/
        $('#background_colour').val(image_name);

        // reset css property
        $('.details_checkbox_phone').click();
        $('.details_checkbox_phone').click();
    });


    /* update text on key up*/

    $('.details_text_name').keyup(function() {
        line1 = $(this).val();

        $('p.error-msg').html('');

        if (line1.length > 10) {
            line1 = line1.substr(0, 9);
            $('p.error-msg').html('Maximum 10 character allowed !');
        }

        $(this).val(line1);

        $('.preview_text').html(line1);
        
        $('#text1').val(line1 + ' '+ line2);
    });


    /// line 2 keyp
    $('.details_text_phone').keyup(function() {
        line2 = $(this).val();
        $('.preview_phone').html(line2);
         $('#text1').val(line1 + ' '+ line2);
    });


    $('#order_quantity').change(function() {
        $('#quantdesc').val($(this).val());
        var price = _price * $(this).val();
        $('#price').val(price);
    });


    function update_preview_image(pic, imgfol) {
        $(".preview_image").css("background-image", "url(images/" + imgfol + "/" + pic + ".png)");
        $('#pic').val(pic);
    }

    $("#designer_options_picture ul li").click(function() {
        pic = $(this).attr('class');
        update_preview_image(pic, imgfol);
    });

    // line 2 check box
    $('.details_checkbox_phone').click(function() {
        ischecked = $('.details_checkbox_phone').is(':checked');
        if (ischecked) {
            $('.preview_phone').show().val(line2);
            $('#split').val('1');
            $('.designer_preview_rainbow_a .preview_text').css('top', '100');
            $('.designer_preview_rainbow_b .preview_text').css('top', '100');
            $('.individual_preivew .preview_text').css('top', '80');
        } else {
            line2 = $('.preview_phone').val();
            $('#split').val('0');
            $('.preview_phone').hide().val('');
            $('.designer_preview_rainbow_a .preview_text').css('top', '122');
            $('.designer_preview_rainbow_b .preview_text').css('top', '122');
            $('.individual_preivew .preview_text').css('top', '90');
        }
    });

    // pic check box
    $('.details_checkbox_pic').click(function() {
        ischecked = $('.details_checkbox_pic').is(':checked');
        if (ischecked) {
            $('#pic').val(pic);
            $('#picon').val('1');
            $('.preview_image').show();
        } else {
            $('#pic').val('0');
            $('#picon').val('0');
            $('.preview_image').hide();
        }
    });

    // make font selected
    $('li.4').trigger('click');

});
