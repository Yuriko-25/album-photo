-- SQL du TD 3. Ajouts : création de la base (début) et AUTO_INCREMENT (fin).
CREATE DATABASE IF NOT EXISTS `album_photo` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `album_photo`;

CREATE TABLE `albums` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `titre` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `creation` date NOT NULL,
  `user_id` bigint(20) DEFAULT NULL
);

INSERT INTO `albums` (`id`, `titre`, `creation`, `user_id`) VALUES
(1, 'Album1', '2023-07-14', NULL),
(2, 'Album2', '2023-02-25', NULL);

CREATE TABLE `photos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `titre` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` int(11) NOT NULL DEFAULT '1',
  `album_id` bigint(20) NOT NULL
);

INSERT INTO `photos` (`id`, `titre`, `url`, `note`, `album_id`) VALUES
(1, 'Ski', 'https://media.skirentalsolution.sport2000.fr/images/cache/cms_image_runtime/rc/bkNlTEFr/cms/CMS%20Guide%20Sport%202000/Ski-Alpin-histoire.jpg', 4, 2),
(2, 'Raquette', 'https://img.hardloop.com/image/upload/v1609858588/articles/id-645-comment-choisir-ses-raquettes-a-neige/randonnee-en-raquettes.jpg', 2, 2),
(3, 'Raclette', 'https://static.actu.fr/uploads/2021/10/la-friche-gourmande-hiver-raclette-station-de-ski-lille-marcq-en-baroeul-960x640.jpg', 4, 2),
(4, 'caraibes', 'https://www.lodge-coco.com/wp-content/uploads/2020/05/Plage-Grande-Anse-Deshaies-Guadeloupe-1000-768x513.jpg', 4, 1),
(5, 'fruits', 'https://www.autolagon.fr/blog/wp-content/uploads/2019/08/58845566_719194398539870_1399447932997992448_o-1080x675.jpg', 2, 1);

CREATE TABLE `possede_tag` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `photo_id` bigint(20) NOT NULL,
  `tag_id` bigint(20) NOT NULL
);

INSERT INTO `possede_tag` (`id`, `photo_id`, `tag_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 1),
(4, 2, 2),
(5, 3, 1),
(6, 3, 4),
(7, 4, 2),
(8, 4, 3),
(9, 5, 2),
(10, 5, 4);

CREATE TABLE `tags` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
);

INSERT INTO `tags` (`id`, `nom`) VALUES
(1, 'neige'),
(2, 'vacances'),
(3, 'mer'),
(4, 'repas');

ALTER TABLE `albums` ADD PRIMARY KEY (`id`);
ALTER TABLE `photos` ADD PRIMARY KEY (`id`);
ALTER TABLE `possede_tag` ADD PRIMARY KEY (`id`);
ALTER TABLE `tags` ADD PRIMARY KEY (`id`);

-- Sans ça, ajouter un album ou une photo sans préciser d'id échoue
ALTER TABLE `albums` MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
ALTER TABLE `photos` MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
ALTER TABLE `possede_tag` MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
ALTER TABLE `tags` MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
