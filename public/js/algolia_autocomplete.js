$(document).ready(function() {
    $('.js_simulation_autocomplete').each(function() {
        var autocompleteUrl = $(this).data('autocomplete-url');

        $(this).autocomplete({hint: false}, [
            {
                source: function(query, cb) {
                    $.ajax({
                        url: autocompleteUrl+'?query='+query
                    }).then(function(data) {
                        cb(data.simulations);
                    });
                },
                displayKey: 'name',
                debounce: 500
            }
        ]);
    });
});