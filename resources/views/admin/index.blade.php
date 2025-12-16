@extends('components.layout')

@section('create-product')
    <x-form-style id="create-form" action="/admin/products" method="POST" class="w-180">
        @csrf
        <h2 class="text-2xl font-bold text-white text-center">Create new product</h2>
        <div class="flex flex-col">
            <x-label-form for="categorie">Categorie</x-label-form>
            <select name="categorie_id" id="categorie"
                class="px-3 py-1 text-black rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-400 bg-white/80">
                <option value="{{ App\Models\Categorie::BOOK }}">Book</option>
                <option value="{{ App\Models\Categorie::TABLET }}">Tablet</option>
                <option value="{{ App\Models\Categorie::LAPTOP }}">Laptop</option>
                <option value="{{ App\Models\Categorie::PHONE }}">Phone</option>
            </select>
            @error('categorie')
                <p class="text-xs text-red-400 font-semibold"><i>{{ $message }}</i></p>
            @enderror
        </div>
        <div class="flex flex-col">
            <x-label-form for="name">Name</x-label-form>
            <x-input-form type="text" id="name" name="name"></x-input-form>
            @error('name')
                <p class="text-xs text-red-400 font-semibold"><i>{{ $message }}</i></p>
            @enderror
        </div>

        <div class="flex flex-col">
            <x-label-form for="description">description</x-label-form>
            <textarea name="description" id="description"
                class="px-3 py-1 text-black rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-400 bg-white/80"></textarea>
            @error('description')
                <p class="text-xs text-red-400 font-semibold"><i>{{ $message }}</i></p>
            @enderror
        </div>
        <div class="flex justify-between gap-3">
            <div class="flex flex-col">
                <x-label-form for="price">Price</x-label-form>
                <x-input-form type="number" id="price" name="price"></x-input-form>
                @error('price')
                    <p class="text-xs text-red-400 font-semibold"><i>{{ $message }}</i></p>
                @enderror
            </div>

            <div class="flex flex-col">
                <x-label-form for="quantity">Quantity</x-label-form>
                <x-input-form type="number" id="quantity" name="quantity"></x-input-form>
                @error('quantity')
                    <p class="text-xs text-red-400 font-semibold"><i>{{ $message }}</i></p>
                @enderror
            </div>
            <div class="flex flex-col">
                <x-label-form for="image">Image</x-label-form>
                <x-input-form type="text" id="image" name="image"></x-input-form>
                @error('image')
                    <p class="text-xs text-red-400 font-semibold"><i>{{ $message }}</i></p>
                @enderror
            </div>
        </div>
        <x-button-form>Create</x-button-form>
    </x-form-style>


    <x-form-style id="edit-form" action="" method="POST" class="w-180 hidden">
        @csrf
        @method('PATCH')
        <h2 class="text-2xl font-bold text-white text-center">Create new product</h2>
        <div class="flex flex-col">
            <x-label-form for="categorie">Categorie</x-label-form>
            <select name="categorie_id" id="edit_categorie"
                class="px-3 py-1 text-black rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-400 bg-white/80">
                <option value="{{ App\Models\Categorie::BOOK }}">Book</option>
                <option value="{{ App\Models\Categorie::TABLET }}">Tablet</option>
                <option value="{{ App\Models\Categorie::LAPTOP }}">Laptop</option>
                <option value="{{ App\Models\Categorie::PHONE }}">Phone</option>
            </select>
            @error('categorie')
                <p class="text-xs text-red-400 font-semibold"><i>{{ $message }}</i></p>
            @enderror
        </div>
        <div class="flex flex-col">
            <x-label-form for="name">Name</x-label-form>
            <x-input-form type="text" id="edit_name" name="name"></x-input-form>
            @error('name')
                <p class="text-xs text-red-400 font-semibold"><i>{{ $message }}</i></p>
            @enderror
        </div>

        <div class="flex flex-col">
            <x-label-form for="description">description</x-label-form>
            <textarea name="description" id="edit_description"
                class="px-3 py-1 text-black rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-400 bg-white/80"></textarea>
            @error('description')
                <p class="text-xs text-red-400 font-semibold"><i>{{ $message }}</i></p>
            @enderror
        </div>
        <div class="flex justify-between gap-3">
            <div class="flex flex-col">
                <x-label-form for="price">Price</x-label-form>
                <x-input-form type="number" id="edit_price" name="price"></x-input-form>
                @error('price')
                    <p class="text-xs text-red-400 font-semibold"><i>{{ $message }}</i></p>
                @enderror
            </div>

            <div class="flex flex-col">
                <x-label-form for="quantity">Quantity</x-label-form>
                <x-input-form type="number" id="edit_quantity" name="quantity"></x-input-form>
                @error('quantity')
                    <p class="text-xs text-red-400 font-semibold"><i>{{ $message }}</i></p>
                @enderror
            </div>
            <div class="flex flex-col">
                <x-label-form for="image">Image</x-label-form>
                <x-input-form type="text" id="edit_image" name="image"></x-input-form>
                @error('image')
                    <p class="text-xs text-red-400 font-semibold"><i>{{ $message }}</i></p>
                @enderror
            </div>
        </div>
        <x-button-form>Update</x-button-form>
    </x-form-style>

    <div id="successCreate" class="fixed hidden inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4">
        <div class="bg-white w-full p-6 max-w-md w-full text-center rounded shadow">
            <h3 class="text-xl font-bold text-green-600 mb-2">Successfully</h3>
            <p class="text-gray-700 mb-4">{{ session('successCreate') }}</p>
            <button onclick="closeSuccessCreateModal()"
                class="px-6 py-2 bg-green-600 text-white rounded hover:bg-green-700">OK</button>
        </div>
    </div>

    <div id="successUpdate" class="fixed hidden inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4">
        <div class="bg-white w-full p-6 max-w-md w-full text-center rounded shadow">
            <h3 class="text-xl font-bold text-green-600 mb-2">Successfully</h3>
            <p class="text-gray-700 mb-4">{{ session('successUpdate') }}</p>
            <button onclick="closeSuccessUpdateModal()"
                class="px-6 py-2 bg-green-600 text-white rounded hover:bg-green-700">OK</button>
        </div>
    </div>

    <script>
        @if (session('successCreate'))
            document.getElementById('create-form').classList.add('hidden')
            document.getElementById('successCreate').classList.remove('hidden');
        @endif

        function closeSuccessCreateModal() {
            document.getElementById('successCreate').classList.add('hidden');
            document.getElementById('create-form').classList.remove('hidden')
        }

        @if (session('successUpdate'))
            document.getElementById('edit-form').classList.add('hidden');
            document.getElementById('create-form').classList.add('hidden');
            document.getElementById('successUpdate').classList.remove('hidden');
        @endif

        function closeSuccessUpdateModal() {
            document.getElementById('successUpdate').classList.add('hidden');
            document.getElementById('create-form').classList.remove('hidden');
        }
    </script>
