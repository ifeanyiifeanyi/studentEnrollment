@extends('admin.layouts.adminLayout')

@section('title', 'Manage Exam Subject')

@section('css')

@endsection

@section('admin')

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>@yield('title')</h1>
        </div>

        <div class="section-body">
            <div class="container">
                <div class="row">
                <div class="col-md-6 mx-auto card shadow p-5">
                    <h2>Add Exam Subjects</h2>
                    <form method="POST" action="{{ route('admin.exam.store') }}">
                        @csrf

                        <div class="form-group">
                            <label for="department">Department:</label>
                            <select name="department_id" id="department" class="form-control">
                                <option value="" selected disabled>Select Department</option>
                                @foreach($departments as $department)
                                <option value="{{ $department->id }}">{{ $department->name }}</option>
                                @endforeach
                            </select>
                            @error('department_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div id="subject-fields">
                            <div class="form-group">
                                <label for="exam_subject">Subject (JSON format):</label>
                                <input type="text" placeholder="Eg. Mathematics" name="exam_subject[]" class="form-control"  value="{{ old('exam_subject.0') }}">
                                @error('exam_subject.0')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="button" class="btn btn-success" id="add-subject">Add Subject</button>
                        </div>

                        <div class="form-group">
                            <label for="venue">Venue:</label>
                            <input type="text" placeholder="Eg. Complex 1B Housing .." name="venue" id="venue" class="form-control" >
                            @error('venue')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="date_time">Date and Time for the Exam:</label>
                            <input type="datetime-local" name="date_time" id="date_time" class="form-control" >
                            @error('date_time')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
        </div>
    </section>
</div>
@endsection



@section('js')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('add-subject').addEventListener('click', function () {
            var subjectFields = document.getElementById('subject-fields');
            var newSubjectField = document.createElement('div');
            newSubjectField.classList.add('form-group');
            newSubjectField.innerHTML = `
                <label for="subjects">Subject (JSON format):</label>
                <input type="text" placeholder="Eg. Mathematics" name="exam_subject[]" value="{{ old('exam_subject.*') }}" class="form-control" >
                @error('exam_subject.*')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            `;
            subjectFields.appendChild(newSubjectField);
        });
    });
</script>
@endsection