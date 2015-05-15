Posts.prototype = new Page();
Posts.prototype.constructor=Posts;

function Posts(name){
	this.name=name;
	this.posts = [];
};

Posts.prototype.init = function() {
	var my = this;
	console.log("init", my.name);

	this.section = document.querySelector("section[data-id='"+my.name+"']");

	this.btnNewPost = this.section.querySelector("#btnNewPost");
	this.btnNewPost.addEventListener("click", function(e) {
		braten.goto("postEdit");
	}, false);


	Ajax.getJSON("/actions/posts_get.php", {}, this.postsCallback.bind(this));


	this.superInit();
};

Posts.prototype.show = function(state) {
	this.superShow(state);

};

Posts.prototype.postsCallback = function(data) {
	console.log("postsCallback", data);
	this.posts = data.posts;
	this.renderPosts();
}

Posts.prototype.renderPosts = function() {
	for(var i=0, l=this.posts.length; i<l; i++) {
		var post = this.posts[i];
		var article = document.createElement("article");
		var title = document.createElement("h3");
		title.textContent = post.title;

		var date = document.createElement("div");
		date.textContent = post.date;

		var writer = document.createElement("div");
		writer.textContent = post.writer;

		var text = document.createElement("text");
		text.innerHTML = post.text;

		article.appendChild(title);
		article.appendChild(date);
		article.appendChild(writer);
		article.appendChild(text);
		this.section.appendChild(article);
	}
}

braten.pages.posts = new Posts("posts");