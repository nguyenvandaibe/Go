@extends('layouts.app')

@section('left-bar')
	@include('components.profile_new_plan')
@endsection

@section('content')
	<div class="row">
		<h3>Kế hoạch mới - Thông tin</h3>
	</div>
	<div class="row">
		<form method="post" action="/plans/create/info" enctype="multipart/form-data">
			@csrf
			<div class="row">
				<div class="col-md-6 offset-md-1">
					<label name="name">Tên kế hoạch:</label>
				</div>
				<div class="col-md-5">
					<input type="text" name="name" value="{{ old('name') }}">
				</div>
			</div>
			<div class="row">
    
                    @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
			</div>

			<div class="row">
				<div class="col-md-6 offset-md-1">
					<label>Chọn ảnh cover:</label><br>
				</div>
				<div class="col-md-3">
					<input type="file" name="cover"  value="{{ old('cover') }}">
				</div>
			</div>
			<div class="row">
				@error('cover')
					<div class="alert alert-danger">{{ $message }}</div>
				@enderror
			</div>

			<div class="row">
				<div class="col-md-6 offset-md-1">
					<label name="start_date">Ngày bắt đầu:</label>
				</div>
				<div class="col-md-3">
					<input class="date" type="text" name="start_date" value="{{ old('start_date') }}">
				</div>
			</div>
			<div class="row">
				@error('start_date')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

			<div class="row">
				<div class="col-md-6 offset-md-1">
					<label name="end_date">Ngày kết thúc:</label>
				</div>
				<div class="col-md-3">
					<input class="date" type="text" name="end_date" value="{{ old('end_date') }}">
				</div>
			</div>
			<div class="row">
				@error('end_date')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

			<div class="row">
				<div class="col-md-6 offset-md-1">
					<label name="member_num">Số lượng người:</label>
				</div>
				<div class="col-md-3">
					<input type="number" name="member_num" value="{{ old('member_num') }}">
				</div>
			</div>
			<div class="row">
				@error('member_num')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
			<div class="row">
				<div class="col-md-3 offset-md-4">
					<button type="submit">Tạo</button>
				</div>
			</div>
		</form>
	</div>
@endsection

@section('script')
    <script src="https://code.jquery.com/jquery-1.12.4.js" defer></script>
  	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js" defer></script>
	<script src="/js/datetime/set_datepicker.js" defer></script>
@endsection