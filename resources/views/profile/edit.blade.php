@extends('layouts.app')

@section('left-bar')
	@include('components.profile_new_plan')
@endsection

@section('content')
	<div class="row">
		<h3>Chỉnh sửa hồ sơ</h3>
	</div>

	<form method="post" action="/profile/store" enctype="multipart/form-data">
		@csrf
		<div class="row">
            <div class="col-md-4 avatar">
                <img src="{{ asset($user->avatar) }}">
                <input type="file" name="avatar">
            </div>
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-3">
                        <label name="full_name">Họ và tên:</label>
                    </div>
                    <div class="col-md-9">
						<input id= "full_name" name="full_name" value="{{ $user->full_name }}"> 
                        @error('full_name')
	                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3">
						<label name="gender">Giới tính:</label>
                    </div>
                    <div class="col-md-9">
                        <input id="gender-male" type="radio" name="gender" value="male">Nam<br>
                        <input id="gender-female" type="radio" name="gender" value="female">Nữ<br>
					</div>
                    @error('gender')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-3">
						<label name="date_of_birth">Ngày sinh:</label>
                    </div>
                    <div class="col-md-9">
						<input class="date" type="text" name="date_of_birth" value="{{ $user->date_of_birth }}">
                        @error('date_of_birth')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2 offset-md-5">
                <button type="submit">Cập nhật</button>	
            </div>
        </div>
    </form>

    <div id="user_data" hidden>{!! $user !!}</div>
@endsection

@section('script')
    {{-- set datepicker --}}
    <script src="https://code.jquery.com/jquery-1.12.4.js" defer></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js" defer></script>
    <script src="/js/datetime/set_datepicker.js" defer></script>
    
    <script src="/js/profile/input_gender.js" defer></script>
@endsection