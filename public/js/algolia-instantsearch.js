(function(){
    var search = instantsearch({
        // Replace with your own values
        appId: 'OBPEOR1PVQ',
        apiKey: 'a1102e941075d1384acae4787f0eb3c2', // search only API key, no ADMIN key
        indexName: 'products',
        urlSync: true,
        // searchParameters: {
        //     hitsPerPage: 10
        // }
    });


    // Add this after the previous JavaScript code
    search.addWidget(
        instantsearch.widgets.hits({
            container: '#hits',
            sortBy: ['name:asc'],
            templates: {
                // item: document.getElementById('hit-template').innerHTML,
                empty: "We didn't find any results for the search <em>\"{{query}}\"</em>",
                item:function (item) {
                    if (item.image == null) {
                        return `
                        <a href="${window.location.origin}/shop/${item.slug}" class="text-dark" style="text-decoration:none;">
                        <div class="sbox py-4 bb-grey">
                            <div class="row">
                                <div class="col-sm-3">
                                    <img src="${window.location.origin}/img/not-found.jpg" class="img-fluid">
                                </div>
                                <div class="col-sm-6">
                                    <div class="title text-dark">
                                        ${item._highlightResult.name.value}
                                    </div>
                                    <div class="details text-muted">
                                        ${item._highlightResult.details.value}
                                    </div>
                                    <div class="price font-weight-bold">
                                        $${(item.price / 100).toFixed(2)}
                                    </div>
                                </div>
                            </div>
                        </div>
                        </a>
                    `;
                    }else{
                        return `
                            <a href="${window.location.origin}/shop/${item.slug}" class="text-dark" style="text-decoration:none;">
                            <div class="sbox py-4 bb-grey">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <img src="${window.location.origin}/storage/${item.image}" class="img-fluid">
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="title text-dark">
                                            ${item._highlightResult.name.value}
                                        </div>
                                        <div class="details text-muted">
                                            ${item._highlightResult.details.value}
                                        </div>
                                        <div class="price font-weight-bold">
                                            $${(item.price / 100).toFixed(2)}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </a>
                        `;
                    }
                }
                // item: '<em>Hit {{ objectID }}</em>: {{{ _highlightResult.name.value }}}',
            }
        })
    );

    // Add this after the previous JavaScript code
    search.addWidget(
        instantsearch.widgets.searchBox({
            container: '#search-input',
            placeholder: 'Search for products'
        })
    );

    // Add this after the other search.addWidget() calls
    search.addWidget(
        instantsearch.widgets.pagination({
            container: '#pagination'
        })
    );

    // Stats Container
    search.addWidget(
        instantsearch.widgets.stats({
            container: '#stats-container'
        })
    );

    // Refinement List
    search.addWidget(
        instantsearch.widgets.refinementList({
            container: '#refinement-list',
            attributeName: 'categories',
            sortBy: ['name:asc'],
            operator: 'or',
            limit: 10,
            // templates: {
            //     header: 'Categories'
            // }
            cssClasses:  {
                label: 'text-dark w-75',
                count: 'text-secondary float-right'
            }
        })
    );

    search.start();
})();
