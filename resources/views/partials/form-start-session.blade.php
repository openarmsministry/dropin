<form action="/sessions" method="post">
    {{ csrf_field() }}
    <input type="submit" href="{{  url('session/start') }}" class="btn btn-primary" value="Start Session">
</form>
