-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2024-10-20 07:34:14
-- 伺服器版本： 10.4.32-MariaDB
-- PHP 版本： 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `javaeducation`
--
CREATE DATABASE IF NOT EXISTS `javaeducation` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `javaeducation`;

-- --------------------------------------------------------

--
-- 資料表結構 `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 資料表新增資料前，先清除舊資料 `cache`
--

TRUNCATE TABLE `cache`;
--
-- 傾印資料表的資料 `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('0dfddec41b02894cc83adcdcfca8fac5', 'i:1;', 1723816962),
('0dfddec41b02894cc83adcdcfca8fac5:timer', 'i:1723816962;', 1723816962),
('3dce29dd1498b35a2c31ae0f35a1aacc', 'i:1;', 1719236179),
('3dce29dd1498b35a2c31ae0f35a1aacc:timer', 'i:1719236179;', 1719236179),
('ca6c49a141d86ad9a006978c0300a99e', 'i:1;', 1729341785),
('ca6c49a141d86ad9a006978c0300a99e:timer', 'i:1729341785;', 1729341785);

-- --------------------------------------------------------

--
-- 資料表結構 `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 資料表新增資料前，先清除舊資料 `cache_locks`
--

TRUNCATE TABLE `cache_locks`;
-- --------------------------------------------------------

--
-- 資料表結構 `card_types`
--

CREATE TABLE `card_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `country_id` bigint(20) UNSIGNED NOT NULL,
  `levels` int(11) NOT NULL,
  `card_type` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 資料表新增資料前，先清除舊資料 `card_types`
--

TRUNCATE TABLE `card_types`;
--
-- 傾印資料表的資料 `card_types`
--

INSERT INTO `card_types` (`id`, `country_id`, `levels`, `card_type`, `created_at`, `updated_at`, `img`) VALUES
(1, 1, 1, '資料型態', NULL, NULL, '&#x1F4D1;'),
(2, 1, 2, '資料輸入輸出', NULL, NULL, '&#x1F503;'),
(3, 1, 3, '運算子', NULL, NULL, '&#x1F9EE;'),
(4, 2, 0, '條件語句', NULL, NULL, ''),
(5, 2, 0, '迴圈控制', NULL, NULL, '');

-- --------------------------------------------------------

--
-- 資料表結構 `countries`
--

CREATE TABLE `countries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `imgPath` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 資料表新增資料前，先清除舊資料 `countries`
--

TRUNCATE TABLE `countries`;
--
-- 傾印資料表的資料 `countries`
--

INSERT INTO `countries` (`id`, `name`, `created_at`, `updated_at`, `imgPath`) VALUES
(1, '蠻金之國', NULL, NULL, 'lv1.svg'),
(2, '南國', NULL, NULL, 'lv2.svg'),
(3, '陰暗森林', NULL, NULL, 'lv3.svg'),
(4, '湍急河道', NULL, NULL, 'lv4.svg'),
(5, '西國女巫之堡', NULL, NULL, 'lv5.svg');

-- --------------------------------------------------------

--
-- 資料表結構 `debugs`
--

CREATE TABLE `debugs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `country_id` bigint(20) UNSIGNED NOT NULL,
  `description` varchar(255) NOT NULL,
  `code` varchar(10000) NOT NULL,
  `wrong_line` int(11) NOT NULL,
  `answer` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 資料表新增資料前，先清除舊資料 `debugs`
--

TRUNCATE TABLE `debugs`;
--
-- 傾印資料表的資料 `debugs`
--

INSERT INTO `debugs` (`id`, `country_id`, `description`, `code`, `wrong_line`, `answer`, `created_at`, `updated_at`) VALUES
(1, 1, '請找出以下程式碼的錯誤:\r\n歡迎來到綠野仙蹤~跟著我們一起冒險吧!\r\n請印出:The Wonderful Wizard of Oz，並且自動換行。', 'public class Main {\r\n    public static void main(String[] args) {\r\n        System.out.print(\"The Wonderful Wizard of Oz\");\r\n    }\r\n}', 3, 'System.out.println(\"The Wonderful Wizard of Oz\");', NULL, NULL),
(2, 1, '請找出以下程式碼的錯誤:\r\n輸入您的姓名，並輸出:「歡迎(您的名字)進入綠野仙蹤，努力幫助桃樂絲通關吧!」', 'import java.util.Scanner;\r\npublic class Main {\r\n    public static void main(String[] args) {\r\n        Scanner keyin = new Scanner(System.in);\r\n        System.out.print(\"請輸入您的名稱：\");\r\n        int Name = keyin.nextInt();\r\n        System.out.println(\"歡迎\"+ Name +\"進入綠野仙蹤，努力幫助桃樂絲通關吧!\");\r\n        keyin.close();\r\n    }\r\n}', 6, 'String Name = keyin.nextLine();', NULL, NULL),
(3, 1, '請找出以下程式碼的錯誤:\r\n桃樂絲和稻草人要在10分25秒跑3公里，逃離金黃色稻田到達南國以免被壞女巫抓住\r\n計算並顯示此桃樂絲每小時的平均英哩時速(1英哩=1.6公里)\r\n計算3公里 = x 英哩(列出公式，不用計算出答案)\r\n10分25秒 = y小時\r\n輸出 : 每小時的平均英哩數=?', 'public class Main {\r\n    public static void main(String[] args) {\r\n        double miles = 3 / 1.6;\r\n        double hours = 10.0 / 60.0 + 25.0 / 3600.0;\r\n        double avgSpeed = miles / hours;\r\n        System.out.print(\"每小時的平均英哩數=%.2f\", avgSpeed);\r\n    }\r\n}', 6, 'System.out.printf(\"每小時的平均英哩數=%.2f\", avgSpeed);', NULL, NULL),
(4, 1, '請找出以下程式碼的錯誤:\r\n稻草人被綁在金黃色稻田裡，為了更快速地替稻草人解綁，請幫助桃樂絲計算金黃色稻田的周長和面積，稻田的半徑為2.5，寫一個程式，計算此圓的周長和面積，PI = 3.14', 'public class Main {\r\n    public static void main(String[] args) {\r\n        final int PI = 3.14;\r\n		double r = 2.5;\r\n		double Peri = 2*PI*r;\r\n		double Area = PI*r*r;\r\n		System.out.println(\"圓周長 = \" +Peri+\", 圓面積 = \"+Area );\r\n    }\r\n}', 3, 'final double PI = 3.14;', NULL, NULL),
(5, 1, '請找出以下程式碼的錯誤:\r\n請幫助蠻金之國的小矮人收割稻草，小矮人族長為了報答您決定收滿1000個稻草送100個稻草，輸入您收割多少稻草並輸出得到多少稻草', 'import java.util.Scanner;\r\npublic class Main {\r\n    public static void main(String[] args) {\r\n        Scanner keyin = new Scanner(System.in);\r\n        System.out.println(\"您收割了多少稻草：\");\r\n        int a = keyin.nextInt();\r\n        System.out.print(\"您獲得了%d根稻草\",(a/1000)*100);\r\n            \r\n    }\r\n}', 8, 'keyin.close();', NULL, NULL),
(6, 1, '請找出以下程式碼的錯誤:\r\n稻草收割完稻草必須公平分配給每一位小矮人，輸入收割的稻草數(a)和小矮人人數(b)，輸出每個小矮人分配到的稻草數量(商)以及多餘的稻草(餘數)', 'import java.util.Scanner;\r\npublic class Main {\r\n   public static void main(String[] args) {\r\n    Scanner keyin = new Scanner(System.out);		\r\n		//輸入兩個整數 a 及 b ，輸出 a 除以 b的商及餘數\r\n		System.out.print(\"請輸入收割的稻草數（a）：\");\r\n		int a = keyin.nextInt();\r\n        System.out.print(\"請輸入小矮人人數（b）：\");\r\n		int b = keyin.nextInt();\r\n		System.out.printf(\"每個小矮人分配到的稻草數量為：%d，多餘稻草數為：%d\",a/b,a%b);\r\n        keyin.close();\r\n   } \r\n}', 4, 'Scanner keyin = new Scanner(System.in);', NULL, NULL),
(7, 1, '請找出以下程式碼的錯誤:\r\n壞女巫對蠻金之國下了暴雨詛咒，農作物需要馬上收割，小矮人請桃樂絲幫助他們收割並給她薪水，輸入桃樂絲幫忙小矮人收割的時數，並計算其薪資(時薪183)', 'import java.util.Scanner;\r\npublic class Main {\r\n    public static void main(String[] args) {\r\n        Scanner keyin = new Scanner(System.in);\r\n        System.out.print(\"請輸入桃樂絲幫忙收割的時數：\");\r\n        float hours = keyin.nextInt();//錯\r\n        double salaryRate = 183.0;\r\n        double salary = hours * salaryRate;\r\n        System.out.println(\"桃樂絲的薪資為：\" + salary);\r\n        keyin.close();\r\n    }\r\n}', 6, 'float hours = keyin.nextFloat();', NULL, NULL),
(8, 1, '小矮人想要利用程式計算一些魔法計算問題，但在寫程式時遇到了一些錯誤，請與桃樂絲一起幫助小矮人解決程式碼的錯誤(新增題)', 'public class Main {\r\n    public static void main(String[] args) {\r\n        double i = 7.1;\r\n        double j = 2.1;\r\n        int b = (int)i/j;\r\n        System.out.println(b);\r\n    }\r\n}', 5, 'double b = (double)i/j;', NULL, NULL);

-- --------------------------------------------------------

--
-- 資料表結構 `debug_records`
--

CREATE TABLE `debug_records` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `debug_id` bigint(20) UNSIGNED NOT NULL,
  `watchtime` time NOT NULL DEFAULT '00:00:00',
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 資料表新增資料前，先清除舊資料 `debug_records`
--

TRUNCATE TABLE `debug_records`;
-- --------------------------------------------------------

--
-- 資料表結構 `dramas`
--

CREATE TABLE `dramas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `country_id` bigint(20) UNSIGNED NOT NULL,
  `order` int(11) NOT NULL,
  `msg` varchar(255) NOT NULL,
  `role_icon` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 資料表新增資料前，先清除舊資料 `dramas`
--

TRUNCATE TABLE `dramas`;
--
-- 傾印資料表的資料 `dramas`
--

INSERT INTO `dramas` (`id`, `country_id`, `order`, `msg`, `role_icon`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '旁白：有一天，桃樂絲和她的狗托托住的房子被一場龍捲風吹走，掉到了蠻支金國土，房子砸在了東方壞女巫的身上，意外地救了這片土地上的居民。正當大家慶祝時，西方壞女巫出現了。\r\n', 'narration', NULL, NULL),
(2, 1, 2, '壞女巫：你們這些小矮人！居然敢慶祝我的姐姐被消滅！', 'badwitch', NULL, NULL),
(3, 1, 3, '旁白：南國女巫葛琳達出現，給了桃樂絲護身符。', 'narration', NULL, NULL),
(4, 1, 4, '好女巫：這個護身符會幫助你通過接下來的關卡，但要小心壞女巫，她一定會想辦法搶走它們，你現在必須要去翡翠城找歐茲法師幫忙，只要沿著這條黃磚路走你就能通往翡翠城。', 'goodwitch', NULL, NULL),
(5, 1, 5, '壞女巫：我們走著瞧！', 'badwitch', NULL, NULL),
(6, 1, 6, '旁白：在蠻之金國土中，桃樂絲決定去翡翠城尋求歐茲法師的幫助。沿著黃磚路，桃樂絲來到一片金黃色的稻田，遇到了被綁住的稻草人。', 'narration', NULL, NULL),
(7, 1, 7, '稻草人：你好，請幫幫我，我被困在這裡好久了。', 'scarecrow', NULL, NULL),
(8, 1, 8, '旁白：桃樂絲爬進藍色柵欄，幫稻草人解開了繩子，並詢問稻草人是否願意跟她一起尋找歐茲法師。', 'narration', NULL, NULL),
(9, 1, 9, '稻草人：謝謝你！我願意陪你一起去找歐茲法師。', 'scarecrow', NULL, NULL),
(10, 1, 10, '桃樂絲：太好了，有你陪我我會安心很多。', 'tls', NULL, NULL),
(11, 2, 1, '綠柱尖頭族領袖：站住！這是我們的領地，沒有人能隨便通過！', 'greendwarf', NULL, NULL),
(12, 2, 2, '桃樂絲：我們沒有惡意，只是想去翡翠城見奧茲法師。', 'tls', NULL, NULL),
(13, 2, 3, '綠柱尖頭族領袖：只有得到好女巫的護身符才能通過。', 'greendwarf', NULL, NULL),
(14, 2, 4, '桃樂絲：這是好女巫給的護身符。', 'tls', NULL, NULL),
(15, 2, 5, '旁白:桃樂絲展示護身符', 'narration', NULL, NULL),
(16, 2, 6, '綠柱尖頭族領袖：你們可以通過了，但小心樹林裡的怪樹。', 'greendwarf', NULL, NULL),
(17, 2, 7, '桃樂絲：謝謝，我們會小心的。', 'tls', NULL, NULL),
(18, 2, 8, '旁白:桃樂絲和稻草人往蘋果樹林走去', 'narration', NULL, NULL),
(19, 2, 9, '桃樂絲：看啊，稻草人，這裡的蘋果樹居然會說話！', 'tls', NULL, NULL),
(20, 2, 10, '蘋果樹：你們這些闖入者，快離開，不然我就用蘋果砸你們！', 'creeptree', NULL, NULL),
(21, 2, 11, '稻草人:快跑啊!', 'scarecrow', NULL, NULL),
(22, 2, 12, '桃樂絲：對不起，我們只是路過，我們不會傷害你們的。', 'tls', NULL, NULL),
(23, 2, 13, '旁白:桃樂絲和稻草人繼續前行遇到了錫人', 'narration', NULL, NULL),
(24, 2, 14, '桃樂絲：稻草人，快看！那裡有一個錫人，他看起來很需要幫助。', 'tls', NULL, NULL),
(25, 2, 15, '旁白：桃樂絲用油罐幫錫人上油', 'narration', NULL, NULL),
(26, 2, 16, '錫人：啊，謝謝你，我終於可以動了！已經好久沒有說話了。', 'tinman', NULL, NULL),
(27, 2, 17, '桃樂絲：不用謝，我是桃樂絲，他是稻草人。我們正要去翡翠城找奧茲法師。', 'tls', NULL, NULL),
(28, 2, 18, '錫人：我叫錫人，我一直希望能有一顆心臟。你們可以帶我一起去見奧茲法師嗎？', 'tinman', NULL, NULL),
(29, 2, 19, '桃樂絲：當然可以，我們一起去尋找奧茲法師。', 'tls', NULL, NULL),
(30, 2, 20, '旁白：突然，西方壞女巫出現', 'narration', NULL, NULL),
(31, 2, 21, '壞女巫：哈哈哈，你們休想去翡翠城，我要用火把你們燒掉！', 'badwitch', NULL, NULL),
(32, 2, 22, '旁白：壞女巫放火，錫人迅速行動', 'narration', NULL, NULL),
(33, 2, 23, '錫人：快退後，我來滅火！', 'tinman', NULL, NULL),
(34, 2, 24, '旁白：錫人用手上的斧頭撲滅火焰', 'narration', NULL, NULL),
(35, 2, 25, '桃樂絲：錫人，真是太感謝你了。你救了我們。', 'tls', NULL, NULL);

-- --------------------------------------------------------

--
-- 資料表結構 `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 資料表新增資料前，先清除舊資料 `failed_jobs`
--

