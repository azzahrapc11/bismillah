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
                            <h6 class="heading-small text-muted mb-4">{{ __('Book information') }}</h6>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <strong>Nama Buku : {{$articles->name}}</strong>
                                                <a></a>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <strong>Created_at : {{$articles->created_at}}</strong>
                                                <a></a>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <strong>Updated_at : {{$articles->updated_at}}</strong>
                                                <a></a>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
