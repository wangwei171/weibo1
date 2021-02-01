<li class="media mt-4 mb-4">
	<a href="{{route('users.show',$user->id)}}">
		<img src="{{$user->gravatar()}}" class="gravatar mr-3">
	</a>
	<div class="media-body">
		<h5>{{$user->name}}<small>/{{$status->created_at->diffForHumans()}}</small></h5>
		{{$status->content}}
	</div>

	@can('destroy',$status)
	<form action="{{route('statuses.destroy',$status->id)}}" method="POST" onsubmit="return confirm('确定删除本条微博吗？');">
		{{csrf_field()}}
		{{method_field('DELETE')}}
		<button class="btn btn-danger" type="submit">删除</button>
	</form>
	@endcan
</li>