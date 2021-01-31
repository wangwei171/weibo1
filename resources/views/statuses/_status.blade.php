<li class="media mt-4 mb-4">
	<a href="{{route('users.show',$user->id)}}">
		<img src="{{$user->gravatar()}}" class="gravatar mr-3">
	</a>
	<div class="media-body">
		<h5>{{$user->name}}<small>/{{$status->created_at->diffForHumans()}}</small></h5>
		{{$status->content}}
	</div>
</li>