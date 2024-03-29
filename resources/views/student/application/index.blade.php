@extends('student.layouts.studentLayout')

@section('title', "Application Manager")
@section('css')
    
@endsection

@section('student')
<section class="content">
    <div class="container-fluid">
        @livewire('student-application')

    </div>
    <!--/. container-fluid -->
</section>
@endsection


@section('js')
<script>
    function changeImg(input) {
        let preview = document.getElementById('previewImage');
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                preview.src = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
  </script>
@endsection