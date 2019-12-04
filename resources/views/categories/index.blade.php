@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'categories'
])

@section('content')
<div class="panel-header" style="margin-bottom:-3em;">
    <div class="header text-center">
        @if($active == 'All' || $active == 'Result')
            <h2 class="title">{{$active}}</h2>
        @else
            <h2 class="title">{{$active->name}}</h2>
        @endif
        <div class="form-inline" style="justify-content:center">

        @if($active != 'All' && $active != 'Result')
            <form action="{{route('categories.destroy', $active->id)}}" method="POST">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <button class="btn btn-primary btn-round text-white" href="{{ route('categories.destroy', $active->id) }}" data-method="delete" class="jquery-postback">{{ __('Remove Category') }}</button>
            </form>
        @endif
        </div>
    </div>
</div>
<div class="content">
    <div class="row">
    <div class="col-md-12">
    @if (session('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('status') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" style="margin-bottom:1em;">
                    <div class="dropdown pull-left">
                        <button type="button" class="btn btn-primary text-white btn-round dropdown-toggle pull-left" data-toggle="dropdown">
                            <a>Categories</a>
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="/categories">All</a>
                        @foreach ($categories as $x)
                            <a class="dropdown-item" href="/categories/{{$x->id}}">{{$x->name}}</a>
                        @endforeach
                        </div>
                    </div>
                    <a class="btn btn-primary btn-round text-white pull-left" href="{{ route('categories.create') }}">{{ __('Add Category') }}</a>
                    <a class="btn btn-primary btn-round text-white pull-right" href="{{ route('articles.create') }}">{{ __('Add Article') }}</a>
                    <div class="col-12 mt-2">

                    </div>
                    <div class="card-body" style="margin-top:2em;">
                    </div>
                </div>
            </div>
        </div>

        @foreach ($articles as $a)
        <div class="col-md-3">
            <div class="card">
                <div class="card-header" style="text-align:right;margin-top:-1em;margin-bottom:-1em;">
                    <div class="dropdown">
                        <button type="button" class="btn btn-round btn-outline-default dropdown-toggle btn-simple btn-icon no-caret" data-toggle="dropdown">
                        <i class="nc-icon nc-minimal-down"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="{{ route('articles.show', $a->id) }}">Lihat</a>
                            <a class="dropdown-item" href="{{ route('articles.edit', $a->id) }}">Edit</a>
                            <form action="{{route('articles.destroy', $a->id)}}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <button style="background:white;color:black" class="btn" data-method="delete" class="jquery-postback">{{ __('Remove Articles') }}</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card-body" style="text-align:center;">
                    
                    <h5>{{$a->name}}</h5>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
@push('script')
<script>
$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
});
$(document).on('click', 'a.jquery-postback', function(e) {
    e.preventDefault(); // does not go through with the link.

    var $this = $(this);

    $.post({
        type: $this.data('method'),
        url: $this.attr('href')
    }).done(function (data) {
        alert('success');
        console.log(data);
    });
});
</script>
@endpush
