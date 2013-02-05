$(function() {  

    $('.add_item').click(function() {
        var item_id = $(this).attr('id');
        enableEditBox($(this).parent().parent(), item_id);
    });
    
    $('#signup-email').click(function(){
        $('#login_form_alert').hide();
        $('#login_dialog').modal();
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
                    window.location.href="/bbY/items/index/";
                }
            },
            error : function(html) {
                alert(html);
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

function enableEditBox(item, item_id) {
     item.replaceWith(
           '<tr><td><p><input id="' + item_id + '" type="text" placeholder="Shopping Item" class="negative-margin"></p></td></tr>'
     );
     $('#' + item_id).focus();
     $('#' + item_id).on("keydown", function(e) {
        if (e.which == 13) 
        {
            var el = $(this).val();
            if (! el) return;
            submitItem(el, item_id);

            return false;
        }

    });
}

function submitItem(value, item_id) {
    $.ajax({
        type: "GET",
        url: "http://localhost/bbY/user/ajax_test",
        data: "elect_item=" + value,
        success: function(html) {
            try {
                var response = JSON.parse(html);
            } catch (e) {
                $('#message').css('visibility', 'visible');
                return false;
            }
            if (response.status == 1) {
                // Get the parent TD element. 
                var td_el = $('#' + item_id).parent().parent().parent();
                td_el.replaceWith(
                    '<tr><td>' + value + '</td></tr>' + 
                    '<tr><td> <a href="#" id="' + item_id + '" class="add_item"><i class="icon-plus-sign"> </i><em> add.. </em> </a></td></tr>'
                );

                $('.add_item').off('click');

                $('.add_item').on('click', function() {
                    var item_id = $(this).attr('id');
                    enableEditBox($(this).parent().parent(), item_id);
                });
            	
                $('#message').css('visibility', 'hidden');
        	} else {
        		$('#message').css('visibility', 'visible');
        	}

        },
        error: function() {
        	$('#message').css('visibility', 'visible');
        }
    });
}