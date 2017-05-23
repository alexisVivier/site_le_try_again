$("p").each(function( index ) {
    console.log( index + ": " + $( this ).text() );
    var pText = $( this ).text();
    pText = pText.substr(0,200) + "...";
    console.log( index + ": " + pText );
    $( this ).text(pText);
});