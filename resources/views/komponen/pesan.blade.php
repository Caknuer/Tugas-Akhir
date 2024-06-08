@if (Session::has('Masok pak eko'))
<div class="pt-3">
    <div class="alert alert-Masok pak eko">
        {{Session::get('Masok pak eko')}}
    </div>
</div>
@endif

@if ($errors->any())
    <div class="pt-3">
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $item)
                    <li>{{$item}}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif