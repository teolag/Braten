Settings.prototype = new Page();
Settings.prototype.constructor=Settings;

function Settings(name){
	this.name=name;
};

Settings.prototype.init = function() {
	var my = this;
	console.log("init", my.name);
	this.initialized = true;
};

Settings.prototype.show = function(state) {
	this.superShow(state);
};

braten.pages.settings = new Settings("userSettings");