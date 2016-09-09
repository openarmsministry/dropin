<div class="card">
    <img class="card-img-top" style="width: 100%" src="{{ $imgPath }}">
    <div class="card-block">
        <form action="{{ $actionPath }}" method="post">
            {{ csrf_field() }}
            @foreach($checkboxes as $checkbox)
                <div class="form-check">
                    <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" name="{{$checkboxName}}" value="{{$checkbox['key']}}">
                        {{ $checkbox['value'] }}
                    </label>
                </div>
            @endforeach
            <input type="submit" value="{{ $buttonText }}" class="btn btn-primary btn-block">
        </form>
    </div>
</div>
