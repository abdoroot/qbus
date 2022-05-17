$(document).on('click', '.btn-confirm', function(e) {
    e.preventDefault();
    var form = $(this).closest('form'),
        title = $(this).data('title'),
        text = $(this).data('text');

    if(!title) title = "Are you sure?";
    if(!text) text = "You won't be able to revert this!";
    Swal.fire({
        title: title,
        text: text,
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#fb9678',
        cancelButtonColor: '#343a40',
        confirmButtonText: 'Confirm'
      })
      .then((result) => {
        if (result.value) {
          form.submit();
        }
      });
})

$.ajaxSetup({
  headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});