<?php require base_path('views/partials/head.php'); ?>
<?php require base_path('views/partials/nav.php'); ?>

    <main>
        <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
            <div class="sm:mx-auto sm:w-full sm:max-w-sm">
                <img src="https://tailwindcss.com/plus-assets/img/logos/mark.svg?color=indigo&shade=500" alt="Your Company" class="mx-auto h-10 w-auto" />
                <h2 class="mt-10 text-center text-2xl/9 font-bold tracking-tight text-white">Register for a new account</h2>
            </div>

            <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
                <form action="/register" method="POST" class="space-y-6">
                    <div>
                        <label for="name" class="block text-sm/6 font-medium text-gray-100">Name</label>
                        <div class="mt-2">
                            <input id="name" type="text" name="name" required autocomplete="name" class="block w-full rounded-md bg-white/5 px-3 py-1.5 text-base text-white outline-1 -outline-offset-1 outline-white/10 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6" />
                        </div>
                        <?php if (isset($errors['name'])) : ?>
                            <p class="text-red-500 text-xs mt-2"><?= $errors['name'] ?></p>
                        <?php endif ?>
                    </div>

                    <div>
                        <label for="email" class="block text-sm/6 font-medium text-gray-100">Email address</label>
                        <div class="mt-2">
                            <input id="email" type="email" name="email" required autocomplete="email" class="block w-full rounded-md bg-white/5 px-3 py-1.5 text-base text-white outline-1 -outline-offset-1 outline-white/10 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6" />
                        </div>
                        <?php if (isset($errors['email'])) : ?>
                            <p class="text-red-500 text-xs mt-2"><?= $errors['email'] ?></p>
                        <?php endif ?>
                    </div>

                    <div>
                        <label for="password" class="block text-sm/6 font-medium text-gray-100">Password</label>
                        <div class="mt-2">
                            <input id="password" type="password" name="password" required autocomplete="current-password" class="block w-full rounded-md bg-white/5 px-3 py-1.5 text-base text-white outline-1 -outline-offset-1 outline-white/10 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6" />
                        </div>
                        <?php if (isset($errors['password'])) : ?>
                            <p class="text-red-500 text-xs mt-2"><?= $errors['password'] ?></p>
                        <?php endif ?>
                    </div>

                    <div>
                        <button type="submit" class="flex w-full justify-center rounded-md bg-indigo-500 px-3 py-1.5 text-sm/6 font-semibold text-white hover:bg-indigo-400 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">Register</button>
                    </div>
                </form>

                <p class="mt-10 text-center text-sm/6 text-gray-400">
                    Already exists?
                    <a href="/login" class="font-semibold text-indigo-400 hover:text-indigo-300">Login</a>
                </p>
            </div>
        </div>

    </main>

<?php require base_path('views/partials/footer.php'); ?>