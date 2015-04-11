$(document).ajaxSend(function(event, jqXHR, settings) {
    //Call method to display spinner
	//$('#loading-indicator').html('<img src="'+HOST+'public/berdict/img/spinner.gif">');
});

function showSpinner(){
$('#loading-indicator').html('<img src="'+HOST+'public/berdict/img/spinner.gif">');
};

$(document).ajaxComplete(function(event, jqXHR, settings) {
    //Call method to hide spinner
	$('#loading-indicator').html('<span class="glyphicon glyphicon-search"></span>');
});

$(document).ready(function() {
    $('.example-countries .typeahead').typeahead({
        name: 'search movies',
        minLength: 2,
        limit: 10,
		valueKey: 'id',
        remote: {
            url: HOST + 'ajax/%QUERY',
			beforeSend: function(xhr){
				showSpinner();
			},
            filter: function(parsedResponse) {
                var dataset = [];
                for (i = 0; i < parsedResponse.length; i++) {
                    dataset.push({
                        name: parsedResponse[i].name,
                        year: parsedResponse[i].year,
                        id: parsedResponse[i].id,
                        url: parsedResponse[i].url
                    });
                }
                if (parsedResponse.length == 0) {
                    dataset.push({
                        name: "No search results",
                        id: "1",
                        url: "1"
                    });
                }
                return dataset;
            },
        },
        template: '<a class="presentation" href="' + HOST + 'movie/{{id}}/{{url}}"><m>{{name}}</m> ({{year}})</a>',
        engine: Hogan
    }).bind('typeahead:selected', function(obj, datum) {
        window.location.href = HOST + 'movie/' + datum.id + '/' + datum.url;
    });

    $('.example-twitter-oss .typeahead').typeahead({
        name: 'twitter-oss',
        prefetch: 'repos.json',
        template: [
            '<p class="repo-language">{{language}}</p>',
            '<p class="repo-name">{{name}}</p>',
            '<p class="repo-description">{{description}}</p>'
        ].join(''),
        engine: Hogan
    });

    $('.example-arabic .typeahead').typeahead({
        name: 'arabic',
        local: [
            "الإنجليزية",
            "نعم",
            "لا",
            "مرحبا",
            "کيف الحال؟",
            "أهلا",
            "مع السلامة",
            "لا أتكلم العربية",
            "لا أفهم",
            "أنا جائع"
        ]
    });

    $('.example-sports .typeahead').typeahead([
        {
            name: 'nba-teams',
            prefetch: 'nba.json',
            header: '<h3 class="league-name">NBA Teams</h3>'
        },
        {
            name: 'nhl-teams',
            prefetch: '../data/nhl.json',
            header: '<h3 class="league-name">NHL Teams</h3>'
        }
    ]);

    $('.example-films .typeahead').typeahead([
        {
            name: 'best-picture-winners',
            remote: '../data/films/queries/%QUERY.json',
            prefetch: '../data/films/post_1960.json',
            template: '<p><strong>{{value}}</strong> – {{year}}</p>',
            engine: Hogan
        }
    ]);
});
