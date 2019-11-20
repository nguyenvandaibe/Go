@extends('layouts.app')

@section('left-bar')
	@include('components.profile_new_plan')
@endsection

@section('content')
	<div class="row">
		<h3>Hồ sơ</h3>
	</div>
	<div class="row profile-container">
		<div class="col-md-4 avatar">
			<img src="{{ asset($user->avatar) }}">
		</div>
		<div class="col-md-6 credit">
			<div class="row">
				<div class="col-md-4">
					<label>Họ và tên:</label>
				</div>
				<div class="col-md-8">
					{{$user->full_name}}
				</div>
			</div>

			<div class="row">
				<div class="col-md-4">
					<label>Username:</label>
				</div>
				<div class="col-md-4">
					{{$user->username}}
				</div>
			</div>

			<div class="row">
				<div class="col-md-4">
					<label>Email:</label>
				</div>
				<div class="col-md-4">
					{{$user->email}}
				</div>
			</div>

			<div class="row">
				<div class="col-md-4">
					<label>Giới tính</label>
				</div>
				<div class="col-md-4">
					@if ($user->gender === 'male')
						Nam
					@endif
					@if ($user->gender === 'female')
                        Nữ
					@endif
				</div>
			</div>

			<div class="row">
				<div class="col-md-4">
					<label>Ngày sinh</label>
				</div>
				<div class="col-md-4">
					{{$user->date_of_birth}}
				</div>
			</div>
		</div>
		<div class="col-md-2">
			<form action="/profile/me/edit">
				<button>Chỉnh sửa</button>
			</form>
		</div>
	</div>
	<div class="row">
		<div class="col-md-4">
			<h5>Kế hoạch của tôi</h5>
			<br>
			@foreach($myPlans as $plan)
				<a href="/plans/{{ $plan->id }}">{{ $plan->name }}</a><br>
			@endforeach
		</div>

		<div class="col-md-4">
			<h5>Tham gia</h5>
		</div>

		<div class="col-md-4">
			<h5>Đang theo dõi</h5>
			
		</div>
	</div>
@endsection
