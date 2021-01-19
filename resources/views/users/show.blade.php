@extends('layouts.default')

@section('title',$user->name)

@section('content')
	<section class="user_info">
		@include('shared._user_info')		
	</section>
@stop