<div style="width: 100%">
    <main class="flex-grow w-full max-w-6xl mx-auto p-4 md:p-8 relative z-10">
        <h2 class="text-3xl font-bold mb-6 hacker-text">إدارة الجهات</h2>

        <!-- Add New Entity Section -->
        <div class="hacker-card p-6 rounded-xl mb-8">
            <h3 class="text-xl font-semibold mb-4 hacker-text">إضافة جهة جديدة</h3>
            <form wire:submit.prevent="addSide" method="post">
                @csrf
                <div class="flex flex-col md:flex-row gap-4 items-end">
                    <div class="flex-grow w-full">
                        <label for="entity-name-input"
                            class="block text-sm font-medium text-gray-400 mb-2 hacker-text">اسم الجهة:</label>
                        <input wire:model="name" type="text" id="entity-name-input" placeholder="أدخل اسم الجهة"
                            class="mt-1 block w-full p-3 rounded-md hacker-input focus:ring-2 focus:ring-cyan-500">
                    </div>
                    <button id="add-entity-button" class="hacker-button py-3 px-6 rounded-md md:w-auto w-full">
                        إضافة جهة
                    </button>
                </div>
                @if (session()->has('message'))
                    <div class="mt-4 p-3 rounded-md text-center text-sm bg-green-500 text-white">
                        {{ session('message') }}
                    </div>
                @endif
            </form>

        </div>

        <!-- Entities Table -->
        <div class="hacker-card p-6 rounded-xl overflow-x-auto">
            <h3 class="text-xl font-semibold mb-4 hacker-text">قائمة الجهات</h3>
            <table class="min-w-full divide-y divide-gray-700">
                <thead class="bg-gray-800">
                    <tr>
                        <th scope="col"
                            class="px-6 py-3 text-right text-xs font-medium text-gray-300 uppercase tracking-wider hacker-text">
                            ID
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-right text-xs font-medium text-gray-300 uppercase tracking-wider hacker-text">
                            UID
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-right text-xs font-medium text-gray-300 uppercase tracking-wider hacker-text">
                            اسم الجهة
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-right text-xs font-medium text-gray-300 uppercase tracking-wider hacker-text">
                            إجراءات
                        </th>
                    </tr>
                </thead>
                <tbody id="entities-table-body" class="bg-gray-900 divide-y divide-gray-700 hacker-subtext">
                    <!-- Entity rows will be injected here by JavaScript -->
                   @if($sides->isEmpty())
                        <tr>
                            <td colspan="4" class="text-center py-4 text-gray-500">لا توجد جهات مسجلة</td>
                        </tr>
                    @else
                        @foreach ($sides as $side)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">{{ $side->id }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">{{ $side->uuid }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">{{ $side->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    <button wire:confirm="هل أنت متأكد من حذف هذه الجهة؟" wire:click="deleteSide({{ $side->id }})"
                                        class="hacker-button bg-red-600 hover:bg-red-700 px-4 py-2 rounded-md">
                                        حذف
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    @endif          
                </tbody>
            </table>
            
        </div>

        <a href="{{ route('dashboard') }}" id="back-button" class="hacker-button mt-8 py-3 px-6 rounded-md">
            العودة
        </a>
    </main>
</div>
