<button {{ $attributes->merge(['class' => 'bg-blue-500 hover:bg-blue-600 hover:cursor-pointer text-white font-bold py-2 rounded-lg transition', 'type' => 'submit']) }}>{{ $slot }}</button>
