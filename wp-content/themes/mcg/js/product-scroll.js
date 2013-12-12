$(document).ready(function () {
	$("#product-scrolling").smoothDivScroll({
		mousewheelScrolling: "allDirections",
		manualContinuousScrolling: true,
		autoScrollingMode: "onStart",
		autoScrollingStep: 1,
		autoScrollingInterval:30,
		touchScrolling: true,
		mousewheelScrolling:"",
		visibleHotSpotBackgrounds: "always"
	});
});