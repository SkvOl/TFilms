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
                                    <a id="{{$session['session_id']}}" value="{{$film['film_id']}}" class="session-c-link change-session-button exist-film-id-on-session" data-bs-toggle="modal" data-bs-target="#changeSessionFilmModal">
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
                    <button id="{{$film['film_id']}}" type="button" class="btn btn-outline-warning me-1 exist-film-id save-session-button" data-bs-toggle="modal" data-bs-target="#saveSessionFilmModal">Добавить сеанс</button>
                        <button id="{{$film['film_id']}}" type="button" class="btn btn-outline-warning me-1 exist-film-id change-film-button" data-bs-toggle="modal" data-bs-target="#changeFilmModal">Изменить фильм</button>
                    </div>
                @endif
            </div>
        @endforeach
    </div>
</div>


@include('inModal')
@include('authModal')
@include('addFilmModal')
@include('changeFilmModal')
@include('addSessionFilmModal')
@include('changeSessionFilmModal')


<script>
    window.onload = function() {
        film_id = 0;
        session_id = 0;
        
        $(".exist-film-id").click(function(){
            film_id = $(this).attr('id');
        });

        $(".exist-film-id-on-session").click(function(){
            film_id = $(this).attr('value');
            session_id = $(this).attr('id');
        });

        $(".delete-session").click(function(){
            ajax('/api/film_session', {
                'id': session_id,
                'method': 'delete',
            });
        });

        $(".save-session").click(function(){
            var parent = $(this).parent();
            var param = {};
            
            var film_start = parent.find('.film_start').val();
            var cost = parent.find('.cost').val();

            if(session_id != 0) param['id'] = session_id;
            param['film_id'] = film_id;
            if(param['film_start'] != '') param['film_start'] = film_start;
            if(param['cost'] != '') param['cost'] = cost;
            param['method'] = $(this).attr('id');

            console.log(param);
            ajax('/api/film_session', param);
        });

        $(".change-film-button").click(function(){
            ajaxFile('/api/film/' + film_id, [], 'GET');
        });

        $(".change-session-button").click(function(){
            session_id = $(this).attr('id');
            ajax('/api/film_session/' + session_id, [], 'get');
        });

        $(".delete-film").click(function(){
            ajax('/api/film', {
                'id':film_id,
                'method':'delete'
            });
        });

        $(".save-film").click(function(){
            var formData = new FormData();
            
            var parent = $(this).parent();
            var name = parent.find('.name').val();
            var photo = parent.find('.photo');
            var description = parent.find('.description').val();
            var duration = parent.find('.duration').val();
            var age_restrictions = parent.find('.age_restrictions').val();
            
            if(film_id != 0) formData.append('id', film_id); 
            if(name != '') formData.append('name', name);
            if(photo.prop('files').length) formData.append('photo', photo.prop('files')[0]);
            if(description != '') formData.append('description', description);
            if(duration != '') formData.append('duration', duration);
            if(age_restrictions != '') formData.append('age_restrictions', age_restrictions);
            formData.append('method', $(this).attr('id'));

            ajaxFile('/api/film', formData);

            return false;
        });


        $(".auth-button").click(function(){
            var login = $(".auth-login").val();
            var password = $(".auth-password").val();

            ajax('/api/auth/auth',{
                'login':login,
                'password':password
            });
        });

        $(".login-button").click(function(){
            var login = $(".login-login").val();
            var password = $(".login-password").val();

            ajax('/api/auth/in',{
                'login':login,
                'password':password
            });
        });

        $(".out-auth").click(function(){
            ajax('/api/auth/out',{
            });
        });


        function ajax(url, item, mmethod = 'post'){
            $.ajax({
                url: url,
                method: mmethod,
                dataType: 'json',
                data: item,
                success: function(data){
                    if(mmethod == 'get'){
                        data = data['data'][0]

                        for (const [key, value] of Object.entries(data)) {
                            if(key != 'photo') $('#change_' + key).val(value);
                        }
                    }
                    else{
                        new Promise(resolve => setTimeout(resolve, 500));
                        window.location.href = window.location.href;
                    }
                }
            });
        }

        function ajaxFile(url, item, mmethod = 'POST'){
            $.ajax({
                url: url,
                data: item,
                processData: false,
                contentType: false,
                type: mmethod,
                success: function(data) {
                    if(mmethod == 'GET'){
                        data = data['data'][0]

                        for (const [key, value] of Object.entries(data)) {
                            if(key != 'photo') $('#change_' + key).val(value);
                        }
                    }
                    else{
                        new Promise(resolve => setTimeout(resolve, 500));
                        window.location.href = window.location.href;
                    }
                }
            });
        }
    }; 
</script>