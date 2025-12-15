<div>
    <section class="bg-gray-50 dark:bg-gray-900">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
            <a href="#" class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">
                <img class="w-8 h-8 mr-2" src="{{ asset('svg/logo.svg') }}" alt="logo">
                TembakauKu
            </a>
            <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                        Sign in to your account
                    </h1>
                    @if (session('error'))
                    <div class="p-2 mb-3 text-sm text-red-600 bg-red-100 rounded">
                        {{ session('error') }}
                    </div>
                    @endif
                    <form wire:submit.prevent="login" class="space-y-4 md:space-y-6" action="#">
                        <div>
                            <div class="relative">
                                <input wire:model="email" type="email" name="email" id="email" aria-describedby="outlined_error_help" class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-heading bg-transparent rounded-base border appearance-none {{ $errors->has('email') ? 'border-danger focus:border-danger' : 'border-neutral-500 focus:border-green-600 focus:ring-green-500' }} peer" placeholder=" " />
                                <label for="email" class="absolute text-sm {{ $errors->has('email') ? 'text-fg-danger-strong' : 'text-heading' }} duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-left bg-neutral-primary px-2 peer-focus:px-2 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 start-1 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Username</label>
                            </div>
                            @error('email')
                            <p id="outlined_error_help" class="mt-2 text-xs text-fg-danger-strong"><span class="font-medium">Oh, snapp!</span> {{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <div class="relative">
                                <input wire:model="password" type="password" name="password" id="password" aria-describedby="outlined_error_help" class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-heading bg-transparent rounded-base border appearance-none {{ $errors->has('password') ? 'border-danger focus:border-danger' : 'border-neutral-500 focus:border-green-600 focus:ring-green-500' }} peer" placeholder=" " />
                                <label for="password" class="absolute text-sm {{ $errors->has('password') ? 'text-fg-danger-strong' : 'text-heading' }} duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-left bg-neutral-primary px-2 peer-focus:px-2 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 start-1 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Password</label>
                            </div>
                            @error('password')
                            <p id="outlined_error_help" class="mt-2 text-xs text-fg-danger-strong"><span class="font-medium">Oh, snapp!</span> {{ $message }}</p>
                            @enderror
                        </div>
                        <button type="submit" class="w-full text-white bg-green-400 hover:bg-green-500 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Masuk</button>

                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
