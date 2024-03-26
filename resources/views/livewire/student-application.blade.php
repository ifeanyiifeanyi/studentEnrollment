<form action="">
    {{-- step on starts  --}}
    <div class="step-one">
        <div class="card shadow">
            <div class="card-header bg-secondary text-white">
                STEP 1 OF 4, PERSONAL DETAILS
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="first_name">First Name</label>
                            <input name="first_name" type="text" class="form-control" id="first_name"
                                value="{{ old('first_name') }}" required>
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
                                value="{{ old('last_name') }}" required>
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
                                value="{{ old('other_names') }}" required>
                            @error('other_names')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- step one ends  --}}
</form>