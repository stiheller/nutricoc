<div class="row float-right" style="z-index: 1;">
    @if(Session::has('message'))
        <div class="alert alert-success alert-dismissible" id="alert-session">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-check"></i> Ok!</h5>
            {{Session::get('message')}}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible " id="alert-session">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-times-circle"></i> Error!</h5>
            {{Session::get('error')}}
        </div>
    @endif

</div>

