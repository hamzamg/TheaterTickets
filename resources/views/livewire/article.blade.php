<div class="py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Flash Messages -->
        @if(session()->has('success'))
            <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                {{ session('success') }}
            </div>
        @endif

        <!-- Header -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-900">المقالات</h1>
            <button wire:click="create" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                إضافة مقال جديد
            </button>
        </div>

        <!-- Search -->
        <div class="mb-4">
            <input type="text" wire:model="search" placeholder="بحث..." 
                   class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <!-- Articles Table -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">العنوان</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">اللغة</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">الحالة</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">الإجراءات</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($articles as $article)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $article->title }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ strtoupper($article->lang) }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 text-xs rounded {{ $article->published ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                {{ $article->published ? 'منشور' : 'مسودة' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <button wire:click="edit({{ $article->id }})" class="text-blue-600 hover:text-blue-900 mr-3">تعديل</button>
                            <button wire:click="confirmDelete({{ $article->id }})" class="text-red-600 hover:text-red-900">حذف</button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-4 text-center text-gray-500">لا توجد مقالات</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            
            <div class="p-4">
                {{ $articles->links() }}
            </div>
        </div>
    </div>

    <!-- Create/Edit Modal -->
    @if($showModal)
    <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50" wire:click.self="$set('showModal', false)">
        <div class="bg-white rounded-lg p-6 w-full max-w-md mx-4">
            <h2 class="text-2xl font-bold mb-4">{{ $editMode ? 'تعديل المقال' : 'إضافة مقال جديد' }}</h2>
            
            <form wire:submit="save">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">العنوان</label>
                    <input type="text" wire:model="title" class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @error('title') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">المحتوى</label>
                    <textarea wire:model="body" rows="5" class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                    @error('body') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">اللغة</label>
                    <select wire:model="lang" class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="ar">العربية</option>
                        <option value="en">English</option>
                        <option value="fr">Français</option>
                    </select>
                    @error('lang') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label class="flex items-center">
                        <input type="checkbox" wire:model="published" class="mr-2">
                        <span class="text-sm">منشور</span>
                    </label>
                </div>

                <div class="flex justify-end gap-2">
                    <button type="button" wire:click="$set('showModal', false)" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">إلغاء</button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                        {{ $editMode ? 'تحديث' : 'حفظ' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
    @endif

    <!-- Delete Confirmation Modal -->
    @if($showDeleteModal)
    <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white rounded-lg p-6 w-full max-w-sm mx-4">
            <h2 class="text-xl font-bold mb-4">تأكيد الحذف</h2>
            <p class="mb-4">هل أنت متأكد من حذف هذا المقال؟</p>
            <div class="flex justify-end gap-2">
                <button wire:click="$set('showDeleteModal', false)" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">إلغاء</button>
                <button wire:click="delete" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">حذف</button>
            </div>
        </div>
    </div>
    @endif
</div>
