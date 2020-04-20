document.onreadystatechange = function() {
	if (window.document.readyState === "interactive") {
		const primaryHeadline = document.querySelector(".site-title");
		const primarySubheadline = document.querySelector(".site-description");
		const secondaryHeadline = document.querySelectorAll("h2");
		const secondarySubheadline = document.querySelectorAll("h3");

		primaryHeadline.classList.add("primary-headline");
		primarySubheadline.classList.add("primary-subheadline");
		secondaryHeadline.forEach(function(e) {
			e.classList.add("secondary-headline");
		});
		secondarySubheadline.forEach(function(e) {
			e.classList.add("secondary-subheadline");
		});

		typeturaInit(document.querySelectorAll(typeturaContexts));
	}
};
