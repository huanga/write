// Setup Filtering Tool
var qdb = new Array();
$('#contents').find('ul > li').each(function() {
    var question = $(this).find('h2').html();
    if ( question.indexOf('Sample Question') != 0 ) { 
        var answer   = $(this).find('p').html();
        if ( answer == undefined ) { answer = $(this).find('ol').html(); }
        var entry = {
            node: $(this).clone(),
            question: question,
            answer: answer
        }
        $(this).remove();
        qdb.push(entry);
    }
});

var options = {
    keys: ['question', 'answer'],
    id: 'node'
}

// var f = new Fuse( qdb, options );

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
    $('#contents').empty();
    $('#contents').append( '<ul></ul>' );
}

function qdb_filter( keyword ) {
    if ( keyword == '' ) {
        __qdb_showall();
    } else {
        __qdb_hideall();

        var aMatches = qdb.filter(function(item) {
            var a = item.answer;
            var k = 0; // remembers position of last found character in answer

            // consider each search character one at a time
            for (var i = 0; i < keyword.length; i++) {
                var l = keyword[i];
                if (l == ' ') continue;                        // ignore spaces
                nk = a.indexOf(l, k+1);                        // search for character & update position in answer
                if (nk == -1) return false;                    // if it's not found, exclude this item
                if ((k != 0) && ((nk - k) > 5)) return false; // skip too far apart
                k = nk;
            }
            return true;
        });
        var qMatches = qdb.filter(function(item) {
            var q = item.question;  // Shortcut

            var j = 0; // remembers position of last found character in question

            // consider each search character one at a time
            for (var i = 0; i < keyword.length; i++) {
                var l = keyword[i];
                if (l == ' ') continue;                        // ignore spaces
                nj = q.indexOf(l, j+1);                        // search for character & update position in question
                if (nj == -1) return false;                    // if it's not found, exclude this item
                if ((j != 0) && ((nj - j) > 5)) return false; // skip too far apart
                j = nj;
            }
            return true;
        });
        qMatches.forEach(function(match) {
            __qdb_add_dom(match.node);
        });
        aMatches.forEach(function(match) {
            __qdb_add_dom(match.node);
        });
    }
}

/*
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
*/

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
$(document).ready(function () {
    var isQDB = ( window.location.href.indexOf("/Entertainment") !== -1 );
        isQDB = isQDB || ( window.location.href.indexOf("/Geography") !== -1 );
        isQDB = isQDB || ( window.location.href.indexOf("/History") !== -1 );
        isQDB = isQDB || ( window.location.href.indexOf("/Lifestyle") !== -1 );
        isQDB = isQDB || ( window.location.href.indexOf("/Science") !== -1 );
        isQDB = isQDB || ( window.location.href.indexOf("/Sports") !== -1 );
        isQDB = isQDB || ( window.location.href.indexOf("/Sorting") !== -1 );

    if (isQDB === true) {
        // Get rid of place holder questions
        __qdb_hideall();
        __qdb_showall();
    } else {
        // Get rid of search bar
        $('#searchform').hide();
    }
});
