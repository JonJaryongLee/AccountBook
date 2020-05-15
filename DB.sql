-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- 생성 시간: 20-05-15 15:48
-- 서버 버전: 8.0.18
-- PHP 버전: 7.3.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 데이터베이스: `accountbook`
--

-- --------------------------------------------------------

--
-- 테이블 구조 `category`
--

CREATE TABLE `category` (
  `Category_name` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Icon_color` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `Icon_tag` varchar(30) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 테이블의 덤프 데이터 `category`
--

INSERT INTO `category` (`Category_name`, `Icon_color`, `Icon_tag`) VALUES
('경조사', '#F44336', 'mdi-spa'),
('비상금', '#4DD0E1', 'mdi-shield-key-outline'),
('생활비', '#29B6F6', 'mdi-emoticon-happy-outline'),
('수입', '#4CAF50', 'mdi-cash-100');

-- --------------------------------------------------------

--
-- 테이블 구조 `fix_spend`
--

CREATE TABLE `fix_spend` (
  `ID` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `Category_Detail` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `price` int(20) NOT NULL,
  `num` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 테이블의 덤프 데이터 `fix_spend`
--

INSERT INTO `fix_spend` (`ID`, `Category_Detail`, `price`, `num`) VALUES
('sj1212', '자취방 월세', 380000, 1),
('sj1212', '통신비', 52000, 2),
('sj1212', '공과금', 20000, 3),
('sj1212', '적금', 20000, 4),
('tg123', '자취방 월세', 300000, 5),
('tg123', '통신비', 50000, 6),
('tg123', '공과금', 50000, 7),
('tg123', '교통비', 50000, 8),
('tg123', '적금', 100000, 9),
('mi111', '전세대출금', 280000, 10),
('mi111', '통신비', 56000, 11),
('mi111', '인터넷비', 18000, 12),
('mi111', '아파트 관리비', 120000, 13),
('mi111', '교통비', 100000, 14),
('mi111', '적금', 100000, 15),
('mi111', '부모님 용돈', 300000, 16),
('mi111', '담배', 140000, 17),
('jr3', '아파트 관리비', 240000, 18),
('jr3', '통신비', 120000, 19),
('jr3', '인터넷비', 30000, 20),
('jr3', '차 기름비', 150000, 21),
('jr3', '적금', 1000000, 22),
('jr3', '부모님 용돈', 500000, 23),
('jr3', '가게 월세', 1020000, 25),
('jr3', '가게 공과금', 250000, 26);

-- --------------------------------------------------------

--
-- 테이블 구조 `goal`
--

CREATE TABLE `goal` (
  `Content` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Point` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 테이블의 덤프 데이터 `goal`
--

INSERT INTO `goal` (`Content`, `Point`) VALUES
('1년 적금 들기', 12);

-- --------------------------------------------------------

--
-- 테이블 구조 `income`
--

CREATE TABLE `income` (
  `ID` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `Category_Detail` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Content` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `price` int(20) NOT NULL,
  `Date_d` date NOT NULL,
  `Division` varchar(5) COLLATE utf8mb4_general_ci NOT NULL,
  `num` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 테이블의 덤프 데이터 `income`
--

INSERT INTO `income` (`ID`, `Category_Detail`, `Content`, `price`, `Date_d`, `Division`, `num`) VALUES
('sj1212', '용돈', '부모님께 받음(엄마)', 100000, '2020-05-01', '+', 1),
('sj1212', '용돈', '부모님께 받음(아빠)', 200000, '2020-05-10', '+', 2),
('sj1212', '용돈', '안쓰는 것들 판매', 50000, '2020-05-25', '+', 3),
('sj1212', '용돈', '친오빠의 생일선물', 200000, '2020-05-26', '+', 4),
('tg123', '용돈', '삼촌께 받음', 5000, '2020-05-03', '+', 5),
('tg123', '용돈', '가게손님께 받음', 10000, '2020-05-03', '+', 6),
('tg123', '주식', '삼성전자 3주매도', 30000, '2020-05-04', '+', 7),
('tg123', '용돈', '부모님께 받음', 500000, '2020-05-10', '+', 8),
('mi111', '주식', '마스크회사 2주매도', 200000, '2020-05-07', '+', 10),
('mi111', '상금', '공모전 출전 대상 수상', 500000, '2020-05-15', '+', 11),
('jr3', '투자', '부동산투자', 300000, '2020-05-15', '+', 12);

-- --------------------------------------------------------

--
-- 테이블 구조 `month_spend`
--

CREATE TABLE `month_spend` (
  `ID` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `Category_name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `price` int(20) NOT NULL,
  `num` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 테이블의 덤프 데이터 `month_spend`
--

INSERT INTO `month_spend` (`ID`, `Category_name`, `price`, `num`) VALUES
('sj1212', '생활비', 70000, 1),
('sj1212', '경조사', 20000, 2),
('tg123', '생활비', 1000000, 3),
('tg123', '경조사', 150000, 4),
('tg123', '비상금', 300000, 5),
('mi111', '생활비', 800000, 6),
('mi111', '경조사', 500000, 7),
('mi111', '병원비(주기적 방문)', 120000, 8),
('jr3', '생활비', 500000, 9),
('jr3', '경조사', 150000, 10),
('jr3', '비상금', 150000, 11);

-- --------------------------------------------------------

--
-- 테이블 구조 `spend`
--

CREATE TABLE `spend` (
  `ID` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Category_name` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Category_Detail` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Content` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Use_division` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Date_d` date NOT NULL,
  `price` int(20) NOT NULL,
  `Division` varchar(5) COLLATE utf8mb4_general_ci NOT NULL,
  `num` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 테이블의 덤프 데이터 `spend`
--

INSERT INTO `spend` (`ID`, `Category_name`, `Category_Detail`, `Content`, `Use_division`, `Date_d`, `price`, `Division`, `num`) VALUES
('sj1212', '경조사', '생일', '생일파티참석', '카드', '2020-05-02', 15000, '-', 1),
('sj1212', '경조사', '생일', '치킨 기프티콘 선물', '카드', '2020-05-03', 21000, '-', 2),
('sj1212', '생활비', '카페', '아마스빈 버블티', '현금', '2020-05-05', 5200, '-', 3),
('sj1212', '생활비', '마트', '반찬', '카드', '2020-05-08', 20000, '-', 4),
('sj1212', '생활비', '편의점', '맥주', '카드', '2020-05-10', 9900, '-', 5),
('sj1212', '생활비', '식비', '경아식당', '현금', '2020-05-12', 7000, '-', 6),
('sj1212', '생활비', '식비', '남매컵밥', '카드', '2020-05-13', 5000, '-', 7),
('sj1212', '생활비', '약국', '마스크', '현금', '2020-05-16', 1500, '-', 8),
('sj1212', '생활비', '마트', '계란', '카드', '2020-05-20', 5500, '-', 9),
('sj1212', '생활비', '카페', '스타벅스', '카드', '2020-05-23', 6100, '-', 10),
('sj1212', '생활비', '다이소', '생필품', '카드', '2020-05-27', 21000, '-', 11),
('tg123', '경조사', '생일', '친구생일', '현금', '2020-05-03', 15000, '-', 12),
('tg123', '생활비', '카페', '엔젤리너스', '현금', '2020-05-03', 6500, '-', 13),
('tg123', '생활비', '미용', '퍼스트헤어', '카드', '2020-05-07', 10000, '-', 14),
('tg123', '생활비', '편의점', '맥주', '카드', '2020-05-11', 3200, '-', 15),
('tg123', '생활비', '카페', '스타벅스', '카드', '2020-05-14', 10500, '-', 16),
('tg123', '생활비', '식비', '맥도날드', '카드', '2020-05-24', 10000, '-', 18),
('mi111', '생활비', '다이소', '생필품', '카드', '2020-05-02', 3000, '-', 19),
('mi111', '교통비', '택시', '퇴근', '카드', '2020-05-02', 14000, '-', 20),
('mi111', '생활비', '마트', '반찬', '카드', '2020-05-05', 17000, '-', 21),
('mi111', '생활비', '유흥', '술집', '카드', '2020-05-05', 33500, '-', 22),
('mi111', '교통비', '택시', '퇴근', '카드', '2020-05-07', 13000, '-', 23),
('mi111', '생활비', '편의점', '야식', '카드', '2020-05-09', 6000, '-', 24),
('mi111', '생활비', '식비', '서브웨이 샌드위치', '카드', '2020-05-09', 8000, '-', 25),
('mi111', '생활비', '미용', '미용실', '카드', '2020-05-18', 45000, '-', 26),
('mi111', '교통비', '기차', '남자친구 만남', '카드', '2020-05-18', 6200, '-', 27),
('mi111', '생활비', '미용', '화장품구매', '카드', '2020-05-21', 20800, '-', 28),
('mi111', '생활비', '오락', '피시방', '카드', '2020-05-24', 15000, '-', 29),
('jr3', '생활비', '식비', '파스타', '카드', '2020-05-02', 24000, '-', 30),
('jr3', '생활비', '식비', '족발 배달', '카드', '2020-05-05', 30000, '-', 31),
('jr3', '교통비', '버스', '진주성 데이트', '현금', '2020-05-05', 1500, '-', 32),
('jr3', '생활비', '식비', '짜장면', '현금', '2020-05-05', 12000, '-', 33),
('jr3', '생활비', '카페', '스타벅스', '카드', '2020-05-07', 6300, '-', 34),
('jr3', '경조사', '결혼식', '친구결혼', '현금', '2020-05-09', 150000, '-', 35),
('jr3', '생활비', '미용', '파마', '카드', '2020-05-09', 70000, '-', 36),
('jr3', '생활비', '식비', '삼겹살', '카드', '2020-05-18', 50000, '-', 37),
('jr3', '생활비', '유흥', '술', '현금', '2020-05-18', 30000, '-', 38),
('jr3', '생활비', '식비', '짬뽕', '카드', '2020-05-21', 7000, '-', 39),
('jr3', '생활비', '마트', '반찬', '카드', '2020-05-24', 8500, '-', 40),
('mi111', '생활비', '마트', '오이', '현금', '2020-05-29', 900, '-', 41),
('mi111', '생활비', '마트', '오이', '현금', '2020-05-29', 900, '-', 42),
('sj1212', '생활비', '식비', '족발', '카드', '2020-05-13', 20000, '', 45);

-- --------------------------------------------------------

--
-- 테이블 구조 `spend_material`
--

CREATE TABLE `spend_material` (
  `Material` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Image` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `Text` text COLLATE utf8mb4_general_ci NOT NULL,
  `Point` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 테이블의 덤프 데이터 `spend_material`
--

INSERT INTO `spend_material` (`Material`, `Image`, `Text`, `Point`) VALUES
('계획소비형', '11', '계획(목표)에 맞게 소비를 함', 50),
('저축형', '0', '소비를 줄이고 저축을 많이 함', 50),
('충동구매형', '1212', '계획된 소비를 못하고 충동적으로 소비', 120);

-- --------------------------------------------------------

--
-- 테이블 구조 `under_category`
--

CREATE TABLE `under_category` (
  `Category_Detail` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Category_name` text COLLATE utf8mb4_general_ci NOT NULL,
  `Icon_color` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `Icon_tag` varchar(50) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 테이블의 덤프 데이터 `under_category`
--

INSERT INTO `under_category` (`Category_Detail`, `Category_name`, `Icon_color`, `Icon_tag`) VALUES
('가게 공과금', '생활비', '#1A237E', 'mdi-flash-outline'),
('가게 월세', '생활비', '#0091EA', 'mdi-cash-minus'),
('결혼식', '경조사', '#####', '#####'),
('공과금', '생활비', '#00B0FF', 'mdi-flash'),
('기차', '교통비', '#####', '#####'),
('담배', '생활비', '#01579B', 'mdi-fire'),
('마트', '생활비', '#0277BD', 'mdi-cart'),
('문화생활', '생활비', '#0288D1', 'mdi-movie-open'),
('미용', '생활비', '#039BE5', 'mdi-emoticon-cool'),
('버스', '교통비', '#40C4FF', 'mdi-bus'),
('부모님 용돈', '생활비', '#4FC3F7', 'mdi-heart-plus'),
('상금', '수입', '#1B5E20', 'mdi-seal-variant'),
('생일', '경조사', '#455A64', 'mdi-flower-poppy'),
('생필품', '생활비', '#81D4FA', 'mdi-account-cash'),
('쇼핑', '생활비', '#B3E5FC', 'mdi-basket'),
('식비', '생활비', '#0D47A1', 'mdi-food-fork-drink'),
('아파트 관리비', '생활비', '#448AFF', 'mdi-office-building'),
('약국', '생활비', '#82B1FF', 'mdi-pill'),
('용돈', '수입', '#2E7D32', 'mdi-heart-plus-outline'),
('월급', '수입', '#388E3C', 'mdi-briefcase'),
('유흥', '생활비', '#1565C0', 'mdi-glass-mug-variant'),
('인터넷비', '생활비', '#1976D2', 'mdi-microsoft-internet-explorer'),
('일급', '수입', '#43A047', 'mdi-network-strength-2'),
('자취방 월세', '생활비', '#1E88E5', 'mdi-cash-marker'),
('전세대출금', '생활비', '#42A5F5', 'mdi-bank-transfer'),
('주급', '수입', '#00C853', 'mdi-network-strength-4'),
('주식', '수입', '#66BB6A', 'mdi-share-variant'),
('차 기름비', '생활비', '#2962FF', 'mdi-gas-station'),
('카페', '생활비', '#3D5AFE', 'mdi-coffee'),
('택시', '교통비', '#00E5FF', 'mdi-taxi'),
('통신비', '생활비', '#536DFE', 'mdi-cellphone-iphone'),
('투자', '수입', '#558B2F', 'mdi-crop-landscape'),
('편의점', '생활비', '#03A9F4', 'mdi-store-24-hour');

-- --------------------------------------------------------

--
-- 테이블 구조 `user`
--

CREATE TABLE `user` (
  `ID` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `PW` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Name` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Sex` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Age` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Cash` int(20) DEFAULT NULL,
  `Fix_Income` int(20) DEFAULT NULL,
  `Change_income` int(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 테이블의 덤프 데이터 `user`
--

INSERT INTO `user` (`ID`, `PW`, `Name`, `Sex`, `Age`, `Cash`, `Fix_Income`, `Change_income`) VALUES
('jr3', '3333', '이자룡', '남성', '30', 2718000, 7000000, 30000),
('mi111', '1111', '박명인', '여성', '30', 32000000, 1900000, 11875),
('sj1212', '2222', '박수진', '여성', '20', 700000, 380000, 9000),
('tg123', '4444', '제태경', '남성', '20', 1200000, 500000, 9500);

-- --------------------------------------------------------

--
-- 테이블 구조 `user_target`
--

CREATE TABLE `user_target` (
  `ID` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `content` text COLLATE utf8mb4_general_ci NOT NULL,
  `num` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 테이블의 덤프 데이터 `user_target`
--

INSERT INTO `user_target` (`ID`, `content`, `num`) VALUES
('tg123', '일년 적금 들기', 1),
('mi111', '전세집 자금 마련하기', 2),
('jr3', '200만원 그래픽카드 구매하기', 3),
('sj1212', '에어팟 구매하기', 4);

-- --------------------------------------------------------

--
-- 테이블 구조 `work_income`
--

CREATE TABLE `work_income` (
  `ID` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `Category_Detail` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Content` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `Date_d` date NOT NULL,
  `Time` int(11) NOT NULL,
  `Division` varchar(5) COLLATE utf8mb4_general_ci NOT NULL,
  `num` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 테이블의 덤프 데이터 `work_income`
--

INSERT INTO `work_income` (`ID`, `Category_Detail`, `Content`, `Date_d`, `Time`, `Division`, `num`) VALUES
('sj1212', '월급', 'GS25편의점', '2020-05-01', 48, '+', 1),
('tg123', '일급', '고깃집 서빙 알바', '2020-05-01', 10, '+', 2),
('tg123', '일급', '고깃집 서빙 알바', '2020-05-04', 8, '+', 3),
('tg123', '일급', '고깃집 서빙 알바', '2020-05-05', 5, '+', 4),
('tg123', '일급', '고깃집 서빙 알바', '2020-05-07', 3, '+', 5),
('tg123', '일급', '고깃집 서빙 알바', '2020-05-10', 6, '+', 6),
('mi111', '월급', '모다아울렛 월급', '2020-05-07', 160, '+', 7),
('jr3', '주급', '가게 카드판매값 계좌 입금', '2020-05-06', 5, '+', 8),
('jr3', '주급', '가게 카드판매값 계좌 입금', '2020-05-13', 5, '+', 9),
('jr3', '주급', '가게 카드판매값 계좌 입금', '2020-05-20', 5, '+', 10),
('jr3', '주급', '가게 카드판매값 계좌 입금', '2020-05-27', 5, '+', 11),
('tg123', '일급 ', '야간알바', '2020-05-05', 5, '+', 12);

--
-- 덤프된 테이블의 인덱스
--

--
-- 테이블의 인덱스 `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`Category_name`);

--
-- 테이블의 인덱스 `fix_spend`
--
ALTER TABLE `fix_spend`
  ADD PRIMARY KEY (`num`);

--
-- 테이블의 인덱스 `goal`
--
ALTER TABLE `goal`
  ADD PRIMARY KEY (`Content`);

--
-- 테이블의 인덱스 `income`
--
ALTER TABLE `income`
  ADD PRIMARY KEY (`num`);

--
-- 테이블의 인덱스 `month_spend`
--
ALTER TABLE `month_spend`
  ADD PRIMARY KEY (`num`);

--
-- 테이블의 인덱스 `spend`
--
ALTER TABLE `spend`
  ADD PRIMARY KEY (`num`);

--
-- 테이블의 인덱스 `spend_material`
--
ALTER TABLE `spend_material`
  ADD PRIMARY KEY (`Material`);

--
-- 테이블의 인덱스 `under_category`
--
ALTER TABLE `under_category`
  ADD PRIMARY KEY (`Category_Detail`);

--
-- 테이블의 인덱스 `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID`);

--
-- 테이블의 인덱스 `user_target`
--
ALTER TABLE `user_target`
  ADD PRIMARY KEY (`num`);

--
-- 테이블의 인덱스 `work_income`
--
ALTER TABLE `work_income`
  ADD PRIMARY KEY (`num`);

--
-- 덤프된 테이블의 AUTO_INCREMENT
--

--
-- 테이블의 AUTO_INCREMENT `fix_spend`
--
ALTER TABLE `fix_spend`
  MODIFY `num` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- 테이블의 AUTO_INCREMENT `income`
--
ALTER TABLE `income`
  MODIFY `num` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- 테이블의 AUTO_INCREMENT `month_spend`
--
ALTER TABLE `month_spend`
  MODIFY `num` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- 테이블의 AUTO_INCREMENT `spend`
--
ALTER TABLE `spend`
  MODIFY `num` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- 테이블의 AUTO_INCREMENT `user_target`
--
ALTER TABLE `user_target`
  MODIFY `num` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- 테이블의 AUTO_INCREMENT `work_income`
--
ALTER TABLE `work_income`
  MODIFY `num` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
