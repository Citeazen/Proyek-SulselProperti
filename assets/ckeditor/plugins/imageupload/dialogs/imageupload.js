CKEDITOR.dialog.add( 'imageuploadDialog', function( editor ) {
  return {
    title: 'Upload Image',
    minWidth: 400,
    minHeight: 200,
    contents: [
      {
        id: 'tab-basic',
        label: 'Basic Settings',
        elements: [
          {
            type: 'file',
            id: 'image',
            label: 'Image',
            validate: CKEDITOR.dialog.validate.notEmpty( 'Image field cannot be empty.' ),
            onChange: function( evt ) {
              var file = evt.data.value;
              var extension = file.substr( ( file.lastIndexOf( '.' ) + 1 ) );

              if ( !( /(jpg|jpeg|png|gif)/.test( extension ) ) ) {
                alert( 'Please select an image file (jpg, jpeg, png, gif).' );
                this.getInputElement().$.value = '';
              }
            }
          },
        ]
      }
    ],
    onOk: function() {
      var dialog = this;
      var image = this.getContentElement( 'tab-basic', 'image' ).getInputElement().$.files[0];

      var formData = new FormData();
      formData.append( 'image', image );

      var xhr = new XMLHttpRequest();
      xhr.open( 'POST', '/path/to/server-side-script.php' );

      xhr.onreadystatechange = function() {
        if ( xhr.readyState == 4 && xhr.status == 200 ) {
          var response = JSON.parse( xhr.responseText );

          if ( response.error ) {
            alert( response.error );
            return;
          }

          var imgElement = editor.document.createElement( 'img' );
          imgElement.setAttribute( 'src', response.url );
          editor.insertElement( imgElement );
          dialog.hide();
        }
      };

      xhr.send( formData );
    }
  };
} );
