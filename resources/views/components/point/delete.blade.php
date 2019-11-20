<div class="row" id="button-delete-point">
    <button onclick="displayForm('delete-point-container')">
        <b>Xóa điểm dừng</b>
    </button>
</div>
<div id="delete-point-container">
    <div class="row collapse-button">
    <button onclick="nonDisplayForm('delete-point-container')">
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
            <input id="deleting-order" type="integer" name="order">
        </div>
        @error('order')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <div id="button-3" class="row">
        <button id="button-delete">Xóa</button>
    </div>
</div>