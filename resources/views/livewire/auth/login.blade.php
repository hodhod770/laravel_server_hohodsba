<div>
    <form id="loginForm" wire:submit.prevent="login" class="space-y-6">
        @csrf
            <div>
                <label for="username" class="block text-sm font-medium text-gray-400 mb-2 hacker-text">اسم المستخدم:</label>
                <input wire:model='email' type="text" id="username" name="username" required
                       class="mt-1 block w-full p-3 rounded-md hacker-input focus:ring-2 focus:ring-cyan-500">
            </div>
            <div>
                <label for="password" class="block text-sm font-medium text-gray-400 mb-2 hacker-text">كلمة المرور:</label>
                <input wire:model='password' type="password" id="password" name="password" required
                       class="mt-1 block w-full p-3 rounded-md hacker-input focus:ring-2 focus:ring-cyan-500">
            </div>
            <div class="flex items-center justify-between mt-4">
                <div class="flex items-center">
                    <input wire:model='remember' type="checkbox" id="remember" class="h-4 w-4 text-cyan-600 focus:ring-cyan-500 border-gray-300 rounded">
                    <label for="remember" class="ml-2 block text-sm text-gray-400 hacker-text">تذكرني</label>
                </div>
            </div>
            <button type="submit"
                    class="w-full py-3 px-4 rounded-md font-semibold text-lg hacker-button">
                تسجيل الدخول
            </button>
        </form>
        @if ($errors->any())
            <div class="mt-4">
                <div class="bg-red-500 text-white p-3 rounded-md">
                    <ul>
                        @foreach ($errors->all() as $error)
                                    <div id="message-box" class="mt-6 p-4 rounded-md text-center text-sm hidden">
                            <li class="mb-2">{{ $error }}</li>
                                    </div>

                        @endforeach
                    </ul>
                </div>
            </div>

</div>