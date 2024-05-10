-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 10 mai 2024 à 19:45
-- Version du serveur : 10.4.24-MariaDB
-- Version de PHP : 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `techr`
--

-- --------------------------------------------------------

--
-- Structure de la table `brand`
--

CREATE TABLE `brand` (
  `brand_id` int(11) NOT NULL,
  `brand_name` varchar(150) NOT NULL,
  `brand_image` varchar(250) NOT NULL,
  `brand_slug` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `brand`
--

INSERT INTO `brand` (`brand_id`, `brand_name`, `brand_image`, `brand_slug`) VALUES
(7, 'CONDOR', '9058e3a17d4b9abed392ad2823f1991d.png', 'CONDOR'),
(9, 'IRIS', '6be235a75f79736c3a409db578cd34be.png', 'iris'),
(12, 'enie', '1e337f75ee090a3677825f4cf5af41f9.png', 'enie');

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(150) NOT NULL,
  `category_image` varchar(250) NOT NULL,
  `category_slug` varchar(150) NOT NULL,
  `brand_id` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `category_image`, `category_slug`, `brand_id`) VALUES
(2, 'Televisions', 'c2e704303411471b175f61923b620676.webp', 'televisions', NULL),
(3, 'Laptops', '23e5db1d6e9877d8d81d1e87c95bca59.jpg', 'laptops', NULL),
(4, 'Smartphones', '33e271be784b566b69a571fa5a60a246.jpg', 'smartphones', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `coupon`
--

CREATE TABLE `coupon` (
  `coupon_id` int(11) NOT NULL,
  `coupon_code` varchar(250) NOT NULL,
  `discount_amount` smallint(6) NOT NULL,
  `expiration_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `VendorId` int(11) DEFAULT NULL,
  `coupon_status` tinyint(4) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `coupon`
--

INSERT INTO `coupon` (`coupon_id`, `coupon_code`, `discount_amount`, `expiration_date`, `VendorId`, `coupon_status`) VALUES
(1, 'hamzawy15', 15, '2023-06-22 10:24:00', 7, 1),
(2, 'hamzawy18', 18, '2023-06-30 10:25:00', 7, 1),
(3, 'hassibaiz', 10, '2024-04-28 05:05:00', 9, 1);

-- --------------------------------------------------------

--
-- Structure de la table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `get_product_data`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `get_product_data` (
`product_id` int(11)
,`product_name` varchar(250)
,`product_slug` varchar(250)
,`product_code` varchar(250)
,`product_quantity` int(11)
,`product_tags` varchar(250)
,`product_price` double
,`product_short_description` text
,`product_long_description` text
,`product_thumbnail` varchar(250)
,`product_status` binary(1)
,`sub_category_id` int(11)
,`brand_id` int(11)
,`vendor_id` int(11)
,`product_colors` varchar(250)
,`offer_id` int(11)
,`offer_product_id` int(11)
,`hot_deal` tinyint(4)
,`featured_product` tinyint(4)
,`special_offer` tinyint(4)
,`special_deal` tinyint(4)
);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `get_sub_categories`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `get_sub_categories` (
`sub_category_id` int(11)
,`sub_category_name` varchar(150)
,`sub_category_slug` varchar(150)
,`sub_category_image` varchar(250)
,`selected_category_id` int(11)
,`created_at` timestamp
,`category_name` varchar(150)
);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `get_vendor_data`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `get_vendor_data` (
`id` bigint(20) unsigned
,`photo` varchar(250)
,`name` varchar(255)
,`email` varchar(255)
,`username` varchar(200)
,`shop_name` varchar(200)
,`created_at` timestamp
,`shop_description` text
,`phone_number` varchar(20)
,`address` varchar(200)
,`vendor_id` int(11)
);

-- --------------------------------------------------------

--
-- Structure de la table `marques`
--

CREATE TABLE `marques` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gmail` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `marques`
--

INSERT INTO `marques` (`id`, `name`, `gmail`, `owner_id`) VALUES
(1, 'Condor', 'hassibaizza827@gmail.com', 31),
(2, 'Iris', 'hadjerbouhenni1@gmail.com', 31),
(3, 'Samsung', 'betterkizinebfarah@gmail.com', NULL),
(4, 'Brandt', 'hassibaizza827@gmail.com', 32),
(42, 'enie', 'enie@gmail.com', 27),
(43, 'starlight', 'starlight@gmail.com', NULL),
(47, 'kemei', 'kemei@gmail.com', NULL),
(48, 'Geant', 'geant@gmail.com', 33),
(49, 'enieeeeee', 'enie@gmail.com', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_04_26_192132_create_notifications_table', 1),
(8, '2023_05_31_194504_notifications', 2),
(12, '2023_06_17_182128_add_social_login', 3),
(13, '2024_05_01_221353_add_owner_id_to_marques_table', 4),
(14, '2024_05_03_134147_add_unique_to_marques_name', 5),
(15, '2024_05_04_221821_add_user_id_to_typepannes', 6),
(16, '2024_05_08_091417_add_foreign_key_typep_id_to_typepannes', 7),
(17, '2024_05_08_093237_create_type_pannes', 8),
(18, '2024_05_08_094128_add_foreign_keys_to_type_pannes', 8),
(19, '2024_05_09_194258_add_foreign_keys_to_rendez_vouses', 9);

-- --------------------------------------------------------

--
-- Structure de la table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `notifications`
--

INSERT INTO `notifications` (`id`, `type`, `notifiable_type`, `notifiable_id`, `data`, `read_at`, `created_at`, `updated_at`) VALUES
('2e0613e5-1e23-481b-ac4c-04a11da53090', 'App\\Notifications\\RegisteredNewVendor', 'App\\Models\\User', 18, '{\"title\":\"New User Registered\",\"message\":\"New user account need to be activated.\",\"icon\":\"bx-group\"}', NULL, '2024-05-03 21:30:14', '2024-05-03 21:30:14'),
('30935a67-6044-4772-9828-7a4953af139c', 'App\\Notifications\\VendorActivated', 'App\\Models\\User', 29, '{\"title\":\"Activation\",\"message\":\"Admin has activated your account.\",\"icon\":\"bx-send\"}', NULL, '2024-05-04 20:54:45', '2024-05-04 20:54:45'),
('33393c64-36a1-4289-99b6-93974330b7cc', 'App\\Notifications\\RegisteredNewVendor', 'App\\Models\\User', 18, '{\"title\":\"New User Registered\",\"message\":\"New user account need to be activated.\",\"icon\":\"bx-group\"}', NULL, '2024-05-03 20:44:44', '2024-05-03 20:44:44'),
('374f2540-69a1-44d8-b346-26320c5bef18', 'App\\Notifications\\RegisteredNewVendor', 'App\\Models\\User', 18, '{\"title\":\"New User Registered\",\"message\":\"New user account need to be activated.\",\"icon\":\"bx-group\"}', NULL, '2024-05-03 21:34:40', '2024-05-03 21:34:40'),
('3939c8c7-f35c-4713-b9a0-262cb07feeff', 'App\\Notifications\\VendorActivated', 'App\\Models\\User', 33, '{\"title\":\"Activation\",\"message\":\"Admin has activated your account.\",\"icon\":\"bx-send\"}', NULL, '2024-05-04 20:54:36', '2024-05-04 20:54:36'),
('3fbc4652-ddbb-40a0-9c14-5fbc32986d4f', 'App\\Notifications\\VendorActivated', 'App\\Models\\User', 31, '{\"title\":\"Activation\",\"message\":\"Admin has activated your account.\",\"icon\":\"bx-send\"}', NULL, '2024-05-04 20:54:43', '2024-05-04 20:54:43'),
('40e057ff-9ccf-4eae-b7ab-6dbffce2b5d4', 'App\\Notifications\\BrandOwnerNotification', 'App\\Models\\User', 31, '{\"title\":\"Nouveau Panne\",\"text\":\"Une nouvelle demande de service a \\u00e9t\\u00e9 soumise \",\"message\":\"Une nouvelle demande de service a \\u00e9t\\u00e9 soumise \",\"icon\":\"bx-send\"}', NULL, '2024-05-09 21:02:42', '2024-05-09 21:02:42'),
('4142f082-be0d-492a-a3ef-5ad1027685bb', 'App\\Notifications\\RegisteredNewVendor', 'App\\Models\\User', 18, '{\"title\":\"New User Registered\",\"message\":\"New user account need to be activated.\",\"icon\":\"bx-group\"}', NULL, '2024-05-03 21:15:25', '2024-05-03 21:15:25'),
('4df8e724-99a9-4f21-a0a3-7d9f21096040', 'App\\Notifications\\BrandOwnerNotification', 'App\\Models\\User', 27, '{\"title\":\"Nouveau Panne\",\"message\":\"un utilisateur besion un rendez-vous.\",\"icon\":\"bx-send\",\"details\":\"content\"}', '2024-05-03 23:22:36', '2024-05-03 22:09:06', '2024-05-03 23:22:36'),
('4fe60ad7-81a5-4600-947c-e3b4cc54a453', 'App\\Notifications\\BrandOwnerNotification', 'App\\Models\\User', 31, '{\"title\":\"Nouveau Panne\",\"text\":\"Une nouvelle demande de service a \\u00e9t\\u00e9 soumise \",\"message\":\"Une nouvelle demande de service a \\u00e9t\\u00e9 soumise \",\"icon\":\"bx-send\"}', NULL, '2024-05-09 08:58:00', '2024-05-09 08:58:00'),
('52835379-6621-49ab-8a36-7238607d802c', 'App\\Notifications\\RegisteredNewVendor', 'App\\Models\\User', 18, '{\"title\":\"New User Registered\",\"message\":\"New user account need to be activated.\",\"icon\":\"bx-group\"}', NULL, '2024-05-03 21:27:06', '2024-05-03 21:27:06'),
('6abe810f-50b2-482d-b7c8-a027c56de916', 'App\\Notifications\\RegisteredNewVendor', 'App\\Models\\User', 18, '{\"title\":\"New User Registered\",\"message\":\"New user account need to be activated.\",\"icon\":\"bx-group\"}', NULL, '2024-04-25 23:06:47', '2024-04-25 23:06:47'),
('6b1afe40-0de8-41cf-8e31-758c9982d9ce', 'App\\Notifications\\VendorActivated', 'App\\Models\\User', 26, '{\"title\":\"Activation\",\"message\":\"Admin has activated your account.\",\"icon\":\"bx-send\"}', NULL, '2024-04-25 23:25:13', '2024-04-25 23:25:13'),
('9f125621-7abd-41e6-8bed-3029f3d717b6', 'App\\Notifications\\VendorActivated', 'App\\Models\\User', 26, '{\"title\":\"Activation\",\"message\":\"Admin has activated your account.\",\"icon\":\"bx-send\"}', NULL, '2024-04-24 07:33:17', '2024-04-24 07:33:17'),
('b15ac780-ea42-4495-8687-23f2d30db3ff', 'App\\Notifications\\BrandOwnerNotification', 'App\\Models\\User', 27, '{\"title\":\"Nouveau Panne\",\"text\":\"Une nouvelle demande de service a \\u00e9t\\u00e9 soumise \",\"message\":\"Une nouvelle demande de service a \\u00e9t\\u00e9 soumise \",\"icon\":\"bx-send\"}', NULL, '2024-05-08 06:56:00', '2024-05-08 06:56:00'),
('d6cee3b0-d28c-4ee9-8fd5-a9fdc783e28f', 'App\\Notifications\\VendorActivated', 'App\\Models\\User', 32, '{\"title\":\"Activation\",\"message\":\"Admin has activated your account.\",\"icon\":\"bx-send\"}', NULL, '2024-05-04 20:54:39', '2024-05-04 20:54:39'),
('fdb55a57-37e0-469d-91ae-591767ab988f', 'App\\Notifications\\BrandOwnerNotification', 'App\\Models\\User', 31, '{\"title\":\"Nouveau Panne\",\"text\":\"Une nouvelle demande de service a \\u00e9t\\u00e9 soumise \",\"message\":\"Une nouvelle demande de service a \\u00e9t\\u00e9 soumise \",\"icon\":\"bx-send\"}', NULL, '2024-05-09 21:17:20', '2024-05-09 21:17:20');

-- --------------------------------------------------------

--
-- Structure de la table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(250) NOT NULL,
  `product_code` varchar(250) DEFAULT NULL,
  `product_tags` varchar(250) NOT NULL,
  `product_colors` varchar(250) NOT NULL,
  `product_short_description` text NOT NULL,
  `product_long_description` text DEFAULT NULL,
  `product_slug` varchar(250) NOT NULL,
  `product_price` double NOT NULL,
  `product_thumbnail` varchar(250) NOT NULL,
  `product_status` binary(1) NOT NULL DEFAULT '',
  `sub_category_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `product_quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `product_code`, `product_tags`, `product_colors`, `product_short_description`, `product_long_description`, `product_slug`, `product_price`, `product_thumbnail`, `product_status`, `sub_category_id`, `brand_id`, `vendor_id`, `product_quantity`) VALUES
(1, 'logo-print cotton T-shirt', 'Calvin1', 'tshirt,calvin', 'red,green,yellow,blue', 'logo-print cotton T-shirt from CALVIN KLEIN featuring black, cotton, logo print to the front, round neck, short sleeves and straight hem.', '<div class=\"ltr-92qs1a\" style=\"box-sizing: border-box; flex-flow: column nowrap; gap: var(--spacers-c8); display: flex; color: #222222; font-family: \'Farfetch Basis\', \'Helvetica Neue\', Arial, sans-serif; font-size: 16px; background-color: #ffffff;\">\r\n<h4 class=\"ltr-2pfgen-Body-BodyBold\" style=\"margin: 0px; box-sizing: border-box; font-family: var(--typography-body-font-family); font-size: var(--typography-body-font-size); line-height: var(--typography-body-line-height);\" data-component=\"BodyBold\">Composition</h4>\r\n<p class=\"ltr-4y8w0i-Body\" style=\"margin: 0px; box-sizing: border-box; font-family: var(--typography-body-font-family); font-size: var(--typography-body-font-size); line-height: var(--typography-body-line-height);\" data-component=\"Body\"><span class=\"ltr-4y8w0i-Body\" style=\"box-sizing: border-box; font-family: var(--typography-body-font-family); font-size: var(--typography-body-font-size); line-height: var(--typography-body-line-height);\" data-component=\"Body\">Organic Cotton 100%</span></p>\r\n<p class=\"ltr-4y8w0i-Body\" style=\"margin: 0px; box-sizing: border-box; font-family: var(--typography-body-font-family); font-size: var(--typography-body-font-size); line-height: var(--typography-body-line-height);\" data-component=\"Body\">&nbsp;</p>\r\n</div>\r\n<div class=\"ltr-92qs1a\" style=\"box-sizing: border-box; flex-flow: column nowrap; gap: var(--spacers-c8); display: flex; color: #222222; font-family: \'Farfetch Basis\', \'Helvetica Neue\', Arial, sans-serif; font-size: 16px; background-color: #ffffff;\">\r\n<h4 class=\"ltr-2pfgen-Body-BodyBold\" style=\"margin: 0px; box-sizing: border-box; font-family: var(--typography-body-font-family); font-size: var(--typography-body-font-size); line-height: var(--typography-body-line-height);\" data-component=\"BodyBold\">Washing instructions</h4>\r\n<p class=\"ltr-4y8w0i-Body\" style=\"margin: 0px; box-sizing: border-box; font-family: var(--typography-body-font-family); font-size: var(--typography-body-font-size); line-height: var(--typography-body-line-height);\" data-component=\"Body\">Machine Wash</p>\r\n<p class=\"ltr-4y8w0i-Body\" style=\"margin: 0px; box-sizing: border-box; font-family: var(--typography-body-font-family); font-size: var(--typography-body-font-size); line-height: var(--typography-body-line-height);\" data-component=\"Body\">&nbsp;</p>\r\n</div>\r\n<div class=\"ltr-92qs1a\" style=\"box-sizing: border-box; flex-flow: column nowrap; gap: var(--spacers-c8); display: flex; color: #222222; font-family: \'Farfetch Basis\', \'Helvetica Neue\', Arial, sans-serif; font-size: 16px; background-color: #ffffff;\">\r\n<h4 class=\"ltr-2pfgen-Body-BodyBold\" style=\"margin: 0px; box-sizing: border-box; font-family: var(--typography-body-font-family); font-size: var(--typography-body-font-size); line-height: var(--typography-body-line-height);\" data-component=\"BodyBold\">Wearing</h4>\r\n<p class=\"ltr-4y8w0i-Body\" style=\"margin: 0px; box-sizing: border-box; font-family: var(--typography-body-font-family); font-size: var(--typography-body-font-size); line-height: var(--typography-body-line-height);\" data-component=\"Body\">The model is 1.85 m wearing size M</p>\r\n<div style=\"box-sizing: border-box;\">The model is also styled with:&nbsp;<a class=\"ltr-1gz2lez-Body\" style=\"box-sizing: border-box; font-family: var(--typography-body-font-family); font-size: var(--typography-body-font-size); line-height: var(--typography-body-line-height); background-color: transparent; cursor: pointer; transition-property: color, text-decoration; transition-duration: var(--motion-functional-duration-s); transition-timing-function: var(--motion-functional-easing-standard);\" href=\"https://www.farfetch.com/eg/shopping/men/polo-ralph-lauren-logo-patch-cotton-cargo-shorts-item-19670190.aspx\" data-ffref=\"pp_stl_detail_links\" data-component=\"LinkDark\">Polo Ralph Lauren logo-patch cotton cargo shorts</a>,&nbsp;<a class=\"ltr-1gz2lez-Body\" style=\"box-sizing: border-box; font-family: var(--typography-body-font-family); font-size: var(--typography-body-font-size); line-height: var(--typography-body-line-height); background-color: transparent; cursor: pointer; transition-property: color, text-decoration; transition-duration: var(--motion-functional-duration-s); transition-timing-function: var(--motion-functional-easing-standard);\" href=\"https://www.farfetch.com/eg/shopping/men/asics-gel-1130-low-top-sneakers-item-17627735.aspx\" data-ffref=\"pp_stl_detail_links\" data-component=\"LinkDark\">ASICS Gel-1130 low-top sneakers</a></div>\r\n<div style=\"box-sizing: border-box;\">&nbsp;</div>\r\n</div>\r\n<div class=\"ltr-92qs1a\" style=\"box-sizing: border-box; flex-flow: column nowrap; gap: var(--spacers-c8); display: flex; color: #222222; font-family: \'Farfetch Basis\', \'Helvetica Neue\', Arial, sans-serif; font-size: 16px; background-color: #ffffff;\">\r\n<h4 class=\"ltr-2pfgen-Body-BodyBold\" style=\"margin: 0px; box-sizing: border-box; font-family: var(--typography-body-font-family); font-size: var(--typography-body-font-size); line-height: var(--typography-body-line-height);\" data-component=\"BodyBold\">Product IDs</h4>\r\n<p class=\"ltr-4y8w0i-Body\" style=\"margin: 0px; box-sizing: border-box; font-family: var(--typography-body-font-family); font-size: var(--typography-body-font-size); line-height: var(--typography-body-line-height);\" data-component=\"Body\">FARFETCH ID:&nbsp;<span class=\"ltr-4y8w0i-Body\" dir=\"ltr\" style=\"box-sizing: border-box; font-family: var(--typography-body-font-family); font-size: var(--typography-body-font-size); line-height: var(--typography-body-line-height);\" data-component=\"Body\">19667543</span></p>\r\n<p class=\"ltr-4y8w0i-Body\" style=\"margin: 0px; box-sizing: border-box; font-family: var(--typography-body-font-family); font-size: var(--typography-body-font-size); line-height: var(--typography-body-line-height);\" data-component=\"Body\">Brand style ID:&nbsp;<span class=\"ltr-4y8w0i-Body\" dir=\"ltr\" style=\"box-sizing: border-box; font-family: var(--typography-body-font-family); font-size: var(--typography-body-font-size); line-height: var(--typography-body-line-height);\" data-component=\"Body\">K10K111133</span></p>\r\n</div>', 'logo-print-cotton-t-shirt', 390.5, 'fd1e5c8620dd7be3c591e7df82164471.webp', 0x31, 3, 7, 7, 15),
(2, 'téléviseur', 'tel', 'tel', 'noir', '//', '//', 'téléviseur', 23000, 'b6803f420a4bca4b3e291eeaa628e1e1.png', 0x31, 2, 9, 9, 10),
(3, 'refrigirateur', 'refrigirateur', 'refrigirateur', 'blanc', 'refrigirateur nouvelle technologie', '<p>bienvenu chez notre point de vents&nbsp;</p>', 'refrigirateur', 70000, '98503fc4016064215712e010b8f607eb.jpg', 0x31, 3, 9, 9, 10),
(4, 'clima', 'clima', 'clima', 'blanc', '/', '<p>/</p>', 'clima', 25000, 'b1dc8741d1955805a0b893586f4b8d88.png', 0x31, 2, 9, 9, 6),
(5, 'téléphone', 'telephone', 'téléphone', 'gris', '/', '<p>/</p>', 'téléphone', 23000, '1e892d42c1124be9cc9de50a96a3e90f.png', 0x31, 2, 9, 9, 4),
(6, 'téléviseur condor', 'tell', 'téle', 'fdfd', 'Smart 52 pouces', '<p>bienvenue chez notre point de vents</p>', 'téléviseur-condor', 23000, 'c406f84a1bfe1100c9dc428e8506329e.jpg', 0x31, 2, 7, 9, 3);

-- --------------------------------------------------------

--
-- Structure de la table `product_images`
--

CREATE TABLE `product_images` (
  `image_id` int(11) NOT NULL,
  `product_image` varchar(250) NOT NULL,
  `image_product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `product_images`
--

INSERT INTO `product_images` (`image_id`, `product_image`, `image_product_id`) VALUES
(1, '54527d2d08eff6faae4689e350e6a84a.webp', 1),
(2, '1f8be4908ff805608e5e1d66ad1ca513.webp', 1),
(3, 'b222d66e6f34f0473a161489f18f6b24.webp', 1),
(4, '2a5d104f3e3de3e50a832c128c95c6e8.jpg', 2),
(5, '067be4dd26adaea65c4bc3bba00fb7ef.PNG', 2),
(6, '389fd375b0e9237f6f2b99651c6c6924.jpg', 3),
(7, '8e575313d4e9f0788a7ca7d38f7d671a.jpg', 3),
(8, '78771067ad68787ae52a57c54c02b7c1.jpg', 3),
(9, 'ebbd74c917767cd5350c22bdab537aa8.png', 4),
(10, 'a0fed8ad74e4757bc92a16b99b87faac.jpg', 5),
(12, '872a8513197f8cdf87836fa4a3225e02.png', 6);

-- --------------------------------------------------------

--
-- Structure de la table `product_offers`
--

CREATE TABLE `product_offers` (
  `offer_id` int(11) NOT NULL,
  `hot_deal` tinyint(4) DEFAULT 0,
  `featured_product` tinyint(4) DEFAULT 0,
  `special_offer` tinyint(4) DEFAULT 0,
  `special_deal` tinyint(4) DEFAULT 0,
  `offer_product_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `product_offers`
--

INSERT INTO `product_offers` (`offer_id`, `hot_deal`, `featured_product`, `special_offer`, `special_deal`, `offer_product_id`) VALUES
(1, 1, 0, 1, 0, 1),
(2, 1, 0, 0, 0, 2),
(3, 0, 1, 0, 0, 3),
(4, 0, 0, 0, 1, 4),
(5, 0, 1, 0, 0, 5),
(6, 0, 0, 0, 1, 6);

-- --------------------------------------------------------

--
-- Structure de la table `rendez_vouses`
--

CREATE TABLE `rendez_vouses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `mail` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `marque` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `catégorie` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `panne` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `problème` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sujet` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `rendez_vouses`
--

INSERT INTO `rendez_vouses` (`id`, `mail`, `marque`, `catégorie`, `panne`, `problème`, `nom`, `sujet`, `created_at`, `updated_at`, `client_id`) VALUES
(1, 'bellesonia18@gmail.com', '1', 'Uttar Pradesh', 'Kanpur', 'kllll', 'hadjer', 'hhdhhhdhhd', '2024-04-21 07:59:22', '2024-04-21 07:59:22', NULL),
(2, 'bellesonia18@gmail.com', '1', 'Uttar Pradesh', 'Lucknow', 'llldllf', 'hadjer', 'hhdhhhdhhd', '2024-04-21 13:47:19', '2024-04-21 13:47:19', NULL),
(3, 'bellesonia18@gmail.com', '1', 'Téléphones mobiles', 'Écran cassé ou endommagé', 'gugyffyyfyf', 'hadjer', 'hhdhhhdhhd', '2024-04-22 08:47:18', '2024-04-22 08:47:18', NULL),
(4, 'bellesonia18@gmail.com', '1', 'Téléphones mobiles', 'Écran cassé ou endommagé', 'ffffthyhyrfd', 'hadjer', 'hhdhhhdhhd', '2024-04-23 06:03:13', '2024-04-23 06:03:13', NULL),
(5, 'hassibaizza9@gmail.com', '1', 'Téléphones mobiles', 'Problèmes de batterie', '::://', 'hassiba', '280 LOGT', '2024-04-27 00:07:39', '2024-04-27 00:07:39', NULL),
(6, 'hassibaizza9@gmail.com', '1', 'Téléphones mobiles', 'Problèmes de batterie', '//', 'hassiba', '//', '2024-04-27 11:27:29', '2024-04-27 11:27:29', NULL),
(7, 'hassibaizza827@gmail.com', '1', 'Téléphones mobiles', 'Problèmes de batterie', '//', 'hajer', '//', '2024-04-28 19:36:19', '2024-04-28 19:36:19', NULL),
(8, 'hajer@gmail.com', '1', 'Téléphones mobiles', 'Problèmes de batterie', '//', 'hajer', '//', '2024-04-28 22:02:08', '2024-04-28 22:02:08', NULL),
(9, 'hajer@gmail.com', '1', 'Téléphones mobiles', 'Problèmes de batterie', '//', 'hajer', '//', '2024-04-28 22:16:05', '2024-04-28 22:16:05', NULL),
(10, 'hajer@gmail.com', '1', 'Téléphones mobiles', 'Problèmes de batterie', '//', 'hajer', '//', '2024-04-28 22:16:53', '2024-04-28 22:16:53', NULL),
(11, 'hassibaizza9@gmail.com', '1', 'Téléphones mobiles', 'Problèmes de batterie', '//', 'hajer', '//', '2024-04-28 22:17:29', '2024-04-28 22:17:29', NULL),
(12, 'hassibaizza9@gmail.com', '1', 'Téléphones mobiles', 'Problèmes de batterie', '//', 'hajer', '//', '2024-04-28 22:34:23', '2024-04-28 22:34:23', NULL),
(13, 'hassibaizza9@gmail.com', '1', 'Téléphones mobiles', 'Problèmes de batterie', '//', 'hajer', '//', '2024-04-28 22:39:22', '2024-04-28 22:39:22', NULL),
(14, 'hajer@gmail.com', '1', 'Téléphones mobiles', 'Problèmes de batterie', '//', 'hajer', '//', '2024-04-29 21:46:08', '2024-04-29 21:46:08', NULL),
(15, 'hajer@gmail.com', '1', 'Téléphones mobiles', 'Problèmes de batterie', '//', 'hajer', '//', '2024-04-29 21:47:24', '2024-04-29 21:47:24', NULL),
(16, 'hajer@gmail.com', '1', 'Téléphones mobiles', 'Problèmes de batterie', '//', 'hajer', '//', '2024-04-29 21:53:39', '2024-04-29 21:53:39', NULL),
(17, 'hajer@gmail.com', '1', 'Téléphones mobiles', 'Problèmes de batterie', '//', 'hajer', '//', '2024-04-29 21:56:54', '2024-04-29 21:56:54', NULL),
(18, 'hajer@gmail.com', '1', 'Téléphones mobiles', 'Problèmes de batterie', '//', 'hajer', '//', '2024-04-29 22:20:12', '2024-04-29 22:20:12', NULL),
(19, 'hajer@gmail.com', '1', 'Tablettes', 'Problèmes d\'écran tactile', '//', 'admin', 'nn,n', '2024-04-29 22:26:30', '2024-04-29 22:26:30', NULL),
(20, 'hajer@gmail.com', '1', 'Tablettes', 'Problèmes d\'écran tactile', 'gg', 'hajer', 'b', '2024-04-30 21:17:31', '2024-04-30 21:17:31', NULL),
(21, 'hajer@gmail.com', '1', 'Tablettes', 'Problèmes d\'écran tactile', 'gg', 'hajer', 'b', '2024-04-30 21:21:42', '2024-04-30 21:21:42', NULL),
(22, 'hassibaizza827@gmail.com', '1', 'Téléphones mobiles', 'Écran cassé ou endommagé', 'hhh', 'TechRevive', 'nn', '2024-04-30 21:22:49', '2024-04-30 21:22:49', NULL),
(23, 'hassibaizza827@gmail.com', '1', 'Téléphones mobiles', 'Écran cassé ou endommagé', 'hhh', 'TechRevive', 'nn', '2024-04-30 21:33:26', '2024-04-30 21:33:26', NULL),
(24, 'hajer@gmail.com', '1', 'Tablettes', 'Problèmes d\'écran tactile', 'nn', 'admin', 'nn', '2024-04-30 21:34:27', '2024-04-30 21:34:27', NULL),
(25, 'hassibaizza9@gmail.com', '1', 'Tablettes', 'Problèmes de batterie', 'nn', 'enseignants', 'bbb', '2024-04-30 22:14:13', '2024-04-30 22:14:13', NULL),
(26, 'hajer@gmail.com', '1', 'Tablettes', 'Problèmes d\'écran tactile', 'ee', 'admin', 'ee', '2024-05-01 20:24:32', '2024-05-01 20:24:32', NULL),
(27, 'hajer@gmail.com', '1', 'Téléphones mobiles', 'Problèmes de batterie', '::::::::::::::', 'hajer', '::', '2024-05-03 22:09:01', '2024-05-03 22:09:01', NULL),
(28, 'hajer@gmail.com', '1', 'Téléphones mobiles', 'Problèmes de batterie', ';;;', 'hajer', ';;', '2024-05-03 23:03:02', '2024-05-03 23:03:02', NULL),
(29, 'hajer@gmail.com', '1', 'Téléphones mobiles', 'Problèmes de batterie', ';;;', 'hajer', ';;', '2024-05-03 23:03:38', '2024-05-03 23:03:38', NULL),
(30, 'hajer@gmail.com', '1', 'Téléphones mobiles', 'Problèmes de batterie', ';;;', 'admin', ';;;', '2024-05-03 23:04:17', '2024-05-03 23:04:17', NULL),
(31, 'hassibaizza9@gmail.com', '1', 'Téléphones mobiles', 'Problèmes de batterie', ';;;;', 'hajer', ';;', '2024-05-03 23:20:02', '2024-05-03 23:20:02', NULL),
(32, 'hajer@gmail.com', '1', 'Tablettes', 'Problèmes de batterie', ';;;', 'hajer', '::', '2024-05-03 23:26:08', '2024-05-03 23:26:08', NULL),
(33, 'hassibaizza827@gmail.com', '1', 'Tablettes', 'Problèmes d\'écran tactile', 'nnn', 'admin', ';;;', '2024-05-03 23:32:16', '2024-05-03 23:32:16', NULL),
(34, 'hassibaizza9@gmail.com', '1', 'Ordinateurs portables', 'Problèmes de charge', '///', 'HASSIBA', '280logts', '2024-05-08 06:55:50', '2024-05-08 06:55:50', NULL),
(35, 'betterkizinebfarah@gmail.com', '1', 'Tablettes', 'Afficheur défaillant', 'Afficheur noir', 'Farah', 'Castor', '2024-05-09 08:57:51', '2024-05-09 08:57:51', NULL),
(36, 'amine@gmail.com', '1', 'Ordinateurs portables', 'Problèmes de charge', ':::', 'amine', 'ssss', '2024-05-09 20:50:02', '2024-05-09 20:50:02', NULL),
(37, 'amine@gmail.com', '1', 'Ordinateurs portables', 'Problèmes de charge', '::', 'amine', '23', '2024-05-09 21:02:36', '2024-05-09 21:02:36', NULL),
(38, 'amine@gmail.com', '1', 'Tablettes', 'Afficheur défaillant', ':::', 'amine', 'ssss', '2024-05-09 21:17:16', '2024-05-09 21:17:16', 23),
(39, 'amine@gmail.com', '2', 'Téléphones mobiles', 'Amaravati', '///', 'amine', 'ssss', '2024-05-10 13:59:07', '2024-05-10 13:59:07', 23);

-- --------------------------------------------------------

--
-- Structure de la table `sub_category`
--

CREATE TABLE `sub_category` (
  `sub_category_id` int(11) NOT NULL,
  `sub_category_name` varchar(150) NOT NULL,
  `sub_category_image` varchar(250) NOT NULL,
  `category_id` int(11) NOT NULL,
  `sub_category_slug` varchar(150) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `sub_category`
--

INSERT INTO `sub_category` (`sub_category_id`, `sub_category_name`, `sub_category_image`, `category_id`, `sub_category_slug`, `created_at`) VALUES
(2, 'Smart', 'b28fb8bbf7d007635f048670a5c612ef.jpg', 2, 'smart', '2023-06-18 09:09:48'),
(3, 'tablette-mode', '5caac2d25cf948a457d6645d66851a3f.webp', 3, 'tablette-mode', '2023-06-18 09:11:56');

-- --------------------------------------------------------

--
-- Structure de la table `typepannes`
--

CREATE TABLE `typepannes` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `typep_id` bigint(20) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `typepannes`
--

INSERT INTO `typepannes` (`id`, `name`, `typep_id`, `user_id`) VALUES
(22, 'Amaravati', 6, NULL),
(23, 'Anantapur', 6, NULL),
(24, 'Bhimavaram', 6, NULL),
(25, 'Chirala', 6, NULL),
(26, 'Lucknow', 7, NULL),
(27, 'Kanpur', 7, NULL),
(28, 'Varanasi', 9, NULL),
(29, 'Mumbai', 9, NULL),
(30, 'Pune', 5, NULL),
(31, 'Nagpur', 6, NULL),
(32, 'Nasik', 4, NULL),
(33, 'Problèmes de batterie', 6, NULL),
(34, 'Écran cassé ou endommagé', 7, NULL),
(35, 'Problèmes de charge', 3, NULL),
(36, 'Problèmes de réseau', 7, NULL),
(37, 'Problèmes de performance', 5, NULL),
(38, 'Problèmes d\'écran tactile', 8, NULL),
(39, 'Problèmes de batterie', 6, NULL),
(40, 'Problèmes de charge', 8, NULL),
(41, 'Problèmes de performance', 6, NULL),
(42, 'Problèmes de connectivité', 8, NULL),
(44, 'test', 6, 18),
(45, 'probléme', 2, 27),
(46, 'probléme', 2, 27),
(47, 'Afficheur défaillant', 2, 27),
(48, 'Afficheur défaillant', 2, 27);

-- --------------------------------------------------------

--
-- Structure de la table `typeps`
--

CREATE TABLE `typeps` (
  `id` bigint(20) NOT NULL,
  `name` varchar(30) NOT NULL,
  `marque_id` bigint(20) UNSIGNED NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `typeps`
--

INSERT INTO `typeps` (`id`, `name`, `marque_id`) VALUES
(1, 'Téléphones mobiles', 1),
(2, 'Tablettes', 1),
(3, 'Ordinateurs portables', 1),
(4, 'Téléviseurs', 1),
(5, 'Appareils électroménagers', 1),
(6, 'Téléphones mobiles', 2),
(7, 'Tablettes', 2),
(8, 'Ordinateurs portables', 2),
(9, 'Téléviseurs', 2),
(10, 'Appareils électroménagers', 2);

-- --------------------------------------------------------

--
-- Structure de la table `type_pannes`
--

CREATE TABLE `type_pannes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `typep_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `photo` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `phone_number` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `social_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `social_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `photo`, `role`, `username`, `status`, `phone_number`, `address`, `social_id`, `social_type`) VALUES
(18, 'Hamzawy', 'Admin@gmail.com', NULL, '$2y$10$hi71eru18IhSUr5K.XI27eOvrCkKQzGWsDPHuTqU0NnT6afpo4RHu', 'GxjCRYLVwJ0jvQ8HTYhJSnzlrNBmQDbKsIVRz7i9IicFRMirH6aaJKQp5s73', '2024-04-01 08:32:47', '2024-04-24 21:55:45', 'd26e8bff00b0b5b74ad89fde18e6f385.jpg', 'admin', 'hamzawy1', 1, NULL, NULL, NULL, NULL),
(21, 'Mustafa Mahmoud', 'vendor2@gmail.com', NULL, '$2y$10$Dn68crfXX/HrMR0JtxXuEe6WmLczTQURy82GQX5SlU5H380bD21d2', 'hypQ7YBboQcqJ7z6kRZnR86fCPmgETg51bSg3vZ0J9KOUFpYunkJwCmrd7Uh', '2024-04-02 06:33:45', '2024-04-18 16:49:52', NULL, 'vendor', 'mustafa_vendor_1', 1, NULL, NULL, NULL, NULL),
(22, 'hajer', 'hajer@gmail.com', NULL, '$2y$10$.3HZaNVrjqprvPoVFXLXTeJFtwXafe9gcwRQ1QYAAPh7QeiPIatAK', 'J6oFL5evGEaoOiC92jiZOcxoORJDrAgWRRn1hMgXRSJrMhO0RlwK7s6ASRAp', '2024-04-15 22:54:44', '2024-04-18 16:50:15', NULL, 'reparateur', 'hajer', 1, NULL, NULL, NULL, NULL),
(23, 'amine', 'amine@gmail.com', NULL, '$2y$10$Zf5gRiow7o4T86c8RuJJTOM1W4ygIXjQVNb9Z9TDB2we0/s8vOayW', 'jDcsBlotAgyyqevQF2oNMNs4xRAdVgXg79qNYxYJQbvSkXjl739DFQwadAI2', '2024-04-15 23:03:29', '2024-05-10 13:40:45', '531d3c7ebd8590ab1da0c41142d3e4e5.png', 'client', 'amine', 1, '0678345612', 'ssss', NULL, NULL),
(25, 'Hassiba', 'hassibaizza827@gmail.com', NULL, '$2y$10$npKcHKER2HWLe9WPmzT9xuleR1q9uUgyekAD3/evUNa67ZOxGAVsW', '7M7FbN5hBbA82FW5VJvyX1Nqe8hOp5DHEDPIaJqHa0lFknlca9b7MP0RqcyE', '2024-04-16 17:07:46', '2024-05-10 13:28:37', '49c1783d92fa3f46fdb4c6df7b750ddf.jpg', 'vendor', 'hassibaiz', 1, NULL, NULL, NULL, NULL),
(26, 'houda', 'houda@gmail.com', NULL, '$2y$10$MbsEJlVoFtdl8r2bmnPyfOyIFJqqT.hWgOw7AlIKXl6UsIu5SG7R2', 'JD93cgrfAE0sAtj4fKRqZqjd3mtyXmAv02Zk53Jjntw2uNGvMILK2bxjoV3T', '2024-04-21 19:53:47', '2024-04-25 23:25:13', '2c0d3bffef15237a2752d02dfdc6044d.jpg', 'client', 'houda1', 1, '0787342332', 'Mostaganem', NULL, NULL),
(27, 'ENIE', 'Enie@gmail.com', NULL, '$2y$10$iOeOQxk5dcE7FE3dQJwe7ueQKKQk1ZbwBkMnehziPGyZmtNioWpHu', 'IZLw7MgtJHk3KiU1Z3mm36GSXBCbbtImr05CpXueJz5jj5KCSx4C1SiHArJD', '2024-04-25 23:06:46', '2024-04-26 11:32:14', '201c356f5de391aa4bd7edb77d3e8878.png', 'Fabricant', 'Enie', 1, NULL, NULL, NULL, NULL),
(28, 'Amina', 'amina@gmail.com', NULL, '$2y$10$QTcAMu4cyOL1HGEhKlvgMuF30oXvgM3V9x7yr2nXGEcT1v1mif1y6', 'Z2oPPamGj93cXyrKQIiRj6hvRMBukMmbM5MB1tbP52bCcfMm8W8DIj0toEKA', '2024-04-26 12:07:45', '2024-04-26 13:20:41', 'ce15fdf33e69cfc4866cbbe0794d14d9.jpg', 'vendor', 'amina', 1, NULL, NULL, NULL, NULL),
(29, 'hassiba', 'hassibaizza9@gmail.com', NULL, '$2y$10$3rHmjPDssKVtP3R.suAnJ.2E9wAPMLIkP81rGJ57A/IV.yUZgx6rK', NULL, '2024-05-03 20:44:42', '2024-05-04 20:54:45', NULL, 'vendor', 'hassiba', 1, NULL, NULL, NULL, NULL),
(31, 'IRIS', 'IRIS@gmail.com', NULL, '$2y$10$ew.TaX/g1Afn6GOzmSMdsu2mCkZN6P3RvmNF6JysPAMrfI2ZCmvsq', 'IElLkWYqKW6vRFNH390kH4jDBjehYjJnQw260ppGxH1S27pXo7nwkxjMS3J7', '2024-05-03 21:27:06', '2024-05-04 20:54:43', NULL, 'Fabricant', 'iris', 1, NULL, NULL, NULL, NULL),
(32, 'brandt', 'brandt@gmail.com', NULL, '$2y$10$WvHBvH0.0FU4gV8AGpydmeu8lCvbBdbLWXuNTWUlgVJmO/8N./r76', NULL, '2024-05-03 21:30:14', '2024-05-04 20:54:39', NULL, 'Fabricant', 'brandt', 1, NULL, NULL, NULL, NULL),
(33, 'Geant', 'geant@gmail.com', NULL, '$2y$10$7Gejr.xQhVScVmnJDzuuu.Pl4AymVbzewaU8oOF5Hd4syxIb0cPI6', NULL, '2024-05-03 21:34:40', '2024-05-04 20:54:34', NULL, 'Fabricant', 'geant', 1, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `vendor_shop`
--

CREATE TABLE `vendor_shop` (
  `vendor_id` int(11) NOT NULL,
  `shop_name` varchar(200) DEFAULT NULL,
  `shop_description` text DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `vendor_shop`
--

INSERT INTO `vendor_shop` (`vendor_id`, `shop_name`, `shop_description`, `user_id`) VALUES
(7, NULL, NULL, 21),
(9, 'mycompany', '<p>//</p>', 25),
(12, NULL, NULL, 28),
(13, NULL, NULL, 29);

-- --------------------------------------------------------

--
-- Structure de la vue `get_product_data`
--
DROP TABLE IF EXISTS `get_product_data`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `get_product_data`  AS SELECT DISTINCT `product`.`product_id` AS `product_id`, `product`.`product_name` AS `product_name`, `product`.`product_slug` AS `product_slug`, `product`.`product_code` AS `product_code`, `product`.`product_quantity` AS `product_quantity`, `product`.`product_tags` AS `product_tags`, `product`.`product_price` AS `product_price`, `product`.`product_short_description` AS `product_short_description`, `product`.`product_long_description` AS `product_long_description`, `product`.`product_thumbnail` AS `product_thumbnail`, `product`.`product_status` AS `product_status`, `product`.`sub_category_id` AS `sub_category_id`, `product`.`brand_id` AS `brand_id`, `product`.`vendor_id` AS `vendor_id`, `product`.`product_colors` AS `product_colors`, `po`.`offer_id` AS `offer_id`, `po`.`offer_product_id` AS `offer_product_id`, `po`.`hot_deal` AS `hot_deal`, `po`.`featured_product` AS `featured_product`, `po`.`special_offer` AS `special_offer`, `po`.`special_deal` AS `special_deal` FROM (`product` join `product_offers` `po` on(`product`.`product_id` = `po`.`offer_product_id`))  ;

-- --------------------------------------------------------

--
-- Structure de la vue `get_sub_categories`
--
DROP TABLE IF EXISTS `get_sub_categories`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `get_sub_categories`  AS SELECT `sub`.`sub_category_id` AS `sub_category_id`, `sub`.`sub_category_name` AS `sub_category_name`, `sub`.`sub_category_slug` AS `sub_category_slug`, `sub`.`sub_category_image` AS `sub_category_image`, `sub`.`category_id` AS `selected_category_id`, `sub`.`created_at` AS `created_at`, `category`.`category_name` AS `category_name` FROM (`sub_category` `sub` join `category` on(`sub`.`category_id` = `category`.`category_id`))  ;

-- --------------------------------------------------------

--
-- Structure de la vue `get_vendor_data`
--
DROP TABLE IF EXISTS `get_vendor_data`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `get_vendor_data`  AS SELECT `users`.`id` AS `id`, `users`.`photo` AS `photo`, `users`.`name` AS `name`, `users`.`email` AS `email`, `users`.`username` AS `username`, `vendor_shop`.`shop_name` AS `shop_name`, `users`.`created_at` AS `created_at`, `vendor_shop`.`shop_description` AS `shop_description`, `users`.`phone_number` AS `phone_number`, `users`.`address` AS `address`, `vendor_shop`.`vendor_id` AS `vendor_id` FROM (`users` join `vendor_shop` on(`users`.`id` = `vendor_shop`.`user_id`))  ;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`brand_id`);

--
-- Index pour la table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Index pour la table `coupon`
--
ALTER TABLE `coupon`
  ADD PRIMARY KEY (`coupon_id`),
  ADD KEY `coupon_vendor_shop_vendor_id_fk` (`VendorId`);

--
-- Index pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Index pour la table `marques`
--
ALTER TABLE `marques`
  ADD PRIMARY KEY (`id`),
  ADD KEY `marques_owner_id_foreign` (`owner_id`);

--
-- Index pour la table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Index pour la table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`email`);

--
-- Index pour la table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Index pour la table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `product_product__fk` (`vendor_id`),
  ADD KEY `product_brand_brand_id_fk` (`brand_id`),
  ADD KEY `product_sub_category_sub_category_id_fk` (`sub_category_id`);

--
-- Index pour la table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`image_id`),
  ADD KEY `product_images_product_product_id_fk` (`image_product_id`);

--
-- Index pour la table `product_offers`
--
ALTER TABLE `product_offers`
  ADD PRIMARY KEY (`offer_id`),
  ADD KEY `product_offers_product_product_id_fk` (`offer_product_id`);

--
-- Index pour la table `rendez_vouses`
--
ALTER TABLE `rendez_vouses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rendez_vouses_client_id_foreign` (`client_id`);

--
-- Index pour la table `sub_category`
--
ALTER TABLE `sub_category`
  ADD PRIMARY KEY (`sub_category_id`),
  ADD KEY `sub_category_category_category_id_fk` (`category_id`);

--
-- Index pour la table `typepannes`
--
ALTER TABLE `typepannes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `typepannes_user_id_foreign` (`user_id`),
  ADD KEY `type_panne_typep_id` (`typep_id`);

--
-- Index pour la table `typeps`
--
ALTER TABLE `typeps`
  ADD PRIMARY KEY (`id`),
  ADD KEY `typep_marque_id` (`marque_id`);

--
-- Index pour la table `type_pannes`
--
ALTER TABLE `type_pannes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `type_pannes_user_id_foreign` (`user_id`),
  ADD KEY `type_panne_type_produit` (`typep_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Index pour la table `vendor_shop`
--
ALTER TABLE `vendor_shop`
  ADD PRIMARY KEY (`vendor_id`),
  ADD KEY `vendor_shop_users_id_fk` (`user_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `brand`
--
ALTER TABLE `brand`
  MODIFY `brand_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `coupon`
--
ALTER TABLE `coupon`
  MODIFY `coupon_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `marques`
--
ALTER TABLE `marques`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT pour la table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT pour la table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `product_offers`
--
ALTER TABLE `product_offers`
  MODIFY `offer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `rendez_vouses`
--
ALTER TABLE `rendez_vouses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT pour la table `sub_category`
--
ALTER TABLE `sub_category`
  MODIFY `sub_category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `typepannes`
--
ALTER TABLE `typepannes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT pour la table `typeps`
--
ALTER TABLE `typeps`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `type_pannes`
--
ALTER TABLE `type_pannes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT pour la table `vendor_shop`
--
ALTER TABLE `vendor_shop`
  MODIFY `vendor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `coupon`
--
ALTER TABLE `coupon`
  ADD CONSTRAINT `coupon_vendor_shop_vendor_id_fk` FOREIGN KEY (`VendorId`) REFERENCES `vendor_shop` (`vendor_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `marques`
--
ALTER TABLE `marques`
  ADD CONSTRAINT `marques_owner_id_foreign` FOREIGN KEY (`owner_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Contraintes pour la table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_brand_brand_id_fk` FOREIGN KEY (`brand_id`) REFERENCES `brand` (`brand_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `product_product__fk` FOREIGN KEY (`vendor_id`) REFERENCES `vendor_shop` (`vendor_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `product_sub_category_sub_category_id_fk` FOREIGN KEY (`sub_category_id`) REFERENCES `sub_category` (`sub_category_id`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_images_product_product_id_fk` FOREIGN KEY (`image_product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `product_offers`
--
ALTER TABLE `product_offers`
  ADD CONSTRAINT `product_offers_product_product_id_fk` FOREIGN KEY (`offer_product_id`) REFERENCES `product` (`product_id`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `rendez_vouses`
--
ALTER TABLE `rendez_vouses`
  ADD CONSTRAINT `rendez_vouses_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Contraintes pour la table `sub_category`
--
ALTER TABLE `sub_category`
  ADD CONSTRAINT `sub_category_category_category_id_fk` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `typepannes`
--
ALTER TABLE `typepannes`
  ADD CONSTRAINT `type_panne_typep_id` FOREIGN KEY (`typep_id`) REFERENCES `typeps` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `typepannes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Contraintes pour la table `typeps`
--
ALTER TABLE `typeps`
  ADD CONSTRAINT `typep_marque_id` FOREIGN KEY (`marque_id`) REFERENCES `marques` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `type_pannes`
--
ALTER TABLE `type_pannes`
  ADD CONSTRAINT `type_panne_type_produit` FOREIGN KEY (`typep_id`) REFERENCES `typeps` (`id`),
  ADD CONSTRAINT `type_pannes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Contraintes pour la table `vendor_shop`
--
ALTER TABLE `vendor_shop`
  ADD CONSTRAINT `vendor_shop_users_id_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

DELIMITER $$
--
-- Évènements
--
CREATE DEFINER=`root`@`localhost` EVENT `update_coupon_status` ON SCHEDULE EVERY 1 HOUR STARTS '2023-04-23 22:29:54' ON COMPLETION NOT PRESERVE ENABLE DO UPDATE coupon set coupon_status = '0' where expiration_date < NOW()$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
