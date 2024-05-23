<x-layout.auth>
    <x-slot:title>{{ $title }}</x-slot:title>
    <x-slot:title_form>Register</x-slot:title_form>

    <form x-data="{
        firstName: '',
        lastName: '',
        email: '',
        password: '',
        passwordConfirmation: '',
        gender: '',
        birthday: '',
        firstNameErrors: '',
        passwordErrors: '',
        confirmPasswordErrors: '',
        validateFirstName() {
            let firstName = this.firstName;
            let errors = [];
            if (firstName.length < 3) {
                errors.push('First name must be at least 3 characters long.');
            }
            if (/\d/.test(firstName)) {
                errors.push('First name cannot contain numbers.');
            }
            this.firstNameErrors = errors.join('<br>');
        },
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
        validateConfirmationPassword() {
            let password = this.password;
            let passwordConfirmation = this.passwordConfirmation;
            let errors = [];
            if (password !== passwordConfirmation) {
                errors.push('Password and confirmation do not match.');
            }
            this.confirmPasswordErrors = errors.join('<br>');
        },
        getMaxDate() {
            let date = new Date();
            date.setFullYear(date.getFullYear() - 15);
            return date.toISOString().split('T')[0];
        },
        getMinDate() {
            let date = new Date();
            date.setFullYear(date.getFullYear() - 80);
            return date.toISOString().split('T')[0];
        },
        submitForm(event) {
            event.preventDefault(); // Mencegah perilaku default pengiriman formulir
            this.validateFirstName();
            this.validatePassword();
            this.validateConfirmationPassword();
            if (this.firstNameErrors || this.passwordErrors || this.confirmPasswordErrors) {
                return;
            }
            console.log({
                firstName: this.firstName,
                lastName: this.lastName,
                email: this.email,
                password: this.password,
                passwordConfirmation: this.passwordConfirmation,
                gender: this.gender,
                birthday: this.birthday,
            });
            this.$refs.form.submit();
        }
    }" x-init="() => {}" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4"
        method="POST" action="{{ route('register') }}" @submit.prevent="submitForm" x-ref="form">
        @csrf

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="firstName">
                First Name<span class="text-red-500">*</span>
            </label>
            <input
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @if ($errors->has('first_name')) border-red-500 @endif"
                id="firstName" name="first_name" type="text" autocomplete="given-name" x-model="firstName"
                placeholder="First Name" required autofocus @input="validateFirstName" value="{{ old('first_name') }}">
            <p class="text-red-500 text-xs italic" x-html="firstNameErrors"></p>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="lastName">
                Last Name
            </label>
            <input
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @if ($errors->has('last_name')) border-red-500 @endif"
                id="lastName" name="last_name" type="text" autocomplete="family-name" x-model="lastName"
                placeholder="Last Name" value="{{ old('last_name') }}">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                Email<span class="text-red-500">*</span>
            </label>
            <input
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @if ($errors->has('email')) border-red-500 @endif"
                id="email" name="email" type="email" autocomplete="email" x-model="email" placeholder="Email"
                value="{{ old('email') }}" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="gender">
                Gender<span class="text-red-500">*</span>
            </label>
            <select
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @if ($errors->has('gender')) border-red-500 @endif"
                id="gender" name="gender" x-model="gender" required>
                <option value="" disabled selected>-- Select Gender --</option>
                <option value="male">Male
                <option value="female">Female</option>
            </select>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="birthday">
                Birthday<span class="text-red-500">*</span>
            </label>
            <input
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @if ($errors->has('birthday')) border-red-500 @endif"
                id="birthday" name="birthday" type="date" x-model="birthday" :max="getMaxDate()"
                :min="getMinDate()" required>
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                Password<span class="text-red-500">*</span>
            </label>
            <input
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @if ($errors->has('password')) border-red-500 @endif"
                id="password" name="password" type="password" autocomplete="new-password" placeholder="Password"
                required x-model="password" @input="validatePassword">
            <p class="text-red-500 text-xs italic" x-html="passwordErrors"></p>
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="passwordConfirmation">
                Confirm Password<span class="text-red-500">*</span>
            </label>
            <input
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @if ($errors->has('password')) border-red-500 @endif"
                id="passwordConfirmation" name="passwordConfirmation" type="password" autocomplete="new-password"
                placeholder="Confirm Password" required x-model="passwordConfirmation"
                @input="validateConfirmationPassword">
            <p class="text-red-500 text-xs italic" x-html="confirmPasswordErrors"></p>
        </div>

        <div class="mb-9 text-green-500 text-xs italic">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
        </div>

        <div class="mb-9 text-red-500 text-xs italic">
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            @if ($errors->any())
                <div>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>

        <div class="flex items-center justify-between">
            <button
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                type="submit">
                Register
            </button>
            <a class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800" href="/login">
                Have Account? Login.
            </a>
        </div>
    </form>
</x-layout.auth>
