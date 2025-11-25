-- SECTION 3: Notes --
create database if not exists myapp;
use myapp;

drop table if exists users;
drop table if exists notes;
drop table if exists posts;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notes`
--

CREATE TABLE `notes` (
                         `id` int NOT NULL,
                         `body` text NOT NULL,
                         `user_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `notes`
--

INSERT INTO `notes` (`id`, `body`, `user_id`) VALUES
                                                  (23, 'rr', 3),
                                                  (24, 'qwerty', 3),
                                                  (25, 'qwdf', 3),
                                                  (26, 'dfghjk', 9);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `posts`
--

CREATE TABLE `posts` (
                         `id` int NOT NULL,
                         `title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `posts`
--

INSERT INTO `posts` (`id`, `title`) VALUES
                                        (1, 'My first blog'),
                                        (2, 'My second blog');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
                         `id` int NOT NULL,
                         `name` varchar(255) NOT NULL,
                         `email` varchar(255) NOT NULL,
                         `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`) VALUES
                                                            (3, 'Sergio', 'sergio@gmail.com', '$2y$10$DxmNVQBtcoS7dvCykJo77ekY/FVrvn/lLqAV70dLOXWy/bQosxnqW'),
                                                            (4, 'Amine', 'amine@gmail.com', '$2y$10$4h9HGJhJh.l4vOeZRFCUdulfpuw3i7qlri2NxJ9pa3BZIcLiyI8ty'),
                                                            (9, 'Paco', 'paco@gmail.com', '$2y$10$aYjhvMOGN61MWrO.C7TYVOX9iam733O8bacTRMKIvGPFb.t47SGoC');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `notes`
--
ALTER TABLE `notes`
    ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indices de la tabla `posts`
--
ALTER TABLE `posts`
    ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
    ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `notes`
--
ALTER TABLE `notes`
    MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `posts`
--
ALTER TABLE `posts`
    MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
    MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `notes`
--
ALTER TABLE `notes`
    ADD CONSTRAINT `notes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;
