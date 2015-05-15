function Page(){
	this.initialized = false;
}

Page.prototype.superInit = function() {
	console.log("superinit", this.name);
	this.initialized = true;

}

Page.prototype.superShow = function() {
	if(!this.initialized) this.init();

}