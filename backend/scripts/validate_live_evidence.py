#!/usr/bin/env python3
"""Validate a live-evidence markdown file has required filled sections."""

from __future__ import annotations

import re
import sys
from pathlib import Path

REQUIRED_MARKERS = [
    '- Tarih/Saat:',
    '- Ortam:',
    '- Sorumlu ekip:',
    '- Değişiklik referansı:',
    '- Cutover dry-run sonucu:',
    '- Rollback dry-run sonucu:',
    '- Trafik geçiş adımları (%):',
    '- Karar: continue / rollback',
    '- 0-6 saat özet:',
    '- 48-72 saat özet:',
    '- L1 sonucu:',
    '- L2 sonucu:',
    '- L3 sonucu:',
    '- Kalıcı geçiş onayı: approve / hold',
]

PLACEHOLDER_VALUES = {
    '',
    'n/a',
    'na',
    'todo',
    'tbd',
    '-',
}


def _extract_value(line: str) -> str:
    return line.split(':', 1)[1].strip() if ':' in line else ''


def main() -> int:
    if len(sys.argv) != 2:
        print('Usage: python3 backend/scripts/validate_live_evidence.py <evidence_file.md>')
        return 2

    file_path = Path(sys.argv[1])
    if not file_path.exists():
        print(f'ERROR: file not found: {file_path}')
        return 2

    content = file_path.read_text(encoding='utf-8')
    lines = content.splitlines()

    missing_markers: list[str] = []
    empty_fields: list[str] = []

    for marker in REQUIRED_MARKERS:
        matched_line = next((ln for ln in lines if ln.strip().startswith(marker)), None)
        if matched_line is None:
            missing_markers.append(marker)
            continue

        value = _extract_value(matched_line).lower()
        value = re.sub(r'\s+', ' ', value).strip()
        if value in PLACEHOLDER_VALUES:
            empty_fields.append(marker)

    if missing_markers or empty_fields:
        print('VALIDATION_FAILED')
        if missing_markers:
            print('missing_markers:')
            for marker in missing_markers:
                print(f'  - {marker}')
        if empty_fields:
            print('empty_fields:')
            for marker in empty_fields:
                print(f'  - {marker}')
        return 1

    print('VALIDATION_OK')
    return 0


if __name__ == '__main__':
    raise SystemExit(main())
