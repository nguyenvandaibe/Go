@extends('layouts.app')

@section('left-bar')
	<h4 id="header-bar">Thông tin kế hoạch:</h4>

	<div class="row">
		<div class="col-md-6">
			{{'Trạng thái: '}}<br>
		</div>
	</div>
	<div class="row status-container">
		<p id="plan-status">
			@if ($plan->status === 'planning')
				Đang lập kế hoạch
			@elseif ($plan->status === 'running')
				Đang diễn ra
			@elseif ($plan->status === 'ended')
				Đã kết thúc
			@else
				Đã hủy
			@endif
		</p>
	</div>

	<div class="row" id="status-button-holder">
		@if ($plan->status === 'planning')
			<div class="col-md-6">
				<div class="row status-container" id="status-run-container">
					<button id="button-run" onclick="runPlan()">Chạy</button>
				</div>
			</div>
			<div class="col-md-6">
				<div class="row status-container" id="status-cancel-container">
					<button id="button-cancel" onclick="cancelPlan()">Hủy</button>
				</div>
			</div>
		
		@elseif ($plan->status === 'running')
			<div class="row status-container" id="status-end-container">
				<button id="button-end" onclick="endPlan()">Kết thúc</button>
			</div>
		@endif
	</div>

	<hr>

	<div class="row">
		<div class="col-md-9">
			{{'Số lượng tham gia: '}}
		</div>
		<div class="col-md-2">
			{{ $plan->member_num }}
		</div>
	</div>

	<div class="row">
		<div class="col-md-6">
			{{'Bắt đầu: '}}
		</div>
		<div class="col-md-4">
			{{ $plan->start_date }}
		</div>
	</div>

	<div class="row">
		<div class="col-md-6">
			{{'Kết thúc: '}}
		</div>
		<div class="col-md-4">
			{{ $plan->end_date }}
		</div>
	</div>
	<hr>

	@if ($plan->status === 'planning')
		<div id="edit-plan-container" class="row">
			<div class="col-md-6 offset-md-3">
				<button id="button-edit" type="button" onclick="window.location='/plans/edit/show/{{ $plan->id }}'">Chỉnh sửa</button>
			</div>
		</div>
	@endif
@endsection

@section('content')
	<h3>{{ $plan->name }}</h3>

	<div class="cover-container">
		<img src="{{ asset($plan->cover) }}" height="200px">
	</div>

		<h4><b>Bản đồ</b></h4><br>
	<div class="map-container" id="map">
	</div>

	<div class="schedule-container">
		<h4><b>Lịch trình</b></h4><br>
		<div id="table-schedule" class="row">
			<table id="table2">
				<thead>
					<th>Thứ tự</th>
					<th>Địa điểm</th>
					<th>Vĩ độ</th>
					<th>Kinh độ</th>
					<th>Thời gian đến</th>
					<th>Thời gian rời đi</th>
					<th>Phương tiện</th>
					<th>Hoạt động</th>
				</thead>
				<tbody id="table2-body">
					@foreach($plan->points as $point)
						<tr>
							<td>{{ $point->order }}</td>
							<td>{{ $point->place }}</td>
							<td>{{ $point->place_lat }}</td>
							<td>{{ $point->place_lng }}</td>
							<td>{{ $point->arrive_time }}</td>
							<td>{{ $point->depature_time }}</td>
							<td>{{ $point->vehicle }}</td>
							<td>{{ $point->activity }}</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>

	<hr>
    <h4><b>Bình luận</b></h4>

    <div id=comment-panel>
        <div id="comment-container"></div>
        <div id="input-comment-container"></div>
    </div>

	<div id="my_data" hidden>{!! $plan !!}</div>
@endsection

@section('right-bar')

    @include('components.point.add')
    <hr>

    @include('components.point.edit')
    <hr>
	
    @include('components.point.delete')
@endsection

@section('script')
    <script src="/js/sticky_header.js" defer></script>
    <script src="/js/table_to_form.js" defer></script>

	{{-- Datetime --}}
    <script src="/js/datetime/jquery.datetimepicker.full.js" defer></script>
    <script src="/js/datetime/set_datetimepicker.js" defer></script>

	{{-- Plan's status --}}
    <script src="/js/plan_status/change_elements.js" defer></script>
    <script src="/js/plan_status/change_status.js" defer></script>

    {{-- Map --}}
    <script src="/js/map/display_map.js" defer></script>
    <script src="/js/map/action_point.js" defer></script>
    <script src="/js/map/calculate_route.js" defer></script>
    <script src="/js/map/refresh_element.js" defer></script>
    <script src="/js/map/request_point.js" defer></script>

    {{-- Comment --}}
    <script src="/js/comment/delete.js" defer></script>
    <script src="/js/comment/create.js" defer></script>
    <script src="/js/comment/show.js" defer></script>
    <script src="/js/comment/reply.js" defer></script>
    <script src="/js/comment/request.js" defer></script>
@endsection