TRUNCATE TABLE `failed_jobs`;
-- --------------------------------------------------------

--
-- 資料表結構 `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 資料表新增資料前，先清除舊資料 `jobs`
--

TRUNCATE TABLE `jobs`;
-- --------------------------------------------------------

--
-- 資料表結構 `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 資料表新增資料前，先清除舊資料 `job_batches`
--

TRUNCATE TABLE `job_batches`;
-- --------------------------------------------------------

--
-- 資料表結構 `knowledge_cards`
--

CREATE TABLE `knowledge_cards` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `country_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(45) DEFAULT NULL,
  `content` varchar(45) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `card_type_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 資料表新增資料前，先清除舊資料 `knowledge_cards`
--

TRUNCATE TABLE `knowledge_cards`;
--
-- 傾印資料表的資料 `knowledge_cards`
--

INSERT INTO `knowledge_cards` (`id`, `country_id`, `name`, `content`, `created_at`, `updated_at`, `card_type_id`) VALUES
(1, 1, 'float', 'float', NULL, NULL, 1),
(2, 1, 'double', 'double', NULL, NULL, 1),
(3, 1, 'boolean', 'boolean', NULL, NULL, 1),
(4, 1, 'int', 'int', NULL, NULL, 1),
(5, 1, 'char', 'char', NULL, NULL, 1),
(6, 1, 'java.util.Scanner', 'java.util.Scanner', NULL, NULL, 2),
(7, 1, 'System.in', 'System.in', NULL, NULL, 2),
(8, 1, 'Scanner.close()', 'Scanner.close()', NULL, NULL, 2),
(9, 1, 'Scanner.nextDouble()', 'Scanner.nextDouble()', NULL, NULL, 2),
(10, 1, 'Scanner.nextLine()', 'Scanner.nextLine()', NULL, NULL, 2),
(11, 1, 'Scanner.next()', 'Scanner.next()', NULL, NULL, 2),
(12, 1, 'Scanner.nextInt()', 'Scanner.nextInt()', NULL, NULL, 2),
(13, 1, 'System.out.println()', 'System.out.println()', NULL, NULL, 2),
(14, 1, 'System.out.printf()', 'System.out.printf()', NULL, NULL, 2),
(15, 1, 'System.out.print()', 'System.out.print()', NULL, NULL, 2),
(16, 1, '算術運算子', '算術運算子', NULL, NULL, 3),
(17, 1, '關係運算子', '關係運算子', NULL, NULL, 3),
(18, 1, '邏輯條件運算子', '邏輯條件運算子', NULL, NULL, 3),
(19, 1, '遞增與遞減運算子', '遞增與遞減運算子', NULL, NULL, 3),
(20, 1, '三元條件運算子', '三元條件運算子', NULL, NULL, 3),
(21, 1, 'string', 'string', NULL, NULL, 1),
(22, 1, 'Scanner.nextFloat()', 'Scanner.nextFloat()', NULL, NULL, 2),
(23, 2, 'if', 'if', NULL, NULL, 4),
(24, 2, 'for', 'for', NULL, NULL, 5),
(25, 2, 'while', 'while', NULL, NULL, 5),
(26, 2, 'if...else', 'if...else', NULL, NULL, 4),
(27, 2, 'switch…case…default', 'switch…case…default', NULL, NULL, 4),
(28, 2, 'do…while', 'do…while', NULL, NULL, 5),
(29, 2, 'if…else if…else', 'if…else if…else', NULL, NULL, 4),
(30, 2, 'continue', 'continue', NULL, NULL, 5),
(31, 2, 'break', 'break', NULL, NULL, 5);

-- --------------------------------------------------------

--
-- 資料表結構 `match_options`
--

CREATE TABLE `match_options` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `question_id` bigint(20) UNSIGNED DEFAULT NULL,
  `options` varchar(45) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 資料表新增資料前，先清除舊資料 `match_options`
--

TRUNCATE TABLE `match_options`;
-- --------------------------------------------------------

--
-- 資料表結構 `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 資料表新增資料前，先清除舊資料 `migrations`
--

TRUNCATE TABLE `migrations`;
--
-- 傾印資料表的資料 `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2024_04_22_161124_add_two_factor_columns_to_users_table', 1),
(5, '2024_04_22_161241_create_personal_access_tokens_table', 1),
(6, '2024_05_13_101958_countries_table', 1),
(7, '2024_05_13_102850_questions_table', 1),
(8, '2024_05_13_102934_options_table', 1),
(9, '2024_05_13_103900_rewriting_options_table', 1),
(10, '2024_05_13_104017_match_options_table', 1),
(11, '2024_05_13_104226_knowledge_cards_table', 1),
(12, '2024_05_13_104415_pass_course_need_cards_table', 1),
(13, '2024_05_13_104518_pass_course_get_cards_table', 1),
(14, '2024_05_16_054649_user_knowledge_cards', 1),
(15, '2024_05_16_054703_user_records', 1),
(16, '2024_05_23_063527_create_user_record_details_table', 1),
(17, '2024_05_23_063840_create_question_status_table', 1),
(18, '2024_05_24_055903_add_img_path_to_countries', 1),
(19, '2024_05_24_161002_create_card_type_table', 1),
(20, '2024_05_24_161701_add_card_type_to_knowledge_cards_table', 1),
(21, '2024_06_05_130006_add_status_to_user_records', 2),
(22, '2024_06_05_130257_drop_table_question_status', 3),
(23, '2024_06_11_020714_add_img_to_card_types', 4),
(24, '2024_06_23_081840_add_questions_cards_table', 5),
(25, '2024_06_23_082651_drop_knowledge_card_id_to_questions', 6),
(26, '2024_06_30_173824_create_dramas_table', 7),
(27, '2024_07_05_045408_create_debugs_table', 8),
(28, '2024_07_05_045951_create_debug_records_table', 8),
(41, '2024_08_08_111012_create_sec_games_table', 9),
(52, '2024_08_11_075225_create_sec_parameters_table', 10),
(53, '2024_08_11_075423_create_sec_records_table', 10),
(54, '2024_08_17_003037_rename_cols_to_pass_course_get_cards', 10),
(55, '2024_08_17_003338_rename_cols_to_pass_course_need_cards', 10),
(57, '2024_09_15_054336_create_sec_answers_table', 11),
(58, '2024_09_15_164214_change_length_parameter_to_sec_records', 12),
(59, '2024_09_23_013533_add_user_answer_to_sec_records', 13),
(60, '2024_10_07_195428_add_img_path_to_sec_games', 14);

-- --------------------------------------------------------

--
-- 資料表結構 `options`
--

CREATE TABLE `options` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `question_id` bigint(20) UNSIGNED DEFAULT NULL,
  `options` varchar(45) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 資料表新增資料前，先清除舊資料 `options`
--

TRUNCATE TABLE `options`;
--
-- 傾印資料表的資料 `options`
--

INSERT INTO `options` (`id`, `question_id`, `options`, `created_at`, `updated_at`) VALUES
(5, 6, 'int', NULL, NULL),
(6, 6, 'double', NULL, NULL),
(7, 6, 'float', NULL, NULL),
(8, 6, 'char', NULL, NULL),
(9, 7, 'int x = 10;', NULL, NULL),
(10, 7, 'int y;', NULL, NULL),
(11, 7, 'double z;', NULL, NULL),
(12, 7, 'char name = \"a\";', NULL, NULL),
(13, 8, 'int', NULL, NULL),
(14, 8, 'double', NULL, NULL),
(15, 8, 'char', NULL, NULL),
(16, 8, 'String', NULL, NULL),
(17, 9, 'int', NULL, NULL),
(18, 9, 'double', NULL, NULL),
(19, 9, 'char', NULL, NULL),
(20, 9, 'boolean', NULL, NULL),
(21, 93, 'System.out.print()', NULL, NULL),
(22, 93, 'System.out.println()', NULL, NULL),
(23, 93, 'System.out.printf()', NULL, NULL),
(25, 94, 'System.out.print()', NULL, NULL),
(26, 94, 'System.out.println()', NULL, NULL),
(27, 94, 'System.out.printf()', NULL, NULL),
(29, 95, 'Scanner keyin = new Scanner(System.in);', NULL, NULL),
(30, 95, 'keyin.nextLine()', NULL, NULL),
(31, 95, 'System.out.print()', NULL, NULL),
(32, 95, 'keyin.nextInt()', NULL, NULL),
(33, 96, 'keyin.nextInt()', NULL, NULL),
(34, 96, 'Scanner keyin = new Scanner(System.in);', NULL, NULL),
(35, 96, 'int a = keyin.nextInt();', NULL, NULL),
(36, 96, 'System.out.print()', NULL, NULL),
(37, 97, 'keyin.nextLine()', NULL, NULL),
(38, 97, 'keyin.next()', NULL, NULL),
(39, 97, 'keyin.nextint()', NULL, NULL),
(40, 97, 'keyin.close()', NULL, NULL),
(41, 98, '+', NULL, NULL),
(42, 98, '*', NULL, NULL),
(43, 98, '/', NULL, NULL),
(44, 98, '%', NULL, NULL),
(45, 99, '==', NULL, NULL),
(46, 99, '!=', NULL, NULL),
(47, 99, '>', NULL, NULL),
(48, 99, '<', NULL, NULL),
(49, 100, '&&', NULL, NULL),
(50, 100, '||', NULL, NULL),
(51, 100, '!', NULL, NULL),
(52, 100, '&', NULL, NULL),
(53, 101, '&&', NULL, NULL),
(54, 101, '||', NULL, NULL),
(55, 101, '!', NULL, NULL),
(56, 101, '&', NULL, NULL),
(57, 102, '&&', NULL, NULL),
(58, 102, '||', NULL, NULL),
(59, 102, '!', NULL, NULL),
(60, 102, '&', NULL, NULL),
(61, 103, '&&', NULL, NULL),
(62, 103, '==', NULL, NULL),
(63, 103, '--', NULL, NULL),
(64, 103, '++', NULL, NULL),
(65, 104, '&&', NULL, NULL),
(66, 104, '==', NULL, NULL),
(67, 104, '--', NULL, NULL),
(68, 104, '++', NULL, NULL),
(69, 105, 'print', NULL, NULL),
(70, 105, 'printf', NULL, NULL),
(71, 105, 'println', NULL, NULL),
(72, 106, 'printf', NULL, NULL),
(73, 106, 'println', NULL, NULL),
(74, 106, 'print', NULL, NULL),
(75, 107, 'print', NULL, NULL),
(76, 107, 'printf', NULL, NULL),
(77, 107, 'println', NULL, NULL),
(79, 108, 'nextFloat', NULL, NULL),
(80, 108, 'close', NULL, NULL),
(81, 108, 'nextLine', NULL, NULL),
(127, 109, 'new', NULL, NULL),
(128, 109, 'int', NULL, NULL),
(129, 109, 'string', NULL, NULL),
(130, 110, 'nextLine', NULL, NULL),
(131, 110, 'nextFloat', NULL, NULL),
(132, 110, 'nextInt', NULL, NULL),
(133, 111, 'nextInt', NULL, NULL),
(134, 111, 'nextLine', NULL, NULL),
(135, 111, 'nextFloat', NULL, NULL),
(136, 112, '!', NULL, NULL),
(137, 112, '&&', NULL, NULL),
(138, 112, '||', NULL, NULL),
(139, 113, '+=', NULL, NULL),
(140, 113, '-=', NULL, NULL),
(141, 113, '*-', NULL, NULL),
(142, 114, '%=', NULL, NULL),
(143, 114, '*=', NULL, NULL),
(144, 114, '/=', NULL, NULL),
(145, 115, '+=', NULL, NULL),
(146, 115, '*=', NULL, NULL),
(147, 115, '-=', NULL, NULL),
(148, 116, '&&', NULL, NULL),
(149, 116, '||', NULL, NULL),
(150, 116, '!', NULL, NULL),
(151, 117, '!', NULL, NULL),
(152, 117, '&&', NULL, NULL),
(153, 117, '||', NULL, NULL),
(154, 118, 'int', NULL, NULL),
(155, 118, 'String', NULL, NULL),
(156, 118, 'double', NULL, NULL),
(157, 119, 'float', NULL, NULL),
(158, 119, 'String', NULL, NULL),
(159, 119, 'char', NULL, NULL),
(160, 120, 'float、double', NULL, NULL),
(161, 120, 'int', NULL, NULL),
(162, 120, 'boolean', NULL, NULL),
(163, 121, 'boolean', NULL, NULL),
(164, 121, 'int', NULL, NULL),
(165, 121, 'String', NULL, NULL),
(166, 122, 'char', NULL, NULL),
(167, 122, 'float', NULL, NULL),
(168, 122, 'boolean', NULL, NULL),
(169, 123, 'int', NULL, NULL),
(170, 123, 'char', NULL, NULL),
(171, 123, 'float', NULL, NULL);

