(function() {


	var posts = [];


	var _ = self.Posts = function(name){
		this.name=name;
	};

	_.prototype = new Page();
	_.prototype.constructor = _;

	_.prototype.init = function() {
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

	_.prototype.show = function(state) {
		this.superShow(state);
	};

	_.prototype.postsCallback = function(data) {
		console.log("postsCallback", data);
		posts = data.posts;
		this.renderPosts();
	}

	Posts.prototype.renderPosts = function() {
		for(var i=0, l=posts.length; i<l; i++) {
			var post = posts[i];
			var article = document.createElement("article");
			article.classList.add("post");

			var title = document.createElement("h3");
			title.textContent = post.title;


			var date = document.createElement("div");
			date.textContent = post.date;

			var writer = document.createElement("div");
			writer.textContent = post.firstName + " " + post.lastName;

			var text = document.createElement("div");
			text.classList.add("text");
			text.innerHTML = post.text;

			if(user.id === post.writer_id) {
				var btnEdit = document.createElement("button");
				btnEdit.textContent = "Redigera";
				btnEdit.dataset.id = post.id;
				btnEdit.addEventListener("click", this.doEditPost.bind(this), false);
				article.appendChild(btnEdit);
			}

			article.appendChild(title);
			article.appendChild(date);


			article.appendChild(writer);
			article.appendChild(text);
			this.section.appendChild(article);
		}
	};

	_.prototype.doEditPost = function(e) {
		braten.goto("postEdit", e.target.dataset.id, "edit");
	};











	_.get = function(id) {
		for(var i=0, l=posts.length; i<l; i++) {
			if(posts[i].id === id) {
				return posts[i];
			}
		}
	};





	braten.pages.posts = new _("posts");
}());