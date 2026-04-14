<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - TUPEL</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 flex items-center justify-center min-h-screen">

    <div class="bg-white p-8 rounded-3xl shadow-2xl w-full max-w-md border-t-8 border-orange-500">
        <div class="text-center mb-8">
            <h1 class="text-2xl font-bold text-slate-800">Administrator</h1>
            <p class="text-slate-500 text-sm">Masuk ke panel manajemen TUPEL</p>
        </div>

        <form action="{{ route('admin.login.process') }}" method="POST" class="space-y-5">
            @csrf
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required autofocus
                       class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-orange-500 outline-none">
                @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Password</label>
                <input type="password" name="password" required
                       class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-orange-500 outline-none">
            </div>

            <button type="submit" class="w-full bg-orange-600 hover:bg-orange-900 text-white font-bold py-3.5 rounded-xl transition cursor-pointer">
                Login
            </button>
        </form>
    </div>

</body>
</html>