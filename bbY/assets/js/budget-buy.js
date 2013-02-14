$(function() {  

    $('#item1').focus();
    
    $('.add_item').keydown(function(e) {
        if (e.which == 13) 
        {
            var el = $(this).val();
            if (! el) return;
            item_id = $(this).attr('id');
            submitItem(el, item_id);
            return false;
        }
    });
    
    $('#signup-email').click(function(){
        $('#login_form_alert').hide();
        // $('#login_dialog').modal();
        $('#login_dialog_fb').modal();
    });
    
    $('#submit_login_form').click(function(event) {
        event.preventDefault();
        formData = $('#login_form').serialize();
        $.ajax({
            type: "POST",
            url: 'http://localhost/bbY/user/register_ajax',
            cache : false,
            data: formData,
            success : function(html) {
                try {
                    var response = JSON.parse(html);
                } catch (e) {
                    show_error();
                    return false;
                }
                if (response.status == 0) {
                    $('#login_form_alert').html(response.error_msg);
                    $('#login_form_alert').show();
                } else {
                    $('#login_form_alert').html("");
                    $('#login_form_alert').hide();
                    window.location.href = "/bbY/user/index/" + response.id;
                }
            },
            error : function(html) {
                console.log(html);
                show_error();
            }

        });
        return false;
    });

    $('#login_dialog').on('show', function() {
        // use this function to bind any dom elements
        // in the login popup-dialog. 
    });
}); 

function show_error() {
    $('#login_form_alert').html("Our bad! Please try again in a short while. Thanks!");
    $('#login_form_alert').show();
}

function submitItem(value, item_id) {
    $.ajax({
        type: "GET",
        url: "http://localhost/bbY/items/add_ajax",
        data: {id : item_id , item : value},
        success: function(html) {
            try {
                var response = JSON.parse(html);
            } catch (e) {
                $('#message').css('visibility', 'visible');
                return false;
            }
            if (response.redirect) {
                window.location.href = response.redirect;
            }
            else if(response.status == 1) {
                // Get the parent TD element. 
                var td_el = $('#' + item_id).parent().parent().parent();
                td_el.replaceWith(
                    '<tr><td>' + value + '</td></tr>' + 
                    '<tr><td><p><input id="' + item_id + '" type="text" placeholder="" class="add_item negative-margin"></p></td></tr>'

                );
                $('#' + item_id).focus();

                $('.add_item').off('keydown');

                $('.add_item').on('keydown', function(e) {
                    if (e.which == 13) 
                    {
                        var el = $(this).val();
                        if (! el) return;
                        item_id = $(this).attr('id');
                        submitItem(el, item_id);
                        return false;
                    }
                });
            	
                $('#message').css('visibility', 'hidden');
        	} else {
        		$('#message').css('visibility', 'visible');
        	}

        },
        error: function(html) {
        	$('#message').css('visibility', 'visible');
        }
    });
}