@extends('admin.layouts.adminLayout')

@section('title', 'Create Admin')

@section('css')

@endsection

@section('admin')

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>@yield('title')</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-md-6 mx-auto">
                    <div class="card">
                        <div class="card-body">
                            <form action="" enctype="multipart/form-data">
                                @csrf
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection



@section('js')

@endsection