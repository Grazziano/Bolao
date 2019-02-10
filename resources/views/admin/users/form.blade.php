<div class="row">
  <div class="form-group col-6">
    <label for="name">Nome</label>
    <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}">
    @if ($errors->has('name'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('name') }}</strong>
        </span>
    @endif
  </div>
  <div class="form-group col-6">
    <label for="email">E-mail</label>
    <input type="mail" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}">
    @if ($errors->has('email'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('email') }}</strong>
        </span>
    @endif
  </div>
  <div class="form-group col-6">
    <label for="password">Senha</label>
    <input type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" value="">
    @if ($errors->has('password'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('password') }}</strong>
        </span>
    @endif
  </div>
  <div class="form-group col-6">
    <label for="password_confirmation">Confirmar Senha</label>
    <input type="password" class="form-control" name="password_confirmation" value="">
  </div>
</div>