-- --------------------------------------------------------

--
-- 資料表結構 `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 資料表新增資料前，先清除舊資料 `password_reset_tokens`
--

TRUNCATE TABLE `password_reset_tokens`;
-- --------------------------------------------------------

--
-- 資料表結構 `pass_course_get_cards`
--

CREATE TABLE `pass_course_get_cards` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `secGameID` bigint(20) UNSIGNED DEFAULT NULL,
  `knowledge_card_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 資料表新增資料前，先清除舊資料 `pass_course_get_cards`
--

TRUNCATE TABLE `pass_course_get_cards`;
--
-- 傾印資料表的資料 `pass_course_get_cards`
--

INSERT INTO `pass_course_get_cards` (`id`, `secGameID`, `knowledge_card_id`, `created_at`, `updated_at`) VALUES
(1, 1, 23, NULL, NULL),
(2, 1, 24, NULL, NULL),
(3, 2, 25, NULL, NULL),
(4, 2, 26, NULL, NULL),
(5, 3, 27, NULL, NULL),
(6, 3, 28, NULL, NULL),
(7, 3, 29, NULL, NULL);

-- --------------------------------------------------------

--
-- 資料表結構 `pass_course_need_cards`
--

CREATE TABLE `pass_course_need_cards` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `secGameID` bigint(20) UNSIGNED DEFAULT NULL,
  `knowledge_card_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 資料表新增資料前，先清除舊資料 `pass_course_need_cards`
--

TRUNCATE TABLE `pass_course_need_cards`;
--
-- 傾印資料表的資料 `pass_course_need_cards`
--

INSERT INTO `pass_course_need_cards` (`id`, `secGameID`, `knowledge_card_id`, `created_at`, `updated_at`) VALUES
(1, 2, 24, NULL, NULL),
(2, 3, 24, NULL, NULL),
(3, 3, 26, NULL, NULL),
(4, 4, 23, NULL, NULL),
(5, 5, 23, NULL, NULL),
(6, 5, 24, NULL, NULL),
(7, 6, 25, NULL, NULL),
(8, 6, 26, NULL, NULL),
(9, 7, 25, NULL, NULL),
(10, 8, 27, NULL, NULL),
(11, 8, 29, NULL, NULL),
(12, 9, 25, NULL, NULL),
(13, 9, 28, NULL, NULL),
(14, 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- 資料表結構 `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 資料表新增資料前，先清除舊資料 `personal_access_tokens`
--

TRUNCATE TABLE `personal_access_tokens`;
-- --------------------------------------------------------

--
-- 資料表結構 `questions`
--

