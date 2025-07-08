<footer class="bg-[#000] text-white py-8">
  <div class="container mx-auto grid grid-cols-1 md:grid-cols-3 gap-4">
    
    {{-- Info & Socials --}}
    <div class="flex flex-col justify-between">
      <div>
        <h2 class="text-2xl font-bold mb-4">MY Information</h2>
        <p class="text-gray-300 mb-2">123 Street Name, City, Country</p>
        <p class="text-gray-300 mb-2">Email: info@example.com</p>
        <p class="text-gray-300">Phone: +123 456 7890</p>
      </div>
      <div class="mt-8">
        <h3 class="text-lg font-semibold mb-3">Follow me</h3>
        <div class="flex gap-4 items-start">
          {{-- Social Icons --}}
          <a href="https://facebook.com" target="_blank">
            {{-- Facebook SVG --}}
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
              <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="4">
                <path stroke-dasharray="24" stroke-dashoffset="24" d="M17 4l-2 0c-2.5 0 -4 1.5 -4 4v12">
                  <animate fill="freeze" attributeName="stroke-dashoffset" dur="0.4s" values="24;0" />
                </path>
                <path stroke-dasharray="8" stroke-dashoffset="8" d="M8 12h7">
                  <animate fill="freeze" attributeName="stroke-dashoffset" begin="0.5s" dur="0.2s" values="8;0" />
                </path>
              </g>
            </svg>
          </a>

          {{-- Add more icons as needed with similar <a> + <svg> structure --}}
        </div>
      </div>
    </div>

    {{-- Pages --}}
    <div>
      <h2 class="text-2xl font-bold mb-4">Pages</h2>
      <ul class="space-y-2">
        <li><a href="{{ url('/about') }}" class="text-gray-300 hover:text-white">About</a></li>
        <li><a href="{{ url('/projects') }}" class="text-gray-300 hover:text-white">Projects</a></li>
        <li><a href="{{ url('/services') }}" class="text-gray-300 hover:text-white">Services</a></li>
        <li><a href="{{ url('/experiences') }}" class="text-gray-300 hover:text-white">Experiences</a></li>
        <li><a href="{{ url('/study') }}" class="text-gray-300 hover:text-white">Study</a></li>
        <li><a href="{{ url('/blog') }}" class="text-gray-300 hover:text-white">Blogs</a></li>
      </ul>
    </div>

    {{-- Contact Form --}}
    <div>
      <h2 class="text-2xl font-bold mb-4">Get In Touch</h2>
      <form method="POST" action="{{ route('contact.submit') }}" class="space-y-2">
        @csrf
        <input
          type="text"
          name="name"
          placeholder="Your Name"
          required
          class="w-full p-2 rounded bg-[#F4F1EA] text-black border border-gray-700 focus:bg-[#111] focus:outline-none focus:border-b-[#4a90e2] focus:shadow-[0_0_4px_rgba(74,144,226,0.5)] focus:text-white"
        />
        <input
          type="email"
          name="email"
          placeholder="Your Email"
          required
          class="w-full p-2 rounded bg-[#F4F1EA] text-black border border-gray-700 focus:bg-[#111] focus:outline-none focus:border-b-[#4a90e2] focus:shadow-[0_0_4px_rgba(74,144,226,0.5)] focus:text-white"
        />
        <textarea
          name="message"
          rows="4"
          placeholder="Your Message"
          required
          class="w-full p-2 rounded bg-[#F4F1EA] text-black border border-gray-700 focus:bg-[#111] focus:outline-none focus:border-b-[#4a90e2] focus:shadow-[0_0_4px_rgba(74,144,226,0.5)] focus:text-white"
        ></textarea>
        <button
          type="submit"
          class="bg-blue-600 hover:bg-blue-700 transition-colors px-6 py-3 rounded text-white font-semibold"
        >
          Submit Now
        </button>
      </form>
    </div>
  </div>

  <div class="text-center text-gray-500 text-sm mt-12">
    &copy; {{ date('Y') }} All Rights Reserved.
  </div>
</footer>
