PlannerPage.prototype = new Page();
PlannerPage.prototype.constructor=PlannerPage;

function PlannerPage(name){ 
	this.name=name;
	this.section = document.querySelector("section[data-id='"+this.name+"']");
	this.plannerWeeks = document.getElementById("plannerWeeks");
	this.plannerPeriods = document.getElementById("plannerPeriods");
	this.btnYearNow = document.getElementById("btnYearNow");
	this.btnYearPrev = document.getElementById("btnYearPrev");
	this.btnYearNext = document.getElementById("btnYearNext");
	this.heading = this.section.querySelector("article h2");
	this.owners = ["Mats", "Gunilla", "Eva"];
};

PlannerPage.prototype.init = function() {
	var my = this;
	
	console.log("init", my.name);
	this.btnYearNext.addEventListener("click", function(e) {
		braten.goto(my.name, my.year+1);
	}, false);

	this.btnYearPrev.addEventListener("click", function(e) {
		braten.goto(my.name, my.year-1);
	}, false);

	this.btnYearNow.addEventListener("click", function(e) {
		braten.goto(my.name);
	}, false);

	this.initialized = true;
};

PlannerPage.prototype.show = function(state) {
	console.log("show state", state);
	this.setYear(parseInt(state.item));
	this.superShow(state);
	
};

PlannerPage.prototype.setYear = function(year) {
	console.log("set year to", year);
	if(this.year === year) return;
	
	if(year) {
		this.year = year;
	} else {
		this.year = (new Date()).getFullYear()
	}
	this.heading.textContent = "Planering " + this.year;
	
	
	var weeks = {};
	var period, owner;
	var easterWeek = parseInt(easterWeeks[this.year-2000]);
	console.log("easterweek", easterWeek);
	
	
	plannerPeriods.innerHTML="";
	
	var period0 = document.createElement("LI");
	period0.innerHTML="<div class='family'>"+this.owners[getOwner(0, this.year)]+"</div>v. 25-27 - Sommar I";
	period0.classList.add("ownercolor"+getOwner(0, this.year));	
	plannerPeriods.appendChild(period0);
	
	var period1 = document.createElement("LI");
	period1.innerHTML="<div class='family'>"+this.owners[getOwner(1, this.year)]+"</div>v. "+easterWeek+" - Påsk<br />v. 28-29 - Sommar II";
	period1.classList.add("ownercolor"+getOwner(1, this.year));	
	plannerPeriods.appendChild(period1);
	
	var period2 = document.createElement("LI");
	period2.innerHTML="<div class='family'>"+this.owners[getOwner(2, this.year)]+"</div>v. "+(easterWeek+6)+" Kristihimmel<br />v. 30-32 - Sommar III";
	period2.classList.add("ownercolor"+getOwner(2, this.year));	
	plannerPeriods.appendChild(period2);
	
	
	
	
	plannerWeeks.innerHTML="";
	for(var week=12; week<35; week++) {
		
		switch(week) {
			case 25: case 26: case 27:
			period = 0;
			break;

			case 28: case 29: case easterWeek:
			period = 1;
			break;

			case 30: case 31: case 32: case easterWeek+6:
			period = 2;
			break;

			default:
			period = -1;
			break;
		}
		
		owner = getOwner(period, this.year);
		
		
		var li = document.createElement("LI");
		li.textContent = week;
		if(owner!==-1) {
			li.classList.add("owner", "ownercolor"+owner);
		} else {
			li.classList.add("noowner");
		}
		plannerWeeks.appendChild(li);
	}
	
	function getOwner(period, year) {
		if(period>=0) {			
			owner = period - year%3;
			if(owner>2) owner -= 3;
			if(owner<0) owner += 3;
		} else {
			owner = -1;
		}
		return owner;
	}
	
}


braten.pages.planner = new PlannerPage("planner");