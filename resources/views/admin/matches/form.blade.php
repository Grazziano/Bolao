<div class="row">
    <div class="form-group col-6">
        <label for="title">{{ __('bolao.title') }}</label>
        <input type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title"
            value="{{ old('title') ?? ($register->title ?? '') }}">
        @if ($errors->has('title'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('title') }}</strong>
            </span>
        @endif
    </div>

    <div class="form-group col-6">
        <label for="round_id">{{ __('bolao.round') }}</label>
        <select class="form-control{{ $errors->has('round_id') ? ' is-invalid' : '' }}" name="round_id" id="">
            @foreach ($listRel as $key => $value)
                @php
                    $selected = '';
                    if (old('round_id') ?? false) {
                        if (old('round_id') == $value->id) {
                            $selected = 'selected';
                        }
                    } else {
                        if ($register_id ?? false) {
                            if ($register_id == $value->id) {
                                $selected = 'selected';
                            }
                        }
                    }
                @endphp
                <option {{ $selected }} value="{{ $value->id }}">{{ $value->title }}</option>
            @endforeach
        </select>
        @if ($errors->has('round_id'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('round_id') }}</strong>
            </span>
        @endif
    </div>

    <div class="form-group col-6">
        <label for="team_a">{{ __('bolao.team_a') }}</label>
        <input type="text" class="form-control{{ $errors->has('team_a') ? ' is-invalid' : '' }}" name="team_a"
            value="{{ old('team_a') ?? ($register->team_a ?? '') }}">
        @if ($errors->has('team_a'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('team_a') }}</strong>
            </span>
        @endif
    </div>

    <div class="form-group col-6">
        <label for="team_b">{{ __('bolao.team_b') }}</label>
        <input type="text" class="form-control{{ $errors->has('team_b') ? ' is-invalid' : '' }}" name="team_b"
            value="{{ old('team_b') ?? ($register->team_b ?? '') }}">
        @if ($errors->has('team_b'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('team_b') }}</strong>
            </span>
        @endif
    </div>

    <div class="form-group col-6">
        <label for="stadium">{{ __('bolao.stadium') }}</label>
        <input type="text" class="form-control{{ $errors->has('stadium') ? ' is-invalid' : '' }}" name="stadium"
            value="{{ old('stadium') ?? ($register->stadium ?? '') }}">
        @if ($errors->has('stadium'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('stadium') }}</strong>
            </span>
        @endif
    </div>

    <div class="form-group col-6">
        <label for="result">{{ __('bolao.result') }} {{ __('bolao.result_description') }}</label>
        <select class="form-control{{ $errors->has('result') ? ' is-invalid' : '' }}" name="result" id="">
            @php
                $lista = ['A', 'B', 'E'];
            @endphp
            @foreach ($lista as $key => $value)
                @php
                    $selected = '';
                    if (old('result') ?? false) {
                        if (old('result') == $value->result) {
                            $selected = 'selected';
                        }
                    } else {
                        if ($register->result ?? false) {
                            if ($register->result == $value) {
                                $selected = 'selected';
                            }
                        } else {
                            if ($value == 'E') {
                                $selected = 'selected';
                            }
                        }
                    }
                @endphp
                <option {{ $selected }} value="{{ $value }}">{{ $value }}</option>
            @endforeach
        </select>
        @if ($errors->has('result'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('result') }}</strong>
            </span>
        @endif
    </div>

    <div class="form-group col-6">
        <label for="scoreboard_a">{{ __('bolao.scoreboard_a') }}</label>
        <input type="text" class="form-control{{ $errors->has('scoreboard_a') ? ' is-invalid' : '' }}"
            name="scoreboard_a" value="{{ old('scoreboard_a') ?? ($register->scoreboard_a ?? '0') }}">
        @if ($errors->has('scoreboard_a'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('scoreboard_a') }}</strong>
            </span>
        @endif
    </div>

    <div class="form-group col-6">
        <label for="scoreboard_b">{{ __('bolao.scoreboard_b') }}</label>
        <input type="text" class="form-control{{ $errors->has('scoreboard_b') ? ' is-invalid' : '' }}"
            name="scoreboard_b" value="{{ old('scoreboard_b') ?? ($register->scoreboard_b ?? '0') }}">
        @if ($errors->has('scoreboard_b'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('scoreboard_b') }}</strong>
            </span>
        @endif
    </div>

    <div class="form-group col-6">
        <label for="date">{{ __('bolao.date') }} ({{ date('Y-m-d H:i:s') }})</label>
        <input type="datetime" placeholder="{{ date('Y-m-d H:i:s') }}"
            class="form-control{{ $errors->has('date') ? ' is-invalid' : '' }}" name="date"
            value="{{ old('date') ?? ($register->date ?? '') }}">
        @if ($errors->has('date'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('date') }}</strong>
            </span>
        @endif
    </div>
</div>
