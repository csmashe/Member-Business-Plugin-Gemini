(function( $ ) {
    'use strict';

    $(document).ready(function() {
        // Owners repeater
        var ownersWrapper = $('#owners-repeater');
        var ownersTemplate = ownersWrapper.find('.repeater-template').html();
        ownersWrapper.find('.repeater-template').remove();

        ownersWrapper.on('click', '#add-owner', function(e) {
            e.preventDefault();
            var newField = ownersTemplate.replace(/__i__/g, ownersWrapper.find('.repeater-item').length);
            $(this).before(newField);
        });

        ownersWrapper.on('click', '.remove-owner', function(e) {
            e.preventDefault();
            $(this).closest('.repeater-item').remove();
        });

        // Links repeater
        var linksWrapper = $('#links-repeater');
        var linksTemplate = linksWrapper.find('.repeater-template').html();
        linksWrapper.find('.repeater-template').remove();

        linksWrapper.on('click', '#add-link', function(e) {
            e.preventDefault();
            var newField = linksTemplate.replace(/__i__/g, linksWrapper.find('.repeater-item').length);
            $(this).before(newField);
        });

        linksWrapper.on('click', '.remove-link', function(e) {
            e.preventDefault();
            $(this).closest('.repeater-item').remove();
        });
    });

})( jQuery );
