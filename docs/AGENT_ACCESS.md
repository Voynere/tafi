# Доступы для агента (tafi / tafimed.ru)

Документ **не хранит пароли и ключи**. Только чеклист, хосты и команды.

Последнее обновление: **2026-06-01**.

## 0. Быстрый старт

```bash
cd ~/Projects/tafi
git pull origin main
git status -sb
curl -sS -o /dev/null -w "%{http_code}\n" https://tafimed.ru/
```

## 1. Git и GitHub

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

## 2. Prod (tafimed.ru)

| Параметр | Значение |
|----------|----------|
| Сайт | https://tafimed.ru/ |
| CMS | 1С-Битрикс + шаблон Aspro.Max |
| Хостинг | Beget Cloud VPS |
| IP | **62.113.97.133** |
| Админка | https://tafimed.ru/bitrix/admin/ |

### SSH

Пользователь имеет **прямой prod-доступ**. Добавь alias в `~/.ssh/config` (пример):

```
Host tafi
    HostName 62.113.97.133
    User <prod-user>
    IdentityFile ~/.ssh/id_ed25519
    IdentitiesOnly yes
```

Проверка:

```bash
ssh -o BatchMode=yes tafi "hostname; pwd"
```

> Точный путь document root и пользователь на VPS — уточни у владельца или по `nginx -T` / `apachectl -S` на сервере.

### Деплой (ручной, без CI)

Типичный поток для Битрикс-репозитория с `local/` и шаблонами:

1. `git push origin main` с рабочей машины.
2. На prod: `git pull` в каталоге сайта **или** rsync изменённых путей (`local/`, `ajax/`, шаблоны).
3. Сброс кеша Битрикс при необходимости (админка или `php -f .../bitrix/modules/main/tools/cache_clear.php`).
4. Prod smoke (см. ниже).

**Не** коммить: `dbconn.php`, `/upload/*`, ядро `/bitrix/*` (кроме исключений из `.gitignore`).

## 3. Prod smoke после push

```bash
curl -sS -o /dev/null -w "home:%{http_code}\n" https://tafimed.ru/
curl -sS -o /dev/null -w "catalog:%{http_code}\n" https://tafimed.ru/catalog/
```

Ожидание: **200** на публичных страницах. 500/502 → логи на сервере → fix → commit → push.

## 4. Push и CI/CD (текущее состояние)

1. **Каждый push:** commit → `git push origin main`.
2. **CI:** GitHub Actions **пока нет** — проверяй prod smoke вместо `gh run list`.
3. Когда появится `.github/workflows/deploy.yml` — см. `.cursor/rules/dev-commit-push-ci.mdc` и § CI в этом файле.

## 5. Структура кода (для агента)

| Путь | Назначение |
|------|------------|
| `local/modules/` | Кастомные модули (itb.*, beeralex.core, …) |
| `local/php_interface/` | init.php, миграции, классы |
| `local/templates/` | Шаблоны Aspro (aspro_max, aspro_max_v2, …) |
| `local/components/` | Кастомные компоненты |
| `ajax/` | AJAX-обработчики |
| `bitrix/templates/` | Шаблоны в git (частично) |

См. также `README.md`.