@endsection

@section('admin-all-products')
    <div class="min-h-screen">
        <h1 class="text-3xl font-bold text-gray-300 mb-6">All Products</h1>
        <div class="overflow-x-auto rounded-xl shadow">
            <table class="min-w-full border border-gray-200 bg-white">
                <thead class="bg-gray-100 border-b border-gray-300">
                    <tr>
                        <th class="px-4 py-3 text-left font-semibold text-gray-700">Image</th>
                        <th class="px-4 py-3 text-left font-semibold text-gray-700">Id</th>
                        <th class="px-4 py-3 text-left font-semibold text-gray-700">Name</th>
                        <th class="px-4 py-3 text-left font-semibold text-gray-700">Description</th>
                        <th class="px-4 py-3 text-left font-semibold text-gray-700">Price</th>
                        <th class="px-4 py-3 text-left font-semibold text-gray-700">Quantity</th>
                        <th class="px-4 py-3 text-left font-semibold text-gray-700">Active</th>
                        <th class="px-4 py-3 text-left font-semibold text-gray-700">Edit</th>
                        <th class="px-4 py-3 text-left font-semibold text-gray-700">Delete</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($products as $product)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-4 py-3">
                                <img src="{{ $product->image }}" class="h-12 w-12 object-cover rounded" />
                            </td>
                            <td class="px-4 py-3">{{ $product->id }}</td>
                            <td class="px-4 py-3">{{ $product->name }}</td>
                            <td class="px-4 py-3">{{ $product->description }}</td>
                            <td class="px-4 py-3">{{ $product->price }} €</td>
                            <td class="px-4 py-3">{{ $product->quantity }}</td>
                            <td class="px-4 py-3">
                                @if ($product->is_active)
                                    <span class="px-3 py-1 text-xs bg-green-200 text-green-800 rounded">Active</span>
                                @else
                                    <span class="px-2 py-1 text-xs bg-amber-200 text-amber-800 rounded">Inactive</span>
                                @endif
                            </td>
                            <td class="px-4 py-3">
                                <button
                                    onclick="editModal({{ json_encode($product->id) }},
                                                        {{ json_encode($product->name) }},
                                                        {{ json_encode($product->description) }},
                                                        {{ json_encode($product->price) }},
                                                        {{ json_encode($product->image) }},
                                                        {{ json_encode($product->quantity) }})"
                                    class="px-3 py-1 bg-teal-300 text-white rounded hover:bg-teal-200 hover:cursor-pointer">
                                    Edit
                                </button>
                            </td>
                            <td class="px-4 py-3">
                                <form action="/admin/products/{{ $product->id }}" method="POST"
                                    onsubmit="return confirm('Are you sure you want to delete this product?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="px-3 py-1 bg-rose-600 text-white rounded hover:bg-rose-700 hover:cursor-pointer">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <script>
                function editModal(id, name, description, price, image, quantity) {
                    document.getElementById('create-form').classList.add('hidden');
                    document.getElementById('edit-form').classList.remove('hidden');
                    document.getElementById('edit-form').action = '/admin/products/' + id;

                    document.getElementById('edit_name').value = name
                    document.getElementById('edit_description').value = description
                    document.getElementById('edit_price').value = price
                    document.getElementById('edit_image').value = image
                    document.getElementById('edit_quantity').value = quantity

                    scroll({
                        top: 0,
                        behavoir: "smooth",
                    })
                }
            </script>
        </div>
        <div class="mt-5 text-gray-200">
            {{ $products->links() }}
        </div>
    </div>
@endsection
