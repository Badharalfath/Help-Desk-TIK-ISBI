@extends('layouts.homelayout')

@section('content')
<section class="text-gray-600 body-font pt-28 relative">
  <!-- Swiper -->
  <div class="swiper-container absolute inset-0 z-0 h-[60vh]">
    <div class="swiper-wrapper">
      <div class="swiper-slide">
        <img class="object-cover w-full h-full" src="https://dummyimage.com/1920x1080/000/fff" alt="Slide 1">
        <div class="absolute inset-0 bg-black opacity-50"></div>
      </div>
      <div class="swiper-slide">
        <img class="object-cover w-full h-full" src="https://dummyimage.com/1920x1080" alt="Slide 2">
        <div class="absolute inset-0 bg-black opacity-50"></div>
      </div>
      <div class="swiper-slide">
        <img class="object-cover w-full h-full" src="https://dummyimage.com/1920x1080/fff/64bccc" alt="Slide 3">
        <div class="absolute inset-0 bg-black opacity-50"></div>
      </div>
    </div>
  </div>

  <!-- Content -->
  <div class="container mx-auto flex px-5 py-24 md:flex-row flex-col items-center relative z-10">
    <div class="lg:flex-grow md:w-1/2 lg:pl-24 md:pl-16 flex flex-col md:items-start md:text-left items-center text-center text-white">
      <h1 class="title-font sm:text-4xl text-3xl mb-4 font-medium">Before they sold out
        <br class="hidden lg:inline-block">readymade gluten
      </h1>
      <p class="mb-8 leading-relaxed">Copper mug try-hard pitchfork pour-over freegan heirloom neutra air plant cold-pressed tacos poke beard tote bag. Heirloom echo park mlkshk tote bag selvage hot chicken authentic tumeric truffaut hexagon try-hard chambray.</p>
      <div class="flex justify-center">
        <button class="inline-flex text-white bg-blue-500 border-0 py-2 px-6 focus:outline-none hover:bg-blue-600 rounded text-lg">Button</button>
        <button class="ml-4 inline-flex text-gray-700 bg-gray-100 border-0 py-2 px-6 focus:outline-none hover:bg-gray-200 rounded text-lg">Button</button>
      </div>
    </div>
  </div>
</section>

<section class="text-gray-600 body-font mt-40">
  <div class="container px-5 py-24 mx-auto flex flex-wrap">
    <div class="lg:w-2/3 mx-auto">
      <div class="flex flex-wrap w-full bg-gray-100 py-32 px-10 relative mb-4">
        <img alt="gallery" class="w-full object-cover h-full object-center block opacity-25 absolute inset-0" src="https://dummyimage.com/820x340">
        <div class="text-center relative z-10 w-full">
          <h2 class="text-2xl text-gray-900 font-medium title-font mb-2">Shooting Stars</h2>
          <p class="leading-relaxed">Skateboard +1 mustache fixie paleo lumbersexual.</p>
          <a class="mt-3 text-blue-500 inline-flex items-center">Learn More
            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 ml-2" viewBox="0 0 24 24">
              <path d="M5 12h14M12 5l7 7-7 7"></path>
            </svg>
          </a>
        </div>
      </div>
      <div class="flex flex-wrap -mx-2">
        <div class="px-2 w-1/2">
          <div class="flex flex-wrap w-full bg-gray-100 sm:py-24 py-16 sm:px-10 px-6 relative">
            <img alt="gallery" class="w-full object-cover h-full object-center block opacity-25 absolute inset-0" src="https://dummyimage.com/542x460">
            <div class="text-center relative z-10 w-full">
              <h2 class="text-xl text-gray-900 font-medium title-font mb-2">Shooting Stars</h2>
              <p class="leading-relaxed">Skateboard +1 mustache fixie paleo lumbersexual.</p>
              <a class="mt-3 text-blue-500 inline-flex items-center">Learn More
                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 ml-2" viewBox="0 0 24 24">
                  <path d="M5 12h14M12 5l7 7-7 7"></path>
                </svg>
              </a>
            </div>
          </div>
        </div>
        <div class="px-2 w-1/2">
          <div class="flex flex-wrap w-full bg-gray-100 sm:py-24 py-16 sm:px-10 px-6 relative">
            <img alt="gallery" class="w-full object-cover h-full object-center block opacity-25 absolute inset-0" src="https://dummyimage.com/542x420">
            <div class="text-center relative z-10 w-full">
              <h2 class="text-xl text-gray-900 font-medium title-font mb-2">Shooting Stars</h2>
              <p class="leading-relaxed">Skateboard +1 mustache fixie paleo lumbersexual.</p>
              <a class="mt-3 text-blue-500 inline-flex items-center">Learn More
                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 ml-2" viewBox="0 0 24 24">
                  <path d="M5 12h14M12 5l7 7-7 7"></path>
                </svg>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Swiper Initialization Script -->
<script>
  var swiper = new Swiper('.swiper-container', {
    loop: true,
    autoplay: {
      delay: 3000,
      disableOnInteraction: false,
    },
    effect: 'fade',
    fadeEffect: {
      crossFade: true
    },
  });
</script>
@endsection
