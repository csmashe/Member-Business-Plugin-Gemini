(function( $ ) {
    'use strict';

    $(document).ready(function() {
        $( '.search-field' ).autocomplete({
            source: function( request, response ) {
                $.ajax({
                    url: window.p116_business_directory.ajax_url,
                    dataType: 'json',
                    data: {
                        action: 'p116_business_directory_autocomplete',
                        term: request.term
                    },
                    success: function( data ) {
                        response( data );
                    }
                });
            },
            minLength: 2,
        });
    });

})( jQuery );
