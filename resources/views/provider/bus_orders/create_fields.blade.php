<!-- Step 1 -->
<section class="mb-3">
    @include('provider.bus_orders.datetime')
</section>
<!-- Step 2 -->
<section class="mb-3">
    <div class="row">
        <h4 class="card-title col-sm-12">@lang('models/busOrders.location_title')</h4>
        <div class="form-group col-sm-12">
            <div id="markermap" class="gmaps"></div>
            {!! Form::hidden('lat', null) !!}
            {!! Form::hidden('lng', null) !!}
            {!! Form::hidden('zoom', null) !!}
            <div class="map-box">
                <iframe width="100%" height="200" frameborder="0" style="border:0" allowfullscreen
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d470029.1604841957!2d72.29955005258641!3d23.019996818380896!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x395e848aba5bd449%3A0x4fcedd11614f6516!2sAhmedabad%2C+Gujarat!5e0!3m2!1sen!2sin!4v1493204785508"></iframe>
            </div>
        </div>
    </div>
</section>
<!-- Step 3 -->
<section class="mb-3">
    @include('provider.bus_orders.destination')
</section>
<!-- Step 4 -->
<section class="mb-3">
    @include('provider.bus_orders.bus')
</section>
<!-- Step 5 -->
<section class="mb-3">
    @include('provider.bus_orders.notes')
</section>

<button type="submit" class="btn btn-primary">@lang('crud.save')</button>
<a href="{{ route('provider.busOrders.index') }}" class="btn btn-dark">@lang('crud.cancel')</a>

@include('provider.bus_orders.script')