function observer(clones, func) {

	var MutationObserver = window.MutationObserver || window.WebkitMutationObserver
		|| window.MozMutationObserver;

	var observer = new MutationObserver(function(mutations) {
		func(mutations[0].addedNodes[0]);
	});

	observer.observe(clones, {
		attributes: true,
		childList: true,
		characterData: true,
	});

}