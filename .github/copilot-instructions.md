# Copilot — обязательные правила (tafimed.ru / tafi)

## Терминал

- **Запрещено**: «I don't have terminal tools available in this session», «нет терминала», «run manually».
- `git pull` / `git push` / curl smoke — **сразу** `#runInTerminal`.
- Prod SSH: `ssh -o BatchMode=yes tafi "..."` — см. `docs/AGENT_ACCESS.md`.

## Кастомный агент

- Выбирай **Agents → «Xiaomi MiMo V2.5 Pro»** (`.github/agents/`), не default Agent + только модель.

## Dev workflow

- **Фича готова → сразу commit → push в `main` → prod smoke** (`.cursor/rules/dev-commit-push-ci.mdc`).

## Dev: commit → push → prod

- **Фича готова → сразу commit → push в `main`**; не оставляй незапушенные коммиты.
- GitHub Actions **пока нет** — после push проверь `curl https://tafimed.ru/` (**200**).
- Когда появится `deploy.yml` — красный CI → fix → push **до зелёного**.

## Стек

- **1С-Битрикс** + Aspro.Max, PHP 7.4+, MySQL.
- Не путать с **monitoring-price** (`/tafimed/*` на price.smyalichi.ru) — это другой сервис.
