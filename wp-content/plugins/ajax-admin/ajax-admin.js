/*

	Ajax Example - JavaScript for Admin Area

*/
(function($) {

    $(document).ready(function() {

        // when user submits the form
        $('.ajax-form').on( 'submit', function(event) {

            // prevent form submission
            event.preventDefault();

            // add loading message
            $('.ajax-response').html('Loading...');

            // define url
            var url = $('#url').val();

            // submit the
            // for ajax in the admin area, the ajaxurl is defined automatically.
            // see the head. Does not get added to public facing pages.
            $.post(ajaxurl, {

                nonce:  ajax_admin.nonce,
                action: 'admin_hook',
                url:    url

            }, function(data) {
                // callback function that handles the server response
                // log data
                console.log(data);

                // display data
                $('.ajax-response').html(data);

            });

        });

    });

})( jQuery );
