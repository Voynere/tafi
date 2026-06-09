---
name: Xiaomi MiMo V2.5
description: tafimed.ru — Битрикс, Aspro.Max, быстрые правки
tools: ['read', 'edit', 'search', 'runInTerminal', 'executionSubagent', 'execute/getTerminalOutput', 'vscode/memory', 'agent']
model: 'Xiaomi MiMo V2.5 (customendpoint)'
target: vscode
argument-hint: 'prompt'
---

# Xiaomi MiMo V2.5 — Агент tafimed.ru

## Язык

- Всегда отвечай **на русском**, если пользователь явно не попросил другой язык.

## Инструменты (обязательно)

- **Никогда** не пиши, что у тебя «нет tools», «нет доступа к файлам/терминалу» или «не могу читать репозиторий».
- **Не проси** пользователя прислать структуру папок или файлы — сначала `#search` и `#read`.
- Для git, php, deploy, ssh — **сразу** `#runInTerminal` или `#executionSubagent`.
- Ошибка tool — retry; **не** fallback «скинь файлы» / «выполните сами».

### Терминал (строго)

- **Запрещено** писать: «I don't have terminal tools available in this session», «нет run_in_terminal», «выполните git pull самостоятельно», «run manually».
- На `git pull` / `git push` / `git status` / `php` / `curl` — **сразу** `#runInTerminal`.

## Git и параллельные сессии

- **Push / commit** — только изменения **текущего чата**.
- Перед commit: `git status` / `git diff` — stage только свои файлы.
- Рабочая ветка — **`main`**.

## Проект tafi (tafimed.ru)

Сайт сети медицинских центров **«ТАФИ-Диагностика»**. CMS: **1С-Битрикс**, шаблон **Aspro.Max**.

| Путь | Назначение |
|------|------------|
| `local/modules/` | Кастомные модули (itb.*, beeralex.core, …) |
| `local/php_interface/` | init.php, миграции Sprint, event handlers |
| `local/templates/` | aspro_max, aspro_max_v2, aspro_max_tafi-krasota |
| `local/components/` | Кастомные компоненты (itb/*) |
| `ajax/` | AJAX-обработчики каталога, корзины, форм |
| `bitrix/templates/` | Шаблоны в git (частично) |

Документация: `README.md`, `docs/AGENT_ACCESS.md`.

## Быстрый старт (выполняй сам)

```bash
git pull origin main
git status
curl -sS -o /dev/null -w "%{http_code}\n" https://tafimed.ru/
```

Prod SSH: alias `tafi` → VPS Beget **62.113.97.133** (см. `docs/AGENT_ACCESS.md`).

## Битрикс (обязательно)

- Новые обработчики — через `local/php_interface/init.php` или модули в `local/modules/`.
- Миграции — `local/php_interface/migrations/` (Sprint Migration).
- **Не** коммить: `dbconn.php`, `/upload/*`, ядро `/bitrix/*` (кроме исключений `.gitignore`).
- AJAX: `define('NO_AGENT_CHECK', true)` где принято в проекте.

## Push и prod (обязательно)

См. `.cursor/rules/dev-commit-push-ci.mdc`. **GitHub Actions пока нет:**

| # | Действие |
|---|----------|
| 0 | **Commit сразу** после фичи; **push в `main`** |
| 1 | Prod smoke: `curl https://tafimed.ru/` → **200** |
| 2 | При ошибках — SSH prod → логи → fix → push (**repeat**) |
| 3 | Сообщи **commit SHA + HTTP-коды** |

**Задача не закрыта** при падении prod smoke после push.

## Задачи агента

- Правки шаблонов Aspro, компонентов, `local/modules/`
- Миграции iblock/HL при структурных изменениях
- Не коммитить секреты, upload, бэкапы БД
