# Модуль itb.licencecheck

Краткое описание
- Модуль собирает дату истечения лицензии Bitrix и отправляет её на API менеджера.
- Поддерживает агент, который запускается раз в сутки и отправляет уведомление только один раз для конкретной даты окончания (\Itb\Licencecheck\LicenceCheckAgent::exec()). Агент ставится при установке модуля и удаляется после удаления.
- Логирование выполняется через Add2MessageLog / AddMessage2Log (fallback на error_log).

Модуль считается выключенным, если в настройках главного модуля (main) параметр `update_devsrv` установлен в 'Y' (что означает установка для разработки). В этом случае уведомления не отправляются.

[![PHP](https://img.shields.io/badge/PHP-5.6+-blue.svg)](https://www.php.net/)
[![Bitrix](https://img.shields.io/badge/Bitrix-14.0.0+-orange.svg)](https://www.bitrix24.ru/)

**Требования**
- Включён PHP cURL extension для отправки HTTP-запросов.

**Установка**
- Скопируйте папку модуля в `/local/modules/itb.licencecheck`.
- Установите модуль стандартными средствами Bitrix (через административную панель)

После установки модуля должен появится агент `\Itb\Licencecheck\LicenceCheckAgent::exec` в списке агентов, который будет выполняться раз в сутки.

**Установка через composer**

```json
"extra": {
  "installer-paths": {
    "local/modules/{$name}/": ["type:bitrix-module"]
  }
}
"repositories": [
  {
      "type": "vcs",
      "url": "https://git.itb-dev.ru/ITB-dev/itb.licencecheck.git"
  }
]
```
repositories добавляется для того, чтобы composer шел на наш гит за пакетом

и выполните

```bash
composer require itb/itb.licencecheck
```

и так же установите модуль в админке.

**Структура важных файлов**
- **Класс отправки:** [site/local/modules/itb.licencecheck/lib/BitrixLicenсeNotifier.php](site/local/modules/itb.licencecheck/lib/BitrixLicenсeNotifier.php) — формирует JSON и отправляет POST запрос на API.
- **Агент:** [site/local/modules/itb.licencecheck/lib/LicenceCheckAgent.php](site/local/modules/itb.licencecheck/lib/LicenceCheckAgent.php) — логика сравнения timestamp и вызова отправки.
- **Хелпер получения даты:** [site/local/modules/itb.licencecheck/lib/LicenceCheckHelper.php](site/local/modules/itb.licencecheck/lib/LicenceCheckHelper.php) — чтение данных из `CUpdateClientPartner::GetUpdatesList`.
- **Вспомогательные include:** [site/local/modules/itb.licencecheck/include.php](site/local/modules/itb.licencecheck/include.php) и [site/local/modules/itb.licencecheck/include/functions.php](site/local/modules/itb.licencecheck/include/functions.php).

**Опции модуля (Option keys)**
- `notified_timestamp` — хранит timestamp лицензии, для которого уже отправлялось уведомление.

**Логирование и отладка**
- По умолчанию модуль использует AddMessage2Log для записи сообщений. Рекомендуется объявить констанку `LOG_FILENAME`, иначе модуль сам ее объявит по пути `/bitrix/modules/error.log`

**Поведение при продлении лицензии**
- Механизм: агент читает текущую дату окончания лицензии. Если она равна `notified_timestamp` — уведомление не отправляется. Если отличается — отправляет уведомление и сохраняет новый `notified_timestamp`.

**Запуск из под крона**

Добавьте задачу для запуска файла `/path/to/module-itb.licencecheck/lib/licence_check.php`

Пример crontab (запуск каждый день в 9:00):
```txt
0 9 * * * php /path/to/module-itb.licencecheck/lib/licence_check.php
```

в таком случае не забудьте отключить агент, чтобы он не выполнялся дважды. Это можно сделать через админку в разделе "Агенты".