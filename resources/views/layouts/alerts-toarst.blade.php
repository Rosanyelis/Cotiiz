toastr.options = {
    "closeButton": true,
    "debug": false,
    "newestOnTop": false,
    "progressBar": true,
    "positionClass": "toast-bottom-right",
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "5000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
}
@if (session('status'))
toastr.success('{{ session('status') }}', 'Exito!')
@endif
@if (session('success'))
toastr.success('{{ session('success') }}', 'Exito!')
@endif

@if (session('error'))
toastr.error('{{ session('error') }}', 'Error!')
@endif
