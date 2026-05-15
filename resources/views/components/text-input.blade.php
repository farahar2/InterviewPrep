@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-gray-300 dark:border-dark-600 bg-white dark:bg-dark-700 text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-dark-400 focus:border-status-mastered focus:ring-status-mastered rounded-lg shadow-sm transition']) }}>