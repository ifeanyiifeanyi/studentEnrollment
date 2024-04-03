<div class="main-sidebar sidebar-style-2">
  <aside id="sidebar-wrapper">
    <div class="sidebar-brand">
      <a href="{{ route('admin.dashboard') }}">Admin Dashboard</a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
      <a href="{{ route('admin.dashboard') }}">AMD</a>
    </div>
    <ul class="sidebar-menu">
      <li class="menu-header">Dashboard</li>
      <li class="dropdown">
        <a href="#" class="nav-link has-dropdown"><i class="fab fa-steam-symbol"></i><span>Manage School</span></a>
        <ul class="dropdown-menu">
          <li><a class="nav-link" href="{{ route('admin.manage.faculty') }}">Manage Faculty</a></li>
          <li><a class="nav-link" href="{{ route('admin.manage.department') }}">Manage Department</a></li>
        </ul>
      </li>
      <li class="dropdown">
        <a href="{{ route('admin.exam.manager') }}" class="nav-link has-dropdown" data-toggle="dropdown"><i
            class="fas fa-columns"></i> <span>Exam/Subject Manager</span></a>
        <ul class="dropdown-menu">
          <li><a class="nav-link" href="{{ route('admin.exam.manager') }}">Exam Manager</a></li>
          <li><a class="nav-link" href="{{ route('admin.exam.details') }}">Exam Details</a></li>
        </ul>
      </li>
      <li class="dropdown">
        <a href="{{ route('admin.student.management') }}" class="nav-link has-dropdown"><i class="fas fa-users"></i>
          <span>Student Management</span></a>
        <ul class="dropdown-menu">
          <li><a class="nav-link" href="{{ route('admin.student.management') }}">All Students</a></li>
          <li><a class="nav-link" href="bootstrap-badge.html">Active Applications</a></li>
          <li><a class="nav-link" href="bootstrap-breadcrumb.html">Breadcrumb</a></li>
        </ul>
      </li>
      <li class="dropdown">
        <a href="{{ route('admin.payment.manage') }}" class="nav-link has-dropdown"><i class="fas fa-coins"></i>
          <span>Payment Management</span></a>
        <ul class="dropdown-menu">
          <li><a class="nav-link" href="{{ route('admin.payment.manage') }}">Create Payment</a></li>
          <li><a class="nav-link" href="bootstrap-badge.html">Payment Types</a></li>
          <li><a class="nav-link" href="bootstrap-breadcrumb.html">All Payments</a></li>
        </ul>
      </li>

      <li><a class="nav-link" href="credits.html"><i class="fas fa-pencil-ruler"></i> <span>Credits</span></a></li>
    </ul>


  </aside>
</div>