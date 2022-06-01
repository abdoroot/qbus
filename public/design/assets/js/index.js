 $('.sliderBanner').slick({
   infinite: true,
   slidesToShow: 1,
   slidesToScroll: 1,
   dots: true,
   arrows: false,
 });

 $('nav button').click(function () {
   $('nav .flex-1').toggleClass('active')
 })

 $('.multiple-items').slick({
   infinite: true,
   slidesToShow: 3,
   slidesToScroll: 3,
   responsive: [{
       breakpoint: 768,
       settings: {
         arrows: false,
         centerMode: true,
         centerPadding: '40px',
         slidesToShow: 2
       }
     },
     {
       breakpoint: 480,
       settings: {
         arrows: false,
         centerMode: true,
         centerPadding: '40px',
         slidesToShow: 1
       }
     }
   ]
 });


 $('.openFilter').click(function () {
   $('.filter').toggleClass('active');
 })


 $('.language').mouseover(function(){
  $(this).removeClass('overflow-hidden');
 })
 $('.language').mouseleave(function(){
  $(this).addClass('overflow-hidden');
})

