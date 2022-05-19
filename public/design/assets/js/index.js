 $('.sliderBanner').slick({
   infinite: true,
   slidesToShow: 1,
   slidesToScroll: 1,
   dots: true,
   arrows: false,
 });

 $('nav button').click(function () {
   $('nav .flex-1').toggleClass('active')
   console.log('done')
 })


 $('.firstStep .next').click(function () {
   $('li.first').addClass('done')
   $('.firstStep').addClass('hidden')
   $('.seconedStep').removeClass('hidden')
 })

 $('.seconedStep .next').click(function () {
   $('li.seconed').addClass('done')
   $('.seconedStep').addClass('hidden')
   $('.thirdStep').removeClass('hidden')
 })


 $('.thirdStep .next').click(function () {
   $('li.third').addClass('done')
   $('.thirdStep').addClass('hidden')
   $('.fourthStep').removeClass('hidden')
 })



 $('.fourthStep .next').click(function () {
   $('li.fourth').addClass('done')
   $('.fourthStep').addClass('hidden')
   $('.fifthStep').removeClass('hidden')
 })


 $('#Book .busItem').click(function () {
   $(this).siblings().removeClass('active');
   $(this).addClass('active')
 })
 $('#Book .companyItem').click(function () {
   $(this).siblings().removeClass('active');
   $(this).addClass('active')
 })
 $("#Book .btn").on("click", function () {
   $("html").scrollTop(0);
 });





 $('.seconedStep .back').click(function () {
   $('li.first').removeClass('done')
   $('.seconedStep').addClass('hidden')
   $('.firstStep').removeClass('hidden')
 })

 $('.thirdStep .back').click(function () {
   $('li.seconed').removeClass('done')
   $('.thirdStep').addClass('hidden')
   $('.seconedStep').removeClass('hidden')
 })

 $('.fourthStep .back').click(function () {
   $('li.third').removeClass('done')
   $('.fourthStep').addClass('hidden')
   $('.thirdStep').removeClass('hidden')
 })

 $('.fifthStep .back').click(function () {
   $('li.fourth').removeClass('done')
   $('.fifthStep').addClass('hidden')
   $('.fourthStep').removeClass('hidden')
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

 $(function () {
   $(".repeat").on('click', function (e) {
     e.preventDefault(); // to prevent form submit
     var $self = $(this);
     $self.before($self.prev('div').clone()); // use prev() not parent()
   });
 });

 $(function () {
   $("#One").click(function () {
     if ($("#One").is(":checked")) {
       $(".itemForm").addClass('hidden')
       $(".oneWay").removeClass('hidden');
     }
   });
 });

 $(function () {
   $("#Round").click(function () {
     if ($("#Round").is(":checked")) {
       $(".itemForm").addClass('hidden')
       $(".Round").removeClass('hidden');
     }
   });
 });


 $(function () {
   $("#Multi").click(function () {
     if ($("#Multi").is(":checked")) {
       $(".itemForm").addClass('hidden')
       $(".Multi").removeClass('hidden');
     }
   });
 });

 $(function () {
   $("#Full").click(function () {
     if ($("#Full").is(":checked")) {
       $(".itemForm").addClass('hidden')
       $(".Full").removeClass('hidden');
     }
   });
 });

 $('.language').mouseover(function(){
  $(this).removeClass('overflow-hidden');
   console.log('Done')
 })
 $('.language').mouseleave(function(){
  $(this).addClass('overflow-hidden');
  console.log('Done')
})

