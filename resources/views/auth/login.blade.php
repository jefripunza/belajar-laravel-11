<x-layout.auth>
    <x-slot:title>{{ $title }}</x-slot:title>
    <x-slot:title_form>Login</x-slot:title_form>

    <form x-data="{
        password: '',
        passwordErrors: '',
        validatePassword() {
            let password = this.password;
            let errors = [];
            if (password.length < 8) {
                errors.push('Password must be at least 8 characters long.');
            }
            if (!password.match(/[A-Z]/)) {
                errors.push('Password must contain at least one uppercase letter.');
            }
            if (!password.match(/[a-z]/)) {
                errors.push('Password must contain at least one lowercase letter.');
            }
            if (!password.match(/\d/)) {
                errors.push('Password must contain at least one digit.');
            }
            if (!password.match(/[\W_]/)) {
                errors.push('Password must contain at least one symbol.');
            }
            this.passwordErrors = errors.join('<br>');
        },
        submitForm() {
            if (this.passwordErrors) {
                return;
            }
            this.$refs.form.submit();
        }
    }" x-init="() => {}" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4"
        method="POST" action="{{ route('login') }}" @submit.prevent="submitForm" x-ref="form">
        @csrf
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                Email
            </label>
            <input
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @if ($errors->has('email')) border-red-500 @endif"
                id="username" name="email" type="email" autocomplete="email" placeholder="Email"
                value="{{ old('email') }}" required>
        </div>
        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                Password
            </label>
            <input
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline @if ($errors->has('password')) border-red-500 @endif"
                id="password" name="password" type="password" autocomplete="new-password" placeholder="Password"
                required x-model="password" @input="validatePassword">
            <p class="text-red-500 text-xs italic" x-html="passwordErrors"></p>
        </div>
        <div class="flex items-center justify-between">
            <button
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                type="submit">
                Sign In
            </button>
            <div>
                {{-- <a class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800"
                    href="#">
                    Forgot Password?
                </a> --}}
                <a class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800"
                    href="/register">
                    Don't Have Account? Register Now.
                </a>
            </div>
        </div>
    </form>
    <p class="text-center text-gray-500 text-xs">
        &copy;2020 Jefri Herdi Triyanto.
    </p>
</x-layout.auth>
