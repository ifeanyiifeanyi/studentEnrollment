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
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>@yield('title')</h4>
                        </div>
                        <div class="card-body">
                            <div class="float-right mb-3">
                                <select class="form-control selectric">
                                    <option>Action For Selected</option>
                                    <option>Delete Pemanently</option>
                                </select>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped" id="table-1">
                                    <thead>
                                        <tr>
                                            <th class="text-center">
                                                <div class="custom-checkbox custom-control">
                                                    <input type="checkbox" data-checkboxes="mygroup"
                                                        data-checkbox-role="dad" class="custom-control-input"
                                                        id="checkbox-all">
                                                    <label for="checkbox-all"
                                                        class="custom-control-label">&nbsp;</label>
                                                </div>
                                            </th>
                                            <th>Student Name</th>
                                            <th>Department</th>
                                            <th>photo</th>
                                            <th>Application Date</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($students as $student)

                                        <tr>
                                            <td>
                                                <div class="custom-checkbox custom-control">
                                                    <input type="checkbox" data-checkboxes="mygroup"
                                                        class="custom-control-input" id="checkbox-1">
                                                    <label for="checkbox-1" class="custom-control-label">&nbsp;</label>
                                                </div>
                                            </td>
                                            <td>
                                                {{ Str::title($student->full_name) }}
                                                <p><code>{{ $student->student->application_unique_number }}</code></p>
                                                <div class="">
                                                    <a
                                                        href="{{ route('admin.show.student', $student->nameSlug) }}">View</a>
                                                    <div class="bullet"></div>
                                                    <a href="#">Edit</a>
                                                    <div class="bullet"></div>
                                                    <a href="#" class="text-danger">Trash</a>
                                                </div>

                                            </td>
                                            <td class="align-middle">
                                                @if ($student->applications->isNotEmpty())
                                                @foreach ($student->applications as $application)
                                                <p>{{ $application->department_name ?? 'N/A' }}</p>
                                                @endforeach
                                                @else
                                                <p>N/A</p>
                                                @endif
                                            </td>
                                            <td>
                                                <img alt="image" src="{{ empty($student->student->passport_photo) ? asset('admin/assets/img/avatar/avatar-5.png') : Storage::url($student->student->passport_photo) }}" class="rounded-circle" width="90"
                                                    data-toggle="title" title="{{ $student->last_name }}">
                                            </td>
                                            <td>
                                                @if ($student->applications->isNotEmpty())
                                                @foreach ($student->applications as $application)
                                                <p>
                                                    {{ \Carbon\Carbon::parse($application->created_at)->format('jS F Y') }}
                                                </p>
                                                @endforeach
        
                                                @else
        
                                                null
                                                @endif
                                            </td>
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
                                            <td><a href="#" class="btn btn-danger"><i class="fas fa-trash"></i></a></td>
                                        </tr>
                                        @empty

                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="float-right">
                            {{ $students->links() }}
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