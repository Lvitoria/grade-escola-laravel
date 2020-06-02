<form class="form-inline" method="GET" action="{{route($routeName.'.index')}}">
  <div class="form-group mb-2">
    <a href="{{route($routeName.'.create')}}">@lang('escola.add')</a>
  </div>
  <div class="form-group mx-sm-3 mb-2">
    <input type="search" class="form-control" name="search" placeholder="@lang('escola.search')" value="{{$search}}">
  </div>
  <button type="submit" class="btn btn-primary mb-2">@lang('escola.search')</button>
  <a class="btn btn-warning mb-2" href="{{route($routeName.'.index')}}">@lang('escola.clean')</a>
</form>
