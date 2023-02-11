CKEDITOR.plugins.add( 'imageupload', {
  init: function( editor ) {
    editor.addCommand( 'imageupload', new CKEDITOR.dialogCommand( 'imageuploadDialog' ) );
    editor.ui.addButton( 'ImageUpload', {
      label: 'Upload Image',
      command: 'imageupload',
      toolbar: 'insert'
    } );
    CKEDITOR.dialog.add( 'imageuploadDialog', this.path + 'dialogs/imageupload.js' );
  }
} );
