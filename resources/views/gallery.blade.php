@extends('layouts.app')

@section('content')

<body>
<div class="container">
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Gallery</div>
            <head>
                <meta name="_token" content="{{csrf_token()}}"/>
                <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css">
                <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/dropzone.js"></script>
            </head>
            <form method="post" action="{{url('/Gallery')}}" enctype="multipart/form-data"
                    class="dropzone" id="dropzone">
                @csrf
            </form>
        </div>
    </div>
</div>    
</div>

<script type="text/javascript">
    Dropzone.options.dropzone =
        {
            maxFilesize: 10,
            acceptedFiles: ".jpeg,.jpg,.png,.gif",
            addRemoveLinks: true,
            timeout: 50000,
            init: function(){
                    this.on("error", function(file, errorMessage) {
                        alert("error : " + errorMessage );
                    });

                    this.on('maxfilesexceeded', function (file) {
                    this.removeAllFiles();
                    this.addFile(file);
                    });
            },
            removedfile: function (file) {
                var name = file.upload.filename;
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    },
                    type: 'POST',
                    url: '{{ url("/delete") }}',
                    data: {filename: name},
                    success: function (data) {
                        console.log("File has been successfully removed!!");
                    },
                    error: function (e) {
                        console.log(e);
                    }
                });
                var fileRef;
                return (fileRef = file.previewElement) != null ?
                    fileRef.parentNode.removeChild(file.previewElement) : void 0;
            },

            success: function (file, response) {
                console.log(response);
            },
            error: function (file, response) {
                return false;
            }
        };
</script>
@endsection