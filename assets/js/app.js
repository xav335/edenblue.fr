var mySwiper = new Swiper('.slider', {
    direction: 'horizontal',
    loop: true,
    autoplay: {
        delay: 5000,
    },
    speed: 1000,
    pagination: {
        el: '.swiper-pagination',
        clickable: true,
    },
    effect: 'fade',
});


var displayElements = function (event) {
    [].forEach.call(document.querySelectorAll('[data-animation]'), function(el) {
		var bounding = el.getBoundingClientRect();
		var myElementHeight = el.offsetHeight;
		var myElementWidth = el.offsetWidth;
		if (bounding.top >= -myElementHeight 
			&& bounding.left >= -myElementWidth
			&& bounding.right <= (window.innerWidth || document.documentElement.clientWidth) + myElementWidth
			&& bounding.bottom <= (window.innerHeight || document.documentElement.clientHeight) + myElementHeight) {
			el.classList.add('visible');
		} else {
            el.classList.remove('visible');
        }
	});
};

// Add our event listeners
window.addEventListener('load', displayElements, false);
window.addEventListener('scroll', displayElements, false);
document.querySelector('body').addEventListener('scroll', displayElements, false);
window.addEventListener('mousemove', displayElements, false);