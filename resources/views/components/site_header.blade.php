<header id="nav-header" 
  class="fixed top-5 left-0 w-full h-[5vh] z-50 transition-transform duration-200 translate-y-0"
>
  <nav class="max-w-5xl mx-auto flex justify-center rajdhani">
    <ul class="flex gap-4 p-4 rounded-full bg-black">
      <li><a href="{{ url('/') }}" class="text-white">Home</a></li>
      <li><a href="{{ url('/about') }}" class="text-white">About</a></li>
      <li><a href="{{ url('/project') }}" class="text-white">Projects</a></li>
      <li><a href="{{ url('/services') }}" class="text-white">Services</a></li>
      <li><a href="{{ url('/experiences') }}" class="text-white">Experiences</a></li>
      <li><a href="{{ url('/study') }}" class="text-white">Study</a></li>
      <li><a href="{{ url('/blog') }}" class="text-white">Blogs</a></li>
      <li><a href="{{ url('/admin') }}" class="text-white">admin</a></li>
      <li><a href="{{ url('/login') }}" class="text-white">login</a></li>
    </ul>
  </nav>
</header>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const navHeader = document.getElementById('nav-header');
    let lastScrollY = window.scrollY;
    let ticking = false;

    window.addEventListener('scroll', () => {
      if (!ticking) {
        window.requestAnimationFrame(() => {
          const currentScrollY = window.scrollY;

          if (currentScrollY > lastScrollY && currentScrollY > 50) {
            // Scrolling down and past 50px - hide nav
            navHeader.classList.add('-translate-y-24');
            navHeader.classList.remove('translate-y-0');
          } else if (currentScrollY < lastScrollY || currentScrollY <= 50) {
            // Scrolling up or near top - show nav
            navHeader.classList.remove('-translate-y-24');
            navHeader.classList.add('translate-y-0');
          }

          lastScrollY = currentScrollY;
          ticking = false;
        });

        ticking = true;
      }
    });
  });
</script>
