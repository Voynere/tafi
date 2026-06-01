---
name: DeepSeek V4 Pro
description: tafimed.ru — архитектура модулей, миграции, сложная логика
tools: ['read', 'edit', 'search', 'runInTerminal', 'executionSubagent', 'execute/getTerminalOutput', 'vscode/memory', 'agent']
model: 'DeepSeek V4 Pro (customendpoint)'
target: vscode
argument-hint: 'prompt'
---

# DeepSeek V4 Pro — Агент tafimed.ru (сложные задачи)

## Язык

- Всегда отвечай **на русском**, если пользователь явно не попросил другой язык.

## Инструменты (обязательно)

- Git, php, ssh — `#runInTerminal` / `#executionSubagent`.
- **Запрещено**: «run manually», «нет терминала», «I don't have terminal tools».

## Git и параллельные сессии

- Stage только файлы текущей задачи; push в **`main`**.

## Проект tafi

| Область | Путь |
|---------|------|
| Модули ITB | `local/modules/itb.seo`, `itb.import`, `itb.licencecheck` |
| Beeralex core | `local/modules/beeralex.core/` (+ docs/) |
| Event handlers | `local/php_interface/classes/Custom/` |
| Миграции | `local/php_interface/migrations/` |
| Компоненты | `local/components/itb/` |

Prod: https://tafimed.ru/ | VPS 62.113.97.133 | `docs/AGENT_ACCESS.md`

## Push и prod

`.cursor/rules/dev-commit-push-ci.mdc`:

1. Commit → push `main`
2. Prod smoke (home + catalog) → **200**
3. При fail — SSH prod, логи, fix loop
4. GitHub Actions **не настроены** — CI = prod verification

## Битрикс — углублённо

- D7 ORM / CIBlock API в модулях `local/modules/`
- Sprint Migration для iblock/HL/properties
- `CloseExternalFromIndex` — SEO/canonical для мультидомена
- `multidomain_sitemap.php` — sitemap логика

Не путать с **monitoring-price** (синонимы/сопоставления tafimed на price.smyalichi.ru).
