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

document.querySelector('header label').addEventListener('click', function(){
    if(this.classList.contains('active')){
        this.classList.remove('active');
    } else {
        this.classList.add('active');
    }
});

document.addEventListener("DOMContentLoaded", function(event) {
    if(document.querySelector('body').offsetWidth < 800){
        document.querySelector('header nav').appendChild(document.querySelector('.top .cell:last-of-type div'));

        let liensMenu = document.querySelectorAll('nav ul > li a');
        liensMenu.forEach(lien => {
            lien.addEventListener('click', function(e){
                if(this.nextElementSibling){
                    e.preventDefault();
                    this.classList.toggle('open');
                }
            });
        });
    }
    if(document.querySelector('body').classList.contains('spa')){
        document.querySelector('.top img').setAttribute('src','assets/img/logo-eden-blue-white.png');
    }
}, false);

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