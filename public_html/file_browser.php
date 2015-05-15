<p>Välj en fil att ladda upp</p>


<input type="file" name="filename" id="fileBrowser" />


<script>

	var args = top.tinymce.activeEditor.windowManager.getParams();
	var field = args.field;
	var type = args.type;

	var fileBrowser = document.getElementById("fileBrowser");
	fileBrowser.addEventListener("change", uploadFile, false);
	fileBrowser.focus();

	function uploadFile(e) {
		console.log("Upload "+type, e);

		var file = e.target.files[0];
		var formData = new FormData();
		formData.append("file1", file);
		var xhr = new XMLHttpRequest();
		xhr.upload.addEventListener("progress", progressHandler, false);
		xhr.addEventListener("load", completeHandler, false);
		xhr.addEventListener("error", errorHandler, false);
		xhr.addEventListener("abort", abortHandler, false);
		xhr.open("POST", "/actions/upload_files.php");
		xhr.send(formData);

	}

	function progressHandler(e){
		var percent = (e.loaded / e.total) * 100;
		console.log("Uploaded "+e.loaded+" bytes of "+e.total + "(" + percent + ")");
	}
	function completeHandler(e){
		console.log("done", e);
		var json = JSON.parse(e.target.responseText);
		if(json.uploaded[0]) {
			field.value = "/file.php?id=" + json.uploaded[0].file_id;
			top.tinymce.activeEditor.windowManager.close();
		} else {
			console.log("error uploading", e);
		}
	}
	function errorHandler(e){
		console.error("Upload Failed", e);
	}
	function abortHandler(e){
		console.log("Upload Aborted", e);
	}

</script>