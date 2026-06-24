# Доступы для агента (tafi / tafimed.ru)

Документ **не хранит пароли и ключи**. Только чеклист, хосты и команды.

Последнее обновление: **2026-06-24**.

## 0. Быстрый старт

```bash
cd ~/Projects/tafi
git pull origin main
git status -sb
curl -sS -o /dev/null -w "%{http_code}\n" https://tafimed.ru/
```

## 1. Два git — разные роли

На проде сайт живёт в репозитории **ITB-dev**; параллельно есть **твой** репозиторий для мелких правок в рамках своей работы. Это нормальная схема, главное — не смешивать git на VPS.

| | **Твой репо (работа)** | **Prod VPS** (`/home/bitrix/www`) |
|---|---|---|
| Remote | `github.com/Voynere/tafi` | `git.itb-dev.ru/ITB-dev/tafimed.ru` |
| Ветка | `main` | `master` |
| Назначение | история **твоих** правок, Cursor, откат | основной код сайта, ведут **ITB-dev** |

### Твой workflow (мелкие правки)

1. Правишь локально в `~/Projects/tafi` → commit → `git push origin main` (GitHub).
2. На prod выкладываешь **только затронутые файлы** (`scp` / `rsync` по пути), не весь проект.
3. Перед перезаписью — бэкап на сервере: `cp file file.bak-$(date +%Y%m%d)`.
4. Prod smoke (`curl` 200).

```bash
# пример: одна правка в шаблоне
scp ~/Projects/tafi/local/templates/aspro_max/js/custom.js \
  tafi:/home/bitrix/www/local/templates/aspro_max/js/custom.js
```

### На prod git ITB-dev — не трогать

- **Не делать** на сервере: `git pull`, `git push`, `merge`, `reset`, коммиты.
- ITB-dev деплоит и мержит через свой `git.itb-dev.ru`; случайный git на VPS может сломать их выкладку или твои файлы при их pull.
- Ты **не подменяешь** их репо — только точечно кладёшь свои файлы поверх рабочего каталога.

Итого: **история твоих фиксов — GitHub `tafi`; выкладка на сайт — scp; git на VPS — зона ITB-dev.**

## 2. Git и GitHub (локально)

| Что | Значение |
|-----|----------|
| Репозиторий | https://github.com/Voynere/tafi |
| SSH remote | `git@github.com:Voynere/tafi.git` |
| Рабочая ветка | **`main`** (ветки `dev` нет) |
| GitHub Actions | **не настроены** (deploy workflow отсутствует) |

```bash
git remote -v
git fetch origin && git status -sb
gh repo view Voynere/tafi --json defaultBranchRef
```

### Push из Cursor

- Предпочтительно **SSH** (`git@github.com:Voynere/tafi.git`).
- HTTPS без credential helper в неинтерактивной среде может падать — переключи remote на SSH.

## 3. Prod (tafimed.ru)

| Параметр | Значение |
|----------|----------|
| Сайт | https://tafimed.ru/ |
| CMS | 1С-Битрикс + шаблон Aspro.Max |
| Хостинг | Beget Cloud VPS |
| IP | **62.113.97.133** |
| Document root | **`/home/bitrix/www/`** |
| Админка | https://tafimed.ru/bitrix/admin/ |

### SSH

Пользователь имеет **прямой prod-доступ**. Добавь alias в `~/.ssh/config` (пример):

```
Host tafi
    HostName 62.113.97.133
    Port 22
    User root
    IdentityFile ~/.ssh/id_ed25519
    IdentitiesOnly yes
```

Проверка:

```bash
ssh -o BatchMode=yes tafi "hostname; whoami; ls /home/bitrix/www/.git"
```

### Деплой (ручной, без CI)

1. `git push origin main` — только в **GitHub** (локально).
2. На prod — **`scp` / `rsync` только изменённых файлов** (см. §1). **Не** `git pull` на VPS.
3. Бэкап перезаписываемых файлов на сервере.
4. Сброс кеша Битрикс при необходимости (админка или `php -f .../bitrix/modules/main/tools/cache_clear.php`).
5. Prod smoke (см. ниже).

**Не** коммить: `dbconn.php`, `/upload/*`, ядро `/bitrix/*` (кроме исключений из `.gitignore`).

## 4. Prod smoke после выкладки

```bash
curl -sS -o /dev/null -w "home:%{http_code}\n" https://tafimed.ru/
curl -sS -o /dev/null -w "catalog:%{http_code}\n" https://tafimed.ru/catalog/
```

Ожидание: **200** на публичных страницах. 500/502 → логи на сервере → fix → commit → push.

## 5. Push и CI/CD (текущее состояние)

1. **Каждый push:** commit → `git push origin main`.
2. **CI:** GitHub Actions **пока нет** — проверяй prod smoke вместо `gh run list`.
3. Когда появится `.github/workflows/deploy.yml` — см. `.cursor/rules/dev-commit-push-ci.mdc` и § CI в этом файле.

## 6. Структура кода (для агента)

| Путь | Назначение |
|------|------------|
| `local/modules/` | Кастомные модули (itb.*, beeralex.core, …) |
| `local/php_interface/` | init.php, миграции, классы |
| `local/templates/` | Шаблоны Aspro (aspro_max, aspro_max_v2, …) |
| `local/components/` | Кастомные компоненты |
| `ajax/` | AJAX-обработчики |
| `bitrix/templates/` | Шаблоны в git (частично) |

См. также `README.md`.
