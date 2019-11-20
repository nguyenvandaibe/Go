@extends('layouts.app')

@section('left-bar')
	@include('components.profile_new_plan')
@endsection

@section('content')
	<div class="cover-container">
		<img src="{{ asset($plan->cover) }}" height="200px">
	</div>
	
	<hr>
	<form action="/plans/edit/store/{{ $plan->id }}" method="post" enctype="multipart/form-data">
		@csrf
		<div class="row">
			<div class="col-md-3 offset-md-4">
				<label name="name">Tên kế hoạch:</label>
			</div>
			<div class="col-md-3">
				<input type="text" name="name" value="{{ $plan->name }}">
			</div>
		</div>
		<div class="row error-edit-plan">
			@error('name')
				<div class="alert alert-danger">{{ $message }}</div>
			@enderror
		</div>
		<div class="row">
			<div class="col-md-3 offset-md-4">
				<label>Chọn ảnh bìa mới:</label><br>
			</div>
			<div class="col-md-3">
				<input type="file" name="cover" value="C:/xampp/htdocs/Go{{$plan->cover}}">
			</div>
		</div>
		<div class="row error-edit-plan">
			@error('cover')
				<div class="alert alert-danger">{{ $message }}</div>
			@enderror
		</div>

		<div class="row">
			<div class="col-md-3 offset-md-4">
				<label name="start_date">Ngày bắt đầu:</label>
			</div>
			<div class="col-md-3">
				<input class="date" type="text" name="start_date" value="{{ $plan->start_date }}">
			</div>
		</div>
		<div class="row error-edit-plan">
			@error('start_date')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

		<div class="row">
			<div class="col-md-3 offset-md-4">
				<label name="end_date">Ngày kết thúc:</label>
			</div>
			<div class="col-md-3">
				<input class="date" type="text" name="end_date" value="{{ $plan->end_date }}">
			</div>
		</div>
		<div class="row error-edit-plan">
			@error('end_date')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

		<div class="row">
			<div class="col-md-3 offset-md-4">
				<label name="member_num">Số lượng người:</label>
			</div>
			<div class="col-md-3">
				<input type="number" name="member_num" value="{{ $plan->member_num }}">
			</div>
		</div>
		<div class="row error-edit-plan">
			@error('member_num')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

		<div class="row button-edit-plan">
			<button type="submit">Cập nhật</button>
		</div>
	</form>
@endsection

@section('right-bar')
@endsection

@section('script')
    {{-- set datepicker --}}
	    <script src="https://code.jquery.com/jquery-1.12.4.js" defer></script>
	  	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js" defer></script>
		<script src="/js/datetime/set_datepicker.js" defer></script>
@endsection
