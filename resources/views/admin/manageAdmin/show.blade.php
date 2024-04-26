@extends('admin.layouts.adminLayout')

@section('title', 'View Admin Manager Details')

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
                <div class="col-md-7 mx-auto">
                    <div class="card text-left">
                        <div class="card-body">
                            <a href="{{ route('admin.manage.admin') }}" class="btn btn-outline-primary">Back</a>
                            <div class="table-responsive">
                                <img src="{{ empty($user->admin->photo) ? 'null' : asset($user->admin->photo) }}" alt="" class="img-responsive"> <code>{{ $user->role }}</code>
                                <table class="table table-striped">
                                    <tr>
                                        <th>Name: </th>
                                        <td>{{ Str::title($user->full_name) }}</td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <td>{{ $user->email }}</td>
                                    </tr>
                                    <tr>
                                        <th>Phone</th>
                                        <td>{{ $user->admin->phone }}</td>
                                    </tr>
                                    <tr>
                                        <th>Address</th>
                                        <td>{{ $user->admin->address }}</td>
                                    </tr>
                                    <tr>
                                        <th>Last Login</th>
                                        <td>{{ $user->last_login_at?->diffForHumans() ?? 'N/A' }}</td>
                                    </tr>
                                </table>
                            </div>
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