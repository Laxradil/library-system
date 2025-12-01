@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'w-full px-4 py-3 border-2 border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 rounded-xl shadow-sm transition-all duration-300 ease-out focus:border-blue-500 dark:focus:border-blue-400 focus:ring-4 focus:ring-blue-500/20 dark:focus:ring-blue-400/20 focus:outline-none hover:border-gray-300 dark:hover:border-gray-500 focus:-translate-y-0.5 focus:shadow-lg focus:shadow-blue-500/10 placeholder-gray-400 dark:placeholder-gray-500']) }}>
