<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />
                    <form method="post" action="{{ route('user.roads.store') }}" enctype="multipart/form-data">
                        @csrf
                        <x-road.form :road="$road" :lat="$lat" :lng="$lng" :tags="$tags" :prefectures="$prefectures" />
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
