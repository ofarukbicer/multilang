<?php

namespace Multilang;

class Multilang
{
    private $defaults = [
        'key' => 'lang', // GET değerinin key'ini ayarlar.
        'default' => 'tr', // Varsayılan dili ayarlar
        'debug' => false // Geliştirici modu varsayılan olarak kapalıdır hata gösterimi için true yapmanız lazımdır.
    ];
    private $options;
    private $langPaths;
    public function __construct($langPaths, array $options = [])
    {
        $options = array_merge($this->defaults, $options);
        $this->options = $options;
        $this->langPaths = $langPaths;
        if (file_exists($langPaths)) {
            if ($_SERVER["REQUEST_METHOD"] == "GET") {
                if ($_GET == []) {
                    if (!isset($_GET[$options["key"]]) || $_GET[$options["key"]] == null) {
                        header("Location: ?".$options["key"]."=".$options["default"]);
                    }
                }else {
                    $getsRedirect = "";
                    $i = 0;
                    foreach ($_GET as $key => $value) {
                        $i++;
                        if ($i == 1) {
                            if ($value == "") {
                                $getsRedirect .= "?" . $key;
                            }else {
                                $getsRedirect .= "?" . $key . "=" . $value;
                            }
                        }else {
                            if ($value == "") {
                                $getsRedirect .= "&" . $key;
                            }else {
                                $getsRedirect .= "&" . $key . "=" . $value;
                            }
                        }
                    }
                    if (!isset($_GET[$options["key"]]) || $_GET[$options["key"]] == null) {
                        header("Location: ".$getsRedirect."&".$options["key"]."=".$options["default"]);
                    }
                }
                if ($this->options['debug'] == true) {
                    if (!file_exists($this->langPaths."/".$_GET[$this->options["key"]].".php")) {
                        $this->showError($this->langPaths."/".$_GET[$this->options["key"]].".php Dosyasını bulamadık onu oluşturmanız lazım.","Dosya hatası!");
                    }
                }
            }else {
                $this->showError("Dil desteği için GET methodunu kullanmalısınız.","Method hatası!");
            }
        }else {
            $this->showError($langPaths.' adlı dil klasörünüz bulunamadı',"Klasör hatası!");
        }
    }

    public function load($attr, $default = "")
    {
        if (file_exists($this->langPaths."/".$_GET[$this->options["key"]].".php")) {
            $lang = require($this->langPaths."/".$_GET[$this->options["key"]].".php");

            if (!isset($lang[$attr])) {
                return "Multilang->$attr";
            }else {
                return $lang[$attr];
            }
        }else {
            $lang = require($this->langPaths."/".$this->options["default"].".php");

            if (!isset($lang[$attr])) {
                return "Multilang->$attr";
            }else {
                return $lang[$attr];
            }
        }
    }

    private function showError($errorMsg, $title = null)
    {
        if ($this->options['debug'] == true) {
            $this->errorTemplate($errorMsg, $title);
            if ($title == "Klasör hatası!") {
                die();
            }
        }
    }

    private function errorTemplate($errorMsg, $title = null)
    {
        ?>
        <div class="db-error-msg-content">
            <div class="db-error-title">
                <?= $title ? $title : __CLASS__ . ' Hatası:' ?>
            </div>
            <div class="db-error-msg"><?= $errorMsg ?></div>
        </div>
        <style>
            .db-error-msg-content {
                padding: 15px;
                border-left: 5px solid #c00000;
                background: rgba(192, 0, 0, 0.06);
                background: #f8f8f8;
                margin-bottom: 10px;
            }

            .db-error-title {
                font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
                font-size: 16px;
                font-weight: 500;
            }

            .db-error-msg {
                margin-top: 15px;
                font-size: 14px;
                font-family: Consolas, Monaco, Menlo, Lucida Console, Liberation Mono, DejaVu Sans Mono, Bitstream Vera Sans Mono, Courier New, monospace, sans-serif;
                color: #c00000;
            }
        </style>
        <?php
    }
}