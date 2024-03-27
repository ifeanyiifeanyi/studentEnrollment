<form action="">
    {{-- step on starts --}}
    <div class="step-one">
        <div class="shadow card">
            <div class="text-white card-header bg-secondary">
                STEP 1 OF 4, PERSONAL DETAILS
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="first_name">First Name</label>
                            <input name="first_name" type="text" class="form-control" id="first_name"
                                value="{{ old('first_name', $user->first_name ?? '') }}" placeholder="Enter First Name"
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
                            <input name="last_name" type="text" class="form-control" id="last_name"
                                value="{{ old('last_name', $user->last_name ?? '') }}" placeholder="Enter Last Name"
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
                            <input name="other_names" type="text" class="form-control" id="other_names"
                                value="{{ old('other_names', $user->other_names ?? '') }}" placeholder="Other Names .."
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
                            <input name="email" type="email" class="form-control" id="email"
                                value="{{ old('email', $user->email ?? '') }}" placeholder="Enter Email Address"
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
                            <input name="phone" type="tel" class="form-control" id="phone"
                                value="{{ old('phone', $user->student->phone ?? '') }}" placeholder="Enter Phone Number"
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
                            <label for="gender">Gender</label>
                            <select name="gender" id="gender" class="form-control">
                                <option disabled>Select Gender</option>

                                <option value="male" {{ old('gender')=='male' || (isset($user) && $user->student->gender
                                    == 'male') ? 'selected' : '' }}>Male</option>

                                <option value="female" {{ old('gender')=='female' || (isset($user) && $user->
                                    student->gender == 'female') ? 'selected' : '' }}>Female</option>
                            </select>

                            @error('phone')
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
                            <input name="religion" type="text" class="form-control" id="religion"
                                value="{{ old('religion', $user->student->religion ?? '') }}" placeholder="Religion"
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
                            <input name="dob" type="date" class="form-control" id="dob"
                                value="{{ old('dob', $user->student->dob ?? '') }}" required>
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
                            <input name="nin" type="text" class="form-control" id="nin"
                                value="{{ old('nin', $user->student->nin ?? '') }}"
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
                            <select id="country" class="form-control" wire:model="country"
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
                            <select id="state" class="form-control" wire:model="state" wire:change="stateSelected">
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
                            <select id="localGovernment" class="form-control" wire:model="localGovernment">
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
                                wire:model="state">
                            @error('state') <span class="error">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="localGovernment">City/Local Government</label>
                            <input type="text" placeholder="City/Local Government" id="localGovernment"
                                class="form-control" wire:model="localGovernment">
                            @error('localGovernment') <span class="error">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    @endif

                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="current_residence_address">Current Residence Address</label>
                            <input name="current_residence_address" type="text" class="form-control"
                                id="current_residence_address"
                                value="{{ old('current_residence_address', $user->student->current_residence_address ?? '') }}"
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
                            <input name="permanent_residence_address" type="text" class="form-control"
                                id="permanent_residence_address"
                                value="{{ old('permanent_residence_address', $user->student->permanent_residence_address ?? '') }}"
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
                            <input name="guardian_name" type="text" class="form-control" id="guardian_name" value="{{ old('guardian_name', $user->student->guardian_name ?? "") }}" placeholder="Guardian / Parent Name" />
                            @error('guardian_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="guardian_phone_number">Guardian/Parent Phone number</label>
                            <input name="guardian_phone_number" type="text" class="form-control" id="guardian_phone_number" value="{{ old('guardian_phone_number', $user->student->guardian_phone_number ?? "") }}" />
                            @error('guardian_phone_number')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="guardian_address">Guardian/Parent Address</label>
                            <input name="guardian_address" type="text" class="form-control" id="guardian_address" value="{{ old('guardian_address', $user->student->guardian_address ?? "") }}" />
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

    {{-- step two starts  --}}
    <div class="step-two">
        <div class="shadow card">
            <div class="text-white card-header bg-secondary">
                STEP 2 OF 4, ACADEMIC DETAILS
            </div>
            <div class="card-body">
                
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="secondary_school_attended">Secondary School Attended</label>
                            <input name="secondary_school_attended" type="text" class="form-control" id="secondary_school_attended" value="{{ old('secondary_school_attended', $user->student->secondary_school_attended ?? "") }}" placeholder="Secondary School Attended" />
                            @error('secondary_school_attended')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="secondary_school_graduation_year">Graduation Year</label>
                            <input name="secondary_school_graduation_year" type="date" class="form-control" id="secondary_school_graduation_year" value="{{ old('secondary_school_graduation_year', $user->student->secondary_school_graduation_year ?? "") }}" placeholder="Secondary School Graduation Year" />
                            @error('secondary_school_graduation_year')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="secondary_school_certificate_type">Certificate Obtained</label>
                            <input name="secondary_school_certificate_type" type="text" class="form-control" id="secondary_school_certificate_type" value="{{ old('secondary_school_certificate_type', $user->student->secondary_school_certificate_type ?? "") }}" placeholder="Secondary School Certificate obtained" />
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
                            <input name="jamb_reg_no" type="text" class="form-control" id="jamb_reg_no" value="{{ old('jamb_reg_no', $user->student->jamb_reg_no ?? "") }}" placeholder="Secondary School Attended" />
                            @error('jamb_reg_no')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- step two ends  --}}
    
    {{-- step three starts  --}}
    <div class="step-three">
        <div class="shadow card">
            <div class="text-white card-header bg-info">
                STEP 3 OF 4, SELECT DEPARTMENT(PROGRAM OF CHOICE)
            </div>
            <div class="card-body">
                
                <div class="row">
                    <div class="mx-auto mt-5 col-md-6">
                        <div class="form-group">
                            <label for="department_id">Select Department</label>
                            <select name="department_id" class="form-control" id="department_id">
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
    {{-- step three ends  --}}


    {{-- step four starts  --}}
    <div class="step-four">
        <div class="shadow card">
            <div class="text-white card-header bg-primary">
                STEP 4 OF 4, SUBMIT COPIES OF ALL REQUIRED DOCUMENTS
            </div>
            <div class="card-body">
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="department_id">Select Department</label>
                            <input type="file" name="" id="">
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
    {{-- step four ends  --}}
</form>