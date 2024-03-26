@extends('admin.layouts.adminLayout')

@section('title', 'Student Information')

@section('css')

@endsection

@section('admin')

<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>@yield('title')</h1>
    </div>

    <div class="section-body">
        {{-- @dd($student) --}}
    </div>
  </section>
</div>
@endsection



@section('js')

@endsection