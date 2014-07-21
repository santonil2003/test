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
var split = false;

imgfol = black_images_folder_path;


$('document').ready(function() {

    $('#designer_options_font ol li').click(function() {
        $('#designer_options_font ol li').removeClass('selected');
        font = myTrim($(this).attr('class'));
        $('#font').val(font);
        $(this).addClass('selected');
        font_family = $(this).attr('data');
        $('.preview_text').css('font-family', font_family);
        $('.preview_phone').css('font-family', font_family);
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

        //$('#text1').val(line1 + ' ' + line2);
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
        //$('#text1').val(line1 + ' ' + line2);
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
            $('.line-2').attr('disabled', false);

            $('.preview_phone').show().val(line2);
            split = $('#split').is(':checked');
            $('#split').prop('checked', false);
            $('.individual_preivew .preview_text').css('top', '14');
        } else {
            $('.line-2').attr('disabled', 'disabled');
            line2 = $('.preview_phone').val();

            if (split) {
                $('#split').prop('checked', true);
            }

            $('.preview_phone').hide().val('');
            $('.individual_preivew .preview_text').css('top', '26');
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
    $('li.3').trigger('click');

    $('#semi-permanet-irons-ons input').click(function() {
        $(this).removeClass('required-field');
    });

    $('#semi-permanet-irons-ons').submit(function(e) {
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
            if (line2.length <= 0) {
                $('.details_text_phone').addClass('required-field');
                $('.details_text_phone').focus();
                e.preventDefault();
            }
        }


    });

    // uncheck line2
    $('.details_checkbox_phone').click();

});
