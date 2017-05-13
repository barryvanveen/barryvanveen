@foreach ((array) session('flash_notification') as $message)
   <div class="alert alert-{{ $message['level'] }} alert-dismissible" role="alert">
       <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

        {!! $message['message'] !!}
    </div>
@endforeach

{{ session()->forget('flash_notification') }}