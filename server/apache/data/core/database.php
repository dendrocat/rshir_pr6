<?php
    require_once "consts.php";

    class DatabaseSQL {
        public static function getConnection() {
            $mysql = new mysqli(Consts::sql_host, 
                                Consts::sql_user, 
                                Consts::sql_pass, 
                                Consts::sql_db_name);
            return $mysql;
        }

        public static function query($q) {
            $mysql = self::getConnection();
            if (!$mysql) {
                echo "Connection failed";
                return "";
            }

            $res = $mysql->query($q);
            $mysql->close();
            return $res;
        }
    }
    
    class DatabaseRedis {
        public static $was_logged = false;

        private static function getConnection() {
            $r = new Redis();
            $r->connect(Consts::redis_host, Consts::redis_port);
            return $r;
        }

        public static function loadLastUserData() {
            $r = self::getConnection();

            $login = "null";
            $pass = "null";
            if (!$r->exists(Consts::kLogin)) {
                if (isset($_SERVER['PHP_AUTH_USER'])) {
                    $login = $_SERVER['PHP_AUTH_USER'];
                    $pass = $_SERVER['PHP_AUTH_PW'];
                }
            }
            else {
                $login = $r->get(Consts::kLogin);
                $pass = $r->get(Consts::kPass);
            }
            
            $_SESSION[Consts::kLogin] = $login;
            $_SESSION[Consts::kPass] = $pass;
            $_SESSION[Consts::kTheme] = Consts::start_theme;

        }

        public static function loadUserDataTheme() {
            $kLogin = Consts::kLogin;
            $kPass = Consts::kPass;
            $kTheme = Consts::kTheme;

            $_SESSION[$kLogin] = $_SERVER['PHP_AUTH_USER'];
            $_SESSION[$kPass] = $_SERVER['PHP_AUTH_PW'];

            $r = self::getConnection();
            if ($r->exists($_SESSION[$kLogin]))
                $_SESSION[$kTheme] = $r->hget($_SESSION[$kLogin], $kTheme);
        }

        public static function saveTheme() {
            $login = $_SESSION[Consts::kLogin];
            $kTheme = Consts::kTheme;

            $r = self::getConnection();
            if ($r->exists($login)) {
                $session_data = array($kTheme => $_SESSION[$kTheme]);
                $r->hmset($login, $session_data);
            }
        }

        public static function saveSessionData() {
            $kLogin = Consts::kLogin;
            $kPass = Consts::kPass;
            $kTheme = Consts::kTheme;

            $r = self::getConnection();
            $r->set($kLogin, $_SESSION[$kLogin]);
            $r->set($kPass, $_SESSION[$kPass]);

            $session_data = array($kTheme => $_SESSION[$kTheme]);

            $r->hmset($_SESSION[$kLogin], $session_data);
        }
    }
?>