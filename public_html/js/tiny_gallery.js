var fileList = document.getElementById("fileList");


var fileBrowser = document.getElementById("fileBrowser");
fileBrowser.addEventListener("change", filesAdded, false);
fileBrowser.focus();



function filesAdded(e) {
	for(var i=0, l=e.target.files.length; i<l; i++) {
		var file = e.target.files[i];
		addFile(file);
	}
}

function addFile(file) {
	var li = document.createElement("li");

	var spanName = document.createElement("span");
	spanName.textContent = file.name;
	li.appendChild(spanName);

	var spanStatus = document.createElement("span");
	li.appendChild(spanStatus);


	fileList.appendChild(li);

	var reader = new FileReader();
	reader.onload = fileRead;
	reader.readAsDataURL(file);

	function fileRead() {
		var img = new Image();
		img.src = reader.result;
		img.onload = imageLoaded;
		img.classList.add("preview");
		li.appendChild(img);
	}

	function imageLoaded(e)  {
		var img = e.target;

	}
}



function uploadFiles(e) {
	for(var i=0, l=e.target.files.length; i<l; i++) {
		var file = e.target.files[i];
		uploadFile(file);
	}
}

function uploadFile(file) {
	console.log("upload file", file);

	var li = document.createElement("li");


	var formData = new FormData();
	formData.append("file", file);
	var xhr = new XMLHttpRequest();
	xhr.upload.addEventListener("progress", progressHandler, false);
	xhr.addEventListener("load", completeHandler, false);
	xhr.addEventListener("error", errorHandler, false);
	xhr.addEventListener("abort", abortHandler, false);
	xhr.open("POST", "/actions/upload_files.php");
	xhr.send(formData);

	function progressHandler(e){
		var percent = (e.loaded / e.total) * 100;
		console.log("progress", e);
		console.log("Uploaded "+e.loaded+" bytes of "+e.total + "(" + percent + ")");

		spanStatus.textContent = percent + "%";

	}
	function completeHandler(e){
		console.log("complete", e);
		var json = JSON.parse(e.target.responseText);
		spanStatus.textContent = "Done!";

		/*
		if(json.uploaded[0]) {
			var fileId = json.uploaded[0].file_id;
			top.tinymce.activeEditor.windowManager.getParams().oninsert(fileId, "koko", "orvar", 44);
			top.tinymce.activeEditor.windowManager.close();
		} else {
			console.log("error uploading", e);
		}
		*/
	}



	function errorHandler(e){
		console.error("Upload Failed", e);
	}
	function abortHandler(e){
		console.log("Upload Aborted", e);
	}
}