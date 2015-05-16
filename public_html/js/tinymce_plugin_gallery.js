tinymce.PluginManager.add('tinyGallery', function(editor, url) {
    // Add a button that opens a window
    editor.addButton('tinyGallery', {
        icon: 'image',
        onclick: function() {
            // Open window
            editor.windowManager.open({
                title: 'Infoga bilder',
				url: '/tiny_gallery.php',
				width: 500,
				height: 400,
			}, {
				oninsert: function (fileId, a, b, c) {
					console.log("image insert", fileId, a, b, c);
					editor.insertContent('<a href=""><img src="/file.php?id='+fileId+'" /></a>');
				}
			});
        }
    });
});






