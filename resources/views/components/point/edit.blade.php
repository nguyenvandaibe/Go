<div class="row" id="button-edit-point">
	<button onclick="displayForm('edit-point-container')">
		<b>Chỉnh sửa thông tin</b>
	</button>
</div>
<div id="edit-point-container">
	<div class="row collapse-button">
		<button onclick="nonDisplayForm('edit-point-container')">
			<small>Thu gọn</small>
		</button>
	</div>
	<div class="row">
		<div class="col-md-6">
			<label name="old_order">Thứ tự cũ</label>
		</div>
	</div>

	<div class="row">
		<div class="col-md-4">
			<input id="old_order" type="integer" name="old_order">
		</div>
		@error('old_order')
			<div class="alert alert-danger">{{ $message }}</div>
		@enderror
	</div>

	<div class="row">
		<div class="col-md-6">
			<label name="new_order">Thứ tự mới</label>
		</div>
	</div>

	<div class="row">
		<div class="col-md-4">
			<input id="new_order" type="integer" name="new_order">
		</div>
		@error('new_order')
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
			<input id="place" type="text" name="place">
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
			<input id="place_lat" name="place_lat">
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
			<input id="place_lng" name="place_lng">
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
			<input id="arrive_time" class="datetime" type="text" name="arrive_time">
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
			<input id="depature_time" class="datetime" type="text" name="depature_time">
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
			<select id="vehicle" name="vehicle">
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
			<input id="activity" type="text" name="activity">
		</div>
		@error('activity')
			<div class="alert alert-danger">{{ $message }}</div>
		@enderror
	</div>

	<div class="row" id="button-2">
		<button id="button-edit" onclick="requestEditPoint()">Cập nhật</button>
	</div>
</div>