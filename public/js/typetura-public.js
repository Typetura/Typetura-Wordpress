(function () {
  // Typetura elements
  const typetura_meta = ["[class*='meta']"];
  const typetura_primaryHeadline = ["h1", ".site-title"];
  const typetura_primarySubheadline = ["h1 + h2", ".site-description"];
  const typetura_secondaryHeadline = ["h2"];
  const typetura_secondarySubheadline = ["h3", "h4", "h5", "h6"];

  // Look for new elements on the page that might be Typetura contexts.
  const mutationObserver = new MutationObserver(mutations);
  mutationObserver.observe(document.documentElement, {
    childList: true,
    attributes: false,
    subtree: true,
  });

  const resizeObserver = new ResizeObserver((entries) => {
    for (let entry of entries) {
      if (entry.contentBoxSize) {
        entry.target.style.setProperty("--tt-bind", entry.contentRect.width);
      }
    }
  });

  // Loop through new elements and attach resize observations.
  function mutations(mutationsList) {
    mutationsList.forEach((mutation) => {
      const nodes = mutation.addedNodes;
      nodes.forEach((node) => {
        if (node.classList) {
          if (node.matches(typetura_meta)) {
            node.classList.add("meta");
            resizeObserver.observe(node);
          }
          if (node.matches(typetura_secondaryHeadline)) {
            node.classList.add("section-headline");
            resizeObserver.observe(node);
          }
          if (node.matches(typetura_secondarySubheadline)) {
            node.classList.add("section-subheadline");
            resizeObserver.observe(node);
          }
          if (node.matches(typetura_primaryHeadline)) {
            node.classList.add("primary-headline");
            resizeObserver.observe(node);
          }
          if (node.matches(typetura_primarySubheadline)) {
            node.classList.remove("secondary-headline");
            node.classList.add("primary-subheadline");
            resizeObserver.observe(node);
          }
        }
      });
    });
  }
})();
