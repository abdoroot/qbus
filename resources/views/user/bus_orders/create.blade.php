@extends('guest.layouts.app')

@section('title', __('crud.create') . ' ' . __('models/busOrders.singular'))

@section('id', 'Book')

@section('content')
<section class="bg-white dark:bg-gray-900">
    <div class="container px-6 py-10 mx-auto">
        <h1
            class="text-3xl mb-4 font-semibold text-center text-gray-800 capitalize lg:text-4xl dark:text-white">
            Book Bus <br /> <span class="text-blue-500 mt-4 inline-block">Let's Do Now !</span></h1>
    </div>
</section>
<div class="BookBus">
    <div class="container mx-auto">
        <div class="row flex items-center justify-center flex-wrap p-4 md:p-0">
            <div class="w-full">
                <ul class="timeLine flex items-center justify-between relative overflow-hidden">
                    <li
                        class="first bg-white flex text-center items-center justify-center border-black rounded-full text-2xl border-2 w-12 h-12">
                        1</li>
                    <li
                        class="seconed bg-white flex text-center items-center justify-center border-black rounded-full text-2xl border-2 w-12 h-12">
                        2</li>
                    <li
                        class="third bg-white flex text-center items-center justify-center border-black rounded-full text-2xl border-2 w-12 h-12">
                        3</li>
                    <li
                        class="fourth bg-white flex text-center items-center justify-center border-black rounded-full text-2xl border-2 w-12 h-12">
                        4</li>
                </ul>
            </div>
            <div class="w-full">
                <div class="firstStep">
                    <h1
                        class="text-3xl my-12 font-semibold text-left text-gray-800 capitalize lg:text-4xl dark:text-white">
                        Choose your location </h1>
                    <div class="map">
                        <div class="mt-6 mb-16">
                            <label for="text" class="text-lg text-gray-600 dark:text-gray-200"> Your
                                Location</label>
                            <input type="text" name="text" id="text" placeholder="Your Location"
                                class="block w-full px-4 py-2 mt-2 text-gray-700 placeholder-gray-400 bg-white border border-gray-200 rounded-md dark:placeholder-gray-600 dark:bg-gray-900 dark:text-gray-300 dark:border-gray-700 focus:border-blue-400 dark:focus:border-blue-400 focus:ring-blue-400 focus:outline-none focus:ring focus:ring-opacity-40 text-lg" />
                        </div>
                        <iframe width="100%" height="500" id="gmap_canvas"
                            src="https://maps.google.com/maps?q=Dubai&t=&z=13&ie=UTF8&iwloc=&output=embed"
                            frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
                        <div class="buttons flex items-center justify-center text-center"><a
                                class="mt-8 btn next cursor-pointer float-right w-full px-3 py-2 m-1 text-lg font-medium tracking-wider text-white uppercase transition-colors duration-200 transform bg-blue-700 rounded-md dark:hover:bg-gray-600 dark:bg-gray-700 lg:w-auto hover:bg-gray-700"
                                href="#!">Next Step</a></div>
                    </div>
                </div>
                <div class="seconedStep hidden">
                    <h1
                        class="text-3xl my-12 font-semibold text-left text-gray-800 capitalize lg:text-4xl dark:text-white">
                        What Is Your Destination? </h1>
                    <div class="triple">
                        <div class="grid grid-cols-1 gap-6 my-16 sm:grid-cols-2">
                            <div>
                                <label class="text-gray-700 dark:text-gray-200 text-xl" for="DateFrom">Date
                                    From:</label>
                                <input id="DateFrom" type="date"
                                    class="text-xl block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring">
                            </div>
                            <div>
                                <label class="text-gray-700 dark:text-gray-200 text-xl" for="Dateto">Date
                                    To:</label>
                                <input id="Dateto" type="date"
                                    class="text-xl block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring">
                            </div>
                            <div>
                                <label class="text-gray-700 dark:text-gray-200 text-xl" for="TimeFrom">Time
                                    From:</label>
                                <input id="TimeFrom" type="time"
                                    class="text-xl block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring">
                            </div>
                            <div>
                                <label class="text-gray-700 dark:text-gray-200 text-xl" for="timeto">Time
                                    To:</label>
                                <input id="timeto" type="time"
                                    class="text-xl block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring">
                            </div>
                            <div>
                                <label class="text-gray-700 dark:text-gray-200 text-xl" for="from">To:</label>
                                <select
                                    class="text-xl block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring">
                                    <option>Dubai </option>
                                    <option>Sharjah</option>
                                    <option>Dubai </option>
                                    <option>Sharjah</option>
                                    <option>Dubai </option>
                                    <option>Sharjah</option>
                                </select></div>
                            <div>
                                <label class="text-gray-700 dark:text-gray-200 text-xl" for="to">From:</label>
                                <select
                                    class="text-xl block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring">
                                    <option>Dubai </option>
                                    <option>Sharjah</option>
                                    <option>Dubai </option>
                                    <option>Sharjah</option>
                                    <option>Dubai </option>
                                    <option>Sharjah</option>
                                </select></div>
                        </div>
                        <div class="buttons flex items-center justify-center text-center"><a
                                class="back mt-8  cursor-pointer bg-gray-700 float-right w-full px-3 py-2 m-1 text-lg font-medium tracking-wider text-white uppercase transition-colors duration-200 transform  rounded-md dark:hover:bg-gray-600 dark:bg-gray-700 lg:w-auto hover:bg-gray-700">Back</a><a
                                class="mt-8 btn next cursor-pointer float-right w-full px-3 py-2 m-1 text-lg font-medium tracking-wider text-white uppercase transition-colors duration-200 transform bg-blue-700 rounded-md dark:hover:bg-gray-600 dark:bg-gray-700 lg:w-auto hover:bg-gray-700"
                                href="#!">Next Step</a></div>
                    </div>
                </div>
                <div class="thirdStep hidden">
                    <h1
                        class="text-3xl my-12 font-semibold text-left text-gray-800 capitalize lg:text-4xl dark:text-white">
                        Choose The Company </h1>
                    <div class="row flex items-center justify-center flex-wrap max-h-screen overflow-y-scroll">
                        <div
                            class="companyItem cursor-pointer mb-8 max-w-sm mx-auto lg:w-1/3 overflow-hidden bg-white px-4">
                            <div class="imgItem h-72 rounded-lg overflow-hidden"><img
                                    class="object-cover object-center min-w-full  h-full"
                                    src="assets/img/49.jpg" alt="avatar"></div>
                            <div class="flex items-center px-2 py-3 bg-gray-900">
                                <svg class="w-6 h-6 text-white fill-current" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M17 21C15.8954 21 15 20.1046 15 19V15C15 13.8954 15.8954 13 17 13H19V12C19 8.13401 15.866 5 12 5C8.13401 5 5 8.13401 5 12V13H7C8.10457 13 9 13.8954 9 15V19C9 20.1046 8.10457 21 7 21H3V12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12V21H17ZM19 15H17V19H19V15ZM7 15H5V19H7V15Z" />
                                </svg>
                                <h1 class="mx-3 text-lg font-semibold text-white">Focusing</h1>
                            </div>
                            <div class="px-2 py-4">
                                <h1 class="text-xl font-semibold text-gray-800 dark:text-white">Patterson
                                    johnson</h1>
                                <div class="flex mt-2 item-center">
                                    <svg class="w-5 h-5 text-gray-700 fill-current dark:text-gray-300"
                                        viewBox="0 0 24 24">
                                        <path
                                            d="M12 17.27L18.18 21L16.54 13.97L22 9.24L14.81 8.63L12 2L9.19 8.63L2 9.24L7.46 13.97L5.82 21L12 17.27Z" />
                                    </svg>
                                    <svg class="w-5 h-5 text-gray-700 fill-current dark:text-gray-300"
                                        viewBox="0 0 24 24">
                                        <path
                                            d="M12 17.27L18.18 21L16.54 13.97L22 9.24L14.81 8.63L12 2L9.19 8.63L2 9.24L7.46 13.97L5.82 21L12 17.27Z" />
                                    </svg>
                                    <svg class="w-5 h-5 text-gray-700 fill-current dark:text-gray-300"
                                        viewBox="0 0 24 24">
                                        <path
                                            d="M12 17.27L18.18 21L16.54 13.97L22 9.24L14.81 8.63L12 2L9.19 8.63L2 9.24L7.46 13.97L5.82 21L12 17.27Z" />
                                    </svg>
                                    <svg class="w-5 h-5 text-gray-500 fill-current" viewBox="0 0 24 24">
                                        <path
                                            d="M12 17.27L18.18 21L16.54 13.97L22 9.24L14.81 8.63L12 2L9.19 8.63L2 9.24L7.46 13.97L5.82 21L12 17.27Z" />
                                    </svg>
                                    <svg class="w-5 h-5 text-gray-500 fill-current" viewBox="0 0 24 24">
                                        <path
                                            d="M12 17.27L18.18 21L16.54 13.97L22 9.24L14.81 8.63L12 2L9.19 8.63L2 9.24L7.46 13.97L5.82 21L12 17.27Z" />
                                    </svg>
                                </div>
                                <div class="flex items-center mt-4 text-gray-700 dark:text-gray-200">
                                    <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M14 11H10V13H14V11Z" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M7 5V4C7 2.89545 7.89539 2 9 2H15C16.1046 2 17 2.89545 17 4V5H20C21.6569 5 23 6.34314 23 8V18C23 19.6569 21.6569 21 20 21H4C2.34314 21 1 19.6569 1 18V8C1 6.34314 2.34314 5 4 5H7ZM9 4H15V5H9V4ZM4 7C3.44775 7 3 7.44769 3 8V14H21V8C21 7.44769 20.5522 7 20 7H4ZM3 18V16H21V18C21 18.5523 20.5522 19 20 19H4C3.44775 19 3 18.5523 3 18Z" />
                                    </svg>
                                    <h1 class="px-2 text-lg">Meraki UI</h1>
                                </div>
                                <div class="flex items-center mt-4 text-gray-700 dark:text-gray-200">
                                    <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M16.2721 10.2721C16.2721 12.4813 14.4813 14.2721 12.2721 14.2721C10.063 14.2721 8.27214 12.4813 8.27214 10.2721C8.27214 8.063 10.063 6.27214 12.2721 6.27214C14.4813 6.27214 16.2721 8.063 16.2721 10.2721ZM14.2721 10.2721C14.2721 11.3767 13.3767 12.2721 12.2721 12.2721C11.1676 12.2721 10.2721 11.3767 10.2721 10.2721C10.2721 9.16757 11.1676 8.27214 12.2721 8.27214C13.3767 8.27214 14.2721 9.16757 14.2721 10.2721Z" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M5.79417 16.5183C2.19424 13.0909 2.05438 7.3941 5.48178 3.79418C8.90918 0.194258 14.6059 0.0543983 18.2059 3.48179C21.8058 6.90919 21.9457 12.606 18.5183 16.2059L12.3124 22.7241L5.79417 16.5183ZM17.0698 14.8268L12.243 19.8965L7.17324 15.0698C4.3733 12.404 4.26452 7.9732 6.93028 5.17326C9.59603 2.37332 14.0268 2.26454 16.8268 4.93029C19.6267 7.59604 19.7355 12.0269 17.0698 14.8268Z" />
                                    </svg>
                                    <h1 class="px-2 text-lg">California</h1>
                                </div>
                                <div class="flex items-center mt-4 text-gray-700 dark:text-gray-200">
                                    <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M3.00977 5.83789C3.00977 5.28561 3.45748 4.83789 4.00977 4.83789H20C20.5523 4.83789 21 5.28561 21 5.83789V17.1621C21 18.2667 20.1046 19.1621 19 19.1621H5C3.89543 19.1621 3 18.2667 3 17.1621V6.16211C3 6.11449 3.00333 6.06765 3.00977 6.0218V5.83789ZM5 8.06165V17.1621H19V8.06199L14.1215 12.9405C12.9499 14.1121 11.0504 14.1121 9.87885 12.9405L5 8.06165ZM6.57232 6.80554H17.428L12.7073 11.5263C12.3168 11.9168 11.6836 11.9168 11.2931 11.5263L6.57232 6.80554Z" />
                                    </svg>
                                    <h1 class="px-2 text-lg">patterson@example.com</h1>
                                </div>
                            </div>
                        </div>
                        <div
                            class="companyItem cursor-pointer mb-8 max-w-sm mx-auto lg:w-1/3 overflow-hidden bg-white px-4">
                            <div class="imgItem h-72 rounded-lg overflow-hidden"><img
                                    class="object-cover object-center min-w-full  h-full"
                                    src="assets/img/49.jpg" alt="avatar"></div>
                            <div class="flex items-center px-2 py-3 bg-gray-900">
                                <svg class="w-6 h-6 text-white fill-current" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M17 21C15.8954 21 15 20.1046 15 19V15C15 13.8954 15.8954 13 17 13H19V12C19 8.13401 15.866 5 12 5C8.13401 5 5 8.13401 5 12V13H7C8.10457 13 9 13.8954 9 15V19C9 20.1046 8.10457 21 7 21H3V12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12V21H17ZM19 15H17V19H19V15ZM7 15H5V19H7V15Z" />
                                </svg>
                                <h1 class="mx-3 text-lg font-semibold text-white">Focusing</h1>
                            </div>
                            <div class="px-2 py-4">
                                <h1 class="text-xl font-semibold text-gray-800 dark:text-white">Patterson
                                    johnson</h1>
                                <div class="flex mt-2 item-center">
                                    <svg class="w-5 h-5 text-gray-700 fill-current dark:text-gray-300"
                                        viewBox="0 0 24 24">
                                        <path
                                            d="M12 17.27L18.18 21L16.54 13.97L22 9.24L14.81 8.63L12 2L9.19 8.63L2 9.24L7.46 13.97L5.82 21L12 17.27Z" />
                                    </svg>
                                    <svg class="w-5 h-5 text-gray-700 fill-current dark:text-gray-300"
                                        viewBox="0 0 24 24">
                                        <path
                                            d="M12 17.27L18.18 21L16.54 13.97L22 9.24L14.81 8.63L12 2L9.19 8.63L2 9.24L7.46 13.97L5.82 21L12 17.27Z" />
                                    </svg>
                                    <svg class="w-5 h-5 text-gray-700 fill-current dark:text-gray-300"
                                        viewBox="0 0 24 24">
                                        <path
                                            d="M12 17.27L18.18 21L16.54 13.97L22 9.24L14.81 8.63L12 2L9.19 8.63L2 9.24L7.46 13.97L5.82 21L12 17.27Z" />
                                    </svg>
                                    <svg class="w-5 h-5 text-gray-500 fill-current" viewBox="0 0 24 24">
                                        <path
                                            d="M12 17.27L18.18 21L16.54 13.97L22 9.24L14.81 8.63L12 2L9.19 8.63L2 9.24L7.46 13.97L5.82 21L12 17.27Z" />
                                    </svg>
                                    <svg class="w-5 h-5 text-gray-500 fill-current" viewBox="0 0 24 24">
                                        <path
                                            d="M12 17.27L18.18 21L16.54 13.97L22 9.24L14.81 8.63L12 2L9.19 8.63L2 9.24L7.46 13.97L5.82 21L12 17.27Z" />
                                    </svg>
                                </div>
                                <div class="flex items-center mt-4 text-gray-700 dark:text-gray-200">
                                    <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M14 11H10V13H14V11Z" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M7 5V4C7 2.89545 7.89539 2 9 2H15C16.1046 2 17 2.89545 17 4V5H20C21.6569 5 23 6.34314 23 8V18C23 19.6569 21.6569 21 20 21H4C2.34314 21 1 19.6569 1 18V8C1 6.34314 2.34314 5 4 5H7ZM9 4H15V5H9V4ZM4 7C3.44775 7 3 7.44769 3 8V14H21V8C21 7.44769 20.5522 7 20 7H4ZM3 18V16H21V18C21 18.5523 20.5522 19 20 19H4C3.44775 19 3 18.5523 3 18Z" />
                                    </svg>
                                    <h1 class="px-2 text-lg">Meraki UI</h1>
                                </div>
                                <div class="flex items-center mt-4 text-gray-700 dark:text-gray-200">
                                    <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M16.2721 10.2721C16.2721 12.4813 14.4813 14.2721 12.2721 14.2721C10.063 14.2721 8.27214 12.4813 8.27214 10.2721C8.27214 8.063 10.063 6.27214 12.2721 6.27214C14.4813 6.27214 16.2721 8.063 16.2721 10.2721ZM14.2721 10.2721C14.2721 11.3767 13.3767 12.2721 12.2721 12.2721C11.1676 12.2721 10.2721 11.3767 10.2721 10.2721C10.2721 9.16757 11.1676 8.27214 12.2721 8.27214C13.3767 8.27214 14.2721 9.16757 14.2721 10.2721Z" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M5.79417 16.5183C2.19424 13.0909 2.05438 7.3941 5.48178 3.79418C8.90918 0.194258 14.6059 0.0543983 18.2059 3.48179C21.8058 6.90919 21.9457 12.606 18.5183 16.2059L12.3124 22.7241L5.79417 16.5183ZM17.0698 14.8268L12.243 19.8965L7.17324 15.0698C4.3733 12.404 4.26452 7.9732 6.93028 5.17326C9.59603 2.37332 14.0268 2.26454 16.8268 4.93029C19.6267 7.59604 19.7355 12.0269 17.0698 14.8268Z" />
                                    </svg>
                                    <h1 class="px-2 text-lg">California</h1>
                                </div>
                                <div class="flex items-center mt-4 text-gray-700 dark:text-gray-200">
                                    <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M3.00977 5.83789C3.00977 5.28561 3.45748 4.83789 4.00977 4.83789H20C20.5523 4.83789 21 5.28561 21 5.83789V17.1621C21 18.2667 20.1046 19.1621 19 19.1621H5C3.89543 19.1621 3 18.2667 3 17.1621V6.16211C3 6.11449 3.00333 6.06765 3.00977 6.0218V5.83789ZM5 8.06165V17.1621H19V8.06199L14.1215 12.9405C12.9499 14.1121 11.0504 14.1121 9.87885 12.9405L5 8.06165ZM6.57232 6.80554H17.428L12.7073 11.5263C12.3168 11.9168 11.6836 11.9168 11.2931 11.5263L6.57232 6.80554Z" />
                                    </svg>
                                    <h1 class="px-2 text-lg">patterson@example.com</h1>
                                </div>
                            </div>
                        </div>
                        <div
                            class="companyItem cursor-pointer mb-8 max-w-sm mx-auto lg:w-1/3 overflow-hidden bg-white px-4">
                            <div class="imgItem h-72 rounded-lg overflow-hidden"><img
                                    class="object-cover object-center min-w-full  h-full"
                                    src="assets/img/49.jpg" alt="avatar"></div>
                            <div class="flex items-center px-2 py-3 bg-gray-900">
                                <svg class="w-6 h-6 text-white fill-current" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M17 21C15.8954 21 15 20.1046 15 19V15C15 13.8954 15.8954 13 17 13H19V12C19 8.13401 15.866 5 12 5C8.13401 5 5 8.13401 5 12V13H7C8.10457 13 9 13.8954 9 15V19C9 20.1046 8.10457 21 7 21H3V12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12V21H17ZM19 15H17V19H19V15ZM7 15H5V19H7V15Z" />
                                </svg>
                                <h1 class="mx-3 text-lg font-semibold text-white">Focusing</h1>
                            </div>
                            <div class="px-2 py-4">
                                <h1 class="text-xl font-semibold text-gray-800 dark:text-white">Patterson
                                    johnson</h1>
                                <div class="flex mt-2 item-center">
                                    <svg class="w-5 h-5 text-gray-700 fill-current dark:text-gray-300"
                                        viewBox="0 0 24 24">
                                        <path
                                            d="M12 17.27L18.18 21L16.54 13.97L22 9.24L14.81 8.63L12 2L9.19 8.63L2 9.24L7.46 13.97L5.82 21L12 17.27Z" />
                                    </svg>
                                    <svg class="w-5 h-5 text-gray-700 fill-current dark:text-gray-300"
                                        viewBox="0 0 24 24">
                                        <path
                                            d="M12 17.27L18.18 21L16.54 13.97L22 9.24L14.81 8.63L12 2L9.19 8.63L2 9.24L7.46 13.97L5.82 21L12 17.27Z" />
                                    </svg>
                                    <svg class="w-5 h-5 text-gray-700 fill-current dark:text-gray-300"
                                        viewBox="0 0 24 24">
                                        <path
                                            d="M12 17.27L18.18 21L16.54 13.97L22 9.24L14.81 8.63L12 2L9.19 8.63L2 9.24L7.46 13.97L5.82 21L12 17.27Z" />
                                    </svg>
                                    <svg class="w-5 h-5 text-gray-500 fill-current" viewBox="0 0 24 24">
                                        <path
                                            d="M12 17.27L18.18 21L16.54 13.97L22 9.24L14.81 8.63L12 2L9.19 8.63L2 9.24L7.46 13.97L5.82 21L12 17.27Z" />
                                    </svg>
                                    <svg class="w-5 h-5 text-gray-500 fill-current" viewBox="0 0 24 24">
                                        <path
                                            d="M12 17.27L18.18 21L16.54 13.97L22 9.24L14.81 8.63L12 2L9.19 8.63L2 9.24L7.46 13.97L5.82 21L12 17.27Z" />
                                    </svg>
                                </div>
                                <div class="flex items-center mt-4 text-gray-700 dark:text-gray-200">
                                    <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M14 11H10V13H14V11Z" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M7 5V4C7 2.89545 7.89539 2 9 2H15C16.1046 2 17 2.89545 17 4V5H20C21.6569 5 23 6.34314 23 8V18C23 19.6569 21.6569 21 20 21H4C2.34314 21 1 19.6569 1 18V8C1 6.34314 2.34314 5 4 5H7ZM9 4H15V5H9V4ZM4 7C3.44775 7 3 7.44769 3 8V14H21V8C21 7.44769 20.5522 7 20 7H4ZM3 18V16H21V18C21 18.5523 20.5522 19 20 19H4C3.44775 19 3 18.5523 3 18Z" />
                                    </svg>
                                    <h1 class="px-2 text-lg">Meraki UI</h1>
                                </div>
                                <div class="flex items-center mt-4 text-gray-700 dark:text-gray-200">
                                    <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M16.2721 10.2721C16.2721 12.4813 14.4813 14.2721 12.2721 14.2721C10.063 14.2721 8.27214 12.4813 8.27214 10.2721C8.27214 8.063 10.063 6.27214 12.2721 6.27214C14.4813 6.27214 16.2721 8.063 16.2721 10.2721ZM14.2721 10.2721C14.2721 11.3767 13.3767 12.2721 12.2721 12.2721C11.1676 12.2721 10.2721 11.3767 10.2721 10.2721C10.2721 9.16757 11.1676 8.27214 12.2721 8.27214C13.3767 8.27214 14.2721 9.16757 14.2721 10.2721Z" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M5.79417 16.5183C2.19424 13.0909 2.05438 7.3941 5.48178 3.79418C8.90918 0.194258 14.6059 0.0543983 18.2059 3.48179C21.8058 6.90919 21.9457 12.606 18.5183 16.2059L12.3124 22.7241L5.79417 16.5183ZM17.0698 14.8268L12.243 19.8965L7.17324 15.0698C4.3733 12.404 4.26452 7.9732 6.93028 5.17326C9.59603 2.37332 14.0268 2.26454 16.8268 4.93029C19.6267 7.59604 19.7355 12.0269 17.0698 14.8268Z" />
                                    </svg>
                                    <h1 class="px-2 text-lg">California</h1>
                                </div>
                                <div class="flex items-center mt-4 text-gray-700 dark:text-gray-200">
                                    <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M3.00977 5.83789C3.00977 5.28561 3.45748 4.83789 4.00977 4.83789H20C20.5523 4.83789 21 5.28561 21 5.83789V17.1621C21 18.2667 20.1046 19.1621 19 19.1621H5C3.89543 19.1621 3 18.2667 3 17.1621V6.16211C3 6.11449 3.00333 6.06765 3.00977 6.0218V5.83789ZM5 8.06165V17.1621H19V8.06199L14.1215 12.9405C12.9499 14.1121 11.0504 14.1121 9.87885 12.9405L5 8.06165ZM6.57232 6.80554H17.428L12.7073 11.5263C12.3168 11.9168 11.6836 11.9168 11.2931 11.5263L6.57232 6.80554Z" />
                                    </svg>
                                    <h1 class="px-2 text-lg">patterson@example.com</h1>
                                </div>
                            </div>
                        </div>
                        <div
                            class="companyItem cursor-pointer mb-8 max-w-sm mx-auto lg:w-1/3 overflow-hidden bg-white px-4">
                            <div class="imgItem h-72 rounded-lg overflow-hidden"><img
                                    class="object-cover object-center min-w-full  h-full"
                                    src="assets/img/49.jpg" alt="avatar"></div>
                            <div class="flex items-center px-2 py-3 bg-gray-900">
                                <svg class="w-6 h-6 text-white fill-current" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M17 21C15.8954 21 15 20.1046 15 19V15C15 13.8954 15.8954 13 17 13H19V12C19 8.13401 15.866 5 12 5C8.13401 5 5 8.13401 5 12V13H7C8.10457 13 9 13.8954 9 15V19C9 20.1046 8.10457 21 7 21H3V12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12V21H17ZM19 15H17V19H19V15ZM7 15H5V19H7V15Z" />
                                </svg>
                                <h1 class="mx-3 text-lg font-semibold text-white">Focusing</h1>
                            </div>
                            <div class="px-2 py-4">
                                <h1 class="text-xl font-semibold text-gray-800 dark:text-white">Patterson
                                    johnson</h1>
                                <div class="flex mt-2 item-center">
                                    <svg class="w-5 h-5 text-gray-700 fill-current dark:text-gray-300"
                                        viewBox="0 0 24 24">
                                        <path
                                            d="M12 17.27L18.18 21L16.54 13.97L22 9.24L14.81 8.63L12 2L9.19 8.63L2 9.24L7.46 13.97L5.82 21L12 17.27Z" />
                                    </svg>
                                    <svg class="w-5 h-5 text-gray-700 fill-current dark:text-gray-300"
                                        viewBox="0 0 24 24">
                                        <path
                                            d="M12 17.27L18.18 21L16.54 13.97L22 9.24L14.81 8.63L12 2L9.19 8.63L2 9.24L7.46 13.97L5.82 21L12 17.27Z" />
                                    </svg>
                                    <svg class="w-5 h-5 text-gray-700 fill-current dark:text-gray-300"
                                        viewBox="0 0 24 24">
                                        <path
                                            d="M12 17.27L18.18 21L16.54 13.97L22 9.24L14.81 8.63L12 2L9.19 8.63L2 9.24L7.46 13.97L5.82 21L12 17.27Z" />
                                    </svg>
                                    <svg class="w-5 h-5 text-gray-500 fill-current" viewBox="0 0 24 24">
                                        <path
                                            d="M12 17.27L18.18 21L16.54 13.97L22 9.24L14.81 8.63L12 2L9.19 8.63L2 9.24L7.46 13.97L5.82 21L12 17.27Z" />
                                    </svg>
                                    <svg class="w-5 h-5 text-gray-500 fill-current" viewBox="0 0 24 24">
                                        <path
                                            d="M12 17.27L18.18 21L16.54 13.97L22 9.24L14.81 8.63L12 2L9.19 8.63L2 9.24L7.46 13.97L5.82 21L12 17.27Z" />
                                    </svg>
                                </div>
                                <div class="flex items-center mt-4 text-gray-700 dark:text-gray-200">
                                    <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M14 11H10V13H14V11Z" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M7 5V4C7 2.89545 7.89539 2 9 2H15C16.1046 2 17 2.89545 17 4V5H20C21.6569 5 23 6.34314 23 8V18C23 19.6569 21.6569 21 20 21H4C2.34314 21 1 19.6569 1 18V8C1 6.34314 2.34314 5 4 5H7ZM9 4H15V5H9V4ZM4 7C3.44775 7 3 7.44769 3 8V14H21V8C21 7.44769 20.5522 7 20 7H4ZM3 18V16H21V18C21 18.5523 20.5522 19 20 19H4C3.44775 19 3 18.5523 3 18Z" />
                                    </svg>
                                    <h1 class="px-2 text-lg">Meraki UI</h1>
                                </div>
                                <div class="flex items-center mt-4 text-gray-700 dark:text-gray-200">
                                    <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M16.2721 10.2721C16.2721 12.4813 14.4813 14.2721 12.2721 14.2721C10.063 14.2721 8.27214 12.4813 8.27214 10.2721C8.27214 8.063 10.063 6.27214 12.2721 6.27214C14.4813 6.27214 16.2721 8.063 16.2721 10.2721ZM14.2721 10.2721C14.2721 11.3767 13.3767 12.2721 12.2721 12.2721C11.1676 12.2721 10.2721 11.3767 10.2721 10.2721C10.2721 9.16757 11.1676 8.27214 12.2721 8.27214C13.3767 8.27214 14.2721 9.16757 14.2721 10.2721Z" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M5.79417 16.5183C2.19424 13.0909 2.05438 7.3941 5.48178 3.79418C8.90918 0.194258 14.6059 0.0543983 18.2059 3.48179C21.8058 6.90919 21.9457 12.606 18.5183 16.2059L12.3124 22.7241L5.79417 16.5183ZM17.0698 14.8268L12.243 19.8965L7.17324 15.0698C4.3733 12.404 4.26452 7.9732 6.93028 5.17326C9.59603 2.37332 14.0268 2.26454 16.8268 4.93029C19.6267 7.59604 19.7355 12.0269 17.0698 14.8268Z" />
                                    </svg>
                                    <h1 class="px-2 text-lg">California</h1>
                                </div>
                                <div class="flex items-center mt-4 text-gray-700 dark:text-gray-200">
                                    <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M3.00977 5.83789C3.00977 5.28561 3.45748 4.83789 4.00977 4.83789H20C20.5523 4.83789 21 5.28561 21 5.83789V17.1621C21 18.2667 20.1046 19.1621 19 19.1621H5C3.89543 19.1621 3 18.2667 3 17.1621V6.16211C3 6.11449 3.00333 6.06765 3.00977 6.0218V5.83789ZM5 8.06165V17.1621H19V8.06199L14.1215 12.9405C12.9499 14.1121 11.0504 14.1121 9.87885 12.9405L5 8.06165ZM6.57232 6.80554H17.428L12.7073 11.5263C12.3168 11.9168 11.6836 11.9168 11.2931 11.5263L6.57232 6.80554Z" />
                                    </svg>
                                    <h1 class="px-2 text-lg">patterson@example.com</h1>
                                </div>
                            </div>
                        </div>
                        <div
                            class="companyItem cursor-pointer mb-8 max-w-sm mx-auto lg:w-1/3 overflow-hidden bg-white px-4">
                            <div class="imgItem h-72 rounded-lg overflow-hidden"><img
                                    class="object-cover object-center min-w-full  h-full"
                                    src="assets/img/49.jpg" alt="avatar"></div>
                            <div class="flex items-center px-2 py-3 bg-gray-900">
                                <svg class="w-6 h-6 text-white fill-current" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M17 21C15.8954 21 15 20.1046 15 19V15C15 13.8954 15.8954 13 17 13H19V12C19 8.13401 15.866 5 12 5C8.13401 5 5 8.13401 5 12V13H7C8.10457 13 9 13.8954 9 15V19C9 20.1046 8.10457 21 7 21H3V12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12V21H17ZM19 15H17V19H19V15ZM7 15H5V19H7V15Z" />
                                </svg>
                                <h1 class="mx-3 text-lg font-semibold text-white">Focusing</h1>
                            </div>
                            <div class="px-2 py-4">
                                <h1 class="text-xl font-semibold text-gray-800 dark:text-white">Patterson
                                    johnson</h1>
                                <div class="flex mt-2 item-center">
                                    <svg class="w-5 h-5 text-gray-700 fill-current dark:text-gray-300"
                                        viewBox="0 0 24 24">
                                        <path
                                            d="M12 17.27L18.18 21L16.54 13.97L22 9.24L14.81 8.63L12 2L9.19 8.63L2 9.24L7.46 13.97L5.82 21L12 17.27Z" />
                                    </svg>
                                    <svg class="w-5 h-5 text-gray-700 fill-current dark:text-gray-300"
                                        viewBox="0 0 24 24">
                                        <path
                                            d="M12 17.27L18.18 21L16.54 13.97L22 9.24L14.81 8.63L12 2L9.19 8.63L2 9.24L7.46 13.97L5.82 21L12 17.27Z" />
                                    </svg>
                                    <svg class="w-5 h-5 text-gray-700 fill-current dark:text-gray-300"
                                        viewBox="0 0 24 24">
                                        <path
                                            d="M12 17.27L18.18 21L16.54 13.97L22 9.24L14.81 8.63L12 2L9.19 8.63L2 9.24L7.46 13.97L5.82 21L12 17.27Z" />
                                    </svg>
                                    <svg class="w-5 h-5 text-gray-500 fill-current" viewBox="0 0 24 24">
                                        <path
                                            d="M12 17.27L18.18 21L16.54 13.97L22 9.24L14.81 8.63L12 2L9.19 8.63L2 9.24L7.46 13.97L5.82 21L12 17.27Z" />
                                    </svg>
                                    <svg class="w-5 h-5 text-gray-500 fill-current" viewBox="0 0 24 24">
                                        <path
                                            d="M12 17.27L18.18 21L16.54 13.97L22 9.24L14.81 8.63L12 2L9.19 8.63L2 9.24L7.46 13.97L5.82 21L12 17.27Z" />
                                    </svg>
                                </div>
                                <div class="flex items-center mt-4 text-gray-700 dark:text-gray-200">
                                    <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M14 11H10V13H14V11Z" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M7 5V4C7 2.89545 7.89539 2 9 2H15C16.1046 2 17 2.89545 17 4V5H20C21.6569 5 23 6.34314 23 8V18C23 19.6569 21.6569 21 20 21H4C2.34314 21 1 19.6569 1 18V8C1 6.34314 2.34314 5 4 5H7ZM9 4H15V5H9V4ZM4 7C3.44775 7 3 7.44769 3 8V14H21V8C21 7.44769 20.5522 7 20 7H4ZM3 18V16H21V18C21 18.5523 20.5522 19 20 19H4C3.44775 19 3 18.5523 3 18Z" />
                                    </svg>
                                    <h1 class="px-2 text-lg">Meraki UI</h1>
                                </div>
                                <div class="flex items-center mt-4 text-gray-700 dark:text-gray-200">
                                    <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M16.2721 10.2721C16.2721 12.4813 14.4813 14.2721 12.2721 14.2721C10.063 14.2721 8.27214 12.4813 8.27214 10.2721C8.27214 8.063 10.063 6.27214 12.2721 6.27214C14.4813 6.27214 16.2721 8.063 16.2721 10.2721ZM14.2721 10.2721C14.2721 11.3767 13.3767 12.2721 12.2721 12.2721C11.1676 12.2721 10.2721 11.3767 10.2721 10.2721C10.2721 9.16757 11.1676 8.27214 12.2721 8.27214C13.3767 8.27214 14.2721 9.16757 14.2721 10.2721Z" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M5.79417 16.5183C2.19424 13.0909 2.05438 7.3941 5.48178 3.79418C8.90918 0.194258 14.6059 0.0543983 18.2059 3.48179C21.8058 6.90919 21.9457 12.606 18.5183 16.2059L12.3124 22.7241L5.79417 16.5183ZM17.0698 14.8268L12.243 19.8965L7.17324 15.0698C4.3733 12.404 4.26452 7.9732 6.93028 5.17326C9.59603 2.37332 14.0268 2.26454 16.8268 4.93029C19.6267 7.59604 19.7355 12.0269 17.0698 14.8268Z" />
                                    </svg>
                                    <h1 class="px-2 text-lg">California</h1>
                                </div>
                                <div class="flex items-center mt-4 text-gray-700 dark:text-gray-200">
                                    <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M3.00977 5.83789C3.00977 5.28561 3.45748 4.83789 4.00977 4.83789H20C20.5523 4.83789 21 5.28561 21 5.83789V17.1621C21 18.2667 20.1046 19.1621 19 19.1621H5C3.89543 19.1621 3 18.2667 3 17.1621V6.16211C3 6.11449 3.00333 6.06765 3.00977 6.0218V5.83789ZM5 8.06165V17.1621H19V8.06199L14.1215 12.9405C12.9499 14.1121 11.0504 14.1121 9.87885 12.9405L5 8.06165ZM6.57232 6.80554H17.428L12.7073 11.5263C12.3168 11.9168 11.6836 11.9168 11.2931 11.5263L6.57232 6.80554Z" />
                                    </svg>
                                    <h1 class="px-2 text-lg">patterson@example.com</h1>
                                </div>
                            </div>
                        </div>
                        <div
                            class="companyItem cursor-pointer mb-8 max-w-sm mx-auto lg:w-1/3 overflow-hidden bg-white px-4">
                            <div class="imgItem h-72 rounded-lg overflow-hidden"><img
                                    class="object-cover object-center min-w-full  h-full"
                                    src="assets/img/49.jpg" alt="avatar"></div>
                            <div class="flex items-center px-2 py-3 bg-gray-900">
                                <svg class="w-6 h-6 text-white fill-current" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M17 21C15.8954 21 15 20.1046 15 19V15C15 13.8954 15.8954 13 17 13H19V12C19 8.13401 15.866 5 12 5C8.13401 5 5 8.13401 5 12V13H7C8.10457 13 9 13.8954 9 15V19C9 20.1046 8.10457 21 7 21H3V12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12V21H17ZM19 15H17V19H19V15ZM7 15H5V19H7V15Z" />
                                </svg>
                                <h1 class="mx-3 text-lg font-semibold text-white">Focusing</h1>
                            </div>
                            <div class="px-2 py-4">
                                <h1 class="text-xl font-semibold text-gray-800 dark:text-white">Patterson
                                    johnson</h1>
                                <div class="flex mt-2 item-center">
                                    <svg class="w-5 h-5 text-gray-700 fill-current dark:text-gray-300"
                                        viewBox="0 0 24 24">
                                        <path
                                            d="M12 17.27L18.18 21L16.54 13.97L22 9.24L14.81 8.63L12 2L9.19 8.63L2 9.24L7.46 13.97L5.82 21L12 17.27Z" />
                                    </svg>
                                    <svg class="w-5 h-5 text-gray-700 fill-current dark:text-gray-300"
                                        viewBox="0 0 24 24">
                                        <path
                                            d="M12 17.27L18.18 21L16.54 13.97L22 9.24L14.81 8.63L12 2L9.19 8.63L2 9.24L7.46 13.97L5.82 21L12 17.27Z" />
                                    </svg>
                                    <svg class="w-5 h-5 text-gray-700 fill-current dark:text-gray-300"
                                        viewBox="0 0 24 24">
                                        <path
                                            d="M12 17.27L18.18 21L16.54 13.97L22 9.24L14.81 8.63L12 2L9.19 8.63L2 9.24L7.46 13.97L5.82 21L12 17.27Z" />
                                    </svg>
                                    <svg class="w-5 h-5 text-gray-500 fill-current" viewBox="0 0 24 24">
                                        <path
                                            d="M12 17.27L18.18 21L16.54 13.97L22 9.24L14.81 8.63L12 2L9.19 8.63L2 9.24L7.46 13.97L5.82 21L12 17.27Z" />
                                    </svg>
                                    <svg class="w-5 h-5 text-gray-500 fill-current" viewBox="0 0 24 24">
                                        <path
                                            d="M12 17.27L18.18 21L16.54 13.97L22 9.24L14.81 8.63L12 2L9.19 8.63L2 9.24L7.46 13.97L5.82 21L12 17.27Z" />
                                    </svg>
                                </div>
                                <div class="flex items-center mt-4 text-gray-700 dark:text-gray-200">
                                    <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M14 11H10V13H14V11Z" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M7 5V4C7 2.89545 7.89539 2 9 2H15C16.1046 2 17 2.89545 17 4V5H20C21.6569 5 23 6.34314 23 8V18C23 19.6569 21.6569 21 20 21H4C2.34314 21 1 19.6569 1 18V8C1 6.34314 2.34314 5 4 5H7ZM9 4H15V5H9V4ZM4 7C3.44775 7 3 7.44769 3 8V14H21V8C21 7.44769 20.5522 7 20 7H4ZM3 18V16H21V18C21 18.5523 20.5522 19 20 19H4C3.44775 19 3 18.5523 3 18Z" />
                                    </svg>
                                    <h1 class="px-2 text-lg">Meraki UI</h1>
                                </div>
                                <div class="flex items-center mt-4 text-gray-700 dark:text-gray-200">
                                    <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M16.2721 10.2721C16.2721 12.4813 14.4813 14.2721 12.2721 14.2721C10.063 14.2721 8.27214 12.4813 8.27214 10.2721C8.27214 8.063 10.063 6.27214 12.2721 6.27214C14.4813 6.27214 16.2721 8.063 16.2721 10.2721ZM14.2721 10.2721C14.2721 11.3767 13.3767 12.2721 12.2721 12.2721C11.1676 12.2721 10.2721 11.3767 10.2721 10.2721C10.2721 9.16757 11.1676 8.27214 12.2721 8.27214C13.3767 8.27214 14.2721 9.16757 14.2721 10.2721Z" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M5.79417 16.5183C2.19424 13.0909 2.05438 7.3941 5.48178 3.79418C8.90918 0.194258 14.6059 0.0543983 18.2059 3.48179C21.8058 6.90919 21.9457 12.606 18.5183 16.2059L12.3124 22.7241L5.79417 16.5183ZM17.0698 14.8268L12.243 19.8965L7.17324 15.0698C4.3733 12.404 4.26452 7.9732 6.93028 5.17326C9.59603 2.37332 14.0268 2.26454 16.8268 4.93029C19.6267 7.59604 19.7355 12.0269 17.0698 14.8268Z" />
                                    </svg>
                                    <h1 class="px-2 text-lg">California</h1>
                                </div>
                                <div class="flex items-center mt-4 text-gray-700 dark:text-gray-200">
                                    <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M3.00977 5.83789C3.00977 5.28561 3.45748 4.83789 4.00977 4.83789H20C20.5523 4.83789 21 5.28561 21 5.83789V17.1621C21 18.2667 20.1046 19.1621 19 19.1621H5C3.89543 19.1621 3 18.2667 3 17.1621V6.16211C3 6.11449 3.00333 6.06765 3.00977 6.0218V5.83789ZM5 8.06165V17.1621H19V8.06199L14.1215 12.9405C12.9499 14.1121 11.0504 14.1121 9.87885 12.9405L5 8.06165ZM6.57232 6.80554H17.428L12.7073 11.5263C12.3168 11.9168 11.6836 11.9168 11.2931 11.5263L6.57232 6.80554Z" />
                                    </svg>
                                    <h1 class="px-2 text-lg">patterson@example.com</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="buttons flex items-center justify-center text-center"><a
                            class="back mt-8  cursor-pointer bg-gray-700 float-right w-full px-3 py-2 m-1 text-lg font-medium tracking-wider text-white uppercase transition-colors duration-200 transform  rounded-md dark:hover:bg-gray-600 dark:bg-gray-700 lg:w-auto hover:bg-gray-700">Back</a><a
                            class="mt-8 btn next cursor-pointer float-right w-full px-3 py-2 m-1 text-lg font-medium tracking-wider text-white uppercase transition-colors duration-200 transform bg-blue-700 rounded-md dark:hover:bg-gray-600 dark:bg-gray-700 lg:w-auto hover:bg-gray-700"
                            href="#!">Next Step</a></div>
                </div>
                <div class="fourthStep hidden">
                    <h1
                        class="text-3xl my-12 font-semibold text-left text-gray-800 capitalize lg:text-4xl dark:text-white">
                        Choose The Bus </h1>
                    <div class="row flex items-center justify-center flex-wrap">
                        <div
                            class="busItem cursor-pointer mb-8 max-w-sm mx-auto lg:w-1/3 overflow-hidden bg-white px-4">
                            <div class="imgItem h-72 rounded-lg overflow-hidden"><img
                                    class="object-cover object-center min-w-full  h-full"
                                    src="assets/img/46.jpg" alt="avatar"></div>
                            <div class="flex items-center px-2 py-3 bg-gray-900">
                                <svg class="w-6 h-6 text-white fill-current" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M17 21C15.8954 21 15 20.1046 15 19V15C15 13.8954 15.8954 13 17 13H19V12C19 8.13401 15.866 5 12 5C8.13401 5 5 8.13401 5 12V13H7C8.10457 13 9 13.8954 9 15V19C9 20.1046 8.10457 21 7 21H3V12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12V21H17ZM19 15H17V19H19V15ZM7 15H5V19H7V15Z" />
                                </svg>
                                <h1 class="mx-3 text-lg font-semibold text-white">Focusing</h1>
                            </div>
                            <div class="px-2 py-4">
                                <h1 class="text-xl font-semibold text-gray-800 dark:text-white">Patterson
                                    johnson</h1>
                                <div class="flex items-center mt-4 text-gray-700 dark:text-gray-200">
                                    <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M14 11H10V13H14V11Z" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M7 5V4C7 2.89545 7.89539 2 9 2H15C16.1046 2 17 2.89545 17 4V5H20C21.6569 5 23 6.34314 23 8V18C23 19.6569 21.6569 21 20 21H4C2.34314 21 1 19.6569 1 18V8C1 6.34314 2.34314 5 4 5H7ZM9 4H15V5H9V4ZM4 7C3.44775 7 3 7.44769 3 8V14H21V8C21 7.44769 20.5522 7 20 7H4ZM3 18V16H21V18C21 18.5523 20.5522 19 20 19H4C3.44775 19 3 18.5523 3 18Z" />
                                    </svg>
                                    <h1 class="px-2 text-lg">Meraki UI</h1>
                                </div>
                                <div class="flex items-center mt-4 text-gray-700 dark:text-gray-200">
                                    <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M16.2721 10.2721C16.2721 12.4813 14.4813 14.2721 12.2721 14.2721C10.063 14.2721 8.27214 12.4813 8.27214 10.2721C8.27214 8.063 10.063 6.27214 12.2721 6.27214C14.4813 6.27214 16.2721 8.063 16.2721 10.2721ZM14.2721 10.2721C14.2721 11.3767 13.3767 12.2721 12.2721 12.2721C11.1676 12.2721 10.2721 11.3767 10.2721 10.2721C10.2721 9.16757 11.1676 8.27214 12.2721 8.27214C13.3767 8.27214 14.2721 9.16757 14.2721 10.2721Z" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M5.79417 16.5183C2.19424 13.0909 2.05438 7.3941 5.48178 3.79418C8.90918 0.194258 14.6059 0.0543983 18.2059 3.48179C21.8058 6.90919 21.9457 12.606 18.5183 16.2059L12.3124 22.7241L5.79417 16.5183ZM17.0698 14.8268L12.243 19.8965L7.17324 15.0698C4.3733 12.404 4.26452 7.9732 6.93028 5.17326C9.59603 2.37332 14.0268 2.26454 16.8268 4.93029C19.6267 7.59604 19.7355 12.0269 17.0698 14.8268Z" />
                                    </svg>
                                    <h1 class="px-2 text-lg">California</h1>
                                </div>
                                <div class="flex items-center mt-4 text-gray-700 dark:text-gray-200">
                                    <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M3.00977 5.83789C3.00977 5.28561 3.45748 4.83789 4.00977 4.83789H20C20.5523 4.83789 21 5.28561 21 5.83789V17.1621C21 18.2667 20.1046 19.1621 19 19.1621H5C3.89543 19.1621 3 18.2667 3 17.1621V6.16211C3 6.11449 3.00333 6.06765 3.00977 6.0218V5.83789ZM5 8.06165V17.1621H19V8.06199L14.1215 12.9405C12.9499 14.1121 11.0504 14.1121 9.87885 12.9405L5 8.06165ZM6.57232 6.80554H17.428L12.7073 11.5263C12.3168 11.9168 11.6836 11.9168 11.2931 11.5263L6.57232 6.80554Z" />
                                    </svg>
                                    <h1 class="px-2 text-lg">patterson@example.com</h1>
                                </div>
                            </div>
                        </div>
                        <div
                            class="busItem cursor-pointer mb-8 max-w-sm mx-auto lg:w-1/3 overflow-hidden bg-white px-4">
                            <div class="imgItem h-72 rounded-lg overflow-hidden"><img
                                    class="object-cover object-center min-w-full  h-full"
                                    src="assets/img/46.jpg" alt="avatar"></div>
                            <div class="flex items-center px-2 py-3 bg-gray-900">
                                <svg class="w-6 h-6 text-white fill-current" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M17 21C15.8954 21 15 20.1046 15 19V15C15 13.8954 15.8954 13 17 13H19V12C19 8.13401 15.866 5 12 5C8.13401 5 5 8.13401 5 12V13H7C8.10457 13 9 13.8954 9 15V19C9 20.1046 8.10457 21 7 21H3V12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12V21H17ZM19 15H17V19H19V15ZM7 15H5V19H7V15Z" />
                                </svg>
                                <h1 class="mx-3 text-lg font-semibold text-white">Focusing</h1>
                            </div>
                            <div class="px-2 py-4">
                                <h1 class="text-xl font-semibold text-gray-800 dark:text-white">Patterson
                                    johnson</h1>
                                <div class="flex items-center mt-4 text-gray-700 dark:text-gray-200">
                                    <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M14 11H10V13H14V11Z" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M7 5V4C7 2.89545 7.89539 2 9 2H15C16.1046 2 17 2.89545 17 4V5H20C21.6569 5 23 6.34314 23 8V18C23 19.6569 21.6569 21 20 21H4C2.34314 21 1 19.6569 1 18V8C1 6.34314 2.34314 5 4 5H7ZM9 4H15V5H9V4ZM4 7C3.44775 7 3 7.44769 3 8V14H21V8C21 7.44769 20.5522 7 20 7H4ZM3 18V16H21V18C21 18.5523 20.5522 19 20 19H4C3.44775 19 3 18.5523 3 18Z" />
                                    </svg>
                                    <h1 class="px-2 text-lg">Meraki UI</h1>
                                </div>
                                <div class="flex items-center mt-4 text-gray-700 dark:text-gray-200">
                                    <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M16.2721 10.2721C16.2721 12.4813 14.4813 14.2721 12.2721 14.2721C10.063 14.2721 8.27214 12.4813 8.27214 10.2721C8.27214 8.063 10.063 6.27214 12.2721 6.27214C14.4813 6.27214 16.2721 8.063 16.2721 10.2721ZM14.2721 10.2721C14.2721 11.3767 13.3767 12.2721 12.2721 12.2721C11.1676 12.2721 10.2721 11.3767 10.2721 10.2721C10.2721 9.16757 11.1676 8.27214 12.2721 8.27214C13.3767 8.27214 14.2721 9.16757 14.2721 10.2721Z" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M5.79417 16.5183C2.19424 13.0909 2.05438 7.3941 5.48178 3.79418C8.90918 0.194258 14.6059 0.0543983 18.2059 3.48179C21.8058 6.90919 21.9457 12.606 18.5183 16.2059L12.3124 22.7241L5.79417 16.5183ZM17.0698 14.8268L12.243 19.8965L7.17324 15.0698C4.3733 12.404 4.26452 7.9732 6.93028 5.17326C9.59603 2.37332 14.0268 2.26454 16.8268 4.93029C19.6267 7.59604 19.7355 12.0269 17.0698 14.8268Z" />
                                    </svg>
                                    <h1 class="px-2 text-lg">California</h1>
                                </div>
                                <div class="flex items-center mt-4 text-gray-700 dark:text-gray-200">
                                    <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M3.00977 5.83789C3.00977 5.28561 3.45748 4.83789 4.00977 4.83789H20C20.5523 4.83789 21 5.28561 21 5.83789V17.1621C21 18.2667 20.1046 19.1621 19 19.1621H5C3.89543 19.1621 3 18.2667 3 17.1621V6.16211C3 6.11449 3.00333 6.06765 3.00977 6.0218V5.83789ZM5 8.06165V17.1621H19V8.06199L14.1215 12.9405C12.9499 14.1121 11.0504 14.1121 9.87885 12.9405L5 8.06165ZM6.57232 6.80554H17.428L12.7073 11.5263C12.3168 11.9168 11.6836 11.9168 11.2931 11.5263L6.57232 6.80554Z" />
                                    </svg>
                                    <h1 class="px-2 text-lg">patterson@example.com</h1>
                                </div>
                            </div>
                        </div>
                        <div
                            class="busItem cursor-pointer mb-8 max-w-sm mx-auto lg:w-1/3 overflow-hidden bg-white px-4">
                            <div class="imgItem h-72 rounded-lg overflow-hidden"><img
                                    class="object-cover object-center min-w-full  h-full"
                                    src="assets/img/46.jpg" alt="avatar"></div>
                            <div class="flex items-center px-2 py-3 bg-gray-900">
                                <svg class="w-6 h-6 text-white fill-current" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M17 21C15.8954 21 15 20.1046 15 19V15C15 13.8954 15.8954 13 17 13H19V12C19 8.13401 15.866 5 12 5C8.13401 5 5 8.13401 5 12V13H7C8.10457 13 9 13.8954 9 15V19C9 20.1046 8.10457 21 7 21H3V12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12V21H17ZM19 15H17V19H19V15ZM7 15H5V19H7V15Z" />
                                </svg>
                                <h1 class="mx-3 text-lg font-semibold text-white">Focusing</h1>
                            </div>
                            <div class="px-2 py-4">
                                <h1 class="text-xl font-semibold text-gray-800 dark:text-white">Patterson
                                    johnson</h1>
                                <div class="flex items-center mt-4 text-gray-700 dark:text-gray-200">
                                    <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M14 11H10V13H14V11Z" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M7 5V4C7 2.89545 7.89539 2 9 2H15C16.1046 2 17 2.89545 17 4V5H20C21.6569 5 23 6.34314 23 8V18C23 19.6569 21.6569 21 20 21H4C2.34314 21 1 19.6569 1 18V8C1 6.34314 2.34314 5 4 5H7ZM9 4H15V5H9V4ZM4 7C3.44775 7 3 7.44769 3 8V14H21V8C21 7.44769 20.5522 7 20 7H4ZM3 18V16H21V18C21 18.5523 20.5522 19 20 19H4C3.44775 19 3 18.5523 3 18Z" />
                                    </svg>
                                    <h1 class="px-2 text-lg">Meraki UI</h1>
                                </div>
                                <div class="flex items-center mt-4 text-gray-700 dark:text-gray-200">
                                    <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M16.2721 10.2721C16.2721 12.4813 14.4813 14.2721 12.2721 14.2721C10.063 14.2721 8.27214 12.4813 8.27214 10.2721C8.27214 8.063 10.063 6.27214 12.2721 6.27214C14.4813 6.27214 16.2721 8.063 16.2721 10.2721ZM14.2721 10.2721C14.2721 11.3767 13.3767 12.2721 12.2721 12.2721C11.1676 12.2721 10.2721 11.3767 10.2721 10.2721C10.2721 9.16757 11.1676 8.27214 12.2721 8.27214C13.3767 8.27214 14.2721 9.16757 14.2721 10.2721Z" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M5.79417 16.5183C2.19424 13.0909 2.05438 7.3941 5.48178 3.79418C8.90918 0.194258 14.6059 0.0543983 18.2059 3.48179C21.8058 6.90919 21.9457 12.606 18.5183 16.2059L12.3124 22.7241L5.79417 16.5183ZM17.0698 14.8268L12.243 19.8965L7.17324 15.0698C4.3733 12.404 4.26452 7.9732 6.93028 5.17326C9.59603 2.37332 14.0268 2.26454 16.8268 4.93029C19.6267 7.59604 19.7355 12.0269 17.0698 14.8268Z" />
                                    </svg>
                                    <h1 class="px-2 text-lg">California</h1>
                                </div>
                                <div class="flex items-center mt-4 text-gray-700 dark:text-gray-200">
                                    <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M3.00977 5.83789C3.00977 5.28561 3.45748 4.83789 4.00977 4.83789H20C20.5523 4.83789 21 5.28561 21 5.83789V17.1621C21 18.2667 20.1046 19.1621 19 19.1621H5C3.89543 19.1621 3 18.2667 3 17.1621V6.16211C3 6.11449 3.00333 6.06765 3.00977 6.0218V5.83789ZM5 8.06165V17.1621H19V8.06199L14.1215 12.9405C12.9499 14.1121 11.0504 14.1121 9.87885 12.9405L5 8.06165ZM6.57232 6.80554H17.428L12.7073 11.5263C12.3168 11.9168 11.6836 11.9168 11.2931 11.5263L6.57232 6.80554Z" />
                                    </svg>
                                    <h1 class="px-2 text-lg">patterson@example.com</h1>
                                </div>
                            </div>
                        </div>
                        <div
                            class="busItem cursor-pointer mb-8 max-w-sm mx-auto lg:w-1/3 overflow-hidden bg-white px-4">
                            <div class="imgItem h-72 rounded-lg overflow-hidden"><img
                                    class="object-cover object-center min-w-full  h-full"
                                    src="assets/img/46.jpg" alt="avatar"></div>
                            <div class="flex items-center px-2 py-3 bg-gray-900">
                                <svg class="w-6 h-6 text-white fill-current" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M17 21C15.8954 21 15 20.1046 15 19V15C15 13.8954 15.8954 13 17 13H19V12C19 8.13401 15.866 5 12 5C8.13401 5 5 8.13401 5 12V13H7C8.10457 13 9 13.8954 9 15V19C9 20.1046 8.10457 21 7 21H3V12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12V21H17ZM19 15H17V19H19V15ZM7 15H5V19H7V15Z" />
                                </svg>
                                <h1 class="mx-3 text-lg font-semibold text-white">Focusing</h1>
                            </div>
                            <div class="px-2 py-4">
                                <h1 class="text-xl font-semibold text-gray-800 dark:text-white">Patterson
                                    johnson</h1>
                                <div class="flex items-center mt-4 text-gray-700 dark:text-gray-200">
                                    <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M14 11H10V13H14V11Z" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M7 5V4C7 2.89545 7.89539 2 9 2H15C16.1046 2 17 2.89545 17 4V5H20C21.6569 5 23 6.34314 23 8V18C23 19.6569 21.6569 21 20 21H4C2.34314 21 1 19.6569 1 18V8C1 6.34314 2.34314 5 4 5H7ZM9 4H15V5H9V4ZM4 7C3.44775 7 3 7.44769 3 8V14H21V8C21 7.44769 20.5522 7 20 7H4ZM3 18V16H21V18C21 18.5523 20.5522 19 20 19H4C3.44775 19 3 18.5523 3 18Z" />
                                    </svg>
                                    <h1 class="px-2 text-lg">Meraki UI</h1>
                                </div>
                                <div class="flex items-center mt-4 text-gray-700 dark:text-gray-200">
                                    <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M16.2721 10.2721C16.2721 12.4813 14.4813 14.2721 12.2721 14.2721C10.063 14.2721 8.27214 12.4813 8.27214 10.2721C8.27214 8.063 10.063 6.27214 12.2721 6.27214C14.4813 6.27214 16.2721 8.063 16.2721 10.2721ZM14.2721 10.2721C14.2721 11.3767 13.3767 12.2721 12.2721 12.2721C11.1676 12.2721 10.2721 11.3767 10.2721 10.2721C10.2721 9.16757 11.1676 8.27214 12.2721 8.27214C13.3767 8.27214 14.2721 9.16757 14.2721 10.2721Z" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M5.79417 16.5183C2.19424 13.0909 2.05438 7.3941 5.48178 3.79418C8.90918 0.194258 14.6059 0.0543983 18.2059 3.48179C21.8058 6.90919 21.9457 12.606 18.5183 16.2059L12.3124 22.7241L5.79417 16.5183ZM17.0698 14.8268L12.243 19.8965L7.17324 15.0698C4.3733 12.404 4.26452 7.9732 6.93028 5.17326C9.59603 2.37332 14.0268 2.26454 16.8268 4.93029C19.6267 7.59604 19.7355 12.0269 17.0698 14.8268Z" />
                                    </svg>
                                    <h1 class="px-2 text-lg">California</h1>
                                </div>
                                <div class="flex items-center mt-4 text-gray-700 dark:text-gray-200">
                                    <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M3.00977 5.83789C3.00977 5.28561 3.45748 4.83789 4.00977 4.83789H20C20.5523 4.83789 21 5.28561 21 5.83789V17.1621C21 18.2667 20.1046 19.1621 19 19.1621H5C3.89543 19.1621 3 18.2667 3 17.1621V6.16211C3 6.11449 3.00333 6.06765 3.00977 6.0218V5.83789ZM5 8.06165V17.1621H19V8.06199L14.1215 12.9405C12.9499 14.1121 11.0504 14.1121 9.87885 12.9405L5 8.06165ZM6.57232 6.80554H17.428L12.7073 11.5263C12.3168 11.9168 11.6836 11.9168 11.2931 11.5263L6.57232 6.80554Z" />
                                    </svg>
                                    <h1 class="px-2 text-lg">patterson@example.com</h1>
                                </div>
                            </div>
                        </div>
                        <div
                            class="busItem cursor-pointer mb-8 max-w-sm mx-auto lg:w-1/3 overflow-hidden bg-white px-4">
                            <div class="imgItem h-72 rounded-lg overflow-hidden"><img
                                    class="object-cover object-center min-w-full  h-full"
                                    src="assets/img/46.jpg" alt="avatar"></div>
                            <div class="flex items-center px-2 py-3 bg-gray-900">
                                <svg class="w-6 h-6 text-white fill-current" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M17 21C15.8954 21 15 20.1046 15 19V15C15 13.8954 15.8954 13 17 13H19V12C19 8.13401 15.866 5 12 5C8.13401 5 5 8.13401 5 12V13H7C8.10457 13 9 13.8954 9 15V19C9 20.1046 8.10457 21 7 21H3V12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12V21H17ZM19 15H17V19H19V15ZM7 15H5V19H7V15Z" />
                                </svg>
                                <h1 class="mx-3 text-lg font-semibold text-white">Focusing</h1>
                            </div>
                            <div class="px-2 py-4">
                                <h1 class="text-xl font-semibold text-gray-800 dark:text-white">Patterson
                                    johnson</h1>
                                <div class="flex items-center mt-4 text-gray-700 dark:text-gray-200">
                                    <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M14 11H10V13H14V11Z" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M7 5V4C7 2.89545 7.89539 2 9 2H15C16.1046 2 17 2.89545 17 4V5H20C21.6569 5 23 6.34314 23 8V18C23 19.6569 21.6569 21 20 21H4C2.34314 21 1 19.6569 1 18V8C1 6.34314 2.34314 5 4 5H7ZM9 4H15V5H9V4ZM4 7C3.44775 7 3 7.44769 3 8V14H21V8C21 7.44769 20.5522 7 20 7H4ZM3 18V16H21V18C21 18.5523 20.5522 19 20 19H4C3.44775 19 3 18.5523 3 18Z" />
                                    </svg>
                                    <h1 class="px-2 text-lg">Meraki UI</h1>
                                </div>
                                <div class="flex items-center mt-4 text-gray-700 dark:text-gray-200">
                                    <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M16.2721 10.2721C16.2721 12.4813 14.4813 14.2721 12.2721 14.2721C10.063 14.2721 8.27214 12.4813 8.27214 10.2721C8.27214 8.063 10.063 6.27214 12.2721 6.27214C14.4813 6.27214 16.2721 8.063 16.2721 10.2721ZM14.2721 10.2721C14.2721 11.3767 13.3767 12.2721 12.2721 12.2721C11.1676 12.2721 10.2721 11.3767 10.2721 10.2721C10.2721 9.16757 11.1676 8.27214 12.2721 8.27214C13.3767 8.27214 14.2721 9.16757 14.2721 10.2721Z" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M5.79417 16.5183C2.19424 13.0909 2.05438 7.3941 5.48178 3.79418C8.90918 0.194258 14.6059 0.0543983 18.2059 3.48179C21.8058 6.90919 21.9457 12.606 18.5183 16.2059L12.3124 22.7241L5.79417 16.5183ZM17.0698 14.8268L12.243 19.8965L7.17324 15.0698C4.3733 12.404 4.26452 7.9732 6.93028 5.17326C9.59603 2.37332 14.0268 2.26454 16.8268 4.93029C19.6267 7.59604 19.7355 12.0269 17.0698 14.8268Z" />
                                    </svg>
                                    <h1 class="px-2 text-lg">California</h1>
                                </div>
                                <div class="flex items-center mt-4 text-gray-700 dark:text-gray-200">
                                    <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M3.00977 5.83789C3.00977 5.28561 3.45748 4.83789 4.00977 4.83789H20C20.5523 4.83789 21 5.28561 21 5.83789V17.1621C21 18.2667 20.1046 19.1621 19 19.1621H5C3.89543 19.1621 3 18.2667 3 17.1621V6.16211C3 6.11449 3.00333 6.06765 3.00977 6.0218V5.83789ZM5 8.06165V17.1621H19V8.06199L14.1215 12.9405C12.9499 14.1121 11.0504 14.1121 9.87885 12.9405L5 8.06165ZM6.57232 6.80554H17.428L12.7073 11.5263C12.3168 11.9168 11.6836 11.9168 11.2931 11.5263L6.57232 6.80554Z" />
                                    </svg>
                                    <h1 class="px-2 text-lg">patterson@example.com</h1>
                                </div>
                            </div>
                        </div>
                        <div
                            class="busItem cursor-pointer mb-8 max-w-sm mx-auto lg:w-1/3 overflow-hidden bg-white px-4">
                            <div class="imgItem h-72 rounded-lg overflow-hidden"><img
                                    class="object-cover object-center min-w-full  h-full"
                                    src="assets/img/46.jpg" alt="avatar"></div>
                            <div class="flex items-center px-2 py-3 bg-gray-900">
                                <svg class="w-6 h-6 text-white fill-current" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M17 21C15.8954 21 15 20.1046 15 19V15C15 13.8954 15.8954 13 17 13H19V12C19 8.13401 15.866 5 12 5C8.13401 5 5 8.13401 5 12V13H7C8.10457 13 9 13.8954 9 15V19C9 20.1046 8.10457 21 7 21H3V12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12V21H17ZM19 15H17V19H19V15ZM7 15H5V19H7V15Z" />
                                </svg>
                                <h1 class="mx-3 text-lg font-semibold text-white">Focusing</h1>
                            </div>
                            <div class="px-2 py-4">
                                <h1 class="text-xl font-semibold text-gray-800 dark:text-white">Patterson
                                    johnson</h1>
                                <div class="flex items-center mt-4 text-gray-700 dark:text-gray-200">
                                    <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M14 11H10V13H14V11Z" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M7 5V4C7 2.89545 7.89539 2 9 2H15C16.1046 2 17 2.89545 17 4V5H20C21.6569 5 23 6.34314 23 8V18C23 19.6569 21.6569 21 20 21H4C2.34314 21 1 19.6569 1 18V8C1 6.34314 2.34314 5 4 5H7ZM9 4H15V5H9V4ZM4 7C3.44775 7 3 7.44769 3 8V14H21V8C21 7.44769 20.5522 7 20 7H4ZM3 18V16H21V18C21 18.5523 20.5522 19 20 19H4C3.44775 19 3 18.5523 3 18Z" />
                                    </svg>
                                    <h1 class="px-2 text-lg">Meraki UI</h1>
                                </div>
                                <div class="flex items-center mt-4 text-gray-700 dark:text-gray-200">
                                    <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M16.2721 10.2721C16.2721 12.4813 14.4813 14.2721 12.2721 14.2721C10.063 14.2721 8.27214 12.4813 8.27214 10.2721C8.27214 8.063 10.063 6.27214 12.2721 6.27214C14.4813 6.27214 16.2721 8.063 16.2721 10.2721ZM14.2721 10.2721C14.2721 11.3767 13.3767 12.2721 12.2721 12.2721C11.1676 12.2721 10.2721 11.3767 10.2721 10.2721C10.2721 9.16757 11.1676 8.27214 12.2721 8.27214C13.3767 8.27214 14.2721 9.16757 14.2721 10.2721Z" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M5.79417 16.5183C2.19424 13.0909 2.05438 7.3941 5.48178 3.79418C8.90918 0.194258 14.6059 0.0543983 18.2059 3.48179C21.8058 6.90919 21.9457 12.606 18.5183 16.2059L12.3124 22.7241L5.79417 16.5183ZM17.0698 14.8268L12.243 19.8965L7.17324 15.0698C4.3733 12.404 4.26452 7.9732 6.93028 5.17326C9.59603 2.37332 14.0268 2.26454 16.8268 4.93029C19.6267 7.59604 19.7355 12.0269 17.0698 14.8268Z" />
                                    </svg>
                                    <h1 class="px-2 text-lg">California</h1>
                                </div>
                                <div class="flex items-center mt-4 text-gray-700 dark:text-gray-200">
                                    <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M3.00977 5.83789C3.00977 5.28561 3.45748 4.83789 4.00977 4.83789H20C20.5523 4.83789 21 5.28561 21 5.83789V17.1621C21 18.2667 20.1046 19.1621 19 19.1621H5C3.89543 19.1621 3 18.2667 3 17.1621V6.16211C3 6.11449 3.00333 6.06765 3.00977 6.0218V5.83789ZM5 8.06165V17.1621H19V8.06199L14.1215 12.9405C12.9499 14.1121 11.0504 14.1121 9.87885 12.9405L5 8.06165ZM6.57232 6.80554H17.428L12.7073 11.5263C12.3168 11.9168 11.6836 11.9168 11.2931 11.5263L6.57232 6.80554Z" />
                                    </svg>
                                    <h1 class="px-2 text-lg">patterson@example.com</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="buttons flex items-center justify-center text-center"><a
                            class="back mt-8  cursor-pointer bg-gray-700 float-right w-full px-3 py-2 m-1 text-lg font-medium tracking-wider text-white uppercase transition-colors duration-200 transform  rounded-md dark:hover:bg-gray-600 dark:bg-gray-700 lg:w-auto hover:bg-gray-700">Back</a><a
                            class="mt-8 btn next cursor-pointer float-right w-full px-3 py-2 m-1 text-lg font-medium tracking-wider text-white uppercase transition-colors duration-200 transform bg-blue-700 rounded-md dark:hover:bg-gray-600 dark:bg-gray-700 lg:w-auto hover:bg-gray-700"
                            href="#!">Next Step</a></div>
                </div>
                <div class="fifthStep hidden">
                    <h1
                        class="text-3xl my-12 font-semibold text-left text-gray-800 capitalize lg:text-4xl dark:text-white">
                        Do you have any notes? </h1>
                    <textarea class="w-full border-gray-700 border-2 text-lg p-4" name="" cols="30" rows="10"
                        placeholder="what is your notes?"> </textarea>
                    <div class="buttons flex items-center justify-center text-center"><a
                            class="back mt-8  cursor-pointer bg-gray-700 float-right w-full px-3 py-2 m-1 text-lg font-medium tracking-wider text-white uppercase transition-colors duration-200 transform  rounded-md dark:hover:bg-gray-600 dark:bg-gray-700 lg:w-auto hover:bg-gray-700">Back
                        </a><a
                            class="mt-8 btn cursor-pointer float-right w-full px-3 py-2 m-1 text-lg font-medium tracking-wider text-white uppercase transition-colors duration-200 transform bg-blue-700 rounded-md dark:hover:bg-gray-600 dark:bg-gray-700 lg:w-auto hover:bg-gray-700"
                            href="index.html">Submit </a></div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('guest.layouts.map')

@endsection