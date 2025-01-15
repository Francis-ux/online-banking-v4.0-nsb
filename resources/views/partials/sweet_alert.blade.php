{{-- @if (session()->has('success'))
    <script>
        swal("Success...", "{{ session()->get('success') }}", "success");
    </script>
@elseif (session()->has('error'))
    <script>
        swal("Error...", "{{ session()->get('error') }}", "error");
    </script>
@endif --}}

@if (session()->has('success'))
    {{-- <script>
        Swal.fire({
            icon: "success",
            title: "Success",
            text: "{{ session()->get('success') }}",
        });
    </script> --}}
    <script>
        swal("{{ session()->get('success') }}", "", "success");
    </script>
@elseif (session()->has('error'))
    {{-- <script>
        Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "{{ session()->get('error') }}",
        });
    </script> --}}
    <script>
        swal("{{ session()->get('error') }}", "", "error");
    </script>
@endif
