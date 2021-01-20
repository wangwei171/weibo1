{{--存放session数据--}}
@foreach(['success','danger','warning','info'] as $msg)
	@if(session()->has($msg))
		<p class="alert alert-{{$msg}}">
			{{session()->get($msg)}}
		</p>
	@endif
@endforeach