CREATE TABLE `questions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `country_id` bigint(20) UNSIGNED DEFAULT NULL,
  `gametype` char(255) DEFAULT NULL,
  `levels` int(11) DEFAULT NULL,
  `describe` char(255) DEFAULT NULL,
  `questions` char(200) DEFAULT NULL,
  `answer` char(200) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 資料表新增資料前，先清除舊資料 `questions`
--

TRUNCATE TABLE `questions`;
--
-- 傾印資料表的資料 `questions`
--

INSERT INTO `questions` (`id`, `country_id`, `gametype`, `levels`, `describe`, `questions`, `answer`, `created_at`, `updated_at`) VALUES
(1, 1, '是非', 1, '稻草人在計算他的稻草重量，這重量用float資料型態能否儲存小數值？', '稻草人在計算他的稻草重量，這重量用float資料型態能否儲存小數值？', 'O', NULL, NULL),
(2, 1, '是非', 1, '東方壞女巫在製作毒藥，毒藥的劑量用float資料型態能否儲存整數值？', '東方壞女巫在製作毒藥，毒藥的劑量用float資料型態能否儲存整數值？', 'X', NULL, NULL),
(3, 1, '是非', 1, '桃樂絲在黃磚路上發現了一瓶神奇的藥水，這瓶藥水的容量用int資料型態能否儲存小數值？', '桃樂絲在黃磚路上發現了一瓶神奇的藥水，這瓶藥水的容量用int資料型態能否儲存小數值？', 'X', NULL, NULL),
(4, 1, '是非', 1, '稻草人在計算為村民施肥的劑量，這劑量用double資料型態能否儲存小數值？', '稻草人在計算為村民施肥的劑量，這劑量用double資料型態能否儲存小數值？', 'O', NULL, NULL),
(5, 1, '是非', 1, '在奧茲國，桃樂絲發現了一個神奇的浮點箱。這個箱子可以儲存閃閃發光的小數點嗎？', '在奧茲國，桃樂絲發現了一個神奇的浮點箱。這個箱子可以儲存閃閃發光的小數點嗎？', 'O', NULL, NULL),
(6, 1, '選擇', 1, '當桃樂絲和稻草人需要記下翡翠城的距離時，下列哪個資料型態用於表示整數？', '當桃樂絲和稻草人需要記下翡翠城的距離時，下列哪個資料型態用於表示整數？', 'int', NULL, NULL),
(7, 1, '選擇', 1, '在慶祝桃樂絲解救小矮人的宴會上，他們需要準備一些水果和食物。下列哪個資料型態可以用來表示食物的數量？', '在慶祝桃樂絲解救小矮人的宴會上，他們需要準備一些水果和食物。下列哪個資料型態可以用來表示食物的數量？', 'int x = 10;', NULL, NULL),
(8, 1, '選擇', 1, '桃樂絲想記錄旅途中遇到的每一個朋友的名字，下列哪個資料型態用於表示字串？', '桃樂絲想記錄旅途中遇到的每一個朋友的名字，下列哪個資料型態用於表示字串？', 'String', NULL, NULL),
(9, 1, '選擇', 1, '在桃樂絲的旅途中，稻草人發現需要一種資料型態進行雙精度浮點數計算用來規劃路線。下列哪個是正確的選擇？', '在桃樂絲的旅途中，稻草人發現需要一種資料型態進行雙精度浮點數計算用來規劃路線。下列哪個是正確的選擇？', 'double', NULL, NULL),
(10, 1, '配對', 1, '稻草人需要表示整數的資料型態，來計算稻草數量', '稻草人需要表示整數的資料型態，來計算稻草數量', 'int', NULL, NULL),
(11, 1, '配對', 1, '桃樂絲需要表示浮點數的資料型態，來計算旅途中的距離。', '桃樂絲需要表示浮點數的資料型態，來計算旅途中的距離。', 'float', NULL, NULL),
(12, 1, '配對', 1, '南方女巫需要表示布林值的資料型態，來判斷是否安全。', '南方女巫需要表示布林值的資料型態，來判斷是否安全。', 'boolean', NULL, NULL),
(13, 1, '配對', 1, '桃樂絲需要表示雙精浮點數的資料型態，來更精確地計算旅途距離。', '桃樂絲需要表示雙精浮點數的資料型態，來更精確地計算旅途距離。', 'double', NULL, NULL),
(14, 1, '配對', 1, '桃樂絲需要表示字串的資料型態，來記錄旅途中的地名。', '桃樂絲需要表示字串的資料型態，來記錄旅途中的地名。', 'String', NULL, NULL),
(15, 1, '配對', 1, '托托需要用來表示字元的資料型態，以便表示簡單的指令。', '托托需要用來表示字元的資料型態，以便表示簡單的指令。', 'char', NULL, NULL),
(66, 1, '是非', 2, '桃樂絲和托托被龍捲風帶到神奇的蠻金之國，冒險者需要\"從鍵盤讀取下一行的用戶輸入\"來幫助桃樂絲找到回家的路。請問這段程式碼是否用於此目的？\n\nSystem.out.println(\"幫助桃樂絲找到回家的路：\" + keyin.nextLine());', '桃樂絲和托托被龍捲風帶到神奇的蠻金之國，冒險者需要\"從鍵盤讀取下一行的用戶輸入\"來幫助桃樂絲找到回家的路。請問這段程式碼是否用於此目的？\r\n\r\nSystem.out.println(\"幫助桃樂絲找到回家的路：\" + keyin.nextLine());', 'O', NULL, NULL),
(67, 1, '是非', 2, '在蠻金之國的冒險過程中，桃樂絲需要關閉她的神奇裝置（Scanner）來防止壞女巫輸入干擾。請問這段程式碼是否正確？\n\nScanner keyin = new Scanner(System.in);\nkeyin.close();', '在蠻金之國的冒險過程中，桃樂絲需要關閉她的神奇裝置（Scanner）來防止壞女巫輸入干擾。請問這段程式碼是否正確？\r\n\r\nScanner keyin = new Scanner(System.in);\r\nkeyin.close();', 'O', NULL, NULL),
(68, 1, '是非', 2, '桃樂絲在蠻金之國見到好女巫，請冒險家幫助桃樂絲用以下程式碼進行\"資料輸入的宣告\"，來記錄她的願望。請問這段程式碼是否為資料輸入宣告？\r\n\r\nScanner keyin = new Scanner(System.in);', '桃樂絲在蠻金之國見到好女巫，請冒險家幫助桃樂絲用以下程式碼進行\"資料輸入的宣告\"，來記錄她的願望。請問這段程式碼是否為資料輸入宣告？\r\n\r\nScanner keyin = new Scanner(System.in);', 'O', NULL, NULL),
(69, 1, '是非', 2, '請冒險者幫助桃樂絲計算蠻金之國通往翡翠城的路程，請使用以下程式碼來\"讀取整數輸入\"。請問這段程式碼是否為資料輸出？\r\n\r\nint a = keyin.nextInt();', '請冒險者幫助桃樂絲計算蠻金之國通往翡翠城的路程，請使用以下程式碼來\"讀取整數輸入\"。請問這段程式碼是否為資料輸出？\r\n\r\nint a = keyin.nextInt();', 'X', NULL, NULL),
(70, 1, '是非', 2, '桃樂絲想向稻草人展示他的家鄉，請冒險者幫助桃樂絲使用以下程式碼來\"輸出資料\"。請問這段程式碼是否為資料輸出？\r\n\r\nSystem.out.println();', '桃樂絲想向稻草人展示他的家鄉，請冒險者幫助桃樂絲使用以下程式碼來\"輸出資料\"。請問這段程式碼是否為資料輸出？\r\n\r\nSystem.out.println();', 'O', NULL, NULL),
(71, 1, '是非', 2, '桃樂絲想向稻草人展示地圖，請冒險者幫助桃樂絲使用以下程式碼來\"換行顯示\"不同地點。請問這段程式碼，換行表示是否正確？ \r\n\r\nSystem.out.print(\"\\n\");', '桃樂絲想向稻草人展示地圖，請冒險者幫助桃樂絲使用以下程式碼來\"換行顯示\"不同地點。請問這段程式碼，換行表示是否正確？ \r\n\r\nSystem.out.print(\"\\n\");', 'O', NULL, NULL),
(72, 1, '是非', 3, '桃樂絲和稻草人在黃磚路上發現了一個寶箱，想要打開必須要先解開謎題，請幫助桃樂絲解開下列謎題。&&是否用於表示邏輯運算的\"AND\"', '桃樂絲和稻草人在黃磚路上發現了一個寶箱，想要打開必須要先解開謎題，請幫助桃樂絲解開下列謎題。&&是否用於表示邏輯運算的\"AND\"', 'O', NULL, NULL),
(73, 1, '是非', 3, '托托被壞女巫設下的陷阱給困住了，請幫助桃樂絲解開下列謎題拯救托托。||是否用於表示邏輯運算的\"OR\"', '托托被壞女巫設下的陷阱給困住了，請幫助桃樂絲解開下列謎題拯救托托。||是否用於表示邏輯運算的\"OR\"', 'O', NULL, NULL),
(74, 1, '是非', 3, '桃樂絲和稻草人在冒險途中遇到了岔路，桃樂絲想要利用\"= =\"比較此岔路是否是黃磚路，請幫助桃樂絲判斷\"= =\"是否用於比較兩個值是否相等', '桃樂絲和稻草人在冒險途中遇到了岔路，桃樂絲想要利用\"= =\"比較此岔路是否是黃磚路，請幫助桃樂絲判斷\"= =\"是否用於比較兩個值是否相等', 'O', NULL, NULL),
(75, 1, '是非', 3, '稻草人到程式碼商店購買用於比較兩個值是否相等的關係運算子，\"!=\"用於比較兩個值是否相等', '稻草人到程式碼商店購買用於比較兩個值是否相等的關係運算子，\"!=\"用於比較兩個值是否相等', 'X', NULL, NULL),
(76, 1, '配對', 2, '當桃樂絲需要向稻草人\"輸出下一個目的地並換行顯示\"時，她使用了什麼方法？', '當桃樂絲需要向稻草人\"輸出下一個目的地並換行顯示\"時，她使用了什麼方法？', 'System.out.println()', NULL, NULL),
(77, 1, '配對', 2, '當稻草人需要連續\"輸出多個數字並且不換行\"時，他使用了什麼方法？', '當稻草人需要連續\"輸出多個數字並且不換行\"時，他使用了什麼方法？', 'System.out.print()', NULL, NULL),
(78, 1, '配對', 2, '當桃樂絲需要按照特定格式顯示重要信息時，她使用能\"印出參數並且按照指定格式輸出\"數據的方法', '當桃樂絲需要按照特定格式顯示重要信息時，她使用能\"印出參數並且按照指定格式輸出\"數據的方法', 'System.out.printf()', NULL, NULL),
(79, 1, '配對', 2, '當稻草人需要\"從鍵盤讀取一個整數\"來計算他們前進的步數時，他使用了什麼方法？', '當稻草人需要\"從鍵盤讀取一個整數\"來計算他們前進的步數時，他使用了什麼方法？', 'keyin.nextInt()', NULL, NULL),
(80, 1, '配對', 2, '當稻草人需要\"從鍵盤讀取一個浮點數\"來計算距離時，他使用了什麼方法？', '當稻草人需要\"從鍵盤讀取一個浮點數\"來計算距離時，他使用了什麼方法？', 'keyin.nextFloat()', NULL, NULL),
(81, 1, '配對', 3, '運算符用於\"求餘數\"', '運算符用於\"求餘數\"', '%', NULL, NULL),
(82, 1, '配對', 3, '運算符用於\"求相加\"', '運算符用於\"求相加\"', '+', NULL, NULL),
(83, 1, '配對', 3, '運算符用於\"求相減\"', '運算符用於\"求相減\"', '-', NULL, NULL),
(84, 1, '配對', 3, '運算符用於\"求相乘\"', '運算符用於\"求相乘\"', '*', NULL, NULL),
(85, 1, '配對', 3, '運算符用於\"求相除\"', '運算符用於\"求相除\"', '/', NULL, NULL),
(86, 1, '配對', 3, '運算子用於\"求遞增\"', '運算子用於\"求遞增\"', '++', NULL, NULL),
(87, 1, '配對', 3, '運算子用於\"求遞減\"', '運算子用於\"求遞減\"', '- -', NULL, NULL),
(88, 1, '配對', 3, '運算子用於求\"AND\"', '運算子用於求\"AND\"', '&&', NULL, NULL),
(89, 1, '配對', 3, '運算子用於求\"NOT\"', '運算子用於求\"NOT\"', '!', NULL, NULL),
(90, 1, '配對', 3, '運算子用於求\"OR\"', '運算子用於求\"OR\"', '||', NULL, NULL),
(91, 1, '配對', 3, '運算子用於\"求相等\"', '運算子用於\"求相等\"', '==', NULL, NULL),
(92, 1, '配對', 3, '運算子用於\"求不相等\"', '運算子用於\"求不相等\"', '!=', NULL, NULL),
(93, 1, '選擇', 2, '桃樂絲在冒險中，當她想要在日記中記錄她的探險時，她會使用能\"印出參數，並且自動換行\"的方法。正確的選項是：', '桃樂絲在冒險中，當她想要在日記中記錄她的探險時，她會使用能\"印出參數，並且自動換行\"的方法。正確的選項是：', 'System.out.println()', NULL, NULL),
(94, 1, '選擇', 2, '小矮人為了在宴會上對桃樂絲表示謝意，必須使用特定格式來寫感謝信，\"使用能印出參數，且格式輸出\"的方法是：', '小矮人為了在宴會上對桃樂絲表示謝意，必須使用特定格式來寫感謝信，\"使用能印出參數，且格式輸出\"的方法是：', 'System.out.printf()', NULL, NULL),
(95, 1, '選擇', 2, '當桃樂絲準備好出發時，他需要一個方法來將地圖和計劃分享給稻草人。哪個選項用於表示\"資料輸出\"呢？', '當桃樂絲準備好出發時，他需要一個方法來將地圖和計劃分享給稻草人。哪個選項用於表示\"資料輸出\"呢？', 'System.out.print()', NULL, NULL),
(96, 1, '選擇', 2, '當桃樂絲一行人離開蠻金之國時需要填寫遊客離開人數，他使用以下哪種程式碼來讀取使用者輸入的整數?', '當桃樂絲一行人離開蠻金之國時需要填寫遊客離開人數，他使用以下哪種程式碼來讀取使用者輸入的整數?', 'int a = keyin.nextInt();', NULL, NULL),
(97, 1, '選擇', 2, '當桃樂絲輸入完資料，蠻金之國遊客系統必須關閉輸入，下列哪個意思為\"關閉Scanner不能再輸入\"？', '當桃樂絲輸入完資料，蠻金之國遊客系統必須關閉輸入，下列哪個意思為\"關閉Scanner不能再輸入\"？', 'keyin.close()', NULL, NULL),
(98, 1, '選擇', 3, '桃樂絲要幫助蠻金之國的小矮人計算分配完稻草後稻草的剩餘數量，下列哪個運算符用於\"求餘數\"？', '桃樂絲要幫助蠻金之國的小矮人計算分配完稻草後稻草的剩餘數量，下列哪個運算符用於\"求餘數\"？', '%', NULL, NULL),
(99, 1, '選擇', 3, '稻草人被村民的柵欄困住了，想要開啟柵欄必須找到兩個樣子不相同的鑰匙，下列哪個比較運算符用於比較兩個值「不」相等？', '稻草人被村民的柵欄困住了，想要開啟柵欄必須找到兩個樣子不相同的鑰匙，下列哪個比較運算符用於比較兩個值「不」相等？', '!=', NULL, NULL),
(100, 1, '選擇', 3, '桃樂絲在通往南國路上發現了一道謎題，請幫助桃樂絲破解謎題，下列哪個選項表示邏輯運算的“AND”操作？', '桃樂絲在通往南國路上發現了一道謎題，請幫助桃樂絲破解謎題，下列哪個選項表示邏輯運算的“AND”操作？', '&&', NULL, NULL),
(101, 1, '選擇', 3, '稻草人在金色稻田裡發現了謎題寶箱，想打開寶箱要先破解謎題，請幫助稻草人破解謎題，下列哪個選項表示邏輯運算的“OR”操作？', '稻草人在金色稻田裡發現了謎題寶箱，想打開寶箱要先破解謎題，請幫助稻草人破解謎題，下列哪個選項表示邏輯運算的“OR”操作？', '||', NULL, NULL),
(102, 1, '選擇', 3, '小矮人到程式碼商店購買表示邏輯運算的“NOT”操作，下列哪個選項表示邏輯運算的“NOT”操作？', '小矮人到程式碼商店購買表示邏輯運算的“NOT”操作，下列哪個選項表示邏輯運算的“NOT”操作？', '!', NULL, NULL),
(103, 1, '選擇', 3, '桃樂絲想要離開金色稻田遇到了謎題門，想要打開謎題門必須通過以下謎題，請幫助桃樂絲解開謎題，下列哪個選項表示「遞增」操作？', '桃樂絲想要離開金色稻田遇到了謎題門，想要打開謎題門必須通過以下謎題，請幫助桃樂絲解開謎題，下列哪個選項表示「遞增」操作？', '++', NULL, NULL),
(104, 1, '選擇', 3, '托托被謎題門困住了請幫助桃樂絲解開以下謎題並解救托托，下列哪個選項表示「遞減」操作？', '托托被謎題門困住了請幫助桃樂絲解開以下謎題並解救托托，下列哪個選項表示「遞減」操作？', '--', NULL, NULL),
(105, 1, '填空', 2, '桃樂絲使用打字機向好女巫匯報她的冒險經歷時，她需要\"在每段話後換行\"，她應該使用：', 'System.out.___(\"Hello World\");', 'print', NULL, NULL),
(106, 1, '填空', 2, '桃樂絲需要精確地向稻草人展示黃磚路上的距離，並且\"印出參數並且按照指定格式輸出\"，她應該使用：', 'System.out.___(\"%d\");', 'printf', NULL, NULL),
(107, 1, '填空', 2, '請幫助桃樂絲輸入程式碼與跟稻草人打招呼，她應該使用：', 'System.out.___(\"Hello World\\n\");', 'print', NULL, NULL),
(108, 1, '填空', 2, '桃樂絲在幫助小矮人解決程式碼問題遇到困難了，請幫助桃樂絲完成以下程式碼:', '\"關閉Scanner不再輸入\" => keyin.___();', 'close', NULL, NULL),
(109, 1, '填空', 2, '桃樂絲需要創建一個\"新的Scanner工具\"來收集有關翡翠城的信息時，她應該使用：', 'Scanner keyin = ___ Scanner(System.in);', 'new', NULL, NULL),
(110, 1, '填空', 2, '桃樂絲需要\"讀取一個來自稻草人的整數輸入\"以計算他們的下一步行程，她應該使用：', 'int a = keyin.___();', 'nextInt', NULL, NULL),
(111, 1, '填空', 2, '桃樂絲需要確定蠻金之國的\"浮點數坐標\"時，她應該使用：', 'float b = keyin.___();', 'nextFloat', NULL, NULL),
(112, 1, '填空', 3, '需要輸出 10', '<pre>\nint a = 20;\nint b = 10;\nif(( a > b ) _____ ( b < 1 )){\n    System.out.print(a += b);\n}else{\n    System.out.print(a -= b);\n}</pre>', '&&', NULL, NULL),
(113, 1, '填空', 3, '需要輸出 30', '<pre>\nint a = 20;\nint b = 10;\nSystem.out.print(a ___ b);</pre>', '+=', NULL, NULL),
(114, 1, '填空', 3, '需要輸出 10', '<pre>\nint a = 40;\nint b = 30;\nSystem.out.print(a ___ b);</pre>', '%=', NULL, NULL),
(115, 1, '填空', 3, '需要輸出 10', '<pre>\nint a = 20;\nint b = 10;\nSystem.out.print(a ___ b);</pre>', '-=', NULL, NULL),
(116, 1, '填空', 3, '需要輸出 -60', '<pre>\nint x = -80;\nint y = 20;\nif(x > 0 ___ y > 0 );{\n    System.out.print(x += y);\n}else{\n    System.out.print(x -= y);\n}</pre>', '||', NULL, NULL),
(117, 1, '填空', 3, '需要輸出 -110', '<pre>\nint a = -50;\nint b = -60;\nif(!( a > 0 ) ___ !( b > 0 )){\n    System.out.print(a += b);\n}else{\n    System.out.print(a -= b);\n}</pre>', '&&', NULL, NULL),
(118, 1, '填空', 1, '桃樂絲告訴稻草人她已經 18 歲了。', '___ years = 18;', 'int', NULL, NULL),
(119, 1, '填空', 1, '稻草人給桃樂絲指了一條叫 \"林森北七路\" 的路。', '___ roads = \"林森北七路\";', 'string', NULL, NULL),
(120, 1, '填空', 1, '桃樂絲和稻草人計算他們走了多少公里。', '___ miles = 3 / 1.6;', 'float、double', NULL, NULL),
(121, 1, '填空', 1, '壞女巫試圖催眠桃樂絲，這雙紅鞋不屬於她。', '___ mine = False;', 'boolean', NULL, NULL),
(122, 1, '填空', 1, '好女巫告訴桃樂絲要相信自己能找到通往翡翠城的路。', '___ yourself = True;', 'boolean', NULL, NULL),
(123, 1, '填空', 1, '稻草人看到一個寫著 \"王\" 字的標誌。', '___ K = \'王\';', 'char', NULL, NULL);

-- --------------------------------------------------------

--
-- 資料表結構 `questions_cards`
--

CREATE TABLE `questions_cards` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `question_id` bigint(20) UNSIGNED NOT NULL,
  `knowledge_card_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 資料表新增資料前，先清除舊資料 `questions_cards`
