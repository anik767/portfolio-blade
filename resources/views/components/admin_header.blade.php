<header>
    <nav>
      <a href="{{ route('admin.dashboard') }}">Dashboard</a> |
      <a href="{{ route('admin.posts') }}">Posts</a> |
      <a href="{{ route('admin.logout') }}"
         onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
         Logout
      </a>
  
      <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display:none;">
        @csrf
      </form>
    </nav>
  </header>
  <hr>
  