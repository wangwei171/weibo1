<a href="{{route('users.followings',$user)}}"><strong id="" class="stat">{{count($user->followings)}}</strong>关注</a>

<a href="{{route('users.followers',$user)}}"><strong id="" class="stat">{{count($user->followers)}}</strong>粉丝</a>

<a href="#"><strong id="" class="stat">{{$user->statuses()->count()}}</strong>微博</a>