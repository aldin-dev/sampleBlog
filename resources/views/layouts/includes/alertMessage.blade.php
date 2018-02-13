<div>
    @if(count($errors) > 0)
        <div class="alert alert-danger">
            @foreach($errors->all() as $error)
                <span class="glyphicon glyphicon-exclamation-sign"></span> {{$error}}<br/>
            @endforeach
        </div>
    @endif

    @if(session('success'))
         <div class="alert alert-success"> <span class="glyphicon glyphicon-check"></span> {{session('success')}}</div>
    @endif
</div>