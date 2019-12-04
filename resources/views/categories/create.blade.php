@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'categories'
])

@section('content')
    <div class="panel-header panel-header-sm">
    </div>
    <div class="content">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Article Management') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('categories.index') }}" class="btn btn-primary btn-round">{{ __('Back to list') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('articles.store') }}" enctype="multipart/form-data">
                            @csrf
                            <h6 class="heading-small text-muted mb-4">{{ __('Article information') }}</h6>
                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">{{ __('Article Name *  ') }}</label>
                                    <input type="text" name="name" id="input-name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Article Name') }}" value="{{ old('name') }}" required autofocus>

                                    @if ($errors->has('name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                </div>
                                <div class="row">
                                    <div class="col-8">
                                        <div class="form-group{{ $errors->has('rak') ? ' has-danger' : '' }}">
                                            <label class="form-control-label" for="input-category">{{ __('Category') }}</label><br>
                                                <select name="categories" class="form-control{{ $errors->has('categories') ? ' has-danger' : '' }}">
                                                @foreach ($categories as $x)
                                                    <option value="{{$x->id}}">{{$x->name}}</option>
                                                @endforeach
                                                </select>
                                                @if ($errors->has('categories'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('categories') }}</strong>
                                                    </span>
                                                @endif
                                            </input>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <a href="{{ route('categories.create') }}" class="btn btn-primary btn-round" style="margin-top:25px">{{ __('Add Category') }}</a>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
