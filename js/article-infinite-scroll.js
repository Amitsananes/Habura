window.onload = function () {
	let page = 1;
	let loaded = false;
	let loadMoreOnOffset = document.getElementById(
		'js-article-join-container'
	).clientHeight;

	document.addEventListener('scroll', function () {
		if (!loaded && jQuery(document).scrollTop() >= loadMoreOnOffset) {
			loaded = true;
			loadMoreOnOffset = document.getElementsByClassName(
				'elementor-location-footer'
			)[0].offsetTop;
			loadMorePosts(page);
			page++;
			loaded = false;
		}
	});
};

function loadMorePosts(page) {
	const xhttp = new XMLHttpRequest();
	xhttp.onload = function () {
		const posts = JSON.parse(this.responseText).data;
		const postsContainer = document.getElementById('js-infinite-container');
		let smallText = '';
		let count = 1;
		if (posts.length > 0) {
			posts.forEach(function (post) {
				smallText = post.isAd
					? '<span class="box-content__promoted">מקודם</span>'
					: '<address>' +
					  post.author_fname +
					  ' ' +
					  post.author_lname +
					  '</address>';
				if (count % 6 === 1 || count % 6 === 2) {
					postsContainer.innerHTML +=
						'<article class="box-content large">' +
						'<a href="' +
						post.permalink +
						'">' +
						'<img src="' +
						post.thumbnail +
						'" alt="">' +
						'<div>' +
						'<h3>' +
						post.title +
						'</h3>' +
						smallText +
						'</div>' +
						'</a>' +
						'</article>';
				} else {
					postsContainer.innerHTML +=
						'<article class="box-content medium">' +
						'<a href="' +
						post.permalink +
						'" class="tw-block">' +
						'<img src="' +
						post.thumbnail +
						'" class="box-content__img" alt=""' +
						'</a>' +
						'<a href="' +
						post.permalink +
						'" class="tw-font-medium tw-text-base tw-text-black" style="color: #000000;">' +
						'<span class="box-content__title">' +
						post.title +
						'</span>' +
						'</a>' +
						smallText +
						'</article>';
				}

				count++;
			});
		}
	};
	xhttp.open(
		'POST',
		'/wp-admin/admin-ajax.php?action=' +
			article_ajax.action +
			'&nonce=' +
			article_ajax.nonce +
			'&article_id=' +
			article_ajax.article_id +
			'&page=' +
			page
	);
	xhttp.send();
}
