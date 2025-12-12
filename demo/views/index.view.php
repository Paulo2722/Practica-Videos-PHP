<?php require base_path('views/partials/head.php'); ?>
<?php require base_path('views/partials/nav.php'); ?>
<?php require base_path('views/partials/banner.php'); ?>

    <main>
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <p class="text-white">Hello <?= $_SESSION['user']['name'] ?? "Guest" ?>. Welcome to the home page.</p>

            <!--Campos para añadir el cumpleaños y el telefono!-->
            <form method="post">
                <input type="date" style="color: blue">
                <input type="text" style="color: blue">
                <button type="submit">Guardar</button>
            </form>
        </div>
    </main>

<?php require base_path('views/partials/footer.php'); ?>