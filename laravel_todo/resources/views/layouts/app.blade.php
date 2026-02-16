
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <title>@yield('title', 'Laravel Todo App')</title>
      <!-- Tailwind CSS CDN -->
      <script src="https://cdn.tailwindcss.com"></script>
      <!-- Custom Tailwind Config via CDN -->
      <script>
         tailwind.config = {
             theme: {
                 extend: {
                     colors: {
                         primary: {
                             50: '#eef2ff',
                             100: '#e0e7ff',
                             500: '#6366f1',
                             600: '#4f46e5',
                             700: '#4338ca',
                         },
                         secondary: '#7c3aed',
                     },
                     fontFamily: {
                         sans: ['Inter', 'sans-serif'],
                     },
                 }
             }
         }
      </script>
      <!-- Google Fonts -->
      <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
   </head>
   <body class="bg-gray-50 min-h-screen font-sans">
      <!-- Navigation -->
      <nav class="bg-white shadow-sm border-b border-gray-200">
         <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
               <div class="flex items-center">
                  <a href="/" class="flex items-center gap-2 text-xl font-bold text-primary-600">
                     <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                     </svg>
                     Todo App
                  </a>
               </div>
               <div class="flex items-center space-x-4">
                  <a href="/todos" class="text-gray-600 hover:text-primary-600 px-3 py-2 rounded-md text-sm font-medium transition-colors">
                  My Todos
                  </a>
                  <a href="/todos/create" class="bg-primary-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-primary-700 transition-colors">
                  + New Todo
                  </a>
               </div>
            </div>
         </div>
      </nav>
      <!-- Main Content -->
      <main class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
         @yield('content')
      </main>
      <!-- Footer -->
      <footer class="bg-white border-t border-gray-200 mt-auto">
         <div class="max-w-7xl mx-auto py-6 px-4 text-center">
            <p class="text-gray-500 text-sm">
               © {{ date('Y') }} Laravel Todo App. Built with Laravel 12 & Tailwind CSS.
            </p>
         </div>
      </footer>
   </body>
</html>