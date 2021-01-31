<form action="{{route('statuses.store')}}" method="POST">
	@include('shared._errors')
	{{csrf_field()}}
	<textarea class="form-group" rows="3" placeholder="聊聊新鲜事吧……" name="content">{{old('content')}}</textarea>
	<div class="text-right">
		<button class="btn btn-primary" type="submit" class="mt-3">发布</button>
	</div>
</form>