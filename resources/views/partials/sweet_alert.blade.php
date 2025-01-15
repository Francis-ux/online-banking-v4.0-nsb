@if (session()->has('success'))
    <script>
        swal("Success...", "{{ session()->get('success') }}", "success");
    </script>
@elseif (session()->has('error'))
    <script>
        swal("Error...", "{{ session()->get('error') }}", "error");
    </script>
@endif
