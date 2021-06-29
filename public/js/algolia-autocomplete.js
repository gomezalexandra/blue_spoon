$(document).ready(function() {
    $('.js_simulation_autocomplete').each(function() {
        var autocompleteUrl = $(this).data('autocomplete-url');

        $(this).autocomplete({hint: false}, [
            {
                source: function(query, cb) {
                    console.log(query);
                    $.ajax({
                        url: autocompleteUrl+'?query='+query
                    }).then(function(data) {
                        cb(data.simulations);
                    });
                },
                displayKey: "name",
                debounce: 500
            }
        ]);
    });
});

/*
$(document).ready(function() {
    $('.js-user-autocomplete').autocomplete({hint: false}, [
        {
            source: function(query, cb) {
                cb([
                    {value: 'foo'},
                    {value: 'bar'}
                ])
            }
        }
    ]);
});
 */