<div class="row">
    <div class="form-group col-12">
      <label for="name">Nome</label>
      <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}">
      @if ($errors->has('name'))
          <span class="invalid-feedback" role="alert">
              <strong>{{ $errors->first('name') }}</strong>
          </span>
      @endif
    </div>
    <div class="form-group col-6">
        <label for="holidayStart">inicio de férias</label>
        <input type="date" class="form-control{{ $errors->has('holidayStart') ? ' is-invalid' : '' }}" name="holidayStart" value="{{ old('holidayStart') }}">
        @if ($errors->has('holidayStart'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('holidayStart') }}</strong>
            </span>
        @endif
      </div>
      <div class="form-group col-6">
        <label for="holidayEnd">fim das férias</label>
        <input type="date" class="form-control{{ $errors->has('holidayEnd') ? ' is-invalid' : '' }}" name="holidayEnd" value="{{ old('holidayEnd') }}">
        @if ($errors->has('holidayEnd'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('holidayEnd') }}</strong>
            </span>
        @endif
      </div>
  </div>
  