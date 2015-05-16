UserSettings.prototype = new Page();
UserSettings.prototype.constructor=UserSettings;

function UserSettings(name){
	this.name=name;
};

UserSettings.prototype.init = function() {
	var my = this;
	console.log("init", my.name);
	this.initialized = true;
};

UserSettings.prototype.show = function(state) {
	this.superShow(state);
};

braten.pages.userSettings = new UserSettings("userSettings");