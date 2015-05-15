document.addEventListener("DOMContentLoaded", function(){
	console.log(location.href);

	var parts = location.pathname.slice(1).split("/");
	var page = parts[0];


	var state = {page:page};
	switch(page) {
		case "planner":
		state.item = parts[1];
		break;
	}

	console.log(state, parts);
	braten.loadState(state);
});




var btnMenu = document.getElementById("btnMenu");
var btnUser = document.getElementById("btnUser");
var mainMenu = document.querySelector("nav.main");
var userMenu = document.querySelector("nav.user");
var header = document.querySelector("header");
var userName = userMenu.querySelector(".username");

mainMenu.addEventListener("click", menuHandler, false);
userMenu.addEventListener("click", menuHandler, false);


document.querySelector("nav.main img.logo").addEventListener("click", function(e){
	e.preventDefault();
	mainMenu.classList.remove("open");
	header.classList.remove("main-open");
	braten.goto();
});

btnMenu.addEventListener("click", function(e) {
	if(mainMenu.classList.contains("open")) {
		mainMenu.classList.remove("open");
		header.classList.remove("main-open");
	} else {
		mainMenu.classList.add("open");
		header.classList.add("main-open");
	}
}, false);
btnUser.addEventListener("click", function(e) {
	if(userMenu.classList.contains("open")) {
		userMenu.classList.remove("open");
		header.classList.remove("user-open");
	} else {
		userMenu.classList.add("open");
		header.classList.add("user-open");
	}
}, false);


function menuHandler(e) {
	console.log("menu click", e);

	if(e.target.nodeName==="LI") {
		var action = e.target.dataset.action;
		switch(action) {
			case "logout":
				logout();
			break;

			case "posts":
				braten.goto("posts");
			break;

			case "about":
				braten.goto("about");
			break;

			case "gallery":
				braten.goto("gallery");
			break;

			case "documents":
				braten.goto("documents");
			break;

			case "planner":
				braten.goto("planner");
			break;

			case "settings":
				braten.goto("settings");
			break;

			default:
				console.warn("page not implemented")
		}

		mainMenu.classList.remove("open");
		userMenu.classList.remove("open");
		header.classList.remove("user-open");
		header.classList.remove("main-open");
	}
}


var user;

var formLogin = document.getElementById("formLogin");
var txtUsername = document.getElementById("txtUsername");
var txtPassword = document.getElementById("txtPassword");
formLogin.addEventListener("submit", submitLogin, false);


function authCallback(json) {
	txtUsername.value="";
	txtPassword.value="";

	if(json.status===1000) {
		console.log("authCallback", json);
		document.body.classList.add("authorized");
		setUser(json.user);
	} else {
		txtUsername.focus();
	}
}


function setUser(u) {
	user = u;
	userName.textContent = u.firstName;
}


function submitLogin(e) {
	e.preventDefault();

	if(!txtUsername.value) {
		txtUsername.focus();
		return;
	}

	if(!txtPassword.value) {
		txtPassword.focus();
		return;
	}

	Ajax.post2JSON("/actions/auth_login.php", e.target, authCallback);
}



function logout() {
	Ajax.getJSON("/actions/auth_logout.php", "", logoutCallback);
}

function logoutCallback() {
	document.body.classList.remove("authorized");
}


window.addEventListener('popstate', function(event) {
	var state = event.state;
	console.log("popstate", event);
	braten.loadState(state);
});