--

TRUNCATE TABLE `questions_cards`;
--
-- 傾印資料表的資料 `questions_cards`
--

INSERT INTO `questions_cards` (`id`, `question_id`, `knowledge_card_id`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 3, 4),
(4, 4, 2),
(5, 5, 1),
(6, 6, 4),
(7, 7, 4),
(8, 8, 21),
(9, 9, 2),
(10, 10, 4),
(11, 11, 1),
(12, 12, 3),
(13, 13, 2),
(14, 14, 21),
(15, 15, 5),
(16, 16, 4),
(17, 17, 21),
(18, 18, 1),
(19, 18, 2),
(20, 66, 10),
(21, 66, 13),
(22, 67, 8),
(23, 67, 6),
(24, 67, 7),
(25, 68, 6),
(26, 68, 7),
(27, 69, 12),
(28, 69, 15),
(29, 69, 13),
(30, 69, 14),
(31, 70, 13),
(32, 71, 15),
(33, 72, 18),
(34, 73, 18),
(35, 74, 17),
(36, 74, 17),
(37, 76, 13),
(38, 77, 15),
(39, 78, 14),
(40, 79, 12),
(41, 80, 22),
(42, 81, 16),
(43, 82, 16),
(44, 83, 16),
(45, 84, 16),
(46, 85, 16),
(47, 86, 19),
(48, 87, 19),
(49, 88, 18),
(50, 89, 18),
(51, 90, 18),
(52, 91, 17),
(53, 92, 17),
(54, 93, 13),
(55, 93, 15),
(56, 93, 14),
(57, 94, 14),
(58, 94, 15),
(59, 94, 13),
(60, 95, 15),
(61, 95, 6),
(62, 95, 7),
(63, 95, 10),
(64, 95, 12),
(65, 96, 4),
(66, 96, 12),
(67, 96, 6),
(68, 96, 7),
(69, 96, 15),
(70, 97, 8),
(71, 97, 10),
(72, 97, 11),
(73, 97, 12),
(74, 98, 16),
(75, 99, 17),
(76, 100, 18),
(77, 101, 18),
(78, 102, 18),
(79, 103, 18),
(80, 103, 19),
(81, 104, 18),
(82, 104, 19),
(83, 105, 13),
(84, 105, 15),
(85, 105, 14),
(86, 106, 14),
(87, 106, 15),
(88, 106, 13),
(89, 107, 15),
(90, 107, 14),
(91, 107, 13),
(92, 108, 8),
(93, 108, 22),
(94, 108, 10),
(95, 109, 6),
(96, 109, 7),
(97, 109, 21),
(98, 109, 4),
(99, 110, 12),
(100, 110, 10),
(101, 110, 22),
(102, 111, 22),
(103, 111, 12),
(104, 111, 10),
(105, 112, 18),
(106, 113, 16),
(107, 114, 16),
(108, 115, 16),
(109, 116, 18),
(110, 117, 18),
(111, 118, 4),
(112, 118, 21),
(113, 118, 2),
(114, 119, 21),
(115, 119, 1),
(116, 119, 5),
(117, 120, 1),
(118, 120, 2),
(119, 120, 4),
(120, 120, 3),
(121, 121, 3),
(122, 121, 4),
(123, 121, 21),
(124, 122, 3),
(125, 122, 5),
(126, 122, 1),
(127, 123, 5),
(128, 123, 4),
(129, 123, 1);

-- --------------------------------------------------------

--
-- 資料表結構 `question_status`
--

CREATE TABLE `question_status` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `question_id` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 資料表新增資料前，先清除舊資料 `question_status`
--

TRUNCATE TABLE `question_status`;
-- --------------------------------------------------------

--
-- 資料表結構 `reorganization_option`
--

CREATE TABLE `reorganization_option` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `question_id` bigint(20) UNSIGNED DEFAULT NULL,
  `options` varchar(45) DEFAULT NULL,
  `sort` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 資料表新增資料前，先清除舊資料 `reorganization_option`
--

TRUNCATE TABLE `reorganization_option`;
-- --------------------------------------------------------

--
-- 資料表結構 `sec_answers`
--

