
<div class="row">
    <div class="form-group col-12">
        <label  for="name">disciplina:</label>
            <select class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" id="name">
                <option value="Português">Português</option>
                <option value="Inglês">Inglês</option>
                <option value="Espanhol">Espanhol</option>
                <option value="Literatura">Literatura</option>
                <option value="Matemática">Matemática</option>
                <option value="Geografia">Geografia</option>
                <option value="História">História</option>
                <option value="Física">Física</option>
            </select>
        @if ($errors->has('name'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ str_replace('name','disciplina',$errors->first('name')) }}</strong>
        </span>
        @endif
    </div>

    <div class="form-group col-12">
        <label  for="teacher_idteacher">Professores(as):</label>
            <select class="form-control{{ $errors->has('teacher_idteacher') ? ' is-invalid' : '' }}" name="teacher_idteacher" value="{{ old('teacher_idteacher') }}" id="teacher_idteacher">
                @foreach ($list as $key => $value)
                    <option value="{{$value->id}}">{{$value->name}}</option>
                @endforeach
            </select>
        @if ($errors->has('teacher_idteacher'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ str_replace('teacher_idteacher', 'professor(ar)',$errors->first('teacher_idteacher)')) }}</strong>
        </span>
        @endif
    </div>

</div>
  