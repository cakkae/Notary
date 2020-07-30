<!-- Sidebar -->
<div class="bg-light border-right" id="sidebar-wrapper">
      <div class="sidebar-heading">APPLICATION</div>
      <div class="list-group list-group-flush">
      @if(Auth::check() && Auth::user()->hasRole('Owner'))
        <a href="<?= url('owner'); ?>" class="{{ (request()->segment(2) == 'dashboard' || request()->segment(2) == '') ? 'active' : '' }} list-group-item list-group-item-action bg-light">
          <div class="row">
            <div class="col-md-1">
              <i class="fal fa-tachometer-fast"></i>
            </div>
            <div class="col-md-9">
              Dashboard
            </div>
          </div> 
        </a>
        <a href="<?= url('/owner/company'); ?>" class="{{ (request()->segment(2) == 'company') ? 'active' : '' }} list-group-item list-group-item-action bg-light">
          <div class="row">
            <div class="col-md-1">
              <i class="fal fa-edit"></i>
            </div>
            <div class="col-md-9">
              Company
            </div>
          </div> 
        </a>
        <a href="<?= url('owner/accouting'); ?>" class="{{ (request()->segment(2) == 'accouting') ? 'active' : '' }} list-group-item list-group-item-action bg-light">
          <div class="row">
            <div class="col-md-1">
              <i class="fal fa-building"></i>
            </div>
            <div class="col-md-9">
              Accouting
            </div>
          </div> 
        </a>
        <a href="<?= url('owner/settings'); ?>" class="{{ (request()->segment(2) == 'settings') ? 'active' : '' }} list-group-item list-group-item-action bg-light">
          <div class="row">
            <div class="col-md-1">
              <i class="fal fa-cogs"></i>
            </div>
            <div class="col-md-9">
              Settings
            </div>
          </div> 
        </a>
        <a href="<?= url('shared/vendors'); ?>" class="{{ (request()->segment(2) == 'vendors') ? 'active' : '' }} list-group-item list-group-item-action bg-light">
          <div class="row">
            <div class="col-md-1">
              <i class="fal fa-user"></i>
            </div>
            <div class="col-md-9">
              Vendors
            </div>
          </div> 
        </a>
      </div>
      @endif

      @if(Auth::check() && Auth::user()->hasRole('Admin'))
        <a href="<?= url('admin/dashboard'); ?>" class="{{ (request()->segment(2) == 'dashboard' || request()->segment(2) == '') ? 'active' : '' }} list-group-item list-group-item-action bg-light">
          <div class="row">
            <div class="col-md-1">
              <i class="fal fa-tachometer-fast"></i>
            </div>
            <div class="col-md-9">
              Dashboard
            </div>
          </div> 
        </a>
        <a href="<?= url('/user'); ?>" class="{{ (request()->segment(2) == 'order') ? 'active' : '' }} list-group-item list-group-item-action bg-light">
          <div class="row">
            <div class="col-md-1">
              <i class="fal fa-edit"></i>
            </div>
            <div class="col-md-9">
              Order Edit
            </div>
          </div> 
        </a>
        <a href="<?= url('admin/dashboard'); ?>" class="{{ (request()->segment(2) == 'company') ? 'active' : '' }} list-group-item list-group-item-action bg-light">
          <div class="row">
            <div class="col-md-1">
              <i class="fal fa-building"></i>
            </div>
            <div class="col-md-9">
              Title Company
            </div>
          </div> 
        </a>
        <a href="<?= url('admin/notary'); ?>" class="{{ (request()->segment(2) == 'notary') ? 'active' : '' }} list-group-item list-group-item-action bg-light">
          <div class="row">
            <div class="col-md-1">
              <i class="fal fa-stamp"></i>
            </div>
            <div class="col-md-9">
              Notary
            </div>
          </div> 
        </a>
        <a href="<?= url('admin/users'); ?>" class="{{ (request()->segment(2) == 'users') ? 'active' : '' }} list-group-item list-group-item-action bg-light">
          <div class="row">
            <div class="col-md-1">
              <i class="fal fa-users"></i>
            </div>
            <div class="col-md-9">
              Users
            </div>
          </div> 
        </a>
        <a href="<?= url('admin/reports'); ?>" class="{{ (request()->segment(2) == 'reports') ? 'active' : '' }} list-group-item list-group-item-action bg-light">
          <div class="row">
            <div class="col-md-1">
              <i class="fal fa-file-chart-pie"></i>
            </div>
            <div class="col-md-9">
              Reports
            </div>
          </div> 
        </a>
        <a href="<?= url('admin/settings'); ?>" class="{{ (request()->segment(2) == 'settings') ? 'active' : '' }} list-group-item list-group-item-action bg-light">
          <div class="row">
            <div class="col-md-1">
              <i class="fal fa-cogs"></i>
            </div>
            <div class="col-md-9">
              Settings
            </div>
          </div> 
        </a>
      </div>
      @endif
      @if(Auth::check() && Auth::user()->hasRole('Vendor'))
        <a href="<?= url('vendor/dashboard'); ?>" class="{{ (request()->segment(2) == 'dashboard' || request()->segment(2) == '') ? 'active' : '' }} list-group-item list-group-item-action bg-light">
          <div class="row">
            <div class="col-md-1">
              <i class="fal fa-tachometer-fast"></i>
            </div>
            <div class="col-md-9">
              Dashboard
            </div>
          </div> 
        </a>
        <a href="<?= url('vendor/settings'); ?>" class="{{ (request()->segment(2) == 'settings') ? 'active' : '' }} list-group-item list-group-item-action bg-light">
          <div class="row">
            <div class="col-md-1">
              <i class="fal fa-user-cog"></i>
            </div>
            <div class="col-md-9">
              Account Settings
            </div>
          </div> 
        </a>
        <a href="<?= url('vendor/documents'); ?>" class="{{ (request()->segment(2) == 'documents') ? 'active' : '' }} list-group-item list-group-item-action bg-light">
          <div class="row">
            <div class="col-md-1">
              <i class="fal fa-books"></i>
            </div>
            <div class="col-md-9">
              Documents 
            </div>
          </div> 
        </a>
        <a href="<?= url('vendor/coverage'); ?>" class="{{ (request()->segment(2) == 'coverage') ? 'active' : '' }} list-group-item list-group-item-action bg-light">
          <div class="row">
            <div class="col-md-1">
              <i class="fad fa-house-signal"></i>
            </div>
            <div class="col-md-9">
              Coverage
            </div>
          </div> 
        </a>
        <a href="<?= url('vendor/skills'); ?>" class="{{ (request()->segment(2) == 'skills') ? 'active' : '' }} list-group-item list-group-item-action bg-light">
          <div class="row">
            <div class="col-md-1">
              <i class="fal fa-graduation-cap"></i>
            </div>
            <div class="col-md-9">
              Skills and Experience
            </div>
          </div> 
        </a>
        <a href="<?= url('vendor/pricing'); ?>" class="{{ (request()->segment(2) == 'pricing') ? 'active' : '' }} list-group-item list-group-item-action bg-light">
          <div class="row">
            <div class="col-md-1">
              <i class="fal fa-dollar-sign"></i>
            </div>
            <div class="col-md-9">
              Pricing
            </div>
          </div> 
        </a>
        <a href="<?= url('vendor/hardware'); ?>" class="{{ (request()->segment(2) == 'hardware') ? 'active' : '' }} list-group-item list-group-item-action bg-light">
          <div class="row">
            <div class="col-md-1">
              <i class="fal fa-mouse-alt"></i>
            </div>
            <div class="col-md-9">
              Hardware
            </div>
          </div> 
        </a>
        <a href="<?= url('vendor/invoice'); ?>" class="{{ (request()->segment(2) == 'invoice') ? 'active' : '' }} list-group-item list-group-item-action bg-light">
          <div class="row">
            <div class="col-md-1">
              <i class="fal fa-file-invoice"></i>
            </div>
            <div class="col-md-9">
              Invoice
            </div>
          </div> 
        </a>
      </div>
      @endif
      @if(Auth::check() && Auth::user()->hasRole('User'))
        <a href="<?= url('user/orders'); ?>" class="{{ (request()->segment(2) == 'orders' || request()->segment(2) == '') ? 'active' : '' }} list-group-item list-group-item-action bg-light">
          <div class="row">
            <div class="col-md-1">
              <i class="fal fa-tachometer-fast"></i>
            </div>
            <div class="col-md-9">
              Orders
            </div>
          </div> 
        </a>
        <a href="<?= url('user/settings'); ?>" class="{{ (request()->segment(2) == 'settings') ? 'active' : '' }} list-group-item list-group-item-action bg-light">
          <div class="row">
            <div class="col-md-1">
              <i class="fal fa-user-cog"></i>
            </div>
            <div class="col-md-9">
              Profile
            </div>
          </div> 
        </a>
      </div>
      @endif
    </div>
    <!-- /#sidebar-wrapper -->