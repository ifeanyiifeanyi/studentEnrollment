<div class="main-sidebar sidebar-style-2">
  <aside id="sidebar-wrapper">
    <div class="sidebar-brand">
      <a href="{{ route('admin.dashboard') }}"
        class="{{ (request()->routeIs('admin.dashboard')) ? 'active' : '' }}">Admin Dashboard</a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
      <a href="{{ route('admin.dashboard') }}"
        class="{{ (request()->routeIs('admin.dashboard')) ? 'active' : '' }}">AMD</a>
    </div>
    <ul class="sidebar-menu">
      <li class="menu-header">Dashboard</li>
      <li
        class="dropdown {{ (request()->routeIs('admin.manage.faculty') || request()->routeIs('admin.manage.department')) ? 'parent' : '' }}">
        <a href="#" class="nav-link has-dropdown"><i class="fab fa-steam-symbol"></i><span>Manage School</span></a>
        <ul class="dropdown-menu">
          <li><a class="nav-link {{ (request()->routeIs('admin.manage.faculty')) ? 'active' : '' }}"
              href="{{ route('admin.manage.faculty') }}">Manage Faculty</a></li>
          <li><a class="nav-link {{ (request()->routeIs('admin.manage.department')) ? 'active' : '' }}"
              href="{{ route('admin.manage.department') }}">Manage Department</a></li>
        </ul>
      </li>
      <li
        class="dropdown {{ (request()->routeIs('admin.exam.manager') || request()->routeIs('admin.exam.details') || request()->routeIs('admin.subject')) ? 'parent' : '' }}">
        <a href="#" class="nav-link has-dropdown"><i class="fas fa-columns"></i> <span>Exam/Subject Manager</span></a>
        <ul class="dropdown-menu">
          <li><a class="nav-link {{ (request()->routeIs('admin.exam.manager')) ? 'active' : '' }}"
              href="{{ route('admin.exam.manager') }}">Exam Manager</a></li>
          <li><a class="nav-link {{ (request()->routeIs('admin.exam.details')) ? 'active' : '' }}"
              href="{{ route('admin.exam.details') }}">Exam Details</a></li>
          <li><a class="nav-link {{ (request()->routeIs('admin.subject')) ? 'active' : '' }}"
              href="{{ route('admin.subject') }}">Exam Subject Creater</a></li>
        </ul>
      </li>
      <li
        class="dropdown {{ (request()->routeIs('admin.student.management') || request()->routeIs('admin.student.application') || request()->routeIs('admin.student.applicationRef')) ? 'parent' : '' }}">
        <a href="#" class="nav-link has-dropdown"><i class="fas fa-users"></i><span>Student Management</span></a>
        <ul class="dropdown-menu">
          <li><a class="nav-link {{ (request()->routeIs('admin.student.management')) ? 'active' : '' }}"
              href="{{ route('admin.student.management') }}">All Students</a></li>
          <li><a class="nav-link {{ (request()->routeIs('admin.student.application')) ? 'active' : '' }}"
              href="{{ route('admin.student.application') }}">Active Applications</a></li>
          <li><a class="nav-link {{ (request()->routeIs('admin.student.applicationRef')) ? 'active' : '' }}"
              href="{{ route('admin.student.applicationRef') }}">Application REF</a></li>
        </ul>
      </li>
      <li><a
          class="nav-link {{ (request()->routeIs('admin.payment.manage') || request()->routeIs('admin.studentApplication.payment')) ? 'parent' : '' }}"
          href="{{ route('admin.payment.manage') }}"><i class="fas fa-coins"></i> <span>Payment Management</span></a>
      </li>

      <li
        class="dropdown">
        <a href="#" class="nav-link has-dropdown"><i class="fas fa-cogs "></i><span>Admin Management</span></a>
        <ul class="dropdown-menu">
          <li><a class="nav-link {{ (request()->routeIs('admin.manage.admin')) ? 'active' : '' }}"
              href="{{ route('admin.manage.admin') }}">Admin Manager</a></li>
        </ul>
      </li>



      <li><a class="nav-link {{ (request()->routeIs('site.settings')) ? 'active' : '' }}"
          href="{{ route('site.settings') }}"><i class="fas fa-pencil-ruler"></i> <span>Site Settings</span></a></li>
    </ul>
  </aside>
</div>