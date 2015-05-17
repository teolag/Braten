var files = [];


var fileList = document.getElementById("fileList");



var btnOk = document.getElementById("btnOk");
btnOk.addEventListener("click", processImages, false);


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
	files.push(file);
	var li = document.createElement("li");
	file.li = li;

	var spanName = document.createElement("span");
	spanName.textContent = file.name;
	li.appendChild(spanName);

	var spanStatus = document.createElement("span");
	li.appendChild(spanStatus);
	file.spanStatus = spanStatus;

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



function processImages(e) {
	for(var i=0, l=files.length; i<l; i++) {
		var file = files[i];
		processImage(file);
	}
}

function processImage(file) {
	console.log("upload file", file);

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

		file.spanStatus.textContent = percent + "%";

	}
	function completeHandler(e){
		console.log("complete", e);
		var json = JSON.parse(e.target.responseText);
		file.spanStatus.textContent = "Done!";
		file.done = true;
		file.id = json.uploaded[0].file_id;

		checkAllFiles();
	}



	function errorHandler(e){
		console.error("Upload Failed", e);
	}
	function abortHandler(e){
		console.log("Upload Aborted", e);
	}
}


function checkAllFiles() {
	for(var i=0, l=files.length; i<l; i++) {
		var file = files[i];
		if(!file.done) return false;
	}

	console.log("All files ready");
	top.tinymce.activeEditor.windowManager.getParams().oninsert(files);
	top.tinymce.activeEditor.windowManager.close();

}