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
                    

                    @if ($photos)
                    
                      @foreach ($photos as $photo)

                     
                        <div class="card-header">  {{ $photo['id'] }} </div> 
                      @endforeach
                    @endif
                  
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
