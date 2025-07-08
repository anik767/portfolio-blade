<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Login</title>
  <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
  <!-- Include Alpine.js for simple reactive UI -->
  <script src="//unpkg.com/alpinejs" defer></script>
  <!-- Include any toast notification library you prefer or use your own -->
</head>
<body class="relative w-full h-screen flex items-center justify-center overflow-hidden">

  <!-- Background -->
  <div class="absolute inset-0 z-0">
    <div
      class="w-full h-full bg-cover bg-center filter blur-sm"
      style="background-image: url('{{ asset('Image/Login/login_background.jpg') }}')"
    ></div>
    <div class="absolute inset-0 bg-black/50"></div>
  </div>

  <!-- Login Box -->
  <div
    x-data="loginForm()"
    class="relative z-10 w-[70%] h-[70%] bg-white/20 backdrop-blur-sm grid grid-cols-[30%_70%] rounded-2xl shadow-lg"
  >
    <!-- Left side: Form -->
    <div class="w-full h-full px-5 flex flex-col justify-center">
      <h2 class="text-2xl font-bold text-black/80">Login</h2>
      <p class="text-sm mt-4 text-black/80">If you have an account, please login</p>

      <form @submit.prevent="submitForm" class="mt-6 space-y-4">
        <div>
          <label for="email" class="block text-black/80">Email Address</label>
          <input
            id="email"
            type="email"
            placeholder="Enter Email Address"
            class="w-full px-4 py-3 rounded-lg mt-2 border border-black/50 focus:outline-none"
            x-model="email"
            required
            autofocus
          />
        </div>

        <div class="relative">
          <label for="password" class="block text-black/80">Password</label>
          <input
            :type="showPassword ? 'text' : 'password'"
            id="password"
            placeholder="Enter Password"
            class="w-full px-4 py-3 rounded-lg mt-2 border border-black/50 focus:outline-none"
            x-model="password"
            required
          />
          <button
            type="button"
            @click="showPassword = !showPassword"
            class="absolute right-3 top-[70%] transform -translate-y-1/2 focus:outline-none"
            :aria-label="showPassword ? 'Hide password' : 'Show password'"
          >
            <template x-if="showPassword">
              <svg xmlns="http://www.w3.org/2000/svg" width="29" height="29" viewBox="0 0 36 36" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M2 2l32 32" />
                <path d="M10 10a12 12 0 0116 16" />
                <path d="M14 14a8 8 0 0110 10" />
              </svg>
            </template>
            <template x-if="!showPassword">
              <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 36 36" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="18" cy="18" r="4" />
                <path d="M1 18c4-7 11-12 17-12s13 5 17 12c-4 7-11 12-17 12S5 25 1 18z" />
              </svg>
            </template>
          </button>
        </div>

        <div class="flex items-center">
          <input
            id="rememberMe"
            type="checkbox"
            x-model="rememberMe"
            class="mr-2"
          />
          <label for="rememberMe" class="text-sm">Remember me</label>
        </div>

        <button
          type="submit"
          :disabled="loading"
          class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 disabled:bg-blue-400 transition"
        >
          <span x-text="loading ? 'Logging in...' : 'Login'"></span>
        </button>

        <a href="{{ url('/') }}" class="text-sm text-blue-700 hover:underline inline-block mt-3">
          Back to Home Page
        </a>
      </form>
    </div>

    <!-- Right side: Illustration -->
    <div class="w-full h-full hidden md:block">
      <img
        src="https://static.vecteezy.com/system/resources/previews/024/570/420/non_2x/illustration-of-a-young-man-working-at-the-computer-in-the-office-nerdy-boy-is-programming-at-a-computer-in-a-room-ai-generated-free-photo.jpg"
        alt="Login Illustration"
        class="w-full h-full object-cover rounded-r-2xl"
      />
    </div>
  </div>

  <script>
    function loginForm() {
      return {
        email: localStorage.getItem('rememberedEmail') || '',
        password: localStorage.getItem('rememberedPassword') ? atob(localStorage.getItem('rememberedPassword')) : '',
        rememberMe: !!localStorage.getItem('rememberedEmail'),
        showPassword: false,
        loading: false,

        async submitForm() {
          if (!this.email.trim() || !this.password) {
            alert('Please enter both email and password.');
            return;
          }
          this.loading = true;

          try {
            // Fetch CSRF cookie first (Laravel Sanctum)
            await fetch('/sanctum/csrf-cookie', { credentials: 'include' });

            const res = await fetch('/login', {
              method: 'POST',
              headers: {
                'Content-Type': 'application/json',
                // X-XSRF-TOKEN header is automatically sent by browser if using Sanctum cookie
              },
              credentials: 'include',
              body: JSON.stringify({
                email: this.email,
                password: this.password,
              }),
            });

            if (!res.ok) {
              const data = await res.json();
              throw new Error(data.message || 'Login failed');
            }

            // Save or remove remembered email/password
            if (this.rememberMe) {
              localStorage.setItem('rememberedEmail', this.email);
              localStorage.setItem('rememberedPassword', btoa(this.password));
            } else {
              localStorage.removeItem('rememberedEmail');
              localStorage.removeItem('rememberedPassword');
            }

            alert('Login successful!');
            window.location.href = '/admin';
          } catch (err) {
            alert(err.message || 'Something went wrong');
            this.password = '';
          } finally {
            this.loading = false;
          }
        },
      };
    }
  </script>
</body>
</html>
