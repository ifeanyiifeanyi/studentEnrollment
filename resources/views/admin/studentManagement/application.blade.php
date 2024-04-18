@extends('admin.layouts.adminLayout')

@section('title', 'Active Applications')

@section('css')

@endsection

@section('admin')

<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>@yield('title')</h1>
    </div>

    <div class="section-body">
      <div class="card">
        <!-- /.card-header -->
        <div class="card-body">
          <div class="float-left">
            <form action="{{ route('applications.import') }}" method="post" enctype="multipart/form-data">
              @csrf
              <div class="form-group">
                <label for="exampleInputFile">Import File</label>
                <div class="input-group">
                  <div class="container">
                     @error('file')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                  <div class="custom-file">
                    <input type="file" name="file" class="custom-file-input w-100" id="exampleInputFile">
                   
                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                  </div>
                  <button type="submit" class="btn btn-primary ml-3">Import</button>

                </div>
              </div>
            </form>
          </div>
          <div class="float-right">
            <select class="form-control selectric">
              <option disabled selected>Select by Department</option>
              @forelse ($departments as $department)
              <option value="{{ $department->id }}">{{ Str::title($department->name) }}</option>
              @empty
              <option>Not available</option>

              @endforelse
            </select>
          </div>

          <div class="clearfix mb-3"></div>

          <div class="table-responsive">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th style="width: 20px">s/n</th>
                  <th style="width: auto !important">Student</th>
                  <th>Application No.</th>
                  <th>Department</th>
                  <th>Exam Score</th>
                  <th>Admission</th>
                </tr>
              </thead>
              <tbody>

                @forelse ($applications as $ap)
                <tr>
                  <td>{{ $loop->iteration }}</td>

                  <td>

                    <p>{{ $ap->user->full_name }}</p>

                  </td>
                  <td><p class="text-muted">{{ $ap->user->student->application_unique_number }}</p></td>

                  <td>{{ $ap->department->name }}</td>
                  <td>{{ $ap->user->student->exam_score ?? 'Loading ...' }}</td>
                  <td>
                    @if ($ap->admission_status == "pending")
                    <span class="badge bg-warning text-light">Pending <i class="fa fa-spinner fa-spin"></i> </span>
                    @elseif($ap->admission_status == "denied")
                    <span class="badge bg-danger text-light">Denied <i class="fa fa-times"></i></span>
                    @elseif($ap->admission_status == "approved")
                    <span class="badge bg-success text-light">Approved <i class="fa fa-check"></i></span>
                    @else
                    <span class="badge bg-danger text-light"></span>
                    @endif
                  </td>
                  </td>
                </tr>
                @empty
                <div class="alert alert-danger text-center">Not available</div>
                @endforelse



              </tbody>
              <tfoot>
                <tr>
                  <th>s/n</th>
                  <th>Student</th>
                  <th>Application No.</th>
                  <th>Department</th>
                  <th>Exam Score</th>
                  <th>Admission Status</th>
                </tr>
              </tfoot>
            </table>
          </div>
          <div class="paginate text-center">
            {{ $applications->links() }}
          </div>
        </div>
        <!-- /.card-body -->
      </div>

    </div>
</div>
</section>
</div>
@endsection



@section('js')

@endsection