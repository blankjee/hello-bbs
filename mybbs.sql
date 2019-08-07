-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 2019-05-13 08:19:19
-- 服务器版本： 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mybbs`
--

-- --------------------------------------------------------

--
-- 表的结构 `forum_area`
--

CREATE TABLE `forum_area` (
  `id` int(20) UNSIGNED NOT NULL COMMENT 'ID',
  `name` varchar(50) NOT NULL,
  `description` varchar(500) NOT NULL,
  `icon` varchar(20) NOT NULL,
  `color` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=gbk COMMENT='各个板块的信息';

--
-- 转存表中的数据 `forum_area`
--

INSERT INTO `forum_area` (`id`, `name`, `description`, `icon`, `color`) VALUES
(1, '校园生活', '在这里，您可以对您的校园生活畅所欲言！', 'comments-o', 'link'),
(2, '学术交流', '尽情交流你们的学术问题吧！', 'book', 'success'),
(3, '休闲娱乐', '放松一下吧！', 'users', 'warning'),
(4, '二手交易', '提供二手物品信息', 'support', 'danger');

-- --------------------------------------------------------

--
-- 表的结构 `forum_ip`
--

CREATE TABLE `forum_ip` (
  `id` int(10) UNSIGNED NOT NULL COMMENT '记录ID',
  `topicId` int(10) DEFAULT NULL,
  `ip` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `forum_ip`
--

INSERT INTO `forum_ip` (`id`, `topicId`, `ip`) VALUES
(46, 2, '::1'),
(47, 43, '::1'),
(48, 4, '::1'),
(49, 49, '::1'),
(50, 50, '::1');

-- --------------------------------------------------------

--
-- 表的结构 `forum_reply`
--

CREATE TABLE `forum_reply` (
  `id` int(10) NOT NULL,
  `topic_id` int(10) NOT NULL DEFAULT '0',
  `reply_id` int(10) NOT NULL DEFAULT '0',
  `reply_name` varchar(32) CHARACTER SET gbk NOT NULL,
  `reply_email` varchar(100) CHARACTER SET gbk NOT NULL,
  `reply_detail` text CHARACTER SET gbk NOT NULL,
  `reply_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `forum_reply`
--

INSERT INTO `forum_reply` (`id`, `topic_id`, `reply_id`, `reply_name`, `reply_email`, `reply_detail`, `reply_datetime`) VALUES
(55, 38, 2, 'root', '0766city.com', '沙发！！', '2019-04-18 21:33:26'),
(54, 38, 0, '热热热', '123', '人人人人人人人人人人', '2019-04-24 00:00:00'),
(56, 44, 0, 'root', '996@icu.com', '888', '2019-05-04 12:06:43'),
(57, 44, 0, 'root', '996@icu.com', '恩恩', '2019-05-04 13:47:00'),
(58, 44, 0, 'root', '996@icu.com', '哒哒哒哒哒哒', '2019-05-04 13:47:06'),
(59, 44, 0, 'root', '996@icu.com', 'uuu', '2019-05-04 13:47:33'),
(60, 44, 0, 'root', '996@icu.com', '00000000', '2019-05-05 21:42:58'),
(61, 44, 0, 'root', '996@icu.com', '5588', '2019-05-05 21:43:53'),
(62, 49, 0, '黄杰的小可爱', 'simiaoz@163.com', '黄杰介个大懒猪臭屁猪', '2019-05-06 00:19:06'),
(63, 44, 0, 'root', '996@icu.com', 'll', '2019-05-07 22:31:51'),
(64, 44, 0, 'root', '996@icu.com', '哦哦哦', '2019-05-07 22:32:11'),
(65, 44, 0, 'root', '996@icu.com', '噢噢噢', '2019-05-07 22:32:35'),
(66, 44, 0, 'root', '996@icu.com', '噗噗噗', '2019-05-07 22:34:37'),
(67, 44, 0, 'root', '996@icu.com', '哦哦', '2019-05-07 22:35:08'),
(68, 44, 0, 'root', '996@icu.com', 'ooo', '2019-05-07 22:36:07'),
(69, 55, 0, 'root', '996@icu.com', '[自己评论]评论测试1', '2019-05-10 23:29:10'),
(70, 52, 0, 'blankjie', 'user_blankjie@163.com', 'BBS真好用！', '2019-05-11 00:27:01'),
(71, 52, 0, 'civgih', 'user_civigih@163.com', '还有很多功能没有完善，时间充裕的话可以继续做下去！', '2019-05-11 00:29:16'),
(72, 52, 0, 'kiki', 'user_kike@163.com', '啊啊啊啊 :)', '2019-05-11 00:31:36');

