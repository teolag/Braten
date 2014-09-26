function Page(name){ 
	this.initialized = false;
} 

Page.prototype.superShow = function() { 
	if(!this.initialized) this.init();

} 