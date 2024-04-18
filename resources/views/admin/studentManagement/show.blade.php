@extends('admin.layouts.adminLayout')

@section('title', 'Student Information')

@section('css')
<style>
  .card {
  margin-bottom: 1.5rem;
}

.card-header {
  background-color: #f8f9fa;
}

.list-group-item {
  border-left: 0;
  border-right: 0;
}

.list-group-item:first-child {
  border-top: 0;
}

.list-group-item:last-child {
  border-bottom: 0;
}

.badge {
  font-weight: normal;
}
</style>
@endsection

@section('admin')

<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>{{ Str::title($student->full_name) }}</h1> <br>
    </div>
    <div class="container">
      <h4 class="text-muted">Application No: <code>{{ $student->student->application_unique_number ?? 'Yet To Apply!!' }}</code></h4>
    </div>
    <div class="section-body">
      {{-- @dd($student) --}}
      <div class="row">
        <div class="col-md-6">
          <div class="table-responsive">
            <table class="table table-striped table-responsive">
              <thead class="">
                <tr>
                  <th colspan="2" class="text-center">
                    <p><img alt="image" src="{{ empty($student->student->passport_photo) ? asset('admin/assets/img/avatar/avatar-5.png') : 
                      Storage::url($student->student->passport_photo) }}" class="rounded-circle" width="200"
                      data-toggle="title" title="{{ $student->full_name }}"></p>
                    <div class="d-inline-block">
                      <p>{{ Str::title($student->student->nationality ?? "N/A")  }}</p>
                      <p class="text-muted">
                        @if ($student->student->nationality == "Nigeria")
                          <b>NIN: </b> {{ $student->student->nin  ?? "N/A"}}
                        @endif
                      </p>
                    </div>
                  </th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <th>Email Address</th>
                  <td>{{ Str::lower($student->email ?? "N/A") }}</td>
                </tr>
                <tr>
                  <th>Phone Number</th>
                  <td>{{ $student->student->phone ?? "N/A" }}</td>
                </tr>
                <tr>
                  <th>Gender</th>
                  <td>{{ Str::upper($student->student->gender ?? "N/A") }}</td>
                </tr>
                <tr>
                  <th>Religion</th>
                  <td>{{ $student->student->religion ?? "N/A"}}</td>
                </tr>
                <tr>
                  <th>Date of Birth</th>
                  <td>{{ $student->student->dob ?? "N/A"}}</td>
                </tr>
                <tr>
                  <tr>
                    <th>Genotype</th>
                    <th>Blood Group</th>
                  </tr>
                  <tr>
                    <td>{{ $student->student->genotype ?? 'N/A' }}</td>
                    <td>{{ $student->student->blood_group ?? 'N/A' }}</td>
                  </tr>
                </tr>
                <tr>
                  <th>Secondary School</th>
                  <td>
                    <p><b>School: </b>{{ Str::title($student->student->secondary_school_attended ?? 'N/A') }}</p>
                    <p><b>Graduated: </b> {{ $student->student->secondary_school_graduation_year ?? "N/A" }}</p>
                    <p><b>Cert: </b>{{ Str::upper($student->student->secondary_school_certificate_type ?? "N/A") }}</p>
                  </td>
                </tr>
                <tr>
                  <tr>
                    <th>Jamb Reg No</th>
                    <th>Jamb Score</th>
                  </tr>
                  <tr>
                    <td>{{ $student->student->jamb_reg_no ?? 'N/A' }}</td>
                    <td>{{ $student->student->jamb_score ?? 'N/A' }}</td>
                  </tr>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="container">
            <h1 class="text-center mb-4">SSCE Results</h1>
            @if ($student && $student->student && $student->student->olevel_exams)
              @php
                $olevel_exams = json_decode($student->student->olevel_exams, true);
              @endphp
          
              @if (isset($olevel_exams['sittings']) && $olevel_exams['sittings'] > 0)
                <div class="row">
                  <div class="col-md-6">
                    @for ($i = 1; $i <= $olevel_exams['sittings']; $i++)
                      <div class="card mb-4">
                        <div class="card-header">
                          <h5 class="mb-0">Sitting {{ $i }}</h5>
                        </div>
                        <div class="card-body">
                          <ul class="list-group">
                            @foreach ($olevel_exams['subjects']['sitting_' . $i] as $subject)
                              <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{ $subject['subject'] }}
                                <span class="badge badge-primary badge-pill">{{ $subject['score'] }}</span>
                              </li>
                            @endforeach
                          </ul>
                        </div>
                      </div>
                    @endfor
                  </div>
                  <div class="col-md-6">
                    @if (isset($olevel_exams['exam_boards']))
                      <div class="card">
                        <div class="card-header">
                          <h5 class="mb-0">Exam Boards</h5>
                        </div>
                        <div class="card-body">
                          <ul class="list-group">
                            @foreach ($olevel_exams['exam_boards'] as $key => $value)
                              <li class="list-group-item">{{ $key }}: {{ $value }}</li>
                            @endforeach
                          </ul>
                        </div>
                      </div>
                    @endif
                  </div>
                </div>
              @else
                <p>No SSCE results found for this student.</p>
              @endif
            @else
              <p>No SSCE results found for this student.</p>
            @endif
          </div>
        </div>
        <div class="col-md-6">
          <div class="card">
            
            <div class="card-body">
              <p><b>Permanent Address: </b> <blockquote>{{ $student->student->permanent_residence_address ?? "N/A"}}</blockquote></p>
              <p><b>Current Address: </b> <blockquote>{{ $student->student->current_residence_address ?? "N/A"}}</blockquote></p>
              <p><b>LGA, STATE, COUNTRY: </b> <blockquote>{{ $student->student->lga_origin ?? "N/A" }}, {{ $student->student->state_of_origin ?? "N/A" }}, {{ $student->student->country_of_origin ?? "N/A" }}</blockquote></p>
            </div>
          </div>

          <div class="card">
            <div class="card-body">
              <p><b>Guardian Name: </b> <blockquote>{{ $student->student->guardian_name ?? "N/A" }}</blockquote></p>
              <p><b>Guardian Phone Number: </b> <blockquote>{{ $student->student->guardian_phone_number ?? "N/A" }}</blockquote></p>
              <p><b>Guardian Address: </b> <blockquote>{{ $student->student->guardian_address ?? "N/A" }}</blockquote></p>
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