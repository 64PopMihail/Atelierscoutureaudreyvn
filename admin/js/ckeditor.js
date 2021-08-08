
// console.log($('#editor').length);
if ($('#editor').length !== 0) {
    // console.log("existe");
    ClassicEditor
        .create( document.querySelector( '#editor' ) )

        .catch( error => {
        console.error( error );
} );
}