-- --------------------------------------------------------

--
-- 表的结构 `forum_topic`
--

CREATE TABLE `forum_topic` (
  `id` int(10) NOT NULL,
  `areaid` int(10) NOT NULL,
  `topic` varchar(255) CHARACTER SET gbk NOT NULL,
  `detail` text CHARACTER SET gbk NOT NULL,
  `name` varchar(32) CHARACTER SET gbk DEFAULT NULL,
  `email` varchar(100) CHARACTER SET gbk DEFAULT NULL,
  `datetime` datetime DEFAULT NULL,
  `view` int(10) DEFAULT '0',
  `likes` int(10) UNSIGNED DEFAULT '0' COMMENT '赞的个数',
  `reply` int(10) DEFAULT '0',
  `sticky` tinyint(1) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `forum_topic`
--

INSERT INTO `forum_topic` (`id`, `areaid`, `topic`, `detail`, `name`, `email`, `datetime`, `view`, `likes`, `reply`, `sticky`) VALUES
(55, 2, '【评论】这个一个查看评论内容的帖子', '<p><strong>SEND REPLY.</strong><br><em>SEND REPLY.</em><br>&lt;u&gt;SEND REPLY.&lt;/u&gt;<br><del>SEND REPLY.</del></p><h1>SEND REPLY.</h1><blockquote>SEND REPLY.</blockquote><pre><code class="js">SEND REPLY.</code></pre>', 'root', '', '2019-05-10 23:28:47', 5, 0, 1, 0),
(54, 3, '【表格】这是一个带表格的帖子', '<p>表1 测试表格</p><table><thead><tr><th>column1</th><th>column2</th><th>column3</th></tr></thead><tbody><tr><td>column1</td><td>column2</td><td>column3</td></tr><tr><td>column1</td><td>column2</td><td>column3</td></tr><tr><td>column1</td><td>column2</td><td>column3</td></tr></tbody></table>', 'root', '', '2019-05-10 23:26:47', 3, 0, 0, 0),
(53, 1, '【图片】这是一个带图片的帖子', '<ul><li>图1</li></ul><p><img src="https://upload-images.jianshu.io/upload_images/13721438-4c7d93c02edb71c0.jpg?imageMogr2/auto-orient/strip%7CimageView2/2/w/750/format/webp" alt="alt" title="alt"></p><ul><li>图2</li></ul><p><img src="https://upload-images.jianshu.io/upload_images/13721438-8955bddeddebf7d6.jpg?imageMogr2/auto-orient/strip%7CimageView2/2/w/582/format/webp" alt="alt" title="alt"></p>', 'root', '', '2019-05-10 23:25:36', 4, 0, 0, 0),
(52, 1, '【公告】欢迎各位老师指导我的毕业设计！！！', '<h1>BBS论坛系统的设计与实现</h1><p>现如今，互联网技术正在以前所未有的速度发展，网络已经不再仅仅是获取信息的来源，更是人们探讨问题，沟通思想的天地。其中，网络论坛就扮演着非常重要的角色，它给用户提供一个信息交流的场所，用户可以通过平台获取信息、发表言论，在自己擅长的领域进行经验分享、技术交流。因此非常有必要建设一个完善的BBS论坛系统。本文针对用户对BBS论坛的实际需求，设计了一套简单易用的BBS论坛系统，系统采用PHP语言编写，使用了HTML、JQuery、JavaScript、MySQL等技术。分角色的设计了系统注册登录、发帖、管理帖子、发表评论、管理评论等功能。方便了用户在网络上的交流。</p>', 'root', '', '2019-05-10 23:22:25', 9, 0, 3, 1),
(56, 3, '谈谈百度贴吧、豆瓣小组以及BBS这个产品形态', '<p>国内至今为止一直没有一个稳定的对bbs这个产品形态的看法。bbs和邮箱一样是历史最悠久的产品，全面地铺开介绍分析不仅工程浩大，也很少有人能做到。这里即兴说说我对bbs这个产品形态的感受：</p><p>1、中国互联网市场大部分时候是受资本意志影响的，而资本对bbs最看好的时候也仅仅是康盛的巅峰时期，之后基本上都会认可的一个观点是bbs难以变现，bbs热潮也就随之退去了。</p><p>2、bbs这一古老的产品形态虽然从未成为过互联网行业发展的主角，但其存在一直较为稳定，从未因任何潮流的兴起而被完全替代。bbs在中国甚至全球其实一直没冷过，所以并不存在“回暖”一说。</p><p>3、从UGC这个大范围来说，拿bbs和其它产品比较一下UGC产品的三要素——信息的主要过滤机制、用户的主要互动机制、信息的主要传播机制，twitter分别是follow、@和RT，bbs则是回帖、回帖、回帖。可以明显看出来bbs是在用一种产品设计来实现多种产品目的：过滤信息的靠回帖、用户间互动靠回帖、传播内容靠回帖，twitter已经是一个非常简单的产品了，但bbs其实本质上比twitter还简单——简单意味着门槛低，简单意味着更稳定。</p><p>4、如果把满足版块、发帖、回帖这些要素的产品都算作bbs话，那么国内bbs市场大致由百度贴吧（论坛平台）、Discuz!/phpwind（通用论坛程序）、猫扑/天涯（独立论坛社区）构成。</p><p>5、单从流量上看，百度贴吧是全球最大的bbs平台，每天数亿的访问量，从诞生至今一直都在增长，即使微博的爆发期，贴吧的流量都没有下降。此外是天涯，虽然去年下降过一段时间，但总体还很稳定。最近几年微博等社会化媒体的兴起对各类传统论坛型社区均有不同程度的影响，但总体来说其影响仅限于对用户总体互联网时间的抢占，并不存在本质替代关系。</p><p>6、国内绝大多数商业网站使用Discuz!或Phpwind搭建自己的论坛，由于Discuz!和Phpwind并没有很可靠的数据公开，所以只能推测估算。Discus!全球使用量貌似超过200万，phpwind超过100万，。个人的观察是phpwind最近两年的增速超过Discuz!，按有效网站来看，目前两者的市场比例可能在6：4到5：5之间（非常粗略的估计，我个人不对这个数字负责）。多说一句：康盛把Discuz!免费了，于是做大了，但他并没有把服务器空间一起包下来，所以没有做得非常大。</p><p>7、不同的bbs服务，除了发帖、回帖这些主干功能，外围的功能设计差异也会造成不同产品之间的巨大不同（并不是指社区氛围之类）。比如贴吧和小组的newsfeed页面——“我的i贴吧”就很弱，“我的小组最新话题”则很强，其它的bbs根本没这样的页面。还有回帖的内容呈现是不是和主帖同等、对回帖是否有单独的互动操作...主干功能之外的产品差异，对“bbs”之间的影响，要远大于其它产品种类（比如腾讯微博和新浪微博，在回复转发的机制上很长时间都不一样）。所以在我看，与其说“bbs”是一个产品形态（和“微博”、“网盘”同级），不如说它更像一个服务种类（与“SNS”同级）。</p><p>8、做bbs有关的产品人员必须要看清楚的是：虽然bbs看起来是一个产品形态，但实际上不同的bbs服务却有非常大的差别，总体上可以分为上面说的：bbs平台、通用bbs程序、独立bbs，有些产品会用类bbs做为讨论的辅助，比如新闻门户的评论之类，但这里的“bbs”并非独立产品，只是辅助功能，所以不算。</p><p>9、通用bbs程序本质上不算to C的产品，更接近to B；独立bbs有自己的生命周期，往往受运营影响而不是产品影响更大。有意思的是bbs平台。国内bbs平台的两大代表是百度贴吧和豆瓣小组。贴吧有搜索带来的庞大、完美的流量，不同贴吧之间的区隔性很强，贴吧的核心是关键词，所以绝大多数吧的主题都是由一个词即可准确描述的具体的物，比如魔兽世界、李宇春；豆瓣小组的流量来自豆瓣，不同小组之间的区隔性没那么强，小组的核心是人的特征，所以绝大多数小组都是由一个描述性语句——尤其是对人群的描述——作为主题的，比如“我总觉得自己就是一个傻逼”、“我们就喜欢折腾男朋友”。相对贴吧来说，小组的平台特征还不是特别明显，所有小组用户的共性大于组和组之间的差异。但小组相对松散，并且以人为核心，所以相对贴吧就形成了这种有趣的结果：</p><p><img src="https://upload-images.jianshu.io/upload_images/79432-48a5925477026352.jpg?imageMogr2/auto-orient/strip%7CimageView2/2/w/600/format/webp" alt="alt" title="alt"></p><p>这是我随手找的一个贴吧热门用户加入的全部贴吧，他是百度魔兽世界吧主，根据他加入的贴吧大约能判断出这个人可能与咸阳有关、是吧主、喜欢黑丝和郭德纲，是游戏玩家，热衷魔兽世界、使命召唤等一些游戏。</p><p><img src="https://upload-images.jianshu.io/upload_images/79432-9bd251ab267c631a.jpg?imageMogr2/auto-orient/strip%7CimageView2/2/w/600/format/webp" alt="alt" title="alt"></p><p>这是一个豆瓣用户加入的部分小组，可以看出这个人已经工作、可能毕业于北京师范大学、处女座、A型血、御姐控、主要交通工具是自行车、关注豆瓣、喜欢银魂、富士相机、掌门狗、读书、Opera...可以明显观察到，小组将个人的兴趣、特征、以及教育、工作、个人资料等与人有关的信息全部标签化了。这是贴吧和小组的差异——看起来产品形态差不多，但实际上却很不一样。</p><p>10、听说腾讯对PM的要求是要常泡论坛，我也有个差不多的形而上学的结论——观察用户行为、挖掘用户需求，没有比论坛更好的地方。这是因为，bbs几乎万能，留意一下的话你可以看到，有的人把自己的bbs当垂直门户用、有的人用bbs做数据资料整理、有的人用bbs版聊、有的人用帖子开网店、有的人在bbs上发起团购、有的人用bbs找到女朋友，在很多论坛的水区，你可以看到热门的帖子的标题大多是以“？”作为结尾的（我的观察是在20%～30%之间，成员关系越紧密的论坛比例通常越高），这些行为都是延续了十几年的，然后逐渐才有专门的数据库、专门的IM、专门的电商网站、专门的团购网站、专门的问答网站……出现。再拿豆瓣小组做个例子，豆瓣现在有40多万个小组，研究其中的用户行为和信息特点很有趣。本质上它是满足多种需求的产品集，有广场（eg：小小女人帮）、亚文化圈（eg：景涛同好组）、垂直论坛（eg：穷游天下）、社团俱乐部（eg：星译社）、话题讨论（eg：老友记）、营销论坛（eg：圈内招聘）、私密圈子（eg：月亮组），个人标签（eg：我宣誓我不生孩子）、甚至一些行为艺术（eg：豆瓣火葬场、加入这个小组你就会很有钱）等等比如这个小组，把bbs当游戏，都快把用户玩出翔了：<a href="http://www.douban.com/group/kick/">http://www.douban.com/group/kick/</a></p><p>11、bbs其实自己也在慢慢演化，比如直播帖，前些年是看不到的，最近几年却越发多了起来。我把这个现象解读为是bbs自身的产品和信息意志对抗碎片化信息大潮的结果。直播帖这样的内容，吸收了碎片化信息的优点，又发扬了社区人群围观的优势，最后产生了一个其它产品无法做到的内容——在N多人的围观下、用若干碎片信息、组成了一个完整的故事。还有，利用自己架设的论坛作为客源，通过开设论坛官方淘宝店来盈利，是早在06、07年就已经有很多站长尝试成功的商业模式，社区电子商务的萌芽其实起源于草根。现在甚至有人用bbs做客源，用YY来盈利呢。</p><p>12、bbs的天生缺陷大致有4个，第一是对单个bbs来说需要强力运营投入，单靠产品本身无法持续运转；第二是对单个bbs来说都有生命周期，3年和5年是多数论坛的重要节点；第三是样样通样样松，什么需求都能满足，但都满足得不够极致；第四是内容难以结构化（所以难形成硬广之外的盈利模式）。</p><p>13、一种产品形态一直不温不火，然后某天突然焕发第二春，这种事是很奇怪的不是么？我们看到8848早年做死了，然后阿里做大了，facebook之前也有很多社交服务都做了烈士，但要分清的是，电子商务和社交服务都是服务类型，不是具体的产品形态，这一点非常重要——把bbs看作产品形态，可以预见的未来里，它会一直这个样子，但要是把bbs看作一种服务类型，它自身是会演化的，我相信bbs在不久的未来会有一个进化的形态，然后引发一场热潮。看看blog，再看看tumblr，你能说tumblr不是博客么，但是你能说tumblr是传统博客么。不妨模拟下tumblr创始人最初的设计思路，然后复用到bbs上去想想，也许会有所收获。PS：Reddit其实也是个bbs平台，最近两年得益于digg的不争气，Reddit人气暴涨，听说现在已经估值4亿美金了。暂时说到这吧。</p><p>作者：永远的冷冽<br>链接：<a href="https://www.jianshu.com/p/8c3475f76699">https://www.jianshu.com/p/8c3475f76699</a><br>来源：简书<br>简书著作权归作者所有，任何形式的转载都请联系作者获得授权并注明出处。</p>', 'user', '', '2019-05-11 00:04:45', 2, 0, 0, 0),
(57, 2, '大学应考的可加分加薪的实用证书！！！', '<p><strong>考证还是很重要的，就算是985、211 的学生，如果没什么证书的话也同样没什么竞争力...大学时间还是挺多的，有时间去玩的话，花一点时间在考证上对以后找工作很有用哦~</strong></p><p><img src="https://upload-images.jianshu.io/upload_images/12550067-0fdf8f7e7221ce9d.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1000/format/webp" alt="alt" title="alt"></p><h2>1. 人力资源管理师三级</h2><p>这个证考的人少，但出乎意料的很吃香。考试难度一般，需要你花一些时间去看书记忆，如果觉得内容太多懒得看书的话可以上某宝买一本叫知识清单和例题集，然后疯狂刷选择题!过得几率也很大! 报考条件对专业没有要求，同学们都可以去报。有的同学可能觉得自己以后不会做人力的不需要这个，其实现在很多公司都会靠证书加工资。</p><p><img src="https://upload-images.jianshu.io/upload_images/12550067-24fdc1064c213158.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1000/format/webp" alt="alt" title="alt"></p><h2>2. 会计证</h2><pre><code>  会计证也一样，不仅可以拓宽你毕业后的出路，也可以简单粗暴的靠证加钱。可以在某宝，上买教程和题库刷题联系，难度同样不高。最重要的是实用性超强，大部分大的公司都可以加钱!还可以靠这个证书去评职称加更多的钱!\n</code></pre><p><img src="https://upload-images.jianshu.io/upload_images/12550067-3a63c3c0fb66c2dd.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/388/format/webp" alt="alt" title="alt"></p><h2>3. 全国翻译专业资格</h2><p>? ? ? 这个证书难度就比较高了，也是含金量超高的一个。可以考英、日、法、阿拉伯、俄、德、西班牙等7个语种。很多爱看日剧、美剧的同学们，可能搞不懂语法问题，但听译水平却出乎意料的高，为了追剧，吭生肉也轻轻松松。这就是爱的力量啊!所以其实这个证书门槛也没有那么高，听力过关的话，再加强一下口译水平就可以了。</p><p><img src="https://upload-images.jianshu.io/upload_images/12550067-7edd958236d6bc47.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/511/format/webp" alt="alt" title="alt"></p><h2>4. 英语四六级</h2><p>? ? ? 基本大学生都会考的证书，但其实这个证书现在已经没有那么重要了，很多面试公司都不看重这个。,需要英语能力的公司都会看雅思、PTE的成绩。学姐的建议是考还是要考的，最好在大一的时候就考到，但是刷分就不必了。但是如果英语真的很难学好的话，与其浪费大量的时间，还不如果断放弃。</p><h2>5. 计算机二级</h2><p>? ? ? 这个一般学校周边会有培训机构，也不贵，一百多块钱，包学到过，没有的话上某宝有很多视频买的，基本上属于你只要花一周周时间看一遍就能拿到的证。</p><p><img src="https://upload-images.jianshu.io/upload_images/12550067-928894cba49df2d4.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/546/format/webp" alt="alt" title="alt"></p><p>如果你成绩一般的话， 有一些证书会给你的简历加分很多~而且很多证书实用性很高，入手难度却不高。</p>', 'user', '', '2019-05-11 00:23:26', 0, 0, 0, 0),
(58, 3, '克服人性的弱点，修炼快乐心态', '<p>卡耐基说：“一个人内心的想法是非常重要的。好的想法考虑到原因和结果，可以产生合乎逻辑的、有建设性的计划；而坏的想法通常会导致一个人的心理紧张，甚至精神崩溃。”一个内心强大的人，他从不把自己跟坏情绪联系在一起。其实只要克服人性的弱点，拥有阳光般的快乐心态，就能够远离生活的烦恼、懂得人生的真谛。</p><p><img src="https://upload-images.jianshu.io/upload_images/12550067-ea7aac89c083b07c.jpg?imageMogr2/auto-orient/strip%7CimageView2/2/w/640/format/webp" alt="alt" title="alt"></p><p>1.不要因小事而沮丧</p><p>人真是个奇怪的物种，在面对死亡时可以非常坦然，但在面对小事情时却容易走上极端。想要克服由小事情而引起困扰的最好办法，就是把自己的看法和注意力转移一下就可以了——想一些积极的、向上的、乐观的东西，这样你就会重新快乐起来。</p><p>2.不做为难自己的人</p><p>一个人的感情和精力都是有限的，他无法同时兼顾抗拒无法避免的事和创造新生活，他只能选择其中的一种生活。要么在无法避免的暴风雨面前折腰曲身，要么努力抗拒它然后再被它摧毁。永远保持对生活的美好期待和执着追求，你就是快乐的。</p>', 'blankjie', '', '2019-05-11 00:25:43', 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `forum_user`
--

CREATE TABLE `forum_user` (
  `id` int(10) NOT NULL,
  `username` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  `phonenum` varchar(50) DEFAULT NULL COMMENT '电话号码',
  `email` varchar(100) DEFAULT NULL,
  `permission` int(5) NOT NULL COMMENT '账号等级',
  `regdate` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

--
-- 转存表中的数据 `forum_user`
--

INSERT INTO `forum_user` (`id`, `username`, `password`, `phonenum`, `email`, `permission`, `regdate`) VALUES
(30, 'civgih', '14e1b600b1fd579f47433b88e8d85291', '174695553321', 'user_civigih@163.com', 0, '2019-05-10 22:53:42'),
(29, 'blankjie', '14e1b600b1fd579f47433b88e8d85291', '179644223645', 'user_blankjie@163.com', 0, '2019-05-10 22:52:49'),
(28, 'user', '14e1b600b1fd579f47433b88e8d85291', '17596545556', 'user@mybbs.com', 0, '2019-05-10 22:52:05'),
(27, 'root', '14e1b600b1fd579f47433b88e8d85291', '18556478951', '996@icu.com', 1, '2019-05-10 22:47:35'),
(31, 'kiki', '14e1b600b1fd579f47433b88e8d85291', '1749665333', 'user_kike@163.com', 0, '2019-05-10 22:54:25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `forum_area`
--
ALTER TABLE `forum_area`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `forum_ip`
--
ALTER TABLE `forum_ip`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `forum_reply`
--
ALTER TABLE `forum_reply`
  ADD PRIMARY KEY (`id`),
  ADD KEY `a_id` (`reply_id`);

--
-- Indexes for table `forum_topic`
--
ALTER TABLE `forum_topic`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `forum_user`
--
ALTER TABLE `forum_user`
  ADD PRIMARY KEY (`id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `forum_area`
--
ALTER TABLE `forum_area`
  MODIFY `id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID', AUTO_INCREMENT=5;
--
-- 使用表AUTO_INCREMENT `forum_ip`
--
ALTER TABLE `forum_ip`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '记录ID', AUTO_INCREMENT=51;
--
-- 使用表AUTO_INCREMENT `forum_reply`
--
ALTER TABLE `forum_reply`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;
--
-- 使用表AUTO_INCREMENT `forum_topic`
--
ALTER TABLE `forum_topic`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;
--
-- 使用表AUTO_INCREMENT `forum_user`
--
ALTER TABLE `forum_user`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