CREATE TABLE `sec_answers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `secParameterID` bigint(20) UNSIGNED NOT NULL,
  `order` int(11) NOT NULL,
  `ans_patterns` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 資料表新增資料前，先清除舊資料 `sec_answers`
--

TRUNCATE TABLE `sec_answers`;
--
-- 傾印資料表的資料 `sec_answers`
--

INSERT INTO `sec_answers` (`id`, `secParameterID`, `order`, `ans_patterns`, `created_at`, `updated_at`) VALUES
(1, 2, 1, '^\\s*int\\s+i\\s*=\\s*1\\s*$', NULL, NULL),
(2, 2, 2, '^\\s*i\\s*<=\\s*n\\s*$', NULL, NULL),
(3, 2, 3, '^\\s*i\\s*\\+\\+\\s*$', NULL, NULL),
(4, 2, 4, '^\\s*int\\s+j\\s*=\\s*1\\s*$', NULL, NULL),
(5, 2, 5, '^\\s*j\\s*<=\\s*2\\s*\\*\\s*i\\s*-\\s*1\\s*$', NULL, NULL),
(6, 2, 6, '^\\s*j\\s*\\+\\+\\s*$', NULL, NULL),
(7, 3, 1, '^\\s*int\\s+i\\s*=\\s*n\\s*$', NULL, NULL),
(8, 3, 2, '^\\s*i\\s*>=\\s*1\\s*$', NULL, NULL),
(9, 3, 3, '^\\s*i\\s*\\-\\-\\s*$', NULL, NULL),
(10, 3, 4, '^\\s*int\\s+j\\s*=\\s*1\\s*$', NULL, NULL),
(11, 3, 5, '^\\s*j\\s*<=\\s*2\\s*\\*\\s*i\\s*-\\s*1\\s*$', NULL, NULL),
(12, 3, 6, '^\\s*j\\s*\\+\\+\\s*$', NULL, NULL),
(13, 4, 1, '^\\s*int\\s+i\\s*=\\s*1\\s*$', NULL, NULL),
(14, 4, 2, '^\\s*i\\s*<=\\s*n\\s*$', NULL, NULL),
(15, 4, 3, '^\\s*i\\s*\\+\\+\\s*$', NULL, NULL),
(16, 4, 4, '^\\s*int\\s+j\\s*=\\s*1\\s*$', NULL, NULL),
(17, 4, 5, '^\\s*j\\s*<=\\s*n\\s*-\\s*i\\s*$', NULL, NULL),
(18, 4, 6, '^\\s*j\\s*\\+\\+\\s*$', NULL, NULL),
(19, 4, 7, '^\\s*int\\s+j\\s*=\\s*1\\s*$', NULL, NULL),
(20, 4, 8, '^\\s*j\\s*<=\\s*2\\s*\\*\\s*i\\s*-\\s*1\\s*$', NULL, NULL),
(21, 4, 9, '^\\s*j\\s*\\+\\+\\s*$', NULL, NULL),
(22, 5, 1, '^\\s*int\\s+i\\s*=\\s*n\\s*$', NULL, NULL),
(23, 5, 2, '^\\s*i\\s*>=\\s*1\\s*$', NULL, NULL),
(24, 5, 3, '^\\s*i\\s*--\\s*$', NULL, NULL),
(25, 5, 4, '^\\s*int\\s+j\\s*=\\s*1\\s*$', NULL, NULL),
(26, 5, 5, '^\\s*j\\s*<=\\s*n\\s*-\\s*i\\s*$', NULL, NULL),
(27, 5, 6, '^\\s*j\\s*\\+\\+\\s*$', NULL, NULL),
(28, 5, 7, '^\\s*int\\s+j\\s*=\\s*1\\s*$', NULL, NULL),
(29, 5, 8, '^\\s*j\\s*<=\\s*2\\s*\\*\\s*i\\s*-\\s*1\\s*$', NULL, NULL),
(30, 5, 9, '^\\s*j\\s*\\+\\+\\s*$', NULL, NULL),
(31, 7, 1, '^\\s*material1\\s*>=\\s*20\\s*&&\\s*material1\\s*<=\\s*50\\s*&&\\s*material2\\s*<\\s*30\\s*$', NULL, NULL);

-- --------------------------------------------------------

--
-- 資料表結構 `sec_games`
--

CREATE TABLE `sec_games` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `country_id` bigint(20) UNSIGNED NOT NULL,
  `gamename` varchar(255) NOT NULL,
  `pre_story` text NOT NULL,
  `game_explanation` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `imgPath` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 資料表新增資料前，先清除舊資料 `sec_games`
--

TRUNCATE TABLE `sec_games`;
--
-- 傾印資料表的資料 `sec_games`
--

INSERT INTO `sec_games` (`id`, `country_id`, `gamename`, `pre_story`, `game_explanation`, `created_at`, `updated_at`, `imgPath`) VALUES
(1, 2, '通關密碼', '在蠻金之國與南國之間有一片神秘的蘋果樹林，傳說中只有掌握正確通關密碼的人才能進入這片蘋果樹林，你的任務是破解密碼並把大門密碼輸出到螢幕上，幫助桃樂絲一行人順利往南國前進。', '在大門打開之前，密碼必須正確顯示在螢幕上。請點擊「程式密碼鎖」查看密碼格式與規則，根據PASSWORD指定的格式輸出正確的通關密碼，幫助桃樂絲一行人順利進入神秘的蘋果樹林，繼續他們的旅程！', NULL, NULL, 'password.svg'),
(2, 2, '魔法寶箱', '穿越過蘋果樹林桃樂絲一行人來到了南國門口，卻被綠柱尖頭族領袖攔住，他們說需要獲得好女巫給的護身符才能通過他們進入南國，桃樂絲找出在蠻金之國好女巫給的護身符，但好女巫太熱心怕被壞女巫搶走，所以她在外面加了一個寶箱鎖死。請冒險者打開寶箱取出護身符交給綠柱尖頭族領袖!!', '為了打開好女巫鎖上的寶箱並取出護身符，你必須點亮寶箱上的三角形鎖頭。請在右方程式碼區使用巢狀 for 迴圈來解鎖寶箱，幫助桃樂絲一行人順利通過綠柱尖頭族領袖的阻攔，進入南國！', NULL, NULL, 'box.svg'),
(3, 2, '魔法門衛', '進入南國的你，發現綠柱尖頭族領袖排查進城的人們效率太慢而導致許多人需要在外面排隊至少三天三夜才能進城。許多的商人會的商品會因此爛掉或變質，商人們苦不堪言。你剛好看到他們在招攬專業人才「希望能想出快速通關進城的解決方法。｣請發揮你的才能，幫助他們解決問題！！', '為了解決進城速度過慢的問題，請使用 for 迴圈收集今日進城的身份證，並用 if…else 判斷進城者的身份。怪物禁止進入南國，其他村民與商人可以免費通行。發揮你的才能，幫助南國加快通關效率，減少商人們的損失！', NULL, NULL, 'idcard.svg'),
(4, 2, '調配藥水', '桃樂絲一行人過度飢餓，無法繼續前進。你需要幫助他們隨機獲得一個藥水配方，並使用 if 條件語句成功調製治癒藥水。', '桃樂絲一行人從蠻金之國到蘋果樹林這都沒有涉入食物，過度飢餓導致無力繼續前進，請幫助他們調配出治癒藥水，能夠回復體力並不會再度飢餓', NULL, NULL, 'gem.svg'),
(5, 2, '魔林解密', '在蘋果怪樹林深處，魔法師施展了一個神秘的咒語，隨機選出了一個基準數字作為通行的關鍵。接著，又產生了一個特殊數字，作為森林守護者的試煉。你必須在這兩個數字之間，找出符合特定範圍的質數，才能破解魔林的謎題，幫助桃樂絲一行人繼續前進！', '繼續往前，桃樂絲一行人迎面遇上了一位神秘的南國魔法師，擋在蘋果怪樹林的入口處。魔法師告訴他們：“在林中，有一段路徑被一群蘋果怪所守護。這些怪物並不會輕易讓路，除非你能找到一個規律。只有當你們找到這些數字，怪物才會允許你們通過。” 請幫助桃樂絲完成任務，讓他們能安全通過蘋果怪樹林！', NULL, NULL, 'cave.svg'),
(6, 2, '密碼解碼', '桃樂絲一行人要從蘋果怪樹林前往村莊的路途中，遇到了傳說中的詛咒的神廟 ，其內部隱藏著改變命運的錦囊；想要得到命運錦囊必須拆解神廟內的炸彈。拆解炸彈的唯一方法是將一串神秘的數字倒敘排列，才會得到命運錦囊。請幫助桃樂絲一行人拆解炸彈獲得命運錦囊吧!!', '隨機生成一個三位數，並使用 while 迴圈逐一提取數字位，根據以下規則進行解碼。解碼後的三個數字相加就是拆解炸彈的密碼，請冒險者幫助桃樂絲拆解炸彈，拿到命運錦囊！', NULL, NULL, ''),
(7, 2, '塔中巡油', '桃樂絲和稻草人前進後遇到了錫人，但是它看起來死氣沉沉。桃樂絲突然想到她之前在看書的時候有說，錫人通常都需要用油來恢復生命。請幫助桃樂絲在附近找到足夠數量的油罐，並幫忙錫人上油!!', '為了幫助桃樂絲和稻草人找到足夠的油來恢復錫人的生命，你需要在附近的塔中進行尋油。隨機生成塔層數給冒險者，利用 while 迴圈從下往上跑過整層塔。每層塔根據不同的層數條件，會觸發不同的公式來增減油罐。請確保你能準確找到所需的油罐數量，幫助錫人恢復活力，繼續冒險！', NULL, NULL, ''),
(8, 2, '命運試煉', '正帶著錫人前往翡翠城尋找奧茲法師時，壞女巫出現了!!!她使出火之呼吸包圍了我們一行人；桃樂絲打開在詛咒神廟時所獲得的錦囊，內容詳細的記錄了對付壞女巫的辦法，但是桃樂絲只看得懂switch…case的程式碼，請改寫程式碼幫助桃樂絲讀懂錦囊的內容，打敗壞女巫!!', '壞女巫出現了，桃樂絲正面臨危機！她打開了錦囊，裡面記錄了對付壞女巫的辦法。然而，桃樂絲只懂得使用 switch…case 來解讀這些指示。請根據原始的 if…else if…else 程式碼，將其改寫為 switch…case，並輸出敵人的類型，幫助桃樂絲讀懂錦囊的內容，擊敗壞女巫！', NULL, NULL, ''),
(9, 2, '滅火任務', '壞女巫逃走後，火勢卻沒有熄滅，錫人自告奮用要幫忙滅火，但他忘記他是用油灌澆注的燃燒體，他直接被火燒了好久；請冒險者幫忙錫人滅火，並順勢撲滅錫人身上的火!!', '壞女巫逃走後，火勢仍然肆虐，錫人因為身上充滿油而燒得更加猛烈，這讓他們無法繼續前進。請幫助錫人撲滅火焰，將 while 迴圈改寫為 do…while 迴圈，以確保徹底熄滅火焰並拯救錫人！', NULL, NULL, '');

-- --------------------------------------------------------

--
-- 資料表結構 `sec_parameters`
--

CREATE TABLE `sec_parameters` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `secGameID` bigint(20) UNSIGNED NOT NULL,
  `template_code` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 資料表新增資料前，先清除舊資料 `sec_parameters`
--

TRUNCATE TABLE `sec_parameters`;
--
-- 傾印資料表的資料 `sec_parameters`
--

INSERT INTO `sec_parameters` (`id`, `secGameID`, `template_code`, `created_at`, `updated_at`) VALUES
(1, 1, 'public class StarPatterns {\n    public static void main(String[] args) {\n        System.out.printf(<input type=\"text\" id=\"iInit\" placeholder=\"\" oninput=\"autoResize(this)\">, <input type=\"text\" id=\"iScope\" placeholder=\"\" oninput=\"autoResize(this)\">); // 輸出 \"Password\"\n    }\n}|%s', NULL, NULL),
(2, 2, 'public class StarPatterns {\n    public static void main(String[] args) {\n        int n = $variable; // 階層\n\n        for (<input type=\"text\" id=\"iInit\" placeholder=\"\" oninput=\"autoResize(this)\">;<input type=\"text\" id=\"iScope\" placeholder=\"\" oninput=\"autoResize(this)\">;<input type=\"text\" id=\"iUpdate\" placeholder=\"\" oninput=\"autoResize(this)\">) {\n            for (<input type=\"text\" id=\"jInit\" placeholder=\"\" oninput=\"autoResize(this)\">;<input type=\"text\" id=\"jScope\" placeholder=\"\" oninput=\"autoResize(this)\">;<input type=\"text\" id=\"jUpdate\" placeholder=\"\" oninput=\"autoResize(this)\">) {\n                System.out.print(\"*\");\n            }\n            System.out.println();\n        }\n    }\n}', NULL, NULL),
(3, 2, 'public class StarPatterns {\n    public static void main(String[] args) {\n        int n = $variable; // 階層\n\n        for (<input type=\"text\" id=\"iInit\" placeholder=\"\" oninput=\"autoResize(this)\">;<input type=\"text\" id=\"iScope\" placeholder=\"\" oninput=\"autoResize(this)\">;<input type=\"text\" id=\"iUpdate\" placeholder=\"\" oninput=\"autoResize(this)\">) {\n            for (<input type=\"text\" id=\"jInit\" placeholder=\"\" oninput=\"autoResize(this)\">;<input type=\"text\" id=\"jScope\" placeholder=\"\" oninput=\"autoResize(this)\">;<input type=\"text\" id=\"jUpdate\" placeholder=\"\" oninput=\"autoResize(this)\">) {\n                System.out.print(\"*\");\n            }\n            System.out.println();\n        }\n    }\n}', NULL, NULL),
(4, 2, 'public class StarPatterns {\n    public static void main(String[] args) {\n        int n = $variable; \n\n        for (<input type=\"text\" id=\"iInit\" placeholder=\"\" oninput=\"autoResize(this)\">;<input type=\"text\" id=\"iScope\" placeholder=\"\" oninput=\"autoResize(this)\">;<input type=\"text\" id=\"iUpdate\" placeholder=\"\" oninput=\"autoResize(this)\">) {\n            for (<input type=\"text\" id=\"iInit\" placeholder=\"\" oninput=\"autoResize(this)\">;<input type=\"text\" id=\"iScope\" placeholder=\"\" oninput=\"autoResize(this)\">;<input type=\"text\" id=\"iUpdate\" placeholder=\"\" oninput=\"autoResize(this)\">) {\n                System.out.print(\" \");\n            }\n            for (<input type=\"text\" id=\"iInit\" placeholder=\"\" oninput=\"autoResize(this)\">;<input type=\"text\" id=\"iScope\" placeholder=\"\" oninput=\"autoResize(this)\">;<input type=\"text\" id=\"iUpdate\" placeholder=\"\" oninput=\"autoResize(this)\">) {\n                System.out.print(\"*\");\n            }\n            System.out.println();\n        }\n    }\n}', NULL, NULL),
(5, 2, 'public class StarPatterns {\n    public static void main(String[] args) {\n        int n = $variable; \n\n        for (<input type=\"text\" id=\"iInit\" placeholder=\"\" oninput=\"autoResize(this)\">;<input type=\"text\" id=\"iScope\" placeholder=\"\" oninput=\"autoResize(this)\">;<input type=\"text\" id=\"iUpdate\" placeholder=\"\" oninput=\"autoResize(this)\">) {\n            for (<input type=\"text\" id=\"iInit\" placeholder=\"\" oninput=\"autoResize(this)\">;<input type=\"text\" id=\"iScope\" placeholder=\"\" oninput=\"autoResize(this)\">;<input type=\"text\" id=\"iUpdate\" placeholder=\"\" oninput=\"autoResize(this)\">) {\n                System.out.print(\" \");\n            }\n            for (<input type=\"text\" id=\"iInit\" placeholder=\"\" oninput=\"autoResize(this)\">;<input type=\"text\" id=\"iScope\" placeholder=\"\" oninput=\"autoResize(this)\">;<input type=\"text\" id=\"iUpdate\" placeholder=\"\" oninput=\"autoResize(this)\">) {\n                System.out.print(\"*\");\n            }\n            System.out.println();\n        }\n    }\n}', NULL, NULL),
(6, 3, 'public class StarPatterns {\n    public static void main(String[] args) {\n        int n = $variable; // 今日進城人數\n\n        for(<input type=\"text\" id=\"iInit\" placeholder=\"\" oninput=\"autoResize(this)\">; <input type=\"text\" id=\"iInit\" placeholder=\"\" oninput=\"autoResize(this)\">; <input type=\"text\" id=\"addInit\" placeholder=\"\" oninput=\"autoResize(this)\">){\n\n            // 判斷是否為怪物\n            if (x == <input type=\"text\" id=\"monstarInit\" placeholder=\"\" oninput=\"autoResize(this)\">) {\n                <input type=\"text\" id=\"noInit\" placeholder=\"\" oninput=\"autoResize(this)\"> // 印出禁止進入\n            }\n\n            else {\n                <input type=\"text\" id=\"freeInit\" placeholder=\"\" oninput=\"autoResize(this)\"> // 印出免費進入\n            }\n        }\n    }\n}', NULL, NULL),
(7, 4, 'public class Main {\n    public static void main(String[] args) {\n        int material1 = $variable1;\n        int material2 = $variable2;\n\n        // 判斷治癒藥水的配方條件\n        if (<input type=\"text\" id=\"iInit\" placeholder=\"\" oninput=\"autoResize(this)\">;) {\n            System.out.println(\"治癒藥水的配方條件成立。\");\n        }\n    }\n}|材料一 (material1) 需大於等於 20 且小於 50，並且材料二 (material2) 小於 30。', NULL, NULL),
(8, 5, 'public class Main {\n    public static void main(String[] args) {\n        int n = $variable1;\n        int a = $variable2;\n\n        for(int i = $variable3;<input type=\"text\" id=\"iInit\" placeholder=\"\" oninput=\"autoResize(this)\">;<input type=\"text\" id=\"iInit\" placeholder=\"\" oninput=\"autoResize(this)\">) {\n            boolean isPrime = true; // 假設 i 是質數\n\n            for(<input type=\"text\" id=\"iInit\" placeholder=\"\" oninput=\"autoResize(this)\">; <input type=\"text\" id=\"iInit\" placeholder=\"\" oninput=\"autoResize(this)\">; <input type=\"text\" id=\"iInit\" placeholder=\"\" oninput=\"autoResize(this)\">)\n            {\n                if(<input type=\"text\" id=\"iInit\" placeholder=\"\" oninput=\"autoResize(this)\">)\n                {\n                    // 如果可以被整除，i 不是質數\n                    isPrime = false;\n                    break; // 不需要繼續檢查\n                }\n            }\n            // 如果是質數並且小於 a，則印出\n            if(<input type=\"text\" id=\"iInit\" placeholder=\"\" oninput=\"autoResize(this)\">) {\n                System.out.printf(\"%d\\t\", i);\n            }\n        }\n    }\n}', NULL, NULL),
(9, 4, 'public class Main {\n    public static void main(String[] args) {\n        int material1 = $variable1;\n        int material2 = $variable2;\n\n        // 判斷治癒藥水的配方條件\n        if (<input type=\"text\" id=\"iInit\" placeholder=\"\" oninput=\"autoResize(this)\">;) {\n            System.out.println(\"治癒藥水的配方條件成立。\");\n        }\n    }\n}|材料一 (material1) 大於 10 且小於等於 40，或者材料二 (material2) 大於 20。', NULL, NULL),
(10, 4, 'public class Main {\n    public static void main(String[] args) {\n        int material1 = $variable1;\n        int material2 = $variable2;\n\n        // 判斷治癒藥水的配方條件\n        if (<input type=\"text\" id=\"iInit\" placeholder=\"\" oninput=\"autoResize(this)\">;) {\n            System.out.println(\"治癒藥水的配方條件成立。\");\n        }\n    }\n}|材料一 (material1) 小於 40。', NULL, NULL),
(11, 4, 'public class Main {\n    public static void main(String[] args) {\n        int material1 = $variable1;\n        int material2 = $variable2;\n\n        // 判斷治癒藥水的配方條件\n        if (<input type=\"text\" id=\"iInit\" placeholder=\"\" oninput=\"autoResize(this)\">;) {\n            System.out.println(\"治癒藥水的配方條件成立。\");\n        }\n    }\n}|配方表(條件變數)：材料二 (material2) 大於 10 且小於等於 40。', NULL, NULL),
(12, 6, '<pre>\r\npublic class Main {\r\n    public static void main(String[] args) {\r\n        int number = $variable;\r\n        int result = 0;    // 儲存解碼後的結果\r\n\r\n        // 提取個位數字\r\n        int digit = <input type=\"text\" id=\"iInit\" placeholder=\"\" oninput=\"autoResize(this)\">;  // 提取個位數字\r\n\r\n        // 根據個位數字進行解碼\r\n        if (<input type=\"text\" id=\"iInit\" placeholder=\"\" oninput=\"autoResize(this)\">) {\r\n            result = <input type=\"text\" id=\"iInit\" placeholder=\"\" oninput=\"autoResize(this)\">;\r\n        } else {\r\n            result = <input type=\"text\" id=\"iInit\" placeholder=\"\" oninput=\"autoResize(this)\">;\r\n        }\r\n\r\n        // 輸出解碼後的結果\r\n        System.out.println(\"個位數字解碼後的結果是: \" + result);\r\n    }\r\n}\r\n</pre>|個位數\r\n', NULL, NULL),
(13, 7, '<pre>\npublic class Main {\n    public static void main(String[] args) {\n        int tower = $variable;\n        int totalOil = 1;\n\n        System.out.println(\"層數: \" + tower);\n\n        // 計算油塔的油罐\n        int floor = 1; // 初始化當前樓層數\n        while (<input type=\"text\" id=\"iInit\" placeholder=\"\" oninput=\"autoResize(this)\">;) {\n            // 每層有不同的油罐公式 (條件變數)\n            if (<input type=\"text\" id=\"iInit\" placeholder=\"\" oninput=\"autoResize(this)\">;) {\n                totalOil -= 2;  // 奇數層減少2罐油罐\n            } else {\n                totalOil *= 2;  // 偶數層雙倍油罐\n            }\n            <input type=\"text\" id=\"iInit\" placeholder=\"\" oninput=\"autoResize(this)\">;\n        }\n\n        System.out.println(\"油塔油量: \" + totalOil);\n    }\n}\n</pre>', NULL, NULL),
(14, 8, '<pre>\npublic class Main {\n    public static void main(String[] args) {\n        // 假設敵人類型和來自題目說明(變數)\n        int enemyType = \"$variable\";\n\n        // 根據敵人類型選擇攻擊狀態\n        switch (<input type=\"text\" id=\"iInit\" placeholder=\"\" oninput=\"autoResize(this)\">) {\n            case \"<input type=\"text\" id=\"iInit\" placeholder=\"\" oninput=\"autoResize(this)\">\":\n                <input type=\"text\" id=\"iInit\" placeholder=\"\" oninput=\"autoResize(this)\">;\n                break;\n            case \"<input type=\"text\" id=\"iInit\" placeholder=\"\" oninput=\"autoResize(this)\">\":\n                <input type=\"text\" id=\"iInit\" placeholder=\"\" oninput=\"autoResize(this)\">;\n                break;\n            case \"<input type=\"text\" id=\"iInit\" placeholder=\"\" oninput=\"autoResize(this)\">\":\n                <input type=\"text\" id=\"iInit\" placeholder=\"\" oninput=\"autoResize(this)\">;\n                break;\n            default:\n                <input type=\"text\" id=\"iInit\" placeholder=\"\" oninput=\"autoResize(this)\">;\n                break;\n        }\n        System.out.println(\"你的敵人為：\" + enemyType);\n    }\n}\n</pre>\n|魔女', NULL, NULL);

-- --------------------------------------------------------

--
-- 資料表結構 `sec_records`
--

CREATE TABLE `sec_records` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `secParameterID` bigint(20) UNSIGNED NOT NULL,
  `time` time NOT NULL DEFAULT '00:00:00',
  `parameter` varchar(10000) NOT NULL,
  `status` enum('watched','false','true','watch_again') NOT NULL DEFAULT 'watched',
  `counter` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_answer` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 資料表新增資料前，先清除舊資料 `sec_records`
