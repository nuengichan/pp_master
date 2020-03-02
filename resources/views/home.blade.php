@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Disk Usage Compositions</div>

                <div class="card-body">


                    @if (session('status'))
                        <di v class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif


                    @if (empty($photos))
                      No Data
                    @endif

                    @if ($photos)
                      <div class="card-header">
                        <div class="row">
                          <div class="col-sm-4">Type</div>
                          <div class="col-sm-4">No of image</div> 
                          <div class="col-sm-4">Size</div>
                        </div>
                      </div>
                      @foreach ($photos as $photo)
                        <div class="card-body">
                          <div class="row">
                            <div class="col-md-4">{{ $photo['image_type'] }}</div>
                            <div class="col-md-4">{{ $photo['id'] }}</div>
                            <div class="col-md-4">{{ $photo['size'] }} KB</div>
                            </div> 
                        </div>
                      @endforeach
                    @endif
                  
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
