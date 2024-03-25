@extends('admin.layouts.adminLayout')

@section('title', 'Update Exam Subject Details')

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
                        <h2>Update Exam Subjects</h2>
                        <form method="POST" action="{{ route('admin.exam.update', $exam->id) }}">
                            @csrf
                            @method('patch')
                            <div class="form-group">
                                <label for="department">Department:</label>
                                <select name="department_id" id="department" class="form-control">
                                    <option value="" selected disabled>Select Department</option>
                                    @foreach($departments as $department)
                                    <option {{ $exam->department_id == $department->id ? "selected" : "" }} value="{{
                                        $department->id }}">{{ $department->name }}</option>
                                    @endforeach
                                </select>
                                @error('department_id')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <hr>
                            @forelse (json_decode($exam->exam_subject) as $subject)
                            <div class="subject-fields form-group">
                                <label for="exam_subject">Subject (JSON format):</label>
                                <div class="input-group">
                                    <input type="text" placeholder="Eg. Mathematics" name="exam_subject[]"
                                        class="form-control" value="{{ old('exam_subject.*', $subject) }}">
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-danger remove-subject">Remove</button>
                                    </div>
                                </div>
                                @error('exam_subject.*')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        @empty
                            <div class="alert alert-danger">Try again later</div>
                        @endforelse
                        

                            <hr>
                            <div class="form-group">
                                <button type="button" class="btn btn-success" id="add-subject">Add Subject</button>
                            </div>

                            <div class="form-group">
                                <label for="venue">Venue:</label>
                                <input type="text" placeholder="Eg. Complex 1B Housing .." name="venue" id="venue"
                                    class="form-control" value="{{ old(" venue", $exam->venue) }}">
                                @error('venue')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="date_time">Date and Time for the Exam:</label>
                                <input type="datetime-local" name="date_time" id="date_time" class="form-control"
                                    value="{{ old('date_time', $exam->date_time) }}">
                                @error('date_time')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">Update</button>
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
        document.querySelectorAll('.remove-subject').forEach(function(button) {
            button.addEventListener('click', function () {
                button.closest('.subject-fields').remove();
            });
        });

        document.getElementById('add-subject').addEventListener('click', function () {
            var subjectFields = document.getElementById('subject-fields');
            var newSubjectField = document.createElement('div');
            newSubjectField.classList.add('subject-fields', 'form-group');
            newSubjectField.innerHTML = `
                <label for="subjects">Subject (JSON format):</label>
                <div class="input-group">
                    <input type="text" placeholder="Add another subject ..." name="exam_subject[]" class="form-control" >
                    <div class="input-group-append">
                        <button type="button" class="btn btn-danger remove-subject">Remove</button>
                    </div>
                </div>
            `;
            subjectFields.appendChild(newSubjectField);
            
            // Attach remove button event listener
            newSubjectField.querySelector('.remove-subject').addEventListener('click', function () {
                newSubjectField.remove();
            });
        });
    });
</script>

@endsection