--

TRUNCATE TABLE `sec_records`;
--
-- 傾印資料表的資料 `sec_records`
--

INSERT INTO `sec_records` (`id`, `user_id`, `secParameterID`, `time`, `parameter`, `status`, `counter`, `created_at`, `updated_at`, `user_answer`) VALUES
(101, 1, 3, '00:00:00', '{\"variable\":5}', 'watched', 11, '2024-10-06 14:27:23', '2024-10-13 08:28:16', NULL),
(102, 1, 3, '00:00:00', '{\"variable\":5}', 'true', 2, '2024-10-06 14:27:23', '2024-10-06 14:29:32', '[{\"order\":1,\"userAnswer\":\"int i = n\"},{\"order\":2,\"userAnswer\":\"i >= 1\"},{\"order\":3,\"userAnswer\":\"i--\"},{\"order\":4,\"userAnswer\":\"int j =1\"},{\"order\":5,\"userAnswer\":\"j <= 2 * i - 1\"},{\"order\":6,\"userAnswer\":\"j++\"}]'),
(103, 1, 3, '00:00:00', '{\"variable\":5}', 'false', 0, '2024-10-06 14:27:23', '2024-10-06 14:27:23', NULL),
(104, 1, 3, '00:00:00', '{\"variable\":5}', 'watch_again', 0, '2024-10-06 14:27:23', '2024-10-06 14:27:23', NULL),
(105, 1, 6, '00:00:00', '{\"variable\":5,\"idCardsData\":[{\"gender\":\"\\u7537\",\"identity\":\"\\u5546\\u4eba\",\"age\":45},{\"gender\":\"\\u7537\",\"identity\":\"\\u602a\\u7269\",\"age\":31},{\"gender\":\"\\u5973\",\"identity\":\"\\u602a\\u7269\",\"age\":45},{\"gender\":\"\\u5973\",\"identity\":\"\\u5546\\u4eba\",\"age\":33},{\"gender\":\"\\u7537\",\"identity\":\"\\u602a\\u7269\",\"age\":20}]}', 'watched', 1, '2024-10-06 14:27:27', '2024-10-06 14:27:27', NULL),
(106, 1, 6, '00:00:00', '{\"variable\":5,\"idCardsData\":[{\"gender\":\"\\u7537\",\"identity\":\"\\u5546\\u4eba\",\"age\":45},{\"gender\":\"\\u7537\",\"identity\":\"\\u602a\\u7269\",\"age\":31},{\"gender\":\"\\u5973\",\"identity\":\"\\u602a\\u7269\",\"age\":45},{\"gender\":\"\\u5973\",\"identity\":\"\\u5546\\u4eba\",\"age\":33},{\"gender\":\"\\u7537\",\"identity\":\"\\u602a\\u7269\",\"age\":20}]}', 'true', 0, '2024-10-06 14:27:27', '2024-10-06 14:27:27', NULL),
(107, 1, 6, '00:00:00', '{\"variable\":5,\"idCardsData\":[{\"gender\":\"\\u7537\",\"identity\":\"\\u5546\\u4eba\",\"age\":45},{\"gender\":\"\\u7537\",\"identity\":\"\\u602a\\u7269\",\"age\":31},{\"gender\":\"\\u5973\",\"identity\":\"\\u602a\\u7269\",\"age\":45},{\"gender\":\"\\u5973\",\"identity\":\"\\u5546\\u4eba\",\"age\":33},{\"gender\":\"\\u7537\",\"identity\":\"\\u602a\\u7269\",\"age\":20}]}', 'false', 0, '2024-10-06 14:27:27', '2024-10-06 14:27:27', NULL),
(108, 1, 6, '00:00:00', '{\"variable\":5,\"idCardsData\":[{\"gender\":\"\\u7537\",\"identity\":\"\\u5546\\u4eba\",\"age\":45},{\"gender\":\"\\u7537\",\"identity\":\"\\u602a\\u7269\",\"age\":31},{\"gender\":\"\\u5973\",\"identity\":\"\\u602a\\u7269\",\"age\":45},{\"gender\":\"\\u5973\",\"identity\":\"\\u5546\\u4eba\",\"age\":33},{\"gender\":\"\\u7537\",\"identity\":\"\\u602a\\u7269\",\"age\":20}]}', 'watch_again', 0, '2024-10-06 14:27:27', '2024-10-06 14:27:27', NULL),
(117, 1, 8, '00:00:00', '{\"variable\":\"90,61\"}', 'watched', 1, '2024-10-06 14:27:41', '2024-10-06 14:27:41', NULL),
(118, 1, 8, '00:00:00', '{\"variable\":\"90,61\"}', 'true', 0, '2024-10-06 14:27:41', '2024-10-06 14:27:41', NULL),
(119, 1, 8, '00:00:00', '{\"variable\":\"90,61\"}', 'false', 0, '2024-10-06 14:27:41', '2024-10-06 14:27:41', NULL),
(120, 1, 8, '00:00:00', '{\"variable\":\"90,61\"}', 'watch_again', 0, '2024-10-06 14:27:41', '2024-10-06 14:27:41', NULL),
(157, 1, 1, '00:00:00', '{\"variable\":\"hvkCKeajtHEsDQ74rFtEIoRFWiRf9Gco5HHmUI4c6eTZr4qn\"}', 'watched', 1, '2024-10-19 04:42:18', '2024-10-19 04:42:18', NULL),
(158, 1, 1, '00:00:00', '{\"variable\":\"hvkCKeajtHEsDQ74rFtEIoRFWiRf9Gco5HHmUI4c6eTZr4qn\"}', 'true', 0, '2024-10-19 04:42:18', '2024-10-19 04:42:18', NULL),
(159, 1, 1, '00:00:00', '{\"variable\":\"hvkCKeajtHEsDQ74rFtEIoRFWiRf9Gco5HHmUI4c6eTZr4qn\"}', 'false', 0, '2024-10-19 04:42:18', '2024-10-19 04:42:18', NULL),
(160, 1, 1, '00:00:00', '{\"variable\":\"hvkCKeajtHEsDQ74rFtEIoRFWiRf9Gco5HHmUI4c6eTZr4qn\"}', 'watch_again', 0, '2024-10-19 04:42:18', '2024-10-19 04:42:18', NULL);

-- --------------------------------------------------------

