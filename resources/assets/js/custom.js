$(document).ready(function () {
  $(document.body).on('click', '.js-submit-confirm', function (event) {
    event.preventDefault()
    var $form = $(this).closest('form')
    var $el = $(this)
    var text = $el.data('confirm-message') ? $el.data('confirm-message') : 'Kamu tidak akan bisa membatalkan proses ini!'

  swal({
    title: 'Kamu yakin?',
    text: text,
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#DD6B55',
    confirmButtonText: 'Yap, lanjutkan!',
    cancelButtonText: 'Batal',
    closeOnConfirm: false
    },
    function () {
      swal("Dihapus!", "Berhasil dihapus.", "success");
      $form.submit()
    })
  })

  $('.js-selectize').selectize({
    sortField: 'text'
  })

  // checkout login form
  if ($('input[name=checkout_password]').length > 0 && $('input[name=is_guest]').length > 0 && $('input[name=is_guest]:checked').val() > 0) {
    $('input[name=checkout_password]').prop('disabled', true)
  }

  $('input[name=is_guest]').click(function () {
    var val = $('input[name=is_guest]:checked').val()
    if (val > 0) {
      $('input[name=checkout_password]').prop('disabled', true)
    } else {
      $('input[name=checkout_password]').prop('disabled', false)
    }
  })
})
