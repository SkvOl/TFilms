<div class="mx-auto w-75 h-75">
    <div>
        @foreach ($films as $film)
            <div class="bg-c-card card mb-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col" style="width: 40%;">
                            <img src="{{asset('storage/files')}}/{{$film['photo']}}" class="c-photo mx-2">
                        </div>
                        <div class="col">
                            <div class="d-flex justify-content-between bd-highlight">
                                <div class="p-2 bd-highlight"><h3>{{$film['name']}}</h3></div>
                                <div class="p-2 bd-highlight"><h5 class="p-2">{{$film['age_restrictions']}}+</h5></div>
                            </div>
                            <div>
                                {{$film['description']}}
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center mt-4">
                        @foreach ($sessions as $key=>$session)
                            @if ($session['film_id'] == $film['film_id'])
                                <div class="bg-c-card-session card w-25 text-center mb-3 me-3">
                                    <a class="session-c-link" href="#">
                                        <div><h4>{{$session['cost']}} рублей</h4></div>
                                        <div>{{substr($session['film_start'], 0, -3)}}</div>
                                    </a>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>