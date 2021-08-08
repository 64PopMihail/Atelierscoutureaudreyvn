
let hamburger= document.querySelector('.hamburger');
let navlinks= document.querySelector('.nav-links');
let links= document.querySelectorAll('.nav-links li');
// Au click j'ajoute/retire les classes à ces éléments
hamburger.addEventListener('click', function(){
    navlinks.classList.toggle('open');
    hamburger.classList.toggle('toggle');
    links.forEach(link => 
        {
        link.classList.toggle('fade'); 
        });
});

$('.sliderSlick').slick({
    infinite : true,
    autoplay: true,
    autoplaySpeed: 2000,
    arrows: false,
    
    
  });
