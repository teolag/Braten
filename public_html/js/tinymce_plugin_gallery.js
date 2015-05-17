tinymce.PluginManager.add('tinyGallery', function(editor, url) {
    // Add a button that opens a window
    editor.addButton('tinyGallery', {
        icon: 'image',
		tooltip: "Infoga galleri",
        onclick: function() {
            // Open window
            editor.windowManager.open({
                title: 'Infoga bilder',
				url: '/tiny_gallery.php',
				width: 500,
				height: 400,
			}, {
				oninsert: function (files) {
					console.log("image insert", files);
					var html = "<div class='tinyGallery'>";
					for(var i=0, l=files.length; i<l; i++) {
						html += '<img src="/file.php?id='+files[i].id+'" />';
					}
					html+="</div>";
					editor.insertContent(html);
				}
			});
        },
		onPostRender: function() {
			var ctrl = this;
			editor.on('nodeChange', function() {
				var node = editor.selection.getNode();

				if(node.parentNode.parentNode.classList.contains("tinyGallery")) {
					ctrl.active(true);
					ctrl.tooltip("hej hej");
				} else {
					ctrl.active(false);
				}


				console.log("node", node);
			});
		}
    });
});