<div class="row">
    <div class="form-group col-12">
        <label  for="grid">semana:</label>
            <select class="form-control{{ $errors->has('grid') ? ' is-invalid' : '' }}" name="grid" value="{{ old('grid') }}" id="grid">
                @foreach ($grid as $key => $value)
                    <option value="{{$value->id}}">{{$value->week}}</option>
                @endforeach
            </select>
        @if ($errors->has('grid'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ str_replace('grid', 'professor(ar)',$errors->first('grid)')) }}</strong>
        </span>
        @endif
    </div>

    <div class="form-group col-12">
        <label  for="discipline">Materia:</label>
            <select class="form-control{{ $errors->has('discipline') ? ' is-invalid' : '' }}" name="discipline" value="{{ old('discipline') }}" id="discipline">
                @foreach ($discipline as $key => $value)
                    <option value="{{$value->id}}">{{$value->name}}</option>
                @endforeach
            </select>
        @if ($errors->has('discipline'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ str_replace('discipline', 'disciplina',$errors->first('discipline)')) }}</strong>
        </span>
        @endif
    </div>

    <div class="form-group col-12">
        <label  for="classes">periodo:</label>
            <select class="form-control{{ $errors->has('classes') ? ' is-invalid' : '' }}" name="classes" value="{{ old('classes') }}" id="name">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
            </select>
        @if ($errors->has('classes'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ str_replace('classes','periodo',$errors->first('period')) }}</strong>
        </span>
        @endif
    </div>
  </div>
  