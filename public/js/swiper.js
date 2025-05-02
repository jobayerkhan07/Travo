const swiper = new Swiper('.swiper', {
    slidesPerView: 1, //perv picture visible for 5s 
    effect: 'creative', //for picture transition
    creativeEffect: {
        prev: {
            translate: [0, 0, -400], // translation for previous spicture
        },
        next: {
            translate: ['100%', 0, 0], //translation for next picture
        },
    },
    loop: true, // picture will be keep changing
    direction: 'horizontal',
    autoplay: {
        delay: 5000, // every 5s picture will be changed
    },
    speed: 400, // speed between pictures
    spaceBetween: 100, // space between pictures
});


// navbar active scroll

window.addEventListener('scroll', function() {    //window element scroll
    var sections = document.querySelectorAll('section');
    var navLinks = document.querySelectorAll('nav ul li a');
    //all sectiona and anchor tag selected
    sections.forEach(function(section, index) {
        var rect = section.getBoundingClientRect();
        if (rect.top <= 0 && rect.bottom >= 0) {
            
            navLinks.forEach(link => link.classList.remove('active'));
            
            navLinks[index].classList.add('active');
        }
    });
});

