<div class="row">
  <div class="col-xs-12">
    <ul class="nav nav-pills nav-justified thumbnail setup-panel">
      <li class="{{ Request::is('checkout/login') ? 'active' : 'disabled'}}"><a>
        <h4 class="list-group-item-heading">Login</h4>
      </a></li>
      <li class="{{ Request::is('checkout/address') ? 'active' : 'disabled'}}"><a>
        <h4 class="list-group-item-heading">Alamat</h4>
      </a></li>
      <li class="{{ Request::is('checkout/payment') ? 'active' : 'disabled'}}"><a>
        <h4 class="list-group-item-heading">Pembayaran</h4>
      </a></li>
    </ul>
  </div>
</div>