--
-- 資料表結構 `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 資料表新增資料前，先清除舊資料 `sessions`
--

TRUNCATE TABLE `sessions`;
--
-- 傾印資料表的資料 `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('gBWZsP7rwXtfW9DTwKr8QMHkKjxx1aWDnxKSSwnW', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiN2xVRndwNWx2VkNTcFlNbm1GNldvMVdRaDdWdk9FSXJjWlNORUl6cyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjQ5OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAva25vd2xlZGdlY2FyZC8yP2NhcmRfdHlwZT0xIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjIxOiJwYXNzd29yZF9oYXNoX3NhbmN0dW0iO3M6NjA6IiQyeSQxMiRBQ09rUVVzNHlOVzJHOUNhS0JxMEN1SlN2OHFEZmt4OVRNM2JERHo2UjNCdk53VFNaN3hXUyI7fQ==', 1728848349),
('gCZJJWiH9MLMp9VIWWIZ04ooKEPyt7jkz5g15Dvh', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiODRoeUdIZmRWcm1LVnI2Wlg2eWhZUU9nSUEzR0FZdzk1UHR2MGNGaCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9jb3VudHJ5LzIvc2VjR2FtZUlELzEiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjM6InVybCI7YTowOnt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjIxOiJwYXNzd29yZF9oYXNoX3NhbmN0dW0iO3M6NjA6IiQyeSQxMiRBQ09rUVVzNHlOVzJHOUNhS0JxMEN1SlN2OHFEZmt4OVRNM2JERHo2UjNCdk53VFNaN3hXUyI7fQ==', 1729341759);

-- --------------------------------------------------------

--
-- 資料表結構 `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `two_factor_secret` text DEFAULT NULL,
  `two_factor_recovery_codes` text DEFAULT NULL,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `gender` enum('male','female','other') DEFAULT NULL,
  `country_id` bigint(20) UNSIGNED DEFAULT NULL,
  `levels` int(11) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `current_team_id` bigint(20) UNSIGNED DEFAULT NULL,
  `profile_photo_path` varchar(2048) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 資料表新增資料前，先清除舊資料 `users`
--

TRUNCATE TABLE `users`;
--
-- 傾印資料表的資料 `users`
--

INSERT INTO `users` (`id`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `name`, `gender`, `country_id`, `levels`, `remember_token`, `current_team_id`, `profile_photo_path`, `created_at`, `updated_at`) VALUES
(1, 'tom98075@gmail.com', NULL, '$2y$12$ACOkQUs4yNW2G9CaKBq0CuJSv8qDfkx9TM3bDDz6R3BvNwTSZ7xWS', NULL, NULL, NULL, 'TomChen', 'male', 2, 0, 'FDJD2aiUUOizg7e4vFi7Fpi7KYhmItzIAND5qxcNpioCW7tZFPEaEk60oTYO', NULL, NULL, '2024-05-24 08:58:24', '2024-09-29 04:42:20'),
(2, '98075tom@gmail.com', NULL, '$2y$12$c4YO1MheSVZsNTBuMlxQGe82DlBol5Guai5q4pDW4TKDUv8AIKaNS', NULL, NULL, NULL, 'tomchen', 'male', 1, 1, NULL, NULL, NULL, '2024-06-10 10:42:30', '2024-06-10 10:42:38'),
(3, 'caveira159951@gmail.vom', NULL, '$2y$12$/KupiQsUJHg2NDMNarAKxep8HXi34eQNwTH/hk3D2QUv4sdChqIY.', NULL, NULL, NULL, '哈哈', 'male', 1, 1, NULL, NULL, NULL, '2024-06-10 16:23:01', '2024-06-10 16:23:02'),
(4, '123@gmail.com', NULL, '$2y$12$b7TG/lPPpycIJjDAvv2VueqITkCUx/eJLg4BmYk9CfEX69o2dABsq', NULL, NULL, NULL, '123', 'male', 1, 1, NULL, NULL, NULL, '2024-06-24 05:06:20', '2024-06-24 05:06:20'),
(5, '456@gmail.com', NULL, '$2y$12$B11NDeovLx/sXBPxlMJVrO051xpbmPOYFPcMKhgQYasTMn0eDI2Ra', NULL, NULL, NULL, '456', 'male', 1, 1, NULL, NULL, NULL, '2024-06-30 11:52:43', '2024-06-30 11:52:43'),
(13, 'panz7354@gmail.com', NULL, '$2y$12$LYGEW8/E3JOrQ12utqkqLOkhzDOQ960skXj7I6ndU2m6xcZMy5KEG', NULL, NULL, NULL, 'panz', 'female', 2, 8, NULL, NULL, NULL, '2024-08-16 23:07:57', '2024-08-17 00:29:32');

-- --------------------------------------------------------

--
-- 資料表結構 `user_knowledge_cards`
--

CREATE TABLE `user_knowledge_cards` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `knowledge_card_id` bigint(20) UNSIGNED DEFAULT NULL,
  `watchtime` time NOT NULL DEFAULT '00:00:00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 資料表新增資料前，先清除舊資料 `user_knowledge_cards`
--

TRUNCATE TABLE `user_knowledge_cards`;
--
-- 傾印資料表的資料 `user_knowledge_cards`
--

INSERT INTO `user_knowledge_cards` (`id`, `user_id`, `knowledge_card_id`, `watchtime`, `created_at`, `updated_at`) VALUES
(12, 13, 6, '00:00:00', '2024-08-16 23:10:22', '2024-08-16 23:10:22'),
(13, 13, 7, '00:00:00', '2024-08-16 23:10:22', '2024-08-16 23:10:22'),
(14, 13, 8, '00:00:00', '2024-08-16 23:10:22', '2024-08-16 23:10:22'),
(15, 13, 9, '00:00:00', '2024-08-16 23:10:22', '2024-08-16 23:10:22'),
(16, 13, 10, '00:00:00', '2024-08-16 23:10:22', '2024-08-16 23:10:22'),
(17, 13, 11, '00:00:00', '2024-08-16 23:10:22', '2024-08-16 23:10:22'),
(18, 13, 12, '00:00:00', '2024-08-16 23:10:22', '2024-08-16 23:10:22'),
(19, 13, 13, '00:00:00', '2024-08-16 23:10:22', '2024-08-16 23:10:22'),
(20, 13, 14, '00:00:00', '2024-08-16 23:10:22', '2024-08-16 23:10:22'),
(21, 13, 15, '00:00:00', '2024-08-16 23:10:22', '2024-08-16 23:10:22'),
(22, 13, 22, '00:00:00', '2024-08-16 23:10:22', '2024-08-16 23:10:22'),
(23, 1, 25, '00:00:00', '2024-09-15 10:47:58', '2024-09-15 10:47:58');

-- --------------------------------------------------------

--
-- 資料表結構 `user_records`
--

CREATE TABLE `user_records` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `question_id` bigint(20) UNSIGNED DEFAULT NULL,
  `watchtime` time NOT NULL DEFAULT '00:00:00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 資料表新增資料前，先清除舊資料 `user_records`
--

TRUNCATE TABLE `user_records`;
--
-- 傾印資料表的資料 `user_records`
--

INSERT INTO `user_records` (`id`, `user_id`, `question_id`, `watchtime`, `created_at`, `updated_at`, `status`) VALUES
(29, 1, 4, '00:00:01', '2024-06-10 05:19:26', '2024-07-17 19:46:49', 1),
(30, 1, 5, '00:00:01', '2024-06-10 05:19:40', '2024-06-30 18:10:48', 1),
(31, 1, 1, '00:00:06', '2024-06-10 05:20:21', '2024-07-17 19:47:08', 1),
(32, 1, 2, '00:00:03', '2024-06-10 05:20:33', '2024-06-10 05:20:33', 1),
(33, 1, 3, '00:00:08', '2024-06-10 05:20:45', '2024-07-17 19:47:17', 1),
(34, 1, 7, '00:00:01', '2024-06-10 05:33:30', '2024-06-10 05:33:30', 1),
(35, 1, 14, '00:00:05', '2024-07-17 19:46:58', '2024-07-17 19:46:58', 1),
(36, 1, 11, '00:00:10', '2024-07-17 19:47:01', '2024-07-17 19:47:29', 1),
(37, 1, 12, '00:00:10', '2024-07-17 19:47:02', '2024-07-17 19:47:29', 1),
(38, 1, 15, '00:00:10', '2024-07-17 19:47:03', '2024-07-17 19:47:03', 1),
(39, 1, 10, '00:00:06', '2024-07-17 19:47:25', '2024-07-17 19:47:25', 1),
(40, 1, 13, '00:00:07', '2024-07-17 19:47:26', '2024-07-17 19:47:26', 1),
(41, 12, 15, '00:00:04', '2024-08-12 21:19:38', '2024-08-12 21:19:38', 1),
(42, 12, 12, '00:00:07', '2024-08-12 21:19:42', '2024-08-12 21:19:42', 1),
(43, 12, 11, '00:00:12', '2024-08-12 21:21:25', '2024-08-12 21:21:25', 1),
(44, 12, 13, '00:00:13', '2024-08-12 21:21:26', '2024-08-12 21:21:26', 1),
(45, 12, 14, '00:00:14', '2024-08-12 21:21:28', '2024-08-12 21:21:28', 1),
(46, 12, 10, '00:00:15', '2024-08-12 21:21:29', '2024-08-12 21:21:29', 1),
(47, 12, 7, '00:00:04', '2024-08-12 21:21:35', '2024-08-12 21:21:35', 1),
(48, 12, 2, '00:00:02', '2024-08-12 21:21:40', '2024-08-12 21:21:40', 1),
(49, 12, 123, '00:00:03', '2024-08-12 21:21:49', '2024-08-12 21:21:49', 1),
(50, 13, 4, '00:00:03', '2024-08-16 23:08:23', '2024-08-16 23:08:23', 1),
(51, 13, 11, '00:00:09', '2024-08-16 23:08:35', '2024-08-16 23:08:35', 1),
(52, 13, 14, '00:00:10', '2024-08-16 23:08:37', '2024-08-16 23:08:37', 1),
(53, 13, 10, '00:00:06', '2024-08-16 23:08:38', '2024-08-16 23:09:55', 1),
(54, 13, 12, '00:00:07', '2024-08-16 23:08:40', '2024-08-16 23:09:56', 1),
(55, 13, 2, '00:00:42', '2024-08-16 23:09:30', '2024-08-16 23:09:31', 1),
(56, 13, 122, '00:00:08', '2024-08-16 23:09:41', '2024-08-16 23:09:41', 1),
(57, 13, 5, '00:00:04', '2024-08-16 23:09:46', '2024-08-16 23:09:46', 1),
(58, 13, 15, '00:00:02', '2024-08-16 23:09:50', '2024-08-16 23:09:50', 1),
(59, 13, 13, '00:00:05', '2024-08-16 23:09:52', '2024-08-16 23:09:54', 1),
(60, 13, 123, '00:00:04', '2024-08-16 23:10:01', '2024-08-16 23:10:01', 1),
(61, 13, 6, '00:00:06', '2024-08-16 23:10:14', '2024-08-16 23:10:14', 1),
(62, 13, 3, '00:00:25', '2024-08-16 23:10:50', '2024-08-16 23:10:50', 0),
(63, 13, 1, '00:00:02', '2024-08-16 23:10:55', '2024-08-16 23:10:55', 1),
(64, 13, 119, '00:00:07', '2024-08-16 23:11:04', '2024-08-16 23:11:04', 1),
(65, 13, 118, '00:00:04', '2024-08-16 23:11:10', '2024-08-16 23:11:10', 1),
(66, 13, 70, '00:00:04', '2024-08-16 23:11:26', '2024-08-16 23:11:26', 1),
(67, 13, 94, '00:00:14', '2024-08-16 23:11:43', '2024-08-16 23:15:45', 1),
(68, 13, 107, '00:00:06', '2024-08-16 23:11:52', '2024-08-16 23:11:52', 1),
(69, 13, 77, '00:00:08', '2024-08-16 23:12:00', '2024-08-16 23:15:33', 1),
(70, 13, 76, '00:00:11', '2024-08-16 23:12:04', '2024-08-16 23:12:04', 1),
(71, 13, 79, '00:00:06', '2024-08-16 23:12:07', '2024-08-16 23:15:31', 1),
(72, 13, 78, '00:00:09', '2024-08-16 23:12:08', '2024-08-16 23:15:34', 1),
(73, 13, 71, '00:00:04', '2024-08-16 23:12:14', '2024-08-16 23:12:35', 0),
(74, 13, 80, '00:00:04', '2024-08-16 23:12:21', '2024-08-16 23:15:29', 1),
(75, 13, 67, '00:01:14', '2024-08-16 23:14:06', '2024-08-16 23:14:06', 1),
(76, 13, 69, '00:00:05', '2024-08-16 23:15:22', '2024-08-16 23:15:22', 1),
(77, 13, 108, '00:00:12', '2024-08-16 23:16:00', '2024-08-16 23:16:00', 1),
(78, 13, 74, '00:00:04', '2024-08-16 23:16:16', '2024-08-16 23:16:16', 1),
(79, 13, 86, '00:00:02', '2024-08-16 23:16:23', '2024-08-16 23:16:23', 1),
(80, 13, 85, '00:00:03', '2024-08-16 23:16:24', '2024-08-16 23:16:24', 1),
(81, 13, 82, '00:00:04', '2024-08-16 23:16:24', '2024-08-16 23:16:24', 1),
(82, 13, 83, '00:00:04', '2024-08-16 23:16:25', '2024-08-16 23:16:25', 1),
(83, 13, 101, '00:00:06', '2024-08-16 23:16:35', '2024-08-16 23:16:35', 1),
(84, 13, 117, '00:00:53', '2024-08-16 23:17:32', '2024-08-16 23:17:32', 1);

-- --------------------------------------------------------

--
-- 資料表結構 `user_record_details`
--

CREATE TABLE `user_record_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_record_id` bigint(20) UNSIGNED NOT NULL,
  `knowledge_card_id` bigint(20) UNSIGNED NOT NULL,
  `card_watchtime` time NOT NULL DEFAULT '00:00:00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 資料表新增資料前，先清除舊資料 `user_record_details`
--

TRUNCATE TABLE `user_record_details`;
--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- 資料表索引 `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- 資料表索引 `card_types`
--
ALTER TABLE `card_types`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `debugs`
--
ALTER TABLE `debugs`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `debug_records`
--
ALTER TABLE `debug_records`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `dramas`
--
ALTER TABLE `dramas`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- 資料表索引 `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- 資料表索引 `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `knowledge_cards`
--
ALTER TABLE `knowledge_cards`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `match_options`
--
ALTER TABLE `match_options`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- 資料表索引 `pass_course_get_cards`
--
ALTER TABLE `pass_course_get_cards`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `pass_course_need_cards`
--
ALTER TABLE `pass_course_need_cards`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- 資料表索引 `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `questions_cards`
--
ALTER TABLE `questions_cards`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `question_status`
--
ALTER TABLE `question_status`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `reorganization_option`
--
ALTER TABLE `reorganization_option`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `sec_answers`
--
ALTER TABLE `sec_answers`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `sec_games`
--
ALTER TABLE `sec_games`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `sec_parameters`
--
ALTER TABLE `sec_parameters`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `sec_records`
--
ALTER TABLE `sec_records`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- 資料表索引 `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- 資料表索引 `user_knowledge_cards`
--
ALTER TABLE `user_knowledge_cards`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `user_records`
--
ALTER TABLE `user_records`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `user_record_details`
--
ALTER TABLE `user_record_details`
  ADD PRIMARY KEY (`id`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `card_types`
--
ALTER TABLE `card_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `countries`
--
ALTER TABLE `countries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `debugs`
--
ALTER TABLE `debugs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `debug_records`
--
ALTER TABLE `debug_records`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `dramas`
--
ALTER TABLE `dramas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `knowledge_cards`
--
ALTER TABLE `knowledge_cards`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `match_options`
--
ALTER TABLE `match_options`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `options`
--
ALTER TABLE `options`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=172;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `pass_course_get_cards`
--
ALTER TABLE `pass_course_get_cards`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `pass_course_need_cards`
--
ALTER TABLE `pass_course_need_cards`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `questions`
--
ALTER TABLE `questions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `questions_cards`
--
ALTER TABLE `questions_cards`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=130;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `question_status`
--
ALTER TABLE `question_status`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `reorganization_option`
--
ALTER TABLE `reorganization_option`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `sec_answers`
--
ALTER TABLE `sec_answers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `sec_games`
--
ALTER TABLE `sec_games`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `sec_parameters`
--
ALTER TABLE `sec_parameters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `sec_records`
--
ALTER TABLE `sec_records`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=161;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `user_knowledge_cards`
--
ALTER TABLE `user_knowledge_cards`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `user_records`
--
ALTER TABLE `user_records`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `user_record_details`
--
ALTER TABLE `user_record_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
