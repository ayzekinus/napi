#!/usr/bin/env python3
"""Generate a timestamped live-evidence markdown file from the template."""

from __future__ import annotations

from datetime import datetime, timezone
from pathlib import Path

ROOT = Path(__file__).resolve().parents[2]
TEMPLATE_PATH = ROOT / 'MIGRATION_LIVE_EVIDENCE_TEMPLATE.md'
OUT_DIR = ROOT / 'migration-evidence'


def main() -> int:
    if not TEMPLATE_PATH.exists():
        print(f'Template not found: {TEMPLATE_PATH}')
        return 1

    timestamp = datetime.now(timezone.utc).strftime('%Y%m%d-%H%M%SZ')
    OUT_DIR.mkdir(parents=True, exist_ok=True)

    out_path = OUT_DIR / f'live-evidence-{timestamp}.md'
    content = TEMPLATE_PATH.read_text(encoding='utf-8')
    content = f'<!-- generated_at_utc: {timestamp} -->\n\n' + content
    out_path.write_text(content, encoding='utf-8')

    print(out_path)
    return 0


if __name__ == '__main__':
    raise SystemExit(main())
