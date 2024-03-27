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

@endsection