# itb.seo
# Модуль СЕО везде
____
## Установка 

### 1. 

добавьте в composer.json экстра опцию, чтобы композер поставил пакет в local/modules

```json
"extra": {
  "installer-paths": {
    "local/modules/{$name}/": ["type:bitrix-module"]
  }
}
"repositories": [
  {
      "type": "vcs",
      "url": "https://git.itb-dev.ru/ITB-dev/itb.seo.git"
  }
]
```
repositories добавляется для того, чтобы composer шел на наш гит за пакетом

и выполните 

```bash
composer require itb/itb.seo
```

после скачивания, проверить установку модуля beeralex.core, он так же доступен на нашем гите - https://git.itb-dev.ru/ITB-dev/beeralex.core

Он скачается с packagegist, либо добавьте в composer.json репозиторий с нашего гита

```json
{
    "type": "vcs",
    "url": "https://git.itb-dev.ru/ITB-dev/beeralex.core"
}
```

### 2. Загрузите в папку на сайте  /local/modules/
![Alt-img1](https://images.itb-bx.ru/git/seoeverywhere/1_upload.png)
### 2.Заходим в админку 
![Alt-img2](https://images.itb-bx.ru/git/seoeverywhere/2_modules_path.png)
### 3. Нажимаем кнопку установить
![Alt-img2](https://images.itb-bx.ru/git/seoeverywhere/3_module_in_list.png)
### 4. Вывод на странице
a. Вставить данный код на странице категории где будет вывод тегов.
```php
<?$APPLICATION->IncludeComponent("itb:seo.tags", "", Array(), false);?>
```
b. Обернуть текст на страницах категории в этот тег
```html
<!-- PATTERN --> Замена <!-- END_PATTERN -->
```
____
## Настройки модуля
![Alt-img2](https://images.itb-bx.ru/git/seoeverywhere/4_module_settings.png)
### 1. Список метатегов
 ![Alt-img2](https://images.itb-bx.ru/git/seoeverywhere/5_module_settings.png)
Тут всё понятно.
Только всегда обращаем внимание, что если есть поддомены и тд то добавляем URL без адреса сайта к примеру - /katalog/gitary/
### 2. Список ссылок
![Alt-img2](https://images.itb-bx.ru/git/seoeverywhere/6_module_settings.png)
Старый адрес
Новый ЧПУ адрес
Смотрим за / в конце
Так же смотрим что бы если заполнено в 1 пункте то поменять адрес ссылки на новую
Смотрим на то что если есть поддомены то без адреса сайта
### 3. Список тегов
![Alt-img2](https://images.itb-bx.ru/git/seoeverywhere/7_module_setting.png)
Добавляем для поддоменов без адреса сайта
![Alt-img2](https://images.itb-bx.ru/git/seoeverywhere/8_view_tags_site.png)
### 4. Настройки модуля
В качестве инфоблока указать инфоблок с товарами, например:
![Alt-img2](https://images.itb-bx.ru/git/seoeverywhere/9_module_settings.png)
В строку с массивом фильтра прописываем значение, указанное в скобках:
![Alt-img2](https://images.itb-bx.ru/git/seoeverywhere/10_module_settins.png)
Выбираем индексный файл каталога (index.php). Если у нас url вида 
/catalog/letnyaya_spetsodezhda/**** - выбираем файл:
![Alt-img2](https://images.itb-bx.ru/git/seoeverywhere/11_public_file.png)
Нажимаем «Применить». После этого нужно подправить значения в ЧПУ (добавить в начале «/», если он отсутствует): 
![Alt-img2](https://images.itb-bx.ru/git/seoeverywhere/12_module_settins.png)
Применяем, и переходим к заполненю генерации заголовков и мета-тегов: 
![Alt-img2](https://images.itb-bx.ru/git/seoeverywhere/13_module_settings.png)
Под блоком с полями для заполнения отразились все доступные фильтры. Для вставки переменной, нужно установить курсор в нужное место, и кликнуть на нужное свойство, например:
![Alt-img2](https://images.itb-bx.ru/git/seoeverywhere/14_module_settings.png)
Если нужно, чтобы после значения фильтра был пробел – пишем так:
```
{153.FILTER_TYPE| }
```
Если нужно прописать значение с маленькой буквы:
```
{152.FILTER_COLOR|!-L}
```
Также доступно склонение по падежам. Примеры использования указаны чуть ниже списка свойств:
![Alt-img2](https://images.itb-bx.ru/git/seoeverywhere/15_module_settings.png)