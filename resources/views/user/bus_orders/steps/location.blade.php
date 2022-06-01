<div class="step-item" id="step-1">
    <h1
        class="text-2xl my-12 font-semibold text-left text-gray-800 capitalize lg:text-3xl dark:text-white">
        @lang('msg.choose_your_location') 
    </h1>
    <div id="markermap" class="gmaps"></div>
    {!! Form::hidden('lat', null) !!}
    {!! Form::hidden('lng', null) !!}
    {!! Form::hidden('zoom', null) !!}
    <div class="map-box">
        <iframe width="100%" height="500" frameborder="0" style="border:0" allowfullscreen
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d470029.1604841957!2d72.29955005258641!3d23.019996818380896!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x395e848aba5bd449%3A0x4fcedd11614f6516!2sAhmedabad%2C+Gujarat!5e0!3m2!1sen!2sin!4v1493204785508"></iframe>
    </div>
    <div class="buttons flex items-center justify-center text-center"><a
        class="mt-8 btn next cursor-pointer float-right w-full px-3 py-2 m-1 text-lg font-medium tracking-wider text-white uppercase transition-colors duration-200 transform bg-blue-700 rounded-md dark:hover:bg-gray-600 dark:bg-gray-700 lg:w-auto hover:bg-gray-700"
        href="#!">@lang('pagination.next')</a>
    </div>
</div>