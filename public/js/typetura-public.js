const typetura_meta = document.querySelectorAll(["[class*='meta']"]);
const typetura_primaryHeadline = document.querySelectorAll(["h1", ".site-title"]);
const typetura_primarySubheadline = document.querySelectorAll(["h1 + h2", ".site-description"]);
const typetura_secondaryHeadline = document.querySelectorAll("h2");
const typetura_secondarySubheadline = document.querySelectorAll("h3", "h4", "h5", "h6");

typetura_meta.forEach(function(e) {
	e.classList.add("meta");
});
typetura_secondaryHeadline.forEach(function(e) {
	e.classList.add("section-headline");
});
typetura_secondarySubheadline.forEach(function(e) {
	e.classList.add("section-subheadline");
});
typetura_primaryHeadline.forEach(function(e) {
	e.classList.add("primary-headline");
});
typetura_primarySubheadline.forEach(function(e) {
	e.classList.remove("secondary-headline");
	e.classList.add("primary-subheadline");
});
