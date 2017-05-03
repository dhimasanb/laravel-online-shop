/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId])
/******/ 			return installedModules[moduleId].exports;
/******/
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// identity function for calling harmony imports with the correct context
/******/ 	__webpack_require__.i = function(value) { return value; };
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 42);
/******/ })
/************************************************************************/
/******/ ({

/***/ 10:
/***/ (function(module, exports) {

$(document).ready(function () {
  $(document.body).on('click', '.js-submit-confirm', function (event) {
    event.preventDefault();
    var $form = $(this).closest('form');
    var $el = $(this);
    var text = $el.data('confirm-message') ? $el.data('confirm-message') : 'Kamu tidak akan bisa membatalkan proses ini!';

    swal({
      title: 'Kamu yakin?',
      text: text,
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#DD6B55',
      confirmButtonText: 'Yap, lanjutkan!',
      cancelButtonText: 'Batal',
      closeOnConfirm: true
    }, function () {
      $form.submit();
    });
  });

  $('.js-selectize').selectize({
    sortField: 'text'
  });
  // checkout login form
  if ($('input[name=checkout_password]').length > 0 && $('input[name=is_guest]').length > 0 && $('input[name=is_guest]:checked').val() > 0) {
    $('input[name=checkout_password]').prop('disabled', true);
  }

  $('input[name=is_guest]').click(function () {
    var val = $('input[name=is_guest]:checked').val();
    if (val > 0) {
      $('input[name=checkout_password]').prop('disabled', true);
    } else {
      $('input[name=checkout_password]').prop('disabled', false);
    }
  });

  // dynamically hide new address form for authenticated user
  if ($('input[name="address_id"]').length > 0) {
    var selected = $('input[name="address_id"]:checked').val();
    if (selected === 'undefined' || selected !== 'new-address') {
      $('#js-new-address').hide();
    }

    $('input[name="address_id"]').change(function () {
      var selected = $('input[name="address_id"]:checked').val();
      if (selected === 'new-address') {
        $('#js-new-address').show();
      } else {
        $('#js-new-address').hide();
      }
    });
  }

  // checkout address new form
  if ($('#province_selector').length > 0) {
    var xhr;
    var province_selector, $province_selector;
    var regency_selector, $regency_selector;

    $province_selector = $('#province_selector').selectize({
      sortField: 'text',
      onChange: function onChange(value) {
        if (!value.length) {
          regency_selector.disable();
          regency_selector.clearOptions();
          return;
        }
        regency_selector.clearOptions();
        regency_selector.load(function (callback) {
          xhr && xhr.abort();
          xhr = $.ajax({
            url: '/address/regencies?province_id=' + value,
            success: function success(results) {
              regency_selector.enable();
              callback(results);
            },
            error: function error() {
              callback();
            }
          });
        });
      }
    });

    $regency_selector = $('#regency_selector').selectize({
      sortField: 'name',
      valueField: 'id',
      labelField: 'name',
      searchField: ['name']
    });

    province_selector = $province_selector[0].selectize;
    regency_selector = $regency_selector[0].selectize;
  }
});

/***/ }),

/***/ 42:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(10);


/***/ })

/******/ });