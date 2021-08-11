@if (isset($albumChart))
<h3 class="text-center">@lang('home.chartAlbum')</h3>
<div>
    {!! $albumChart->container() !!}
</div>
{{-- ChartScript --}}
{!! $albumChart->script() !!}
@endif
