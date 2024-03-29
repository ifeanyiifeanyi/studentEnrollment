<form wire:submit.prevent='register'>
    {{-- step on starts --}}
    <div class="step-one">
        <div class="shadow card">
            <div class="text-white card-header bg-secondary">
                STEP 1 OF 5, PERSONAL DETAILS
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="first_name">First Name</label>
                            <input wire:model.lazy="first_name" type="text" class="form-control" id="first_name" placeholder="Enter First Name"
                                required>
                            @error('first_name')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="last_name">Last Name</label>
                            <input wire:model.lazy="last_name" type="text" class="form-control" id="last_name" placeholder="Enter Last Name"
                                required>
                            @error('last_name')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="other_names">Other Names</label>
                            <input wire:model.lazy="other_names" type="text" class="form-control" id="other_names" placeholder="Other Names .."
                                required>
                            @error('other_names')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input wire:model.lazy="email" type="email" class="form-control" id="email"
                                 placeholder="Enter Email Address"
                                required>
                            @error('email')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="phone">Phone Number</label>
                            <input wire:model.lazy="phone" type="tel" class="form-control" id="phone"
                                 placeholder="Enter Phone Number"
                                required>
                            @error('phone')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="gender">Gender:</label>
                            <select wire:model.lazy="gender" id="gender" class="form-control">
                                <option value="" disabled>Select Gender</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                            @error('gender')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="religion">Religion</label>
                            <input wire:model.lazy="religion" type="text" class="form-control" id="religion" placeholder="Religion"
                                required>
                            @error('religion')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="dob">Date of Birth</label>
                            <input wire:model.lazy="dob" type="date" class="form-control" id="dob" required>
                            @error('dob')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="nin">NIN</label>
                            <input wire:model.lazy="nin" type="text" class="form-control" id="nin" 
                                placeholder="National Identification Number" required>
                            @error('nin')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="country">Country of Origin</label>
                            <select id="country" class="form-control" wire:model.lazy="country"
                                wire:change="countrySelected">
                                <option value="">Select Country</option>
                                <option value="Nigeria">Nigeria</option>
                                <option value="Other">Other</option>
                            </select>
                            @error('country') <span class="error">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    @if ($country == 'Nigeria')
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="state">State</label>
                            <select id="state" class="form-control" wire:model.lazy="state" wire:change="stateSelected">
                                <option value="">Select State</option>
                                @foreach ($states as $state)
                                <option value="{{ $state }}">{{ $state }}</option>
                                @endforeach
                            </select>
                            @error('state') <span class="error">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="localGovernment">Local Government</label>
                            <select id="localGovernment" class="form-control" wire:model.lazy="localGovernment">
                                <option value="">Select Local Government</option>
                                @foreach ($localGovernments as $localGovernment)
                                <option value="{{ $localGovernment }}">{{ $localGovernment }}</option>
                                @endforeach
                            </select>
                            @error('localGovernment') <span class="error">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    @else
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="state">State/Province</label>
                            <input type="text" placeholder="State/Province" id="state" class="form-control"
                                wire:model.lazy="state">
                            @error('state') <span class="error">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="localGovernment">City/Local Government</label>
                            <input type="text" placeholder="City/Local Government" id="localGovernment"
                                class="form-control" wire:model.lazy="localGovernment">
                            @error('localGovernment') <span class="error">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    @endif

                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="current_residence_address">Current Residence Address</label>
                            <input wire:model.lazy="current_residence_address" type="text" class="form-control"
                                id="current_residence_address"
                                placeholder="Enter current_residence_address" required>
                            @error('current_residence_address')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="permanent_residence_address">Permanent Residence Address</label>
                            <input wire:model.lazy="permanent_residence_address" type="text" class="form-control"
                                id="permanent_residence_address"
                                placeholder="Enter permanent_residence_address" required>
                            @error('permanent_residence_address')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="guardian_name">Guardian/Parent</label>
                            <input wire:model.lazy="guardian_name" type="text" class="form-control" id="guardian_name"
                                placeholder="Guardian / Parent Name" />
                            @error('guardian_name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="guardian_phone_number">Guardian/Parent Phone number</label>
                            <input wire:model.lazy="guardian_phone_number" type="text" class="form-control"
                                id="guardian_phone_number" />
                            @error('guardian_phone_number')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="guardian_address">Guardian/Parent Address</label>
                            <input wire:model.lazy="guardian_address" type="text" class="form-control" id="guardian_address" />
                            @error('guardian_address')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- step one ends --}}

    {{-- step two starts --}}
    <div class="step-two">
        <div class="shadow card">
            <div class="text-white card-header bg-secondary">
                STEP 2 OF 5, ACADEMIC DETAILS
            </div>
            <div class="card-body">

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="secondary_school_attended">Secondary School Attended</label>
                            <input wire:model.lazy="secondary_school_attended" type="text" class="form-control"
                                id="secondary_school_attended"
                                placeholder="Secondary School Attended" />
                            @error('secondary_school_attended')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="secondary_school_graduation_year">Graduation Year</label>
                            <input wire:model.lazy="secondary_school_graduation_year" type="date" class="form-control"
                                id="secondary_school_graduation_year"
                                placeholder="Secondary School Graduation Year" />
                            @error('secondary_school_graduation_year')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="secondary_school_certificate_type">Certificate Obtained</label>
                            <input wire:model.lazy="secondary_school_certificate_type" type="text" class="form-control"
                                id="secondary_school_certificate_type"
                                placeholder="Secondary School Certificate obtained" />
                            @error('secondary_school_certificate_type')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="jamb_reg_no">Jamb Registration Number</label>
                            <input wire:model.lazy="jamb_reg_no" type="text" class="form-control" id="jamb_reg_no"
                                placeholder="Secondary School Attended" />
                            @error('jamb_reg_no')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="jamb_score">Jamb Score</label>
                            <input wire:model.lazy="jamb_score" type="text" class="form-control" id="jamb_score"
                                placeholder="Jamb Score" />
                            @error('jamb_score')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- step two ends --}}

    {{-- step three starts --}}
    <div class="step-three">
        <div class="shadow card">
            <div class="text-white card-header bg-info">
                STEP 3 OF 5, SELECT DEPARTMENT(PROGRAM OF CHOICE)
            </div>
            <div class="card-body">

                <div class="row">
                    <div class="mx-auto mt-5 col-md-6">
                        <div class="form-group">
                            <label for="department_id">Select Department</label>
                            <select wire:model="department_id" class="form-control" id="department_id">
                                <option selected disabled>Select Department(Program of choice)</option>
                                @forelse ($departments as $department)
                                <option value="{{ $department->id }}">{{ Str::title($department->name) }}</option>
                                @empty

                                @endforelse
                            </select>
                            @error('department_id')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <hr>
            </div>
        </div>
    </div>
    {{-- step three ends --}}

    {{-- step four starts --}}
    <div class="step-four">
        <div class="shadow card">
            <div class="text-white card-header bg-info">
                STEP OF 5, ENTER OLEVEL EXAM SUBJECTS AND SCORE <small>Not less than 8 subject for any sitting</small>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label>Number of Sittings:</label>
                    <div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" wire:model="sittings" value="1"
                                wire:click="$set('subjects2', [])">
                            <label class="form-check-label">One Sitting</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" wire:model="sittings" value="2"
                                wire:click="$set('subjects1', [])">
                            <label class="form-check-label">Two Sittings</label>
                        </div>
                    </div>
                </div>
                @if ($sittings === 1)
                <div class="form-group">
                    <label>Exam Board:</label>
                    <select wire:model="examBoard1" class="form-control">
                        <option value="waec">WAEC</option>
                        <option value="neco">NECO</option>
                        <option value="gce">GCE</option>
                    </select>
                </div>
                @else
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Exam Board 1:</label>
                            <select wire:model="examBoard1" class="form-control">
                                <option value="waec">WAEC</option>
                                <option value="neco">NECO</option>
                                <option value="gce">GCE</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Exam Board 2:</label>
                            <select wire:model="examBoard2" class="form-control">
                                <option value="waec">WAEC</option>
                                <option value="neco">NECO</option>
                                <option value="gce">GCE</option>
                            </select>
                        </div>
                    </div>
                </div>
                @endif

                <div class="row">
                    <div class="col-md-6">
                        <h3>Sitting 1</h3>
                        @foreach ($subjects1 as $index => $subject)
                        <div class="row form-group">
                            <div class="col-md-6">
                                <input type="text" wire:model="subjects1.{{ $index }}.subject" placeholder="Subject"
                                    class="form-control">
                            </div>
                            <div class="col-md-4">
                                <input type="number" wire:model="subjects1.{{ $index }}.score" placeholder="Score"
                                    min="0" max="100" class="form-control">
                            </div>
                            <div class="col-md-2">
                                <button type="button" wire:click="removeSubject(1, {{ $index }})"
                                    class="btn btn-danger">Remove</button>
                            </div>
                        </div>
                        @endforeach
                        <button type="button" wire:click="addSubject(1)" class="btn btn-primary">Add Subject</button>
                    </div>

                    <div class="col-md-6">
                        @if ($sittings == 2)
                        <h3>Sitting 2</h3>
                        @foreach ($subjects2 as $index => $subject)
                        <div class="row form-group">
                            <div class="col-md-6">
                                <input type="text" wire:model="subjects2.{{ $index }}.subject" placeholder="Subject"
                                    class="form-control">
                            </div>
                            <div class="col-md-4">
                                <input type="number" wire:model="subjects2.{{ $index }}.score" placeholder="Score"
                                    min="0" max="100" class="form-control">
                            </div>
                            <div class="col-md-2">
                                <button type="button" wire:click="removeSubject(2, {{ $index }})"
                                    class="btn btn-danger">Remove</button>
                            </div>
                        </div>
                        @endforeach
                        <button type="button" wire:click="addSubject(2)" class="btn btn-primary">Add Subject</button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- step four ends --}}

    {{-- step five starts --}}
    <div class="step-five">
        <div class="shadow card">
            <div class="text-white card-header bg-primary">
                STEP 5 OF 5, SUBMIT COPIES OF ALL REQUIRED DOCUMENTS
            </div>
            <div class="card-body">

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="document_medical_report">Submit Medical Report</label>
                            <input type="file" wire:model="document_medical_report" id="document_medical_report"
                                class="form-control">
                            @error('document_medical_report')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="document_birth_certificate">Birth Certificate</label>
                            <input type="file" wire:model="document_birth_certificate" id="document_birth_certificate"
                                class="form-control">
                            @error('document_birth_certificate')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="document_local_government_identification">LGA Identification</label>
                            <input type="file" wire:model="document_local_government_identification"
                                id="document_local_government_identification" class="form-control">
                            @error('document_local_government_identification')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="document_secondary_school_certificate_type">FSLC</label>
                            <input type="file"  wire:model="document_secondary_school_certificate_type"
                                id="document_secondary_school_certificate_type" class="form-control">
                            @error('document_secondary_school_certificate_type')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="passport_photo">Passport Photo</label>
                                    <input type="file" wire:model="passport_photo" id="passport_photo" class="form-control" capture accept="image/*" onChange="changeImg(this)">
                                    @error('passport_photo')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <img id="previewImage" src="{{ empty($passport_photo) ? asset('admin/assets/img/avatar/avatar-1.png') : asset($passport_photo) }}" alt="" class="img-fluid img-thumbnail w-50">

                            </div>
                        </div>

                    </div>
                </div>
                <hr>

                <div class="form-group mt-5">
                    <label for="terms" class="d-block">
                        <input type="checkbox" wire:model="terms" id="terms"> You must agree to our <a href=""
                            class="link">terms
                            and conditions.</a>
                    </label>
                    @error('terms')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
    </div>
    {{-- step five ends --}}


    <div class="action-buttons d-flex justify-content-between bg-white p-2 mb-5">
        <div></div>
        <button type="button" class="btn btn-secondary">Back</button>
        <button type="button" class="btn btn-primary">Next</button>
        <button type="submit" class="btn btn-success">Submit Application</button>
    </div>


</form>