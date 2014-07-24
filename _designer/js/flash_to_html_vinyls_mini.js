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

    function splitLine1() {
        Line1 = myTrim($('.details_text_name').val());
        Line2 = myTrim($('.details_text_phone').val());

        ischecked = $('.details_checkbox_phone').is(':checked');



        if ((Line2.length <= 0) && ischecked) {
            lineArray = Line1.split(" ");
            no_of_words = lineArray.length;

            $last_index = no_of_words - 1;



            if ($last_index === 0) {
                lname = '';
            } else {
                lname = lineArray[$last_index];
                delete lineArray[$last_index];
            }

            fname = lineArray.join(" ");

            $('.preview_text').html(fname);
            $('.preview_phone').html(lname);

            $('#split').val(1);
        } else {
            $('.preview_text').html($('.details_text_name').val());
            $('.preview_phone').html(Line2);
            $('#split').val(0);
        }
    }

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

        var individual_color = span_class[0];
        var image_name = $.inArray(individual_color, _colourArray);
        image_no = image_name.toString();

        $('#designer_preview').css('background', 'url(images/mini_vinyls/' + image_no + '.png) no-repeat 30px 54px rgba(0, 0, 0, 0)');

        /* update form element*/
        $('#background_colour').val(image_name);

        // reset css property
        $('.details_checkbox_phone').click();
        $('.details_checkbox_phone').click();
    });


    /* update text on key up*/

    $('.details_text_name').keydown(function(event) {
        if (event.keyCode == 32) {
            //$('p.error-msg').html('Space not allowed!');
            // event.preventDefault();
        } else {
            //$('p.error-msg').html('');
        }
    });

    $('.details_text_name').keyup(function() {
        line1 = $(this).val();

        $('p.error-msg').html('');

        if (line1.length > 20) {
            line1 = line1.substr(0, 19);
            $('p.error-msg').html('Maximum 20 character allowed !');
        }

        $(this).val(line1);

        $('.preview_text').html(line1);

        splitLine1();
    });


    /// line 2 keyp
    $('.details_text_phone').keyup(function() {


        line2 = $(this).val();

        $('p.error-msg').html('');

        if (line2.length > 20) {
            line2 = line2.substr(0, 19);
            $('p.error-msg').html('Maximum 20 character allowed!');
        }

        $(this).val(line2);
        $('.preview_phone').html(line2);

        line1 = $('.details_text_name').val();
        $('.preview_text').html(line1);

        splitLine1();
    });


    $('#order_quantity').change(function() {
        //$('#quantdesc').val($(this).val());
        $('#quantdesc').val($(this).find(":selected").text());
        var price = $(this).val();
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
            $('.line-2').show();

            $('.preview_phone').show().val(line2);
            $('#split').val('1');

            $('.designer_preview_rainbow_a .preview_text').css('top', '100');
            $('.designer_preview_rainbow_b .preview_text').css('top', '100');
            $('.individual_preivew .preview_text').css('top', '80');
        } else {
            $('.line-2').hide();

            line2 = $('.preview_phone').val();
            $('#split').val('0');
            $('.preview_phone').hide().val('');
            $('.designer_preview_rainbow_a .preview_text').css('top', '122');
            $('.designer_preview_rainbow_b .preview_text').css('top', '122');
            $('.individual_preivew .preview_text').css('top', '90');
        }

        splitLine1();
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
    $('li.3').trigger('click');

    // make white default
    $('.font_colour_white').trigger('click');


    $('#vinyls-mini input').click(function() {
        $(this).removeClass('required-field');
    });

    $('#vinyls-mini').submit(function(e) {
        $('.details_text_name').removeClass('required-field');
        $('.details_text_phone').removeClass('required-field');

        var line1 = $('.details_text_name').val();

        if (line1.length <= 0) {
            $('.details_text_name').addClass('required-field');
            $('.details_text_name').focus();
            e.preventDefault();
        }

        // if line 2 included
        if ($('.details_checkbox_phone').is(':checked')) {
            var line2 = $('.details_text_phone').val();
            var Previewline2 = $('.preview_phone').html().trim();

            if ((line2.length <= 0) && (Previewline2.length <= 0)) {
                $('.details_text_phone').addClass('required-field');
                $('.details_text_phone').focus();
                e.preventDefault();
            }
        }


    });
});
