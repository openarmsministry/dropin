<div class="card">
    <img class="card-img-top" style="width: 100%" src="{{ $imgPath }}">
    <div class="card-block">
        <form action="{{ $actionPath }}" method="post">
            {{ csrf_field() }}
            <input type="submit" value="Check In" class="btn btn-primary btn-block">
        </form>
    </div>
</div>
