document.onreadystatechange = function() {
	if (window.document.readyState === "interactive") {
		const primaryHeadline = document.querySelector(".site-title");
		const primarySubheadline = document.querySelector(".site-description");
		const secondaryHeadline = document.querySelectorAll("h2");
		const secondarySubheadline = document.querySelectorAll("h3");

		secondaryHeadline.forEach(function(e) {
			e.classList.add("secondary-headline");
		});
		secondarySubheadline.forEach(function(e) {
			e.classList.add("secondary-subheadline");
		});
		primarySubheadline.classList.remove("secondary-headline");
		primarySubheadline.classList.remove("secondary-subheadline");
		primarySubheadline.classList.add("primary-subheadline");
		primaryHeadline.classList.remove("secondary-headline");
		primaryHeadline.classList.add("primary-headline");

		typeturaInit(document.querySelectorAll(typeturaContexts));
	}
};
