@extends('student.layouts.studentLayout')

@section('title', "Application Manager")
@section('css')

@endsection

@section('student')
<section class="content">
    <div class="container-fluid">
        @livewire('student-application')

    </div>
    <!--/. container-fluid -->
</section>
@endsection




@section('js')
<script>
    document.addEventListener('livewire:load', function () {
        // Listen for changes in the file input
        Livewire.hook('afterDomUpdate', () => {
            const input = document.getElementById('passport_photo');
            const preview = document.getElementById('passport_photo_preview');
            
            input.addEventListener('change', function (event) {
                const file = this.files[0];
                if (file) {
                    // Display image preview
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        preview.innerHTML = `<img src="${e.target.result}" alt="Passport Photo11 Preview" style="max-width: 200px;">`;
                    };
                    reader.readAsDataURL(file);
                } else {
                    // Reset image preview if no file is selected
                    preview.innerHTML = '';
                }
            });
        });
    });
</script>
@endsection