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
                                    <a id="{{$session['session_id']}}" class="session-c-link" href="#">
                                        <div><h4>{{$session['cost']}} рублей</h4></div>
                                        <div>{{substr($session['film_start'], 0, -3)}}</div>
                                    </a>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
                @if($isAuthorized)
                    <div class="d-flex flex-row-reverse bd-highlight me-2 mt-2 mb-2 p-1">
                        <a type="submit" href="/delete_film?id={{$film['film_id']}}" class="btn btn-warning">Удалить фильм</a>
                        <button type="submit" class="btn btn-warning me-1">Удалить сеанс</button>
                        <button id="{{$film['film_id']}}"  type="submit" class="btn btn-warning me-1 exist-film-id" data-bs-toggle="modal" data-bs-target="#saveSessionFilmModal">Добавить сеанс</button>
                    </div>
                @endif
            </div>
        @endforeach
    </div>
</div>

@include('addFilmModal')
@include('addSessionFilmModal')

<script>
    window.onload = function() {
        film_id = 0;
        
        $(".exist-film-id").click(function(){
            film_id = $(this).attr('id');
        });


        $(".session-c-link").click(function(){
            session_id = $(this).attr('id');
            ajax('/delete_session', {id: session_id})
            window.location.href = window.location.href;
        });

        $(".save-session").click(function(){
            dataForm = $("#saveSessionFilmFrame").serializeArray();
            
            console.log(film_id);
            ajax('/create_session', {
                'film_id': film_id,
                'film_start':dataForm[0]['value'],
                'cost':dataForm[1]['value']
            })
        });

        function ajax(url, item){
            $.ajax({
                url: url,
                method: 'post',
                dataType: 'json',
                data: item,
                success: function(data){
                    console.log('s');
                }
            });
            window.location.href = window.location.href;
        }
    }; 
</script>