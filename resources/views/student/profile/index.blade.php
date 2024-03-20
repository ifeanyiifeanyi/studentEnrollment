@extends('student.layouts.studentLayout')

@section('title', "Profile")
@section('css')

@endsection

@section('student')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-5">

                <!-- Profile Image -->
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <img src="{{ empty($user->student->photo) ? " https://placehold.it/150x100" :
                                asset($user->student->photo) }}" class="profile-user-img img-fluid img-circle"
                            alt="User profile picture">
                        </div>

                        <h3 class="profile-username text-center">{{ Str::title($user->first_name) }} {{
                            Str::title($user->last_name) }}, <small class="text-muted">{{ Str::lower($user->nameSlug)
                                }}</small></h3>

                        <p class="text-muted text-center">{{ Str::title($user->other_names) }}</p>

                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>Phone Number</b> <a class="float-right text-light">{{ $user->student->phone }}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Email Address</b> <a class="float-right text-light">{{ Str::lower($user->email)
                                    }}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Last Login</b> <a class="float-right">{{
                                    $user->student->previous_login_at?->diffForHumans() ?? 'N/A' }}</a>
                            </li>
                        </ul>

                        <a href="#" class="btn btn-primary btn-block"><b>Update Account Password</b></a>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

                <!-- About Me Box -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">About Me</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <strong><i class="fas fa-book mr-1"></i> Education</strong>

                        <p class="text-muted">
                            B.S. in Computer Science from the University of Tennessee at Knoxville
                        </p>

                        <hr>

                        <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>

                        <p class="text-muted">Malibu, California</p>

                        <hr>

                        <strong><i class="fas fa-pencil-alt mr-1"></i> Skills</strong>

                        <p class="text-muted">
                            <span class="tag tag-danger">UI Design</span>
                            <span class="tag tag-success">Coding</span>
                            <span class="tag tag-info">Javascript</span>
                            <span class="tag tag-warning">PHP</span>
                            <span class="tag tag-primary">Node.js</span>
                        </p>

                        <hr>

                        <strong><i class="far fa-file-alt mr-1"></i> Notes</strong>

                        <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum
                            enim neque.</p>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
            <div class="col-md-7">
                <div class="card">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link active" href="#activity"
                                    data-toggle="tab">Activity</a></li>

                            </li>
                            <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Settings</a>
                            </li>
                        </ul>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane" id="activity">

                            </div>
                            <!-- /.tab-pane -->

                            <div class="active tab-pane" id="settings">
                                    <!-- general form elements -->
                                    <div class="card card-primary">
                                        <!-- form start -->
                                        <form>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="first_name">First Name</label>
                                                            <input name="first_name" type="text" class="form-control" id="first_name" value="{{ old('first_name', $user->first_name) }}"
                                                                placeholder="Enter first name">
                                                            @error('first_name')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="last_name">Last Name</label>
                                                            <input type="text" class="form-control" value="{{ old('last_name', $user->last_name) }}"
                                                                id="last_name" placeholder="Enter last name">
                                                            @error('last_name')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="other_names">Other Names</label>
                                                            <input name="other_names" type="text" class="form-control" id="other_names" value="{{ old('other_names', $user->other_names) }}"
                                                                placeholder="Enter first name">
                                                            @error('other_names')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="email">Email Address</label>
                                                            <input type="email" class="form-control" value="{{ old('email', $user->email) }}"
                                                                id="email" placeholder="Enter last name">
                                                            @error('email')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="phone">Phone Number</label>
                                                            <input name="phone" type="tel" class="form-control" id="phone" value="{{ old('phone', $user->student->phone) }}"
                                                                placeholder="Enter first name">
                                                            @error('phone')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="last_name">Gender</label>
                                                            <select name="gender" class="form-control" id="last_name" >
                                                                <option disabled selected value="">Select Gender</option>
                                                                <option value="male">Male</option>
                                                                <option value="female">Female</option>
                                                            </select>
                                                            @error('gender')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="religion">Religion</label>
                                                            <input name="religion" type="text" class="form-control" id="religion" value="{{ old('religion', $user->student->religion) }}"
                                                                placeholder="Enter first name">
                                                            @error('religion')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="dob">Date of Birth</label>
                                                            <input type="date" class="form-control" value="{{ old('dob', $user->student->dob) }}"
                                                                id="dob" placeholder="Enter date of birth">
                                                            @error('dob')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="secondary_school_attended">Secondary School Attended</label>
                                                            <input name="secondary_school_attended" type="text" class="form-control" id="secondary_school_attended" value="{{ old('secondary_school_attended', $user->student->secondary_school_attended) }}"
                                                                placeholder="Secondary school attended">
                                                            @error('secondary_school_attended')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="secondary_school_graduation_year">Year of Graduation</label>
                                                            <input type="date" class="form-control" value="{{ old('secondary_school_graduation_year', $user->student->secondary_school_graduation_year) }}"
                                                                id="secondary_school_graduation-year" placeholder="Year of graudation">
                                                            @error('secondary_school_graduation_year')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                

                                                <div class="form-group">
                                                    <label for="exampleInputFile">File input</label>
                                                    <div class="input-group">
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input"
                                                                id="exampleInputFile">
                                                            <label class="custom-file-label"
                                                                for="exampleInputFile">Choose file</label>
                                                        </div>
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">Upload</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                                    <label class="form-check-label" for="exampleCheck1">Check me
                                                        out</label>
                                                </div>
                                            </div>
                                            <!-- /.card-body -->

                                            <div class="card-footer">
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- /.card -->
                                <!-- /.tab-pane -->
                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
        </div>
        <!--/. container-fluid -->
</section>
@endsection


@section('js')

@endsection