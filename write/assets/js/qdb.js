// Setup Filtering Tool
var qdb = new Array();
$('#contents').find('ul > li').each(function() {
    var answer = $(this).find('p').html();
    if ( answer == undefined ) { answer = $(this).find('ol').html(); }
    var entry = {
        node: $(this).clone(),
        question: $(this).find('h2').html(),
        answer: answer
    }
    $(this).remove();
    qdb.push(entry);
});

var options = {
    keys: ['question', 'answer'],
    id: 'node'
}

var f = new Fuse( qdb, options );

// Helper Functions 
function __qdb_add_dom( node ) {
    $('#contents').find('ul').append( node );
}

function __qdb_showall() {
    $.each( qdb, function() {
        __qdb_add_dom( $(this)[0].node );
    });
}

function __qdb_hideall() {
    $('#contents').find('ul').empty();
}

function qdb_filter( keyword ) {
    if ( keyword == '' ) {
        __qdb_showall();
    } else {
        __qdb_hideall();

        var results = f.search( keyword );
        $.each( results, function( index, result ) {
		__qdb_add_dom( result );
        });
    }
}

// Bind Search UI
$('#qdb_search').keyup(function() {
    qdb_filter( $(this).val() );
});
$('#qdb_search').click(function() {
    qdb_filter( $(this).val() );
});
$('#searchform').submit(function( event ) {
    event.preventDefault();
});


// Init page
__qdb_showall();
