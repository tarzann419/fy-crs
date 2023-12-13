@include('body.header')
<body>
    <x-app-layout>
        <!-- Sidebar -->
        <div class="flex">
            @include('body.sidebar')

            <!-- Main content area -->
            <div class="w-3/4 p-4">
                <x-slot name="header">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        Hi..{{ Auth::user()->name }}
                    </h2>
                    <a href="" class="btn btn-primary">this is a btn</a>
                </x-slot>

                <div class="py-12">
                    This is just home page
                </div>
            </div>
        </div>
    </x-app-layout>

    <!-- Add other scripts and closing body/html tags as needed -->
</body>
</html>
