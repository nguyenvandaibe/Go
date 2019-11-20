<div class="row" id="button-add-point">
	<button onclick="displayForm('new-point-container')">
		<b>Thêm điểm dừng chân</b>
	</button>
</div>
<div id="new-point-container">
	<div class="row collapse-button">
		<button onclick="nonDisplayForm('new-point-container')">
			<small>Thu gọn</small>
		</button>
	</div>
	<div class="row">
		<div class="col-md-6">
			<label name="order">Thứ tự</label>
		</div>
	</div>

	<div class="row">
		<div class="col-md-4">
			<input id="adding-order" type="integer" name="order" value="{{ old('order') }}">
		</div>
		@error('order')
			<div class="alert alert-danger">{{ $message }}</div>
		@enderror
	</div>

	<div class="row">
		<div class="col-md-10">
			<label name="place">Tên địa điểm</label>
		</div>
	</div>
	<div class="row">
		<div class="col-md-4">
			<input id="adding-place" type="text" name="place" value="{{ old('place') }}">
		</div>
		@error('place')
			<div class="alert alert-danger">{{ $message }}</div>
		@enderror
	</div>

	<div class="row">
		<div class="col-md-6">
			<label name="place_lat">Vĩ độ</label>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6">
			<input id="adding-place-lat" name="place_lat" value="{{ old('place_lat') }}">
		</div>
		@error('place_lat')
			<div class="alert alert-danger">{{ $message }}</div>
		@enderror
	</div>			

	<div class="row">
		<div class="col-md-6">
			<label name="place_lng">Kinh độ</label>
		</div>
	</div>
	<div class="row">
		<div class="col-md-4">
			<input id="adding-place-lng" name="place_lng" value="{{ old('place_lng') }}">
		</div>
		@error('place_lng')
			<div class="alert alert-danger">{{ $message }}</div>
		@enderror			
	</div>

	<div class="row">
		<div class="col-md-10">
			<label name="arrive_time">Thời gian đến:</label>
		</div>
	</div>
	<div class=row>
		<div class="col-md-6">
			<input class="datetime" id="adding-arrive-time" type="text" name="arrive_time" value="{{ old('arrive_time') }}">
		</div>
		@error('arrive_time')
			<div class="alert alert-danger">{{ $message }}</div>
		@enderror
	</div>

	<div class="row">
		<div class="col-md-10">
			<label name="depature_time">Thời gian đi:</label>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6">
			<input class="datetime" id="adding-depature-time" type="text" name="depature_time" value="{{ old('depature_time') }}">
		</div>
		@error('depature_time')
			<div class="alert alert-danger">{{ $message }}</div>
		@enderror
	</div>

	<div class="row">
		<div class="col-md-10">
			<label name="vehicle">Phương tiện:</label>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6">
			<select id="adding-vehicle" name="vehicle">
			    <option value="Xe đạp">Xe đạp</option>
			    <option value="Xe máy">Xe máy</option>
			    <option value="Ô tô">Ô tô</option>
			</select>
		</div>
		@error('vehicle')
			<div class="alert alert-danger">{{ $message }}</div>
		@enderror
	</div>

	<div class="row">
		<div class="col-md-10">
			<label name="activity">Hoạt động:</label>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6">
			<input id="adding-activity" type="text" name="activity" value="{{ old('activity') }}">
		</div>
		@error('activity')
			<div class="alert alert-danger">{{ $message }}</div>
		@enderror
	</div>

	<div class="row" id="button-1">
		<button id="button-add" onclick="requestAddPointManually(map, points)">Thêm</button>
	</div>
</div>