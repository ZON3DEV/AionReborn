-- MySQL dump 10.13  Distrib 5.5.37, for Win32 (x86)
--
-- Host: 192.168.178.55    Database: al_server_gs
-- ------------------------------------------------------
-- Server version	5.7.37-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `player_settings`
--

DROP TABLE IF EXISTS `player_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `player_settings` (
  `player_id` int(11) NOT NULL,
  `settings_type` tinyint(1) NOT NULL,
  `settings` blob NOT NULL,
  PRIMARY KEY (`player_id`,`settings_type`) USING BTREE,
  CONSTRAINT `ps_pl_fk` FOREIGN KEY (`player_id`) REFERENCES `players` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `player_settings`
--

LOCK TABLES `player_settings` WRITE;
/*!40000 ALTER TABLE `player_settings` DISABLE KEYS */;
INSERT INTO `player_settings` (`player_id`, `settings_type`, `settings`) VALUES (115953,-2,'0'),(115953,-1,'0'),(115953,0,'�\r\0\0,S\0\0x��\\�r�E���?���&̻�F�l��.�d͢D�Q\")F�,�?�_K��Ac@�.R,�����@w�\r��O�7��.vb+.�7�/�(ų؋��_D%�*�}){q�א����o�/�U�\n�~�..�_ğ��Y�I���x^��J���x����O����&��A�-������÷��.�Dy>=�?���Ui��\'��\0y~�w?0�+�ʥ�������%z��#���:�u�@n����\'�J!���\0���T����J�r	1 �q�I��W�_����:�_���b~y���b��,��K����[/V������mҝ���<^���@����Y�#��b�1����[�h?�T_f�{�V��y/�U�?����kx�����\'��*U}��H��R_�UGx����=»/�j��~���?�|>��r�cTn�@7=K�=�P�q�<@��ڷ_�������5�����O��?�����e���]D1�?�����m�f�;zV��@�\\O�pNL�G� �����\0����$�u�3U��z�:}��T[�ľ��Z�x�<_U���i��]�Y��WM�꨷�Q�\\�/\\�r�=f\Z�q�=d\Z�q�=b�R1D^��P�Z�S��ׁ�T[��w���X�uU]#x�vX/\Z�7�k.���e�Qg%���K�J6`mk�W��<Ӽ�Z�M�HNiR}J��Z��c�`��s�k��N��皋N��皋N�Jq�qαA?_@�\Z~�45�43�_@����p3����Y=W�g*5������z����W�a�p��MVK����h?��E�Ct��\"���7�*B�g��L\\48D]��y�!\Zf<�F��b.Σ�s�|���N}�[\\XD-KW�W��q��d!_�.�c���=FW��\Z9\\	_�s�p<�W�68T�����&r�u�똪}�_�8�>���\"z����)�W@����_e����AY��N�U#��y�9⚉ԣ55Ƒ�Ai�s�5�̧Z�P3�Zq��/�%�5�Q#��{�Q�j]��~��䱆��*�mq}�I,qEe�V��h�܈�zv��x��-YZ�[\r�ɒ>��Mк�	mG���j����G��Z-V5D�ב�8�aP+H*:���K/6Tm8�۸ԥRN� T)�1gj?�򢯃��[P�7\Z�29n�nY�]��.�n>��d�]�}�[��Ѷ\'�8���Ч\"i�#�$�u,R��P�ˤ�:��%��䔓F*.O��y��j��j�cX�[���՟<ұ�b[���k�-���~o!�d�5|ޱ��m^����U��X=���t����v�N�[��AQ��ۓ��5�>�V�����w��\ZW����ߺ5����:�Ko���zl`~����@|���F/?j����]�D��]�+����7���*�?�YdgI��}�=�j�/ w��ݍ�G��L~Nn�]�Z7�U�sn~nt���Pg~��t�:�N�\Z���e��g2m����zj/�P�Kϡ���B�?�۝[��ZkЎ��%��m*q�la���8�<UN28�ԞK\ZW[\\���5�k��i\\��2��^#\Z6O�F����\"*�N��lTY+�z?4��-�e1��t,���2��^�wRc�\n[p5x(^�����QZ;�1$mT򺤵5c�ںcm-��;�Fҳ5���z��Hk�>�6ZI��dϖ����35�Y����d�k���L�����mmc�g����姱��NA\nUy(�#���;�B���Jc�Ta�P���l�X{V�e,����jx�A�5�m�݇�E&u�g���ٽ��^c����>��l��sײ��`y�����v���]�:;k����Y���\"*�U�8.�;kw�q��y}Z���:o\\Pe���@�5����k�z��q��{^�2�J�y��x���!q���5��k�1`ɗ�p|y�\0��_�1�q�������s�L�\r^o)3�7X��6�����G�_\r�?�L�?x�S���<2x=!9�QKU�^����g\n8d!9όQoQ���^����F���0\Z�D!9�^�Mڹ:3Z{�ޡ���gk�.3�XxјC�����1�Ź�?�Zx5��9UAd���a�����H1�b����?��Q~L�Y[�A;��XѯS���*�Q�\'�٣}q�2�E�%�\",�7��Q���T>�2j��̬�b�����X����x�Bc�!-���,����-?�n,����9?�ln��y�p|�������\0�ϖe���s\r�o�h����6���.��x�rme���閙y�i�].�s���T^�Q��:!���A�(vh���v+�&E����*��5���+�\r���N�B[\"A�;<����pM���=��S\r��Y�n\"后kow��:�¦n%䐎�w��*mFF>N5r�Cv�U��p;�\'�\Zk�B�gh0\"j͚�u�����woW�º�㊛�{��Ĩ������P���)�2����AO��-�7x����\\�p�D�NQi{l�h�Ju%�3}�T��a^r8ä��߱�*�����7�n����O����6�1�GŞ��Yzm�:K��s�5��V�\\Z�N�/o��7Ć>*� v?�Q�~qu���Qﻎ�4��o�JD��i��;7z����X=��8T��y�S���v�̺�9��i�ĥ>{���+/?��j��7P����R��,�|�M˷��s;��)���3�I-�C�s�gq�E����sh��lO\"w*i�1���ރ>�:}��bM�Gx�Z��ԉ#w�gAh��C�x���	�izyeX�~�I����L�t9�����\rhs7%�X�w��I���<�9����b�5��O��4����d\Z�I�g��NzZ�ҘX�[����Q2MI˸�메��deRe�w<�˘�}�=�J�\"�vMc��4Rt��e0�4c#^K�|�9<�fO��J��:�J��3u�)�\Z�9�0<CS�����&�C�e�\n�,C_��\'�����a�s���Y�s䦚��Nh�!|�j���5�Y�i4Z_���,ެ�����\Z�xz=;�����7�u�J�ZOX��8����O��l�Do��9���\r���|$S>7?�N�K��\r\Z;�ӯ9\n�<�ŵ���8�4/�;�bdh�C)���8G��R�>zT����c̡\r�;�f#�/�����-���K�y�zc�ͥK��F���L~�9�aPw[̍��	�y摆�Y��զ� ^�,������)^�W��v�$ϛ§xp��A�d�洄��W�O�K��m�R_WWT��j[7����c,ey0��Z�)�ޮK�l�&w�����\'�Oze�E�QtV��\\q��yC�P�b��\ZZ}!������e,�:U�����8R��Q��-�`t���0+���a�̘�����B6�˳N��y���ڸn&���VI�*��	�L�R�2�Y\'�u�$pM����V,�����҈G\\�}\n��o&�;�W�ak�L}��ޠ]R:W���0���N���ͼ����Q뼙��v���!z�0�\\��ۄ�	�o��&|��yУ�P&�n�kS�R����s'),(115953,1,'k\0\0�\0\0x��T�N�@=����w�������~�>7�\Z+բ��yX���@$.3sv������̰�6���G��[d��)���ѓ!����O�{�[,qFTLm�)Np̈[���/J^[S<�ެ����2��1l5�����,)�~�X�i	�q�/h	�����/E��&_`곱Qo������F=ډ�龜ϕ�������M����S�n�lKl|��#G�ܱ!|������~�d�S��/ZR����rNǊ�joa��x�Bf�՝�\rK�P�F�/��H�(9�b�ژQ����DbE�fG�|�uIlʩ��m�������%wBu��LC�9	}!�#]�kt����i��{�q6��'),(115953,2,'�\0\0\0\0\0\0x���1�@D�-	w ��6T\n�\'������.q��鼚#++����gf�,ؒ2p�%��↣�bرdÊ��@��$^J5�\'5���P[���O����\'�}�E�cJ�sj\n5Z56ڮD��K�Q�Vԉ\'rF{�������,'),(117460,-2,'0'),(117460,-1,'0'),(117460,0,'{\r\0\0�Q\0\0x��\\�n+�e����\'Q���ă�:���� [��dŒ������R��Yl�w�`w�yx��*>�d��O���&vb+.�W���(�ċ؋���D%�*p�������kH݋L�����?��o��K��g`|q�,G��s%�����p���H}�\'���eP�r);x���7�����RH�ϧ��p��UՆ�}�o�P�Wx�˾�\\�{�u���_\"��=!�\\��ܡ�W(��!�>뉶R���7�z�6U�$���~��\\�_�����Z�.疀����Y�5��b��,��m1wsw讘�=��t_�ݝ��z(����\0=sgq��v��cľ��w�9�c��~�����-�^B?����|��^�%Z�/��S�տ_@���\Z�:���^�u�g_ஂ�������\n���+��Q���t/�dt�C���\0徱OolN�~�?��&�����O\\�?�����e���]D>�������mJg�3�W�ڀ�\\O�p�O��G��7�\0���\0���|����j�~K=A���p�/X��b�rL<r��*���4Jb�&���G������G�s��p1���iT[���iTW���1J�Y�g�B�k=hN�������k���X�eUY#X�\rv�.\Z���5�W��8K@7P��XU�[[��`��3�˫u���W�$5��(�EY=֮\nf�<׼�9�t�y�9�t�y�9�t����\r�����]����~?A�b��y�T��2\'Gf�\\���P�99��8D������ ��I�<�!���7�)�~�����>��y�#�w���A�g��L�78D]��Y�!\Zf>�F��b.΢�s�|�5��N}��w�Ⰸz����*�����B��;8\\]����G���/5r��x���x�#��mp���v\rw����s�떪w�oO]!:~�&��|�� Tk��2~>�/A��WNA+����<�q�/qF�懽7�	Q&�\Z7�\Z�+�S�I��E�U&��c�q\rO��A���p���\'x���4y��{ç�b[\\}K\\OY�b�<�87�^w]c=^��h�F�V���D�yyI�b�*h����V�k�4n�a�j\\������N�0��#�/�����5�i\\��\\N�+ T-�dj���Ǩ��~m%����\'�e!w�	��w��v��=�o���?���� ܂<�Ik�I\'�}�z�9��2�L?ɔ�9�y�+�4��<b_��v���*��Kz��O��ް/�c��-��R�߷Pv��\Z>�Vֶ�?�a���j���i:壑�v�N�;��A\rQ���)�r�c���BZ��#�E6����=������\rj�������G�Fޅ��9�2�sѫ�)d�B��H�ɬd�Y���^f���	�rA�B�l\nǰ9����#��C��7�*�P�j�A-�y.ѳ�Q�+I+�[���\"�dp2�uz�j��-��5ښ�����4���|SD�\r[�A#ZV�h����p:��6[�ޕ�d�wpS��bZ�XL�bZ��WY\r7zE=�1:�p��C\r��gt=���V׼�I�k^�����PZ]w����u��HZ]+�p��V�s�HZm�����I��.{�~��e�i�N�\\+��.+\\5�P�e�u�D�uk�=�I��E�<��Pe��S��Cqi��*�U{(�*��S���C���Uc�Y�m8��(g��k�U5Z��j��z2癜׵��;�����x��Wv^����공Z�a\\�ʏ�����6Z�{���w�����ެ����ET��	p��wV�����F�*3�u���� :k�[,?[�/���㼱��Pef�g����{������\0��5�p����8��}��������A_�����:d��o����=��`�\0����٣�̰�uf��ީC{p�����M����Y��^O��]yYEH�2c4ZԬmFo�&$���3:�F>�h#$g���I:�fF�O�:*zq!w,��LT��1�r5�q��1�Ź��-���NU�YmfvXyB���d�-֊����G�>]gu���\"�E�MI�O��EU,���G3��8eG�%�\",_�̬Tz1Հ��Z����6�Ձ/5�dZ\Z+#^�R����.4&��2�=��$��Hmy�x���|\\[�J.�=�U�֦��`��XX�|kp|_C����zh�f�^��w�r=aX��ɖ�(�����|����D*ϳ�F��Ӫ����BM��Ӿ��S���5U���݌x�$q�pW~;Y\r�>��{|J���E�޸�!��� �b�M���!�A�hp���L�8����R\\/��|ҭ�ǖ.q�cj�3�y?��qg���M�t$�b��89<1*9�Fn�n��g���)�2�{�l��Z�w\'�ቲ��c���Ο�ڎ8{��Q9�3��Og	ܩ��,9�aR��XS��x��{�Q	�:�+ᓅ|r�/l�y��Q�gvp�^��Pl�<��\r�U�/-g��U7��+bC�� v��I��pm��ѯ�����c\r���19��$щ�[��llc��Cp�V�h��Jiģ�\'��yN��$V�R��n�8�Չ�?\'�Z�9-_����R��,�|�MϷ��s;������3�I+�C�s�gq�E��S�sh�S\\�\"w\Zg�1yՉ�G}**u�̷�<�X��\\�4��� &��R���RL�x~�\Ze��Gz���_�MD�~9���#�-Hso,���&:+����4�|b�s������!�R�.w�*�.w|�=��rO�Z\Z���l!�۩�twj;���#�<��QJc�7��8�ݗ8��<\"��4v�HsE7Z�H3;⥔�%�\'����Q�T�7Sg�R���N.�R�w-8��0��\"|f���2t]��/`��Qur���1�	����9�����[E��_����Œh���4���uy)�7+iieyc�G<����N窬+�x���c�\'l�j&�Q��B)^(�[������[>S�)_��?\'ѥ��ܹ͝V��R���X<�~�iZ�0�N��<4���s�_8\'����w<�Y�r2���1�6�������1��n�{3��`�\'��΋�K��z���!���0��:̻@��R��#\r����M+�A�b]^������S�����v�$ϛ§x1�ؠt���s:�ᦳ�W�M�wu6��dJ�������7��HjZ�ϱ���ĥ�=���K4�y�$�����/>~�k��z�2k����<���;��XC�/�5��@�=�2�y����X��Kt)yadnf�HK3Y�&�J�;�X>3\'3;�s����bY\'{�<�x�ck\\�Z�q�Ҝ�S�9VVV�4��R&q)N���:�k�&�m�i+�ZW����҈G\\�y\n��o\'�{/��Mq�R�lCO�%0Ocll�mۤ�I;nv�&�M�q�����Aύ�<�t����E!�v�'),(117460,1,'�\0\0\0b\0\0x�����@�?[�wh�q)��\'`-� �.E��W��X�,f����93OJ��@�ǝ5v�R�P���S&&T|�l�&�Θ2�&*�m̈\ne)9q}�$y4d�\"�N�k��F�����\Z����T��	_��0�r����.unh��z�r� uɲ�XT@�A4-��S�h�\\T;�=1-�/(g���\\�k���V�����e}����U2'),(117460,2,'�\0\0\0\0\0\0x���1�@D�-	w ��6T\n�\'������.q��鼚#++����gf�,ؒ2p�%��↣�bرdÊ��@��$^J5�\'5���P[���O����\'�}�E�cJ�sj\n5Z56ڮD��K�Q�Vԉ\'rF{�������,');
/*!40000 ALTER TABLE `player_settings` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-05-06  2:41:44
