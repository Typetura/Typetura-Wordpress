const primaryHeadline = document.querySelectorAll(["h1", ".site-title"]);
const primarySubheadline = document.querySelectorAll(["h1 + h2", ".site-description"]);
const secondaryHeadline = document.querySelectorAll("h2");
const secondarySubheadline = document.querySelectorAll("h3");

secondaryHeadline.forEach(function(e) {
	e.classList.add("section-headline");
});
secondarySubheadline.forEach(function(e) {
	e.classList.add("section-subheadline");
});
primaryHeadline.forEach(function(e) {
	e.classList.add("primary-headline");
});
primarySubheadline.forEach(function(e) {
	e.classList.remove("secondary-headline");
	e.classList.add("primary-subheadline");
});
