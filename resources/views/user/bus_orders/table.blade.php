{{-- <div class="row"> --}}
    @foreach($busOrders as $busOrder)
    @if(!is_null($bus = $busOrder->bus))
    <div class="col-md-4 col-sm-6">
        <div class="ribbon-wrapper card">
            <span class="ribbon ribbon-{{ $busOrder->status_color }}">{{ __('models/busOrders.status.'.$busOrder->status) }}</span>
            <div class="ribbon-content">
                <div class="row">
                    <div class="col-sm-6">
                        <img class="card-img-top img-responsive" src="{{ asset('images/buses/'.$bus->image) }}" alt="" style="height: 100%;">
                    </div>
                    <div class="col-sm-6">
                        <div class="card-body">
                            <h4 class="card-title">
                                <a href="{{ route('busOrders.show', $busOrder->id) }}">@lang('crud.id') #{{ $busOrder->id }}</a>
                            </h4>
                            <p class="card-text">
                                <p><i class="ti-truck"></i> {{ $bus->plate }}</p>
                                <p><i class="icon-calender"></i> {{ $busOrder->date_from }}</p>
                                <p><i class="icon-wallet"></i> {{ $busOrder->fees ?? '-' }}</p>
                            </p>
                        </div>
                    </div>
                </div>
                
            </div>
            
        </div>
    </div>
    @endif
    @endforeach
{{-- </div> --}}

@push('page_css')
<link href="{{ asset('elite/dist/css/pages/ribbon-page.css') }}" rel="stylesheet">
@endpush