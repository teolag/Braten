var braten = (function() {
	var
	pages = {},
	
	loadState = function(state) {	
		var page = state && state.page? state.page : "start";

		var sections = document.getElementsByTagName("section");
		for(var i = 0; i < sections.length; i++) {
			if(sections[i].dataset.id === page) {
				sections[i].style.display = "block";
			} else {
				sections[i].style.display = "none";
			}
		}

		var menuItems = document.querySelectorAll("nav li");
		for(var i = 0; i < sections.length; i++) {
			if(menuItems[i].dataset.action === page) {
				menuItems[i].classList.add("active");
			} else {
				menuItems[i].classList.remove("active");
			}
		}
		
		console.log("try to show state", state, page);
		pages[page].show(state);
	},
	
	goto = function(page, item, action) {
		var state = {page:page, item:item, action:action};
		var url="";
		if(page) url+="/"+page;
		if(item) url+="/"+item;
		if(action) url+="/"+action;
		history.pushState(state, null, page? url:"/");
		loadState(state);
	},
	
	addPage = function(name, page) {
		pages[name] = page;
	};



	return {
		loadState: loadState,
		addPage: addPage,
		goto: goto,
		pages: pages
	}
}());