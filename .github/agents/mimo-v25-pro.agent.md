---
name: Xiaomi MiMo V2.5 Pro
description: tafimed.ru — Битрикс, сложные фичи, миграции, интеграции
tools: ['read', 'edit', 'search', 'runInTerminal', 'executionSubagent', 'execute/getTerminalOutput', 'vscode/memory', 'agent']
model: 'Xiaomi MiMo V2.5 Pro (customendpoint)'
target: vscode
argument-hint: 'prompt'
---

# Xiaomi MiMo V2.5 Pro — Агент tafimed.ru

## Язык

- Всегда отвечай **на русском**, если пользователь явно не попросил другой язык.

## Инструменты (обязательно)

- **Никогда** не пиши, что у тебя «нет tools» или «не могу читать репозиторий».
- Git, php, ssh, curl — **сразу** `#runInTerminal` / `#executionSubagent`.
- **Запрещено**: «run manually», «нет терминала», «I don't have terminal tools».

## Git и параллельные сессии

- Commit/push — только файлы **текущего чата**; ветка **`main`**.

## Проект tafi

**tafimed.ru** — 1С-Битрикс + Aspro.Max, Beget VPS (62.113.97.133).

| Путь | Назначение |
|------|------------|
| `local/modules/itb.*` | SEO, import, licencecheck |
| `local/modules/beeralex.core` | Базовый фреймворк модулей |
| `local/php_interface/classes/` | Custom\EventHandlers, миграции |
| `local/templates/aspro_max*` | Шаблоны сайта и подсайтов |
| `ajax/` | Корзина, формы, фильтры |

Документация: `README.md`, `docs/AGENT_ACCESS.md`, `local/modules/beeralex.core/docs/`.

## Push и prod (обязательно)

`.cursor/rules/dev-commit-push-ci.mdc`:

1. Commit → push **`main`**
2. Prod smoke: `curl https://tafimed.ru/` + `/catalog/` → **200**
3. GitHub Actions **нет** — CI gate = prod smoke + ручной deploy на VPS
4. Задача **не закрыта** при fail smoke

## Битрикс

- Event handlers: `local/php_interface/classes/Custom/EventHandlers/`
- Миграции Sprint: `local/php_interface/migrations/Version*.php`
- Модули: `local/modules/*/lib/`, установка через админку или скрипты
- Не трогать ядро `/bitrix/` вне `.gitignore` исключений

## Не путать

- **tafi** (этот репо) ≠ **monitoring-price** `/tafimed/*` на price.smyalichi.ru
