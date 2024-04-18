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
                                    <option>Delete Pemanently</option>
                                </select>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-striped" id="myTable">
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
                                        <th>Email</th>
                                        <th>Date Join</th>
                                        <th>Application</th>
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
                                            <center>
                                                <div class="text-center mb-1">
                                                    <img alt="image" src="{{ empty($student->student->passport_photo) ? asset('admin/assets/img/avatar/avatar-5.png') : 
                                                            Storage::url($student->student->passport_photo) }}"
                                                        class="rounded-circle" width="35" data-toggle="title"
                                                        title="{{ $student->last_name }}">
                                                </div>

                                                <div class="d-inline-block">
                                                    {!! Str::title($student->full_name) !!}
                                                </div>
                                                <div class="table-links mb-3">
                                                    <a
                                                        href="{{ route('admin.show.student', $student->nameSlug) }}">View</a>
                                                    <div class="bullet"></div>
                                                    <a href="#">Edit</a>
                                                    <div class="bullet"></div>
                                                    <a href="#" class="text-danger">Trash</a>
                                                </div>
                                            </center>

                                        </td>
                                        <td>
                                            <a href="mailto:{{ $student->email }}">

                                                <div class="d-inline-block ml-1 link">{{ Str::lower($student->email) }}
                                                </div>
                                            </a>
                                            {{-- @dd($student->applications->department) --}}
                                            @if ($student->applications->isNotEmpty())
                                                @foreach ($student->applications as $application)
                                                    <p><b>Department</b>: {{ $application->department_name ?? 'N/A' }}</p>
                                                @endforeach
                                            @else
                                                <p><b>Department</b>: N/A</p>
                                            @endif
                                        </td>

                                        <td>{{ \Carbon\Carbon::parse($student->created_at)->format('jS F Y') }}</td>

                                        <td>
                                            @if ($student->applications->isNotEmpty())
                                            @if ($student->applications->contains('payment_id', '!=', null))
                                            <span class="badge bg-success text-light">Applied</span>
                                            @else
                                            <span class="badge bg-secondary text-light">Unknown</span>
                                            @endif
                                            @else
                                            <span class="badge bg-danger text-light">Not Applied</span>
                                            @endif
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