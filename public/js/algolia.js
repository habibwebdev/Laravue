(function(){
    var client = algoliasearch('OBPEOR1PVQ', 'a1102e941075d1384acae4787f0eb3c2');
    var index = client.initIndex('products');
    var enterPressed = false;
    //initialize autocomplete on search input (ID selector must match)
    autocomplete('#aa-search-input', {
        hint: false
    }, {
        source: autocomplete.sources.hits(index, {
            hitsPerPage: 10
        }),
        //value to be displayed in input control after user's suggestion selection
        displayKey: 'name',
        //hash of templates used when rendering dataset
        templates: {
            //'suggestion' templating function used to render a single suggestion
            suggestion: function (suggestion) {
                // console.log(window.location.origin);
                // console.log(suggestion.image);
            const markup = `
                <div class="row">
                    <div class="col-sm-6">
                        <img src = "${window.location.origin}/storage/${suggestion.image}" alt = "image" class = "w-40">
                        ${suggestion._highlightResult.name.value}
                    </div>
                    <div class="col-sm-6 text-right">
                        $${(suggestion.price / 100).toFixed(2)}
                    </div>
                    <div class="col-sm-12 text-secondary">
                        ${suggestion._highlightResult.details.value}
                    </div>
                </div>
            `;
            return markup;
                // return '<span class="col-sm-6 p-0">' +
                //     suggestion._highlightResult.name.value + '</span><span class="col-sm-6 p-0 text-right">' +
                //     suggestion.price + '</span>';
            },
            empty: function(result) {
                return 'Sorry, we did not find results for "' + result.query + '"';
            }
        }
    }).on('autocomplete:selected', function (event, suggestion, dataset){
        // console.log(suggestion);
        window.location.href = window.location.origin + '/shop/' + suggestion.slug;
        enterPressed = true;
    }).on('keyup', function(event){
        if(event.keyCode == 13 && !enterPressed){
            window.location.href = window.location.origin + '/search-algolia?q=' + document.getElementById('aa-search-input').value;
        }
    });
})();
