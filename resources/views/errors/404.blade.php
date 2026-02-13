<x-layouts.app>
    <div class="min-h-screen flex flex-col items-center justify-center text-center">
        <h1 class="text-4xl font-bold mb-4">404</h1>
        <p class="mb-6 text-gray-600">Page not found.</p>
        <p class="text-sm text-gray-500">
            You will be redirected to the homepage in 5 seconds...
        </p>
    </div>

    <meta http-equiv="refresh" content="5;url={{ route('magazine.index') }}">

    <script>
        setTimeout(() => window.location.href = "{{ route('magazine.index') }}", 5000);
    </script>
</x-layouts.app>