    <h4>@lang('home.chartsong') </h4>
    <div>
        @if(isset($chart))
        {!! $chart->container() !!}
        @endif
    </div>
</div>
@if(isset($chart))
    @if($chart)
    {!! $chart->script() !!}
    @endif
@endif
