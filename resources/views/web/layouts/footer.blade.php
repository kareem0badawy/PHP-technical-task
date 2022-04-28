
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>
<script src="{{ asset('select2.full.min.js') }}"></script>

<script>
    $(function () {
        $('.select2bs4').select2({theme: 'bootstrap4'})
        $('.select2').select2()
    })
</script>

@include('sweetalert::alert')

<script>
   var path = "{{ route('autocomplete')  }}";
   $('#search').typeahead({
       source:  function (query, process) {
       return $.get(path, { word: query }, function (data) {
               return process(data.data);
           });
       },
       afterSelect: function (data) {
          window.location.replace(`/products/${data.id}`);
      }
   });
 </script>
</body>
</html>