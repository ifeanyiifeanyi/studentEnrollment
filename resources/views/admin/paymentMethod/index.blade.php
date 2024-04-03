@extends('admin.layouts.adminLayout')

@section('title', 'Payment Method Dashboard')

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

                        <form method="@if (isset($paymentMethod)) PUT @else POST @endif"
                            action="{{ isset($paymentMethod) ? route('admin.payment.update', $paymentMethod->id) : route('admin.payment.store') }}">
                            @csrf
                            @if (isset($paymentMethod))
                            @method('PUT')
                            @endif
                            @if (isset($paymentMethod))
                            <input type="hidden" name="id" value="{{ $paymentMethod->id }}">
                            @endif


                            <div class="form-group">
                                <label for="department">Payment Method:</label>
                                <input type="text" name="name" class="form-control"
                                    placeholder="Payment Method, Eg, Flutterwave"
                                    value="{{ old('name', isset($paymentMethod) ? $paymentMethod->name : '') }}">

                                @error('name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>


                            <div class="form-group">
                                <label for="venue">Description:</label>
                                <textarea class="summernote-simple" placeholder="Payment method description .."
                                    name="description" id="description"
                                    class="form-control">{{ old('description', isset($paymentMethod) ? $paymentMethod->description : '') }}</textarea>
                                @error('description')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>

                <div class="row">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <tr>
                                <th class="text-center pt-2">
                                    <div class="custom-checkbox custom-checkbox-table custom-control">
                                        <input type="checkbox" data-checkboxes="mygroup" data-checkbox-role="dad"
                                            class="custom-control-input" id="checkbox-all">
                                        <label for="checkbox-all" class="custom-control-label">&nbsp;</label>
                                    </div>
                                </th>
                                <th>s/n</th>
                                <th>Name</th>
                            </tr>



                            {{-- @dd($students) --}}

                            @forelse ($paymentMethods as $pay)

                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <div class="custom-checkbox custom-control">
                                        <input type="checkbox" data-checkboxes="mygroup" class="custom-control-input"
                                            id="checkbox-2">
                                        <label for="checkbox-2" class="custom-control-label">&nbsp;</label>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-inline-block">
                                        {!! Str::title($pay->name) !!}
                                    </div>
                                    <div class="table-links mb-3">
                                        <a href="">View</a>
                                        <div class="bullet"></div>
                                        <a href="{{route('admin.payment.manage', $pay->id) }}">Edit</a>
                                        <div class="bullet"></div>
                                        <a href="#" class="text-danger">Trash</a>
                                    </div>
                                </td>
                            </tr>

                            @empty
                            <div class="alert alert-danger text-center"><b>Not available</b></div>
                            @endforelse
                        </table>
                    </div>
                </div>


            </div>
        </div>
    </section>
</div>
@endsection



@section('js')

@endsection