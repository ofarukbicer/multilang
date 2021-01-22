# 🌐 Multi Lang

## 📥 Kurulum

1. Composer bilgisayarınızda kurulu olması lazımdır.
2. Terminal'e `composer require omerfarukbicer0446/multilang` yazın.
3. Kurulum bitti :) 

## 📒 Kullanım
index.php ya da main.php dosyanıza bunları ekleyin.
```php
require "./vendor/autoload.php"; // autoload dosyasını require ettiyseniz bunu eklemenize gerek yoktur.

use Multilang\Multilang;

$lang = new Multilang("lang");
/*
    Ayarlarını değiştirmek istiyorsanız.
    
    $lang = new Multilang("lang",[
        'key' => 'lang',
        'default' => 'tr',
        'debug' => false
    ]);
*/
```
• İlk olarak dil klasörünüzü oluşturun ör: ismi lang olabilir.

• İstediğiniz dilin dosyasını php formatında oluşturun not: dil kısaltmalarıyla oluşturmanızı tavsiye ederim. 

ör: tr.php 

içeriği böyle olmalıdır.
```php
<?php

return [
    "key" => "o dile karşılığı",
    "key 2" => "o dile karşılığı 2"
];
```

• son adım dil dosyalarındaki değişkenleri kullanma
```php
echo $lang->load("key");
```

### Ayarlar

```php
[
    'key' => 'lang', // GET değerinin key'ini ayarlar.
    'default' => 'tr', // Varsayılan dili ayarlar
    'debug' => false // Geliştirici modu açar kapatır.
];

// Kullanımı
$lang = new Multilang("lang",[
    'key' => 'lang',
    'default' => 'tr',
    'debug' => false
]);
```

Not: dilleri kullanmak için URL kısmına lang=tr bunu otamatik ayarlar değiştirmek isterseniz tr yerine başka bi dil yazmanız gerekir.

## 🌐 Telif Hakkı ve Lisans

* *Copyright (C) 2021 by* [omerfarukbicer0446](https://github.com/omerfarukbicer0446) ❤️️
* [MIT LICENSE](https://github.com/omerfarukbicer0446/multilang/blob/master/LICENSE) *Koşullarına göre lisanslanmıştır..*

## ♻️ İletişim

*Benimle iletişime geçmek isterseniz, **Telegram**'dan mesaj göndermekten çekinmeyin;* [@omerfarukbicer](https://t.me/omerfarukbicer)


> **[www.cibza.com](https://www.cibza.com)** *için yazılmıştır..*
