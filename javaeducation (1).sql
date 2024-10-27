-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2024-10-27 16:12:02
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
(5, 2, 0, '迴圈控制', NULL, NULL, ''),
(6, 3, 0, '陣列', NULL, NULL, ''),
(7, 3, 0, '字串', NULL, NULL, '');

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
(35, 2, 25, '桃樂絲：錫人，真是太感謝你了。你救了我們。', 'tls', NULL, NULL),
(36, 3, 1, '旁白：在陰森的森林裡，桃樂絲和朋友們突然被一隻膽小的獅子攻擊。', 'narration', NULL, NULL),
(37, 3, 2, '桃樂絲：住手！我們不是來找麻煩的！', 'tls', NULL, NULL),
(38, 3, 3, '獅子：（哭泣）我只想當萬獸之王，但我卻是一隻膽小的獅子！', 'lion', NULL, NULL),
(39, 3, 4, '稻草人：跟我們一起去找歐茲法師吧，他能幫你實現願望！', 'scarecrow', NULL, NULL),
(40, 3, 5, '獅子：真的嗎？我能和你們一起去嗎？', 'lion', NULL, NULL),
(41, 3, 6, '桃樂絲：當然！一起面對困難！', 'tls', NULL, NULL),
(42, 3, 7, '旁白：走著走著桃樂絲和夥伴們在陰暗的森林中，遇到了一條巨大的壕溝。', 'narration', NULL, NULL),
(43, 3, 8, '桃樂絲：我們該怎麼過去？', 'tls', NULL, NULL),
(44, 3, 9, '稻草人：獅子可以一個個背我們跳過去！', 'scarecrow', NULL, NULL),
(45, 3, 10, '獅子：好，我會試試看！', 'lion', NULL, NULL),
(46, 3, 11, '旁白：獅子蹲下，稻草人爬上他的背，獅子跳過壕溝。', 'narration', NULL, NULL),
(47, 3, 12, '獅子：我做到了！快來，大家都上來！', 'lion', NULL, NULL),
(48, 3, 13, '旁白：通過壕溝後，他們越來越深入陰暗森林，獅子警告大家小心。', 'narration', NULL, NULL),
(49, 3, 14, '獅子：這裡是卡力達的地盤，他可不好惹！', 'lion', NULL, NULL),
(50, 3, 15, '旁白：當他們走到大峽谷時，獅子無法再跳過去。', 'narration', NULL, NULL),
(51, 3, 16, '稻草人：我們可以砍樹搭一座橋！', 'scarecrow', NULL, NULL),
(52, 3, 17, '旁白：突然，卡力達從樹林中衝出。', 'narration', NULL, NULL),
(53, 3, 18, '卡力達：誰敢闖入我的領地？', 'monster', NULL, NULL),
(54, 3, 19, '稻草人：快過橋！不然就來不及了！', 'scarecrow', NULL, NULL),
(55, 3, 20, '旁白：獅子面對卡力達，突然吼叫。', 'narration', NULL, NULL),
(56, 3, 21, '獅子：走開！我不怕你！', 'lion', NULL, NULL),
(57, 3, 22, '旁白：獅子的吼聲震撼了森林，卡力達被嚇住，獅子迅速過了橋。', 'narration', NULL, NULL),
(58, 3, 23, '稻草人：快，砍斷橋！', 'scarecrow', NULL, NULL),
(59, 3, 24, '旁白：轟隆一聲巨響，卡力達掉進了深溝。', 'narration', NULL, NULL);

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
(31, 2, 'break', 'break', NULL, NULL, 5),
(32, 3, 'Arrays.sort()', 'Arrays.sort()', NULL, NULL, 6),
(33, 3, 'for(type 元素: arrayName) 陣列的for-Each', 'for(type 元素: arrayName) 陣列的for-Each', NULL, NULL, 6),
(34, 3, 'Arrays.fills()', 'Arrays.fills()', NULL, NULL, 6),
(35, 3, 'Arrays.equals()', 'Arrays.equals()', NULL, NULL, 6),
(36, 3, 'Arrays.binarySearch()', 'Arrays.binarySearch()', NULL, NULL, 6),
(37, 3, 'ArrayList.forEach()', 'ArrayList.forEach()', NULL, NULL, 6),
(38, 3, 'ArrayList.add()', 'ArrayList.add()', NULL, NULL, 6),
(39, 3, 'ArrayList.remove()', 'ArrayList.remove()', NULL, NULL, 6),
(40, 3, 'ArrayList.removeAll()', 'ArrayList.removeAll()', NULL, NULL, 6),
(41, 3, 'ArrayList.get()', 'ArrayList.get()', NULL, NULL, 6),
(42, 3, 'ArrayList.size()', 'ArrayList.size()', NULL, NULL, 6),
(43, 3, 'ArrayList.indexOf()', 'ArrayList.indexOf()', NULL, NULL, 6),
(44, 3, 'ArrayList.isEmpty()', 'ArrayList.isEmpty()', NULL, NULL, 6),
(45, 3, 'ArrayList.toArray()', 'ArrayList.toArray()', NULL, NULL, 6),
(46, 3, 'ArrayList.contains()', 'ArrayList.contains()', NULL, NULL, 6),
(47, 3, 'StringName.length()', 'StringName.length()', NULL, NULL, 7),
(48, 3, 'StringName.charAt()', 'StringName.charAt()', NULL, NULL, 7),
(49, 3, 'StringName.toLowerCase()', 'StringName.toLowerCase()', NULL, NULL, 7),
(50, 3, 'StringName.toUpperCase()', 'StringName.toUpperCase()', NULL, NULL, 7),
(51, 3, 'StringName.substring()', 'StringName.substring()', NULL, NULL, 7),
(52, 3, 'StringName.compareTo()', 'StringName.compareTo()', NULL, NULL, 7),
(53, 3, 'StringName.replace()', 'StringName.replace()', NULL, NULL, 7),
(54, 3, 'StringName.split()', 'StringName.split()', NULL, NULL, 7);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
