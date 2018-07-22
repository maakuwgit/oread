tinymce.PluginManager.add('anchor', function(editor, url) {
  // Add a button that opens a window
  editor.addButton('anchor', {
    text: '',
    icon: 'anchor',
    onclick: function() {
      // Open window
      editor.windowManager.open({
        title: 'Add Id',
        message: 'whatever',
        body: [
          {type: 'textbox', name: 'id', label: 'Id'}
        ],
        onsubmit: function(e) {
          // Insert content when the window form is submitted
          var element = editor.selection.getNode();
          var str = e.data.id;
          var permalinkEl = document.getElementById('sample-permalink');
          var permalink = permalinkEl.getAttribute('href');
          if ( !permalink ) {
            permalinkEl = document.querySelectorAll('#sample-permalink a');
            permalink = permalinkEl[0].getAttribute('href');
          }

          str = str.replace(/^\s+|\s+$/g, ''); // trim
          str = str.toLowerCase();

          // remove accents, swap ñ for n, etc
          var from = "àáäâèéëêìíïîòóöôùúüûñç·/_,:;";
          var to   = "aaaaeeeeiiiioooouuuunc------";
          for (var i=0, l=from.length ; i<l ; i++) {
              str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
          }

          str = str.replace(/[^a-z0-9 -]/g, '') // remove invalid chars
              .replace(/\s+/g, '-') // collapse whitespace and replace by -
              .replace(/-+/g, '-'); // collapse dashes

          if ( element && permalink ) {
            tinyMCE.activeEditor.windowManager.alert( 'Link to copy: ' + permalink + '#' + str );
            element.setAttribute('id', str);
          }
        }
      });
    }
  });
});
