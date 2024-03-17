<!-- General JS Scripts -->
<script src="{{ asset("") }}admin/assets/modules/jquery.min.js"></script>
<script src="{{ asset("") }}admin/assets/modules/popper.js"></script>
<script src="{{ asset("") }}admin/assets/modules/tooltip.js"></script>
<script src="{{ asset("") }}admin/assets/modules/bootstrap/js/bootstrap.min.js"></script>
<script src="{{ asset("") }}admin/assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
<script src="{{ asset("") }}admin/assets/modules/moment.min.js"></script>
<script src="{{ asset("") }}admin/assets/js/stisla.js"></script>

<!-- JS Libraies -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<!-- Page Specific JS File -->

<!-- Template JS File -->
<script src="{{ asset("") }}admin/assets/js/scripts.js"></script>
<script src="{{ asset("") }}admin/assets/js/custom.js"></script>
<script>
  @if(Session::has('message'))
    var type = "{{ Session::get('alert-type','info') }}"

    switch(type){
    case 'info':
    toastr.info(" {{ Session::get('message') }} ");
    break;

    case 'success':
    toastr.success(" {{ Session::get('message') }} ");
    break;

    case 'warning':
    toastr.warning(" {{ Session::get('message') }} ");
    break;

    case 'error':
    toastr.error(" {{ Session::get('message') }} ");
    break;
  }
@endif
</script>
@yield('js')