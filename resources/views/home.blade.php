@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-4">
                            <ul class="overflow-auto list-group" style="height: 600px">
                                <button class="list-group-item active">Usuário 1</button>
                            </ul>
                        </div>
                        <div class="col-8">
                            <div class="overflow-auto list-group" style="height: 560px">
                            </div>

                            <form id="chat-form" method="POST" action="{{route('message')}}">
                                @csrf
                                <div class="form-group">
                                    <input type="text" id="to" name="to" class="form-control" placeholder="ID do Usuário" required>
                                </div>
                                <div class="form-group mt-2">
                                    <div class="input-group mb-3">
                                        <input type="text" name="content" class="form-control" placeholder="Digite a mensagem." required>
                                        <button type="submit" class="input-group-text btn btn-primary">Enviar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
@if(Auth::check())
<script>
    var token = 'Bearer {{Auth::user()->api_token}}';
</script>
<script src="{{ asset('/js/app.js') }}"></script>
<script>
    $("#chat-form").on('submit', function(e){
        e.preventDefault();
        $.ajax({
            beforeSend: function(request) {
                request.setRequestHeader("Authorization", token);
            },
            type: 'POST',
            url: $(this).attr('action'),
            data: $(this).serialize(),
            success: function(data) {
                alert('msg temporarioa, inserido com sucesso');
            }
        });
    });

    user_id = {{Auth::id()}}

    Echo.private('message.received.'+user_id)
    .listen('Chat.SendMessage', e => {
        console.log(e)
    })
</script>
@endif
@endpush
