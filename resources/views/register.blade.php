<x-app-layout>
    <div class="bg-black text-white flex min-h-screen flex-col items-center pt-16 sm:justify-center sm:pt-0">

        <!-- Logo and title -->
        <div class="text-foreground font-semibold text-2xl tracking-tighter mx-auto flex items-center gap-2">
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15.042 21.672L13.684 16.6m0 0-2.51 2.225.569-9.47 5.227 7.917-3.286-.672Zm-7.518-.267A8.25 8.25 0 1 1 20.25 10.5M8.288 14.212A5.25 5.25 0 1 1 17.25 10.5" />
                </svg>
            </div>
            Ardiansyah Putra
        </div>

        <!-- Registration form container -->
        <div class="relative mt-12 w-full max-w-lg sm:mt-10">
            <div class="relative -mb-px h-px w-full bg-gradient-to-r from-transparent via-sky-300 to-transparent"></div>
            <div
                class="mx-5 border dark:border-b-white/50 dark:border-t-white/50 border-b-white/20 sm:border-t-white/20 shadow-[20px_0_20px_20px] shadow-slate-500/10 dark:shadow-white/20 rounded-lg border-white/20 border-l-white/20 border-r-white/20 sm:shadow-sm lg:rounded-xl lg:shadow-none">

                <!-- Heading -->
                <div class="flex flex-col p-6">
                    <h3 class="text-xl font-semibold leading-6 tracking-tighter">Register</h3>
                    <p class="mt-1.5 text-sm font-medium text-white/50">Create an account to get started.</p>
                </div>

                <!-- Registration form -->
                <div class="p-6 pt-0">
                    <form id="registrationForm" method="POST" action="{{ url('/register') }}">
                        @csrf

                        <!-- Name input -->
                        <div class="mb-4">
                            <label for="name" class="block text-xs font-medium text-gray-400">Name</label>
                            <div
                                class="group relative rounded-lg border px-3 py-2 mt-1 focus-within:border-sky-200 focus-within:ring focus-within:ring-sky-300/30">
                                <input type="text" id="name" name="name" placeholder="Name" autocomplete="off"
                                    class="block w-full border-0 bg-transparent text-sm text-foreground placeholder:text-muted-foreground focus:outline-none focus:ring-0">
                            </div>
                            @error('name')
                            <p class="text-xs text-red-500 mt-1 hidden" id="nameError">{{ $message }}</p>
                            @enderror
                            <p class="text-xs text-red-500 mt-1 hidden" id="nameError"></p>
                        </div>

                        <!-- Email input -->
                        <div class="mb-4">
                            <label for="email" class="block text-xs font-medium text-gray-400">Email</label>
                            <div
                                class="group relative rounded-lg border px-3 py-2 mt-1 focus-within:border-sky-200 focus-within:ring focus-within:ring-sky-300/30">
                                <input type="email" id="email" name="email" placeholder="Email" autocomplete="off"
                                    class="block w-full border-0 bg-transparent text-sm text-foreground placeholder:text-muted-foreground focus:outline-none focus:ring-0">
                            </div>
                            @error('email')
                            <p class="text-xs text-red-500 mt-1 hidden" id="emailError">{{ $message }}</p>
                            @enderror
                            <p class="text-xs text-red-500 mt-1 hidden" id="emailError"></p>
                        </div>

                        <!-- Password input -->
                        <div class="mb-4 relative">
                            <label for="password" class="block text-xs font-medium text-gray-400">Password</label>
                            <div
                                class="group relative rounded-lg border px-3 py-2 mt-1 focus-within:border-sky-200 focus-within:ring focus-within:ring-sky-300/30">
                                <input type="password" name="password" id="password" placeholder="Password"
                                    class="block w-full border-0 bg-transparent text-sm text-foreground placeholder:text-muted-foreground focus:outline-none focus:ring-0">
                                <button type="button" id="togglePassword"
                                    class="absolute inset-y-0 right-0 flex items-center px-2">
                                    <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 3c5.25 0 9.9 3.8 11.4 8.4a1.5 1.5 0 0 1 0 1.2C21.9 19.2 17.25 23 12 23s-9.9-3.8-11.4-8.4a1.5 1.5 0 0 1 0-1.2C2.1 6.8 6.75 3 12 3Zm0 6a3 3 0 1 0 0 6 3 3 0 0 0 0-6Zm0 1.5a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Z" />
                                    </svg>
                                </button>
                            </div>
                            @error('password')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                            <p class="text-xs text-red-500 mt-1 hidden" id="passwordError"></p>
                        </div>

                        <!-- Password confirmation input -->
                        <div class="mb-4 relative">
                            <label for="password_confirmation" class="block text-xs font-medium text-gray-400">Confirm
                                Password</label>
                            <div
                                class="group relative rounded-lg border px-3 py-2 mt-1 focus-within:border-sky-200 focus-within:ring focus-within:ring-sky-300/30">
                                <input type="password" name="password_confirmation" id="password_confirmation"
                                    placeholder="Confirm Password"
                                    class="block w-full border-0 bg-transparent text-sm text-foreground placeholder:text-muted-foreground focus:outline-none focus:ring-0">
                                <button type="button" id="togglePasswordConfirm"
                                    class="absolute inset-y-0 right-0 flex items-center px-2">
                                    <svg id="eyeIconConfirm" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 3c5.25 0 9.9 3.8 11.4 8.4a1.5 1.5 0 0 1 0 1.2C21.9 19.2 17.25 23 12 23s-9.9-3.8-11.4-8.4a1.5 1.5 0 0 1 0-1.2C2.1 6.8 6.75 3 12 3Zm0 6a3 3 0 1 0 0 6 3 3 0 0 0 0-6Zm0 1.5a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Z" />
                                    </svg>
                                </button>
                            </div>
                            @error('password_confirmation')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                            <p class="text-xs text-red-500 mt-1 hidden" id="passwordConfirmError">
                            </p>
                        </div>

                        <!-- Buttons -->
                        <div class="mt-4 flex items-center justify-end gap-x-2">
                            <a href="/"
                                class="inline-flex items-center justify-center rounded-md text-sm font-medium transition-all focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 hover:bg-accent hover:ring hover:ring-white h-10 px-4 py-2 duration-200">
                                Already have an account?
                            </a>
                            <button type="submit"
                                class="font-semibold bg-white text-black rounded-md text-sm h-10 px-4 py-2 transition hover:bg-black hover:text-white hover:ring hover:ring-white">
                                Register
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Validate Email
        function validateEmail(email) {
            const re = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
            return re.test(email);
        }

        // Name validation function
        function validateName(name) {
            // Name should be at least 3 characters long and only contain letters and spaces
            return /^[a-zA-Z\s]{3,}$/.test(name);
        }

        // Password validation function
        function validatePassword(password) {
            // Password should be at least 8 characters long and include at least one number, one uppercase letter, one lowercase letter, and one special character
            const re = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
            return re.test(password);
        }

        // Toggle password visibility
        function togglePasswordVisibility(passwordField, icon) {
            const type = passwordField.type === 'password' ? 'text' : 'password';
            passwordField.type = type;
            icon.setAttribute('stroke', type === 'password' ? 'currentColor' : 'none');
        }

        document.getElementById('name').addEventListener('input', function () {
            const name = this.value;
            const nameError = document.getElementById('nameError');
            if (!validateName(name)) {
                nameError.textContent = 'Name must be at least 3 characters long and only contain letters and spaces.';
                nameError.classList.remove('hidden');
            } else {
                nameError.classList.add('hidden');
            }
        });

        document.getElementById('email').addEventListener('input', function () {
            const email = this.value;
            const emailError = document.getElementById('emailError');
            if (!validateEmail(email)) {
                emailError.textContent = 'Please enter a valid email address.';
                emailError.classList.remove('hidden');
            } else {
                emailError.classList.add('hidden');
            }
        });

        document.getElementById('password').addEventListener('input', function () {
            const password = this.value;
            const passwordError = document.getElementById('passwordError');
            if (!validatePassword(password)) {
                if (password.length < 8) {
                    passwordError.textContent = 'Password must be at least 8 characters long.';
                } else if (!/[A-Z]/.test(password)) {
                    passwordError.textContent = 'Password must contain at least one uppercase letter.';
                } else if (!/[a-z]/.test(password)) {
                    passwordError.textContent = 'Password must contain at least one lowercase letter.';
                } else if (!/[0-9]/.test(password)) {
                    passwordError.textContent = 'Password must contain at least one number.';
                } else if (!/[@$!%*?&]/.test(password)) {
                    passwordError.textContent = 'Password must contain at least one special character.';
                } else {
                    passwordError.textContent = 'Password is too weak. Please choose a stronger password.';
                }
                passwordError.classList.remove('hidden');
            } else {
                passwordError.classList.add('hidden');
            }
        });

        document.getElementById('password_confirmation').addEventListener('input', function () {
            const password = document.getElementById('password').value;
            const passwordConfirmation = this.value;
            const passwordConfirmError = document.getElementById('passwordConfirmError');
            if (password !== passwordConfirmation) {
                passwordConfirmError.textContent = 'Passwords do not match.';
                passwordConfirmError.classList.remove('hidden');
            } else {
                passwordConfirmError.classList.add('hidden');
            }
        });

        document.getElementById('togglePassword').addEventListener('click', function () {
            const passwordField = document.getElementById('password');
            const icon = document.getElementById('eyeIcon');
            togglePasswordVisibility(passwordField, icon);
        });

        document.getElementById('togglePasswordConfirm').addEventListener('click', function () {
            const passwordConfirmField = document.getElementById('password_confirmation');
            const iconConfirm = document.getElementById('eyeIconConfirm');
            togglePasswordVisibility(passwordConfirmField, iconConfirm);
        });
    </script>
</x-app-layout>
