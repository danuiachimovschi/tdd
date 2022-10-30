<x-layouts.auth>
    @section('title')
        Login page
    @endsection
    <div class="flex flex-col">
        <h1 class="text-3xl font-extrabold dark:text-white mb-6">Login</h1>
        <form action="{{ route('login') }}" method="POST" class="h-[300px] w-[300px]">
            @csrf
            @method("POST")
            <div class="mb-6">
                <label for="success" class="block mb-2 text-sm font-medium">Your Email</label>
                <input 
                name="email" 
                type="email" 
                class="bg-green-50 border  text-green-900  text-sm rounded-lg  block w-full p-2.5 dark:bg-gray-700 " 
                placeholder="Email"
                value="{{ old('email', '') }}"
                >
            </div>
            <div>
                <label for="error" class="block mb-2 text-sm font-medium ">Your Password</label>
                <input 
                    name="password" 
                    type="password" 
                    class="bg-green-50 border  text-sm rounded-lg dark:bg-gray-700 block w-full p-2.5"
                    placeholder="Password" 
                    value="{{ old('password', '') }}"
                 >
                 @if (session('error'))
                 <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">{{ session('error') }}</span></p>
                 @endif
            </div>
            <button type="submit" class="mt-5 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Sing In</button>
        </form>
    </div>
</x-layouts.auth>