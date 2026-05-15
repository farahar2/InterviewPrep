<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
      x-data="{
          theme: localStorage.getItem('theme') || (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light'),
          toggleTheme() {
              this.theme = this.theme === 'dark' ? 'light' : 'dark'
          },
          heroRevealed: false,
          featuresRevealed: false,
          aiRevealed: false,
          init() {
              this.heroRevealed = true;
              const observer = new IntersectionObserver((entries) => {
                  entries.forEach(entry => {
                      if (entry.target.id === 'features-section') this.featuresRevealed = true;
                      if (entry.target.id === 'ai-section') this.aiRevealed = true;
                  });
              }, { threshold: 0.15 });
              this.$nextTick(() => {
                  document.getElementById('features-section') && observer.observe(document.getElementById('features-section'));
                  document.getElementById('ai-section') && observer.observe(document.getElementById('ai-section'));
              });
          }
      }"
      x-init="init(); $watch('theme', val => {
          localStorage.setItem('theme', val);
          document.documentElement.classList.toggle('dark', val === 'dark');
      })"
      :class="theme">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>InterviewPrep — Structure Your Knowledge. Ace Your Technical Interviews.</title>
        <meta name="description" content="Stop scattering notes. Build your ultimate personal knowledge base and test yourself with AI-generated interview questions.">
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-gray-50 dark:bg-dark-900 text-gray-900 dark:text-white transition-colors duration-300">

        <script>
            if (localStorage.getItem('theme') === 'dark' || (!localStorage.getItem('theme') && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
            }
        </script>

        {{-- ============================================================ --}}
        {{-- NAVBAR                                                       --}}
        {{-- ============================================================ --}}
        <nav class="fixed top-0 left-0 right-0 z-50 bg-white/80 dark:bg-dark-900/80 backdrop-blur-xl border-b border-gray-200/60 dark:border-dark-700/60">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">
                    <a href="/" class="text-2xl font-extrabold text-gray-900 dark:text-white tracking-tight">
                        Interview<span class="text-status-mastered">Prep</span>
                    </a>

                    <div class="flex items-center space-x-4">
                        <button @click="toggleTheme()"
                                class="p-2 rounded-lg text-gray-400 dark:text-dark-400 hover:bg-gray-100 dark:hover:bg-dark-700 hover:text-gray-600 dark:hover:text-white transition-all duration-200"
                                :title="theme === 'dark' ? 'Light Mode' : 'Dark Mode'">
                            <svg x-show="theme === 'dark'" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path>
                            </svg>
                            <svg x-show="theme === 'light'" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>
                            </svg>
                        </button>

                        @auth
                            <a href="{{ route('dashboard') }}"
                               class="bg-status-mastered hover:bg-status-mastered/80 text-white font-bold px-5 py-2.5 rounded-lg transition-all duration-200 hover:scale-[1.03] active:scale-[0.97] shadow-sm">
                                Go to Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}"
                               class="text-gray-600 dark:text-dark-300 hover:text-gray-900 dark:hover:text-white font-medium transition-colors px-4 py-2">
                                Log in
                            </a>
                            <a href="{{ route('register') }}"
                               class="bg-status-mastered hover:bg-status-mastered/80 text-white font-bold px-5 py-2.5 rounded-lg transition-all duration-200 hover:scale-[1.03] active:scale-[0.97] shadow-sm">
                                Sign Up Free
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>

        {{-- ============================================================ --}}
        {{-- HERO SECTION                                                  --}}
        {{-- ============================================================ --}}
        <section class="relative pt-32 pb-20 sm:pt-40 sm:pb-28 overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-b from-status-mastered/5 via-transparent to-transparent dark:from-status-mastered/5 pointer-events-none"></div>
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
                <div class="text-center max-w-4xl mx-auto"
                     x-show="heroRevealed"
                     x-transition:enter="transition ease-out duration-700"
                     x-transition:enter-start="opacity-0 translate-y-8"
                     x-transition:enter-end="opacity-100 translate-y-0">
                    <h1 class="text-5xl sm:text-6xl lg:text-7xl font-extrabold text-gray-900 dark:text-white leading-[1.1] tracking-tight">
                        Structure Your Knowledge.
                        <span class="block text-status-mastered mt-2">Ace Your Technical Interviews.</span>
                    </h1>
                    <p class="mt-6 text-lg sm:text-xl text-gray-500 dark:text-dark-300 max-w-2xl mx-auto leading-relaxed">
                        Stop scattering notes across tabs and documents. Build your ultimate personal knowledge base — organize concepts by domain, track mastery, and test yourself with AI-generated interview questions.
                    </p>

                    <div class="mt-10 flex flex-col sm:flex-row items-center justify-center gap-4">
                        @auth
                            <a href="{{ route('dashboard') }}"
                               class="bg-status-mastered hover:bg-status-mastered/80 text-white font-bold text-lg px-8 py-4 rounded-xl transition-all duration-200 hover:scale-[1.03] active:scale-[0.97] shadow-lg shadow-status-mastered/25 animate-pulse-slow">
                                Go to Dashboard
                            </a>
                        @else
                            <a href="{{ route('register') }}"
                               class="bg-status-mastered hover:bg-status-mastered/80 text-white font-bold text-lg px-8 py-4 rounded-xl transition-all duration-200 hover:scale-[1.03] active:scale-[0.97] shadow-lg shadow-status-mastered/25">
                                Start Preparing for Free
                            </a>
                            <a href="{{ route('login') }}"
                               class="text-gray-600 dark:text-dark-300 hover:text-gray-900 dark:hover:text-white font-semibold text-lg px-8 py-4 rounded-xl border-2 border-gray-200 dark:border-dark-600 hover:border-gray-300 dark:hover:border-dark-500 transition-all duration-200 hover:scale-[1.02] active:scale-[0.98]">
                                Log in
                            </a>
                        @endauth
                    </div>
                </div>

                {{-- Hero mock preview card --}}
                <div class="mt-16 max-w-3xl mx-auto"
                     x-show="heroRevealed"
                     x-transition:enter="transition ease-out duration-700 delay-300"
                     x-transition:enter-start="opacity-0 translate-y-8"
                     x-transition:enter-end="opacity-100 translate-y-0">
                    <div class="bg-white dark:bg-dark-800 rounded-2xl border border-gray-200 dark:border-dark-700 shadow-xl shadow-gray-200/50 dark:shadow-black/20 overflow-hidden">
                        <div class="px-6 py-4 border-b border-gray-100 dark:border-dark-700 flex items-center space-x-2">
                            <div class="w-3 h-3 rounded-full bg-status-review"></div>
                            <div class="w-3 h-3 rounded-full bg-status-progress"></div>
                            <div class="w-3 h-3 rounded-full bg-status-mastered"></div>
                            <span class="ml-3 text-xs text-gray-400 dark:text-dark-500 font-mono">~ /concepts/laravel-orm</span>
                        </div>
                        <div class="p-6 space-y-4">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-3">
                                    <div class="w-3 h-3 rounded-full" style="background-color: #3B82F6"></div>
                                    <h3 class="font-bold text-gray-900 dark:text-white text-lg">Laravel ORM</h3>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <span class="px-3 py-1 text-xs font-semibold rounded-full bg-difficulty-senior/10 text-difficulty-senior">Senior</span>
                                    <span class="px-3 py-1 text-xs font-semibold rounded-full bg-status-progress/10 text-status-progress">In Progress</span>
                                </div>
                            </div>
                            <div class="space-y-2">
                                <div class="flex items-center space-x-3 p-3 bg-gray-50 dark:bg-dark-700 rounded-lg">
                                    <div class="w-6 h-6 rounded-full bg-status-mastered/20 flex items-center justify-center text-xs font-bold text-status-mastered">1</div>
                                    <p class="text-sm text-gray-600 dark:text-dark-300">What is the N+1 query problem in Eloquent and how do you solve it?</p>
                                </div>
                                <div class="flex items-center space-x-3 p-3 bg-gray-50 dark:bg-dark-700 rounded-lg">
                                    <div class="w-6 h-6 rounded-full bg-status-mastered/20 flex items-center justify-center text-xs font-bold text-status-mastered">2</div>
                                    <p class="text-sm text-gray-600 dark:text-dark-300">Explain the difference between `with()` and `load()` in Eloquent relationships.</p>
                                </div>
                                <div class="flex items-center space-x-3 p-3 bg-gray-50 dark:bg-dark-700 rounded-lg">
                                    <div class="w-6 h-6 rounded-full bg-status-mastered/20 flex items-center justify-center text-xs font-bold text-status-mastered">3</div>
                                    <p class="text-sm text-gray-600 dark:text-dark-300">How would you optimize a query that joins 5 tables in Laravel?</p>
                                </div>
                            </div>
                            <div class="flex items-center justify-between pt-2 border-t border-gray-100 dark:border-dark-700">
                                <div class="flex items-center space-x-1">
                                    <span class="text-xs text-gray-400 dark:text-dark-500">Status changed 2h ago</span>
                                </div>
                                <div class="flex -space-x-1">
                                    <div class="w-8 h-8 rounded-full bg-status-mastered/20 border-2 border-white dark:border-dark-800 flex items-center justify-center">
                                        <span class="text-[10px] font-bold text-status-mastered">🟢</span>
                                    </div>
                                    <div class="w-8 h-8 rounded-full bg-status-progress/20 border-2 border-white dark:border-dark-800 flex items-center justify-center">
                                        <span class="text-[10px] font-bold text-status-progress">🟡</span>
                                    </div>
                                    <div class="w-8 h-8 rounded-full bg-status-review/20 border-2 border-white dark:border-dark-800 flex items-center justify-center">
                                        <span class="text-[10px] font-bold text-status-review">🔴</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- ============================================================ --}}
        {{-- FEATURES GRID (3 Pillars)                                     --}}
        {{-- ============================================================ --}}
        <section id="features-section" class="py-20 sm:py-28">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16"
                     x-show="featuresRevealed"
                     x-transition:enter="transition ease-out duration-500"
                     x-transition:enter-start="opacity-0 translate-y-6"
                     x-transition:enter-end="opacity-100 translate-y-0">
                    <h2 class="text-4xl sm:text-5xl font-extrabold text-gray-900 dark:text-white">Everything you need to prepare</h2>
                    <p class="mt-4 text-lg text-gray-500 dark:text-dark-300 max-w-2xl mx-auto">Three simple pillars to transform how you study for technical interviews.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    {{-- Card 1: Domains --}}
                    <div class="bg-white dark:bg-dark-800 rounded-2xl p-8 border border-gray-200 dark:border-dark-700 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300"
                         x-show="featuresRevealed"
                         x-transition:enter="transition ease-out duration-500 delay-100"
                         x-transition:enter-start="opacity-0 translate-y-6"
                         x-transition:enter-end="opacity-100 translate-y-0">
                        <div class="w-14 h-14 rounded-xl bg-status-mastered/10 flex items-center justify-center mb-6">
                            <svg class="w-7 h-7 text-status-mastered" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3">Smart Domains</h3>
                        <p class="text-gray-500 dark:text-dark-300 leading-relaxed">
                            Organize concepts into custom categories — Laravel, Docker, System Design — each with a unique color badge for instant visual recognition.
                        </p>
                    </div>

                    {{-- Card 2: Mastery --}}
                    <div class="bg-white dark:bg-dark-800 rounded-2xl p-8 border border-gray-200 dark:border-dark-700 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300"
                         x-show="featuresRevealed"
                         x-transition:enter="transition ease-out duration-500 delay-200"
                         x-transition:enter-start="opacity-0 translate-y-6"
                         x-transition:enter-end="opacity-100 translate-y-0">
                        <div class="w-14 h-14 rounded-xl bg-status-progress/10 flex items-center justify-center mb-6">
                            <svg class="w-7 h-7 text-status-progress" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3">Mastery Tracking</h3>
                        <p class="text-gray-500 dark:text-dark-300 leading-relaxed">
                            Track progress from Junior to Senior with clear visual bars. Filter by status — To Review, In Progress, Mastered — and see your growth at a glance.
                        </p>
                    </div>

                    {{-- Card 3: AI --}}
                    <div class="bg-white dark:bg-dark-800 rounded-2xl p-8 border border-gray-200 dark:border-dark-700 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300"
                         x-show="featuresRevealed"
                         x-transition:enter="transition ease-out duration-500 delay-300"
                         x-transition:enter-start="opacity-0 translate-y-6"
                         x-transition:enter-end="opacity-100 translate-y-0">
                        <div class="w-14 h-14 rounded-xl bg-difficulty-junior/10 flex items-center justify-center mb-6">
                            <svg class="w-7 h-7 text-difficulty-junior" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3">Groq AI Interviewer</h3>
                        <p class="text-gray-500 dark:text-dark-300 leading-relaxed">
                            Generate 5 hyper-specific, realistic interview questions per concept with one click. Powered by Groq &amp; Llama 3 — responses in milliseconds.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        {{-- ============================================================ --}}
        {{-- AI INTERACTIVE BANNER                                         --}}
        {{-- ============================================================ --}}
        <section id="ai-section" class="py-20 sm:py-28 relative">
            <div class="absolute inset-0 bg-gradient-to-r from-status-mastered/5 via-transparent to-status-mastered/5 dark:from-status-mastered/10 dark:to-status-mastered/10 pointer-events-none"></div>
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
                <div class="text-center mb-12"
                     x-show="aiRevealed"
                     x-transition:enter="transition ease-out duration-500"
                     x-transition:enter-start="opacity-0 translate-y-6"
                     x-transition:enter-end="opacity-100 translate-y-0">
                    <h2 class="text-4xl sm:text-5xl font-extrabold text-gray-900 dark:text-white">AI-Powered Interview Questions</h2>
                    <p class="mt-4 text-lg text-gray-500 dark:text-dark-300 max-w-2xl mx-auto">Describe any concept and get realistic technical interview questions in seconds.</p>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-center"
                     x-show="aiRevealed"
                     x-transition:enter="transition ease-out duration-500 delay-150"
                     x-transition:enter-start="opacity-0 translate-y-6"
                     x-transition:enter-end="opacity-100 translate-y-0">
                    <div class="space-y-6">
                        <div class="flex items-center space-x-4">
                            <div class="w-12 h-12 rounded-xl bg-status-mastered/10 flex items-center justify-center shrink-0">
                                <svg class="w-6 h-6 text-status-mastered" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-900 dark:text-white">Lightning-fast generation</h3>
                                <p class="text-sm text-gray-500 dark:text-dark-400">Powered by Groq API &mdash; responses in under 2 seconds</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-4">
                            <div class="w-12 h-12 rounded-xl bg-status-progress/10 flex items-center justify-center shrink-0">
                                <svg class="w-6 h-6 text-status-progress" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-900 dark:text-white">Always relevant questions</h3>
                                <p class="text-sm text-gray-500 dark:text-dark-400">5 unique questions per concept, from basic to advanced</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-4">
                            <div class="w-12 h-12 rounded-xl bg-difficulty-junior/10 flex items-center justify-center shrink-0">
                                <svg class="w-6 h-6 text-difficulty-junior" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-900 dark:text-white">Free &amp; private</h3>
                                <p class="text-sm text-gray-500 dark:text-dark-400">No hidden costs. Uses Groq free tier — no credit card required.</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-dark-900 dark:bg-dark-950 rounded-2xl border border-dark-700 shadow-2xl overflow-hidden">
                        <div class="px-5 py-3 bg-dark-800 border-b border-dark-700 flex items-center space-x-2">
                            <div class="w-3 h-3 rounded-full bg-status-review"></div>
                            <div class="w-3 h-3 rounded-full bg-status-progress"></div>
                            <div class="w-3 h-3 rounded-full bg-status-mastered"></div>
                            <span class="ml-3 text-xs text-dark-400 font-mono">groq api ~ llama3-8b-8192</span>
                        </div>
                        <div class="p-5 space-y-4 font-mono text-sm">
                            <div>
                                <span class="text-dark-400">$</span>
                                <span class="text-status-mastered ml-1">curl</span>
                                <span class="text-white ml-1">-X POST</span>
                                <span class="text-dark-300 ml-1">https://api.groq.com/openai/v1/chat/completions</span>
                            </div>
                            <div class="pl-4 border-l-2 border-dark-600 space-y-3">
                                <p><span class="text-dark-500">// Prompt sent to Groq</span></p>
                                <p><span class="text-status-progress">&quot;role&quot;</span>: <span class="text-status-mastered">&quot;user&quot;</span>,</p>
                                <p><span class="text-status-progress">&quot;content&quot;</span>: <span class="text-status-mastered">&quot;Generate 5 interview questions about Dependency Injection in Laravel...&quot;</span></p>
                            </div>
                            <div class="pt-3 border-t border-dark-700">
                                <p><span class="text-dark-500">// AI Response (excerpt)</span></p>
                                <p class="text-dark-200 mt-2 leading-relaxed">
                                    <span class="text-status-mastered">1.</span> What is Dependency Injection and how does Laravel&#39;s IoC container implement it?<br>
                                    <span class="text-status-mastered">2.</span> Explain the difference between service providers and facades...<br>
                                    <span class="text-dark-500">[... 3 more questions generated]</span>
                                </p>
                            </div>
                            <div class="pt-3 border-t border-dark-700 flex items-center justify-between">
                                <span class="text-xs text-dark-400">Generated in 1.2s &bull; llama3-8b-8192</span>
                                <span class="text-xs text-status-mastered font-semibold">&lt; 200 OK</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- ============================================================ --}}
        {{-- CTA BANNER                                                    --}}
        {{-- ============================================================ --}}
        <section class="py-20 sm:py-28">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h2 class="text-4xl sm:text-5xl font-extrabold text-gray-900 dark:text-white">Ready to master your interviews?</h2>
                <p class="mt-4 text-lg text-gray-500 dark:text-dark-300 max-w-xl mx-auto">Join developers who organize their knowledge and practice with AI-generated questions daily.</p>
                <div class="mt-10">
                    @auth
                        <a href="{{ route('dashboard') }}"
                           class="inline-flex items-center px-8 py-4 bg-status-mastered hover:bg-status-mastered/80 text-white font-bold text-lg rounded-xl transition-all duration-200 hover:scale-[1.03] active:scale-[0.97] shadow-lg shadow-status-mastered/25">
                            Go to Dashboard
                            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                            </svg>
                        </a>
                    @else
                        <a href="{{ route('register') }}"
                           class="inline-flex items-center px-8 py-4 bg-status-mastered hover:bg-status-mastered/80 text-white font-bold text-lg rounded-xl transition-all duration-200 hover:scale-[1.03] active:scale-[0.97] shadow-lg shadow-status-mastered/25">
                            Start Preparing for Free
                            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                            </svg>
                        </a>
                    @endauth
                </div>
            </div>
        </section>

        {{-- ============================================================ --}}
        {{-- FOOTER                                                        --}}
        {{-- ============================================================ --}}
        <footer class="border-t border-gray-200 dark:border-dark-700">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
                <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                    <div class="flex items-center space-x-2">
                        <span class="text-lg font-extrabold text-gray-900 dark:text-white">
                            Interview<span class="text-status-mastered">Prep</span>
                        </span>
                        <span class="text-gray-300 dark:text-dark-600 hidden sm:inline">|</span>
                        <span class="text-sm text-gray-400 dark:text-dark-500 hidden sm:inline">
                            &copy; {{ date('Y') }} All rights reserved.
                        </span>
                    </div>
                    <div class="flex items-center space-x-4 text-sm text-gray-400 dark:text-dark-500">
                        <span>Built with</span>
                        <a href="https://laravel.com" target="_blank" rel="noopener" class="hover:text-status-mastered transition-colors font-medium">Laravel 11</a>
                        <span class="text-gray-300 dark:text-dark-600">&amp;</span>
                        <a href="https://tailwindcss.com" target="_blank" rel="noopener" class="hover:text-status-mastered transition-colors font-medium">Tailwind CSS</a>
                        <span class="text-gray-300 dark:text-dark-600">&amp;</span>
                        <a href="https://groq.com" target="_blank" rel="noopener" class="hover:text-status-mastered transition-colors font-medium">Groq AI</a>
                    </div>
                    <div class="text-xs text-gray-400 dark:text-dark-500 sm:hidden">
                        &copy; {{ date('Y') }} All rights reserved.
                    </div>
                </div>
            </div>
        </footer>

    </body>
</html>