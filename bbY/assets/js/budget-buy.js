$(function() {  

    $('.add_item').click(function() {
        var item_id = $(this).attr('id');
        enableEditBox($(this).parent().parent(), item_id);
    });
    
    $('#signup-email').click(function(){
        $('#login_dialog').modal();
    });
    
    $('#new_user').click(function() {
        alert('You got it!');
        return false;
    });
}); 

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
            var response = JSON.parse(html);
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