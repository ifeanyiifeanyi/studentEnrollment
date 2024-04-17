@extends('admin.layouts.adminLayout')

@section('title', 'Active Application
')

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
        <div class="card-header">
          <h3 class="card-title">DataTable with default features</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>s/n</th>
                <th>Student</th>
                <th>Department</th>
                <th>Exam Score</th>
                <th>Admission</th>
              </tr>
            </thead>
            <tbody>
              {{-- @dd($applications[0]->admission_status) --}}
              @forelse ($applications as $ap)
              <tr>
                <td>{{ $loop->iteration }}</td>

                <td>

                  <p>{{ $ap->user->full_name }}</p>
                  
                </td>

                <td>{{ $ap->department->name }}</td>
                <td>{{ $ap->user->student->exam_score ?? 'Loading ...' }}</td>
                <td>{{ $ap->admission_status }}</td>
              </tr>
              @empty

              @endforelse



            </tbody>
            <tfoot>
              <tr>
                <th>s/n</th>
                <th>Student</th>
                <th>Department</th>
                <th>Exam Score</th>
                <th>Admission Status</th>
              </tr>
            </tfoot>
          </table>
          <div class="paginate text-center">
            {{ $applications->links() }}
          </div>
        </div>
        <!-- /.card-body -->
      </div>
    </div>
  </section>
</div>
@endsection



@section('js')

@endsection