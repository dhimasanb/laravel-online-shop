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
      closeOnConfirm: true
    },
      function () {
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

  // dynamically hide new address form for authenticated user
  if ($('input[name="address_id"]').length > 0) {
    var selected = $('input[name="address_id"]:checked').val()
    if (selected === 'undefined' || selected !== 'new-address') {
      $('#js-new-address').hide()
    }

    $('input[name="address_id"]').change(function () {
      var selected = $('input[name="address_id"]:checked').val()
      if (selected === 'new-address') {
        $('#js-new-address').show()
      } else {
        $('#js-new-address').hide()
      }
    })
  }

  // checkout address new form
  if ($('#province_selector').length > 0) {
    var xhr
    var province_selector, $province_selector
    var regency_selector, $regency_selector

    $province_selector = $('#province_selector').selectize({
      sortField: 'text',
      onChange: function (value) {
        if (!value.length) {
          regency_selector.disable()
          regency_selector.clearOptions()
          return
        }
        regency_selector.clearOptions()
        regency_selector.load(function (callback) {
          xhr && xhr.abort()
          xhr = $.ajax({
            url: '/address/regencies?province_id=' + value,
            success: function (results) {
              regency_selector.enable()
              callback(results)
            },
            error: function () {
              callback()
            }
          })
        })
      }
    })

    $regency_selector = $('#regency_selector').selectize({
      sortField: 'name',
      valueField: 'id',
      labelField: 'name',
      searchField: ['name']
    })

    province_selector = $province_selector[0].selectize
    regency_selector = $regency_selector[0].selectize
  }

})
