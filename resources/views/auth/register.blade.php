@extends('layouts.app')
@section('title', 'Create Account')

@section('content')
<div class="min-h-[80vh] flex items-center justify-center px-4 py-16">
    <div class="w-full max-w-sm">
        <div class="text-center mb-8">
            <h1 class="text-2xl font-bold text-white">Create account</h1>
            <p class="text-zinc-500 text-sm mt-1">Join ShopFlow today</p>
        </div>

        <div class="bg-[#111113] border border-white/[0.08] rounded-2xl p-6">
            <form action="{{ route('register.post') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-medium text-zinc-500 mb-1.5">Full name</label>
                    <input name="name" type="text" required value="{{ old('name') }}" placeholder="John Doe"
                        class="w-full px-3.5 py-2.5 rounded-xl bg-white/5 border border-white/10 text-white text-sm placeholder:text-zinc-700 focus:outline-none focus:border-violet-500/50 transition-all @error('name') border-red-500/50 @enderror">
                    @error('name') <p class="text-xs text-red-400 mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-xs font-medium text-zinc-500 mb-1.5">Email</label>
                    <input name="email" type="email" required value="{{ old('email') }}" placeholder="you@example.com"
                        class="w-full px-3.5 py-2.5 rounded-xl bg-white/5 border border-white/10 text-white text-sm placeholder:text-zinc-700 focus:outline-none focus:border-violet-500/50 transition-all @error('email') border-red-500/50 @enderror">
                    @error('email') <p class="text-xs text-red-400 mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-xs font-medium text-zinc-500 mb-1.5">Password</label>
                    <input name="password" type="password" required placeholder="Min. 8 characters"
                        class="w-full px-3.5 py-2.5 rounded-xl bg-white/5 border border-white/10 text-white text-sm placeholder:text-zinc-700 focus:outline-none focus:border-violet-500/50 transition-all @error('password') border-red-500/50 @enderror">
                    @error('password') <p class="text-xs text-red-400 mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-xs font-medium text-zinc-500 mb-1.5">Confirm password</label>
                    <input name="password_confirmation" type="password" required placeholder="••••••••"
                        class="w-full px-3.5 py-2.5 rounded-xl bg-white/5 border border-white/10 text-white text-sm placeholder:text-zinc-700 focus:outline-none focus:border-violet-500/50 transition-all">
                </div>
                <button type="submit"
                    class="w-full py-2.5 rounded-xl bg-gradient-to-r from-violet-600 to-indigo-600 text-white font-semibold text-sm hover:opacity-90 transition-opacity">
                    Create account
                </button>
            </form>
        </div>

        <p class="text-center text-sm text-zinc-600 mt-4">
            Already have an account?
            <a href="{{ route('login') }}" class="text-violet-400 hover:text-violet-300 transition-colors">Sign in</a>
        </p>
    </div>
</div>
@endsection
