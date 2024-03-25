@extends('admin.layouts.adminLayout')

@section('title', 'Student Management')

@section('css')

@endsection

@section('admin')

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>@yield('title')</h1>
        </div>

        <div class="section-body">
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>All Registered Students</h4>
                        </div>
                        <div class="card-body">
                            <div class="float-left">
                                <select class="form-control selectric">
                                    <option>Action For Selected</option>
                                    <option>Move to Draft</option>
                                    <option>Move to Pending</option>
                                    <option>Delete Pemanently</option>
                                </select>
                            </div>
                            <div class="float-right">
                                <form>
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Search">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="clearfix mb-3"></div>

                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <tr>
                                        <th class="text-center pt-2">
                                            <div class="custom-checkbox custom-checkbox-table custom-control">
                                                <input type="checkbox" data-checkboxes="mygroup"
                                                    data-checkbox-role="dad" class="custom-control-input"
                                                    id="checkbox-all">
                                                <label for="checkbox-all" class="custom-control-label">&nbsp;</label>
                                            </div>
                                        </th>
                                        <th>Name</th>
                                        <th>Phone Number</th>
                                        <th>Email</th>
                                        <th>Department</th>
                                        <th>Status</th>
                                    </tr>
                                    @forelse ($students as $student)
                                    <tr>
                                        <td>
                                            <div class="custom-checkbox custom-control">
                                                <input type="checkbox" data-checkboxes="mygroup"
                                                    class="custom-control-input" id="checkbox-2">
                                                <label for="checkbox-2" class="custom-control-label">&nbsp;</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="text-center mb-1">
                                                <img alt="image"
                                                    src="{{ empty($student->student->photo) ? asset('admin/assets/img/avatar/avatar-5.png') : asset($student->student->photo) }}"
                                                    class="rounded-circle" width="35" data-toggle="title"
                                                    title="{{ $student->last_name }}">
                                            </div>

                                            <div class="d-inline-block">
                                                {!! Str::title($student->full_name) !!}
                                            </div>

                                            <div class="table-links">
                                                <a href="#">View</a>
                                                <div class="bullet"></div>
                                                <a href="#">Edit</a>
                                                <div class="bullet"></div>
                                                <a href="#" class="text-danger">Trash</a>
                                            </div>
                                        </td>
                                        <td>
                                            <a href="tel:{{ $student->student->phone }}">{{ $student->student->phone
                                                }}</a>
                                        </td>
                                        <td>
                                            <a href="mailto:{{ $student->email }}">

                                                <div class="d-inline-block ml-1 link">{{ Str::lower($student->email) }}</div>
                                            </a>
                                        </td>
                                        <td>Department</td>
                                        <td>
                                            <div class="badge badge-primary">Published</div>
                                        </td>
                                    </tr>
                                    @empty
                                    <div class="alert alert-danger text-center"><b>Not available</b></div>
                                    @endforelse
                                </table>
                            </div>
                            <div class="float-right">
                                {{ $students->links() }}
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