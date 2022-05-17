@extends('guest.layouts.app')

@section('title', __('msg.home'))

@section('id', 'Home')

@section('content')
    <!-- Banner Section-->
    <div class="Banner">
        <div class="min-h-screen relative overflow-hidden">
            <div class="min-h-screen relative overflow-hidden"><img class="w-full h-full absolute left-0 top-0"
                    src="{{ $header_image }}" alt="">
                <div class="container mx-auto min-h-screen relative">
                     <div
              class="item absolute text-white flex items-center justify-center flex-wrap text-center text-xl top-1/2 left-1/2 w-full">
              <div class="mx-auto rounded-lg flex bg-white w-full flex flex-col py-4 shadow-md">
                <h2 class="w-full mt-4 text-gray-900 text-lg mb-1 font-medium title-font">Book Bus</h2>
                <div
                  class="md:px-8 flex items-center justify-centr flex-wrap md:ml-auto w-full mt-10 md:mt-0 relative z-10">
                  <div class="relative mb-4 text-left w-full md:w-1/4 p-2">
                    <input id="One" type="radio" name="type"
                      class="px-4 py-2  mt-2 text-gray-700 bg-white border border-gray-200 rounded-md" checked>
                    <label class="text-gray-700 dark:text-gray-200 ml-4" for="One">One way</label>
                  </div>
                  <div class="relative mb-4 text-left w-full md:w-1/4 p-2">
                    <input id="Round" type="radio" name="type"
                      class="px-4 py-2  mt-2 text-gray-700 bg-white border border-gray-200 rounded-md">
                    <label class="text-gray-700 dark:text-gray-200 ml-4" for="Round">Round Trip</label>
                  </div>
                  <div class="relative mb-4 text-left w-full md:w-1/4 p-2">
                    <input id="Multi" type="radio" name="type"
                      class="px-4 py-2  mt-2 text-gray-700 bg-white border border-gray-200 rounded-md">
                    <label class="text-gray-700 dark:text-gray-200 ml-4" for="Multi">Multi Trip</label>
                  </div>
                  <div class="relative mb-4 text-left w-full md:w-1/4 p-2">
                    <input id="Full" type="radio" name="type"
                      class="px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md">
                    <label class="text-gray-700 dark:text-gray-200 ml-4" for="Full">Full Bus reservation</label>
                  </div>
                </div>
                <div
                  class="itemForm oneWay md:p-8 md:pt-0 flex items-center justify-centr flex-wrap md:ml-auto w-full mt-10 md:mt-0 relative z-10">
                  <div class="relative mb-4 text-left w-full md:w-1/5 p-2">
                    <label class="text-gray-700 dark:text-gray-200 text-xl" for="from">From :</label>
                    <select
                      class="text-xl block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring">
                      <option>Dubai </option>
                      <option>Sharjah</option>
                      <option>Dubai </option>
                      <option>Sharjah</option>
                      <option>Dubai </option>
                      <option>Sharjah</option>
                    </select></div>
                  <div class="relative mb-4 text-left w-full md:w-1/5 p-2">
                    <label class="text-gray-700 dark:text-gray-200 text-xl" for="">To:</label>
                    <select
                      class="text-xl block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring">
                      <option>Dubai </option>
                      <option>Sharjah</option>
                      <option>Dubai </option>
                      <option>Sharjah</option>
                      <option>Dubai </option>
                      <option>Sharjah </option>
                    </select></div>
                  <div class="relative mb-4 text-left  w-full md:w-2/5 p-2">
                    <label class="text-gray-700 dark:text-gray-200 text-xl" for="from">Departure data:</label>
                    <input type="date" id="from" name="from"
                      class="text-xl block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring">
                  </div>
                  <div class="relative mb-4 text-center w-full md:w-1/5 p-2">
                    <label class="text-white" for=" "> .</label><a href="book.html"
                      class="block text-white text-center bg-indigo-500 w-full border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded text-lg">Booking</a>
                    <!--- <button class="text-white text-center bg-indigo-500 w-full border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded text-lg">Booking</button> -->
                  </div>
                </div>
                <div class="Multi itemForm hidden">
                  <div
                    class="main md:p-8 md:py-0 flex items-center justify-centr flex-wrap md:ml-auto w-full mt-10 md:mt-0 relative z-10">
                    <div class="relative mb-4 md:mb-0 text-left w-full md:w-1/3 p-2">
                      <label class="text-gray-700 dark:text-gray-200 text-xl" for="from">From :</label>
                      <select
                        class="text-xl block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring">
                        <option>Dubai </option>
                        <option>Sharjah</option>
                        <option>Dubai </option>
                        <option>Sharjah</option>
                        <option>Dubai </option>
                        <option>Sharjah</option>
                      </select></div>
                    <div class="relative mb-4 md:mb-0 text-left w-full md:w-1/3 p-2">
                      <label class="text-gray-700 dark:text-gray-200 text-xl" for="">To:</label>
                      <select
                        class="text-xl block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring">
                        <option>Dubai </option>
                        <option>Sharjah</option>
                        <option>Dubai </option>
                        <option>Sharjah</option>
                        <option>Dubai </option>
                        <option>Sharjah </option>
                      </select></div>
                    <div class="relative mb-4 md:mb-0 text-left  w-full md:w-1/3 p-2">
                      <label class="text-gray-700 dark:text-gray-200 text-xl" for="from">Departure data:</label>
                      <input type="date" id="from" name="from"
                        class="text-xl block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring">
                    </div>
                  </div>
                  <button class="repeat mx-8 block text-left text-gray-700">add another destination </button>
                  <div class="relative mb-4 mx-8 md:mb-0 text-center w-full md:w-1/5 p-2">
                    <label class="text-white" for=" "> .</label><a href="book.html"
                      class="block text-white text-center bg-indigo-500 w-full border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded text-lg">Booking</a>
                  </div>
                </div>
                <div class="Round itemForm hidden">
                  <div
                    class="main md:p-8 md:pt-0 flex items-center justify-centr flex-wrap md:ml-auto w-full mt-10 md:mt-0 relative z-10">
                    <div class="relative mb-4 text-left w-full md:w-1/5 p-2">
                      <label class="text-gray-700 dark:text-gray-200 text-xl" for="from">From :</label>
                      <select
                        class="text-xl block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring">
                        <option>Dubai </option>
                        <option>Sharjah</option>
                        <option>Dubai </option>
                        <option>Sharjah</option>
                        <option>Dubai </option>
                        <option>Sharjah</option>
                      </select></div>
                    <div class="relative mb-4 text-left w-full md:w-1/5 p-2">
                      <label class="text-gray-700 dark:text-gray-200 text-xl" for="">To:</label>
                      <select
                        class="text-xl block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring">
                        <option>Dubai </option>
                        <option>Sharjah</option>
                        <option>Dubai </option>
                        <option>Sharjah</option>
                        <option>Dubai </option>
                        <option>Sharjah </option>
                      </select></div>
                    <div class="relative mb-4 text-left  w-full md:w-1/5 p-2">
                      <label class="text-gray-700 dark:text-gray-200 text-xl" for="from">Departure data:</label>
                      <input type="date" id="from" name="from"
                        class="text-xl block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring">
                    </div>
                    <div class="relative mb-4 text-left w-full md:w-1/5 p-2">
                      <label class="text-gray-700 dark:text-gray-200 text-xl" for="from">Return data:</label>
                      <input type="date" id="from" name="from"
                        class="text-xl block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring">
                    </div>
                    <div class="relative mb-4 w-full md:w-1/5 p-2">
                      <label class="text-white" for=" "> .</label><a href="book.html"
                        class="block text-white text-center bg-indigo-500 w-full border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded text-lg">Booking</a>
                    </div>
                  </div>
                </div>
                <div class="Full itemForm hidden">
                  <div
                    class="main md:p-8 md:pt-0 flex items-center justify-centr flex-wrap md:ml-auto w-full mt-10 md:mt-0 relative z-10">
                    <div class="relative mb-4 text-left w-full md:w-1/4 p-2">
                      <label class="text-gray-700 dark:text-gray-200 text-xl" for="from">From :</label>
                      <select
                        class="text-xl block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring">
                        <option>Dubai </option>
                        <option>Sharjah</option>
                        <option>Dubai </option>
                        <option>Sharjah</option>
                        <option>Dubai </option>
                        <option>Sharjah</option>
                      </select></div>
                    <div class="relative mb-4 text-left w-full md:w-1/4 p-2">
                      <label class="text-gray-700 dark:text-gray-200 text-xl" for="">To:</label>
                      <select
                        class="text-xl block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring">
                        <option>Dubai </option>
                        <option>Sharjah</option>
                        <option>Dubai </option>
                        <option>Sharjah</option>
                        <option>Dubai </option>
                        <option>Sharjah </option>
                      </select></div>
                    <div class="relative mb-4 text-left  w-full md:w-1/4 p-2">
                      <label class="text-gray-700 dark:text-gray-200 text-xl" for="from">Departure data:</label>
                      <input type="date" id="from" name="from"
                        class="text-xl block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring">
                    </div>
                    <div class="relative mb-4 w-full md:w-1/4 p-2">
                      <label class="text-white" for=" "> .</label><a href="book.html"
                        class="block text-white text-center bg-indigo-500 w-full border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded text-lg">Booking</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container mx-auto text-center my-32">
        <h2 class="text-2xl font-bold text-gray-800 dark:text-white md:text-3xl">{!! $section_title !!}</h2>
        <p class="mt-4 text-gray-600 dark:text-gray-400 text-lg">{{ $section_text }}</p>
        <div class="mt-8">
            <a href="{{ $section_link }}"
                class="px-5 py-2 font-semibold text-gray-100 transition-colors duration-200 transform bg-gray-900 rounded-md hover:bg-gray-700 text-2xl">
                @lang('msg.click_here')
            </a>
        </div>
    </div>

@endsection
