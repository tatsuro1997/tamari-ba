<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            ツーリング掲示板登録
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />
                    <form method="post" action="{{ route('user.boards.store') }}" enctype="multipart/form-data">
                        @csrf
                        <x-board-form :board="$board" :prefectures="$prefectures" />
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
