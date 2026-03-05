from django.http import JsonResponse

from .services import list_anakod, list_buluntu, list_evrak


LEGACY_MODULES = [
    {'key': 'anakod', 'status': 'in_progress'},
    {'key': 'buluntu', 'status': 'in_progress'},
    {'key': 'acma_rapor', 'status': 'planned'},
    {'key': 'evrak_yonetimi', 'status': 'in_progress'},
    {'key': 'demirbas', 'status': 'planned'},
    {'key': 'kullanicilar', 'status': 'planned'},
]


def _parse_limit(raw_limit: str, default: int = 50) -> int:
    try:
        return int(raw_limit)
    except ValueError:
        return default


def module_inventory(_request):
    return JsonResponse({'modules': LEGACY_MODULES})


def anakod_list(request):
    limit = _parse_limit(request.GET.get('limit', '50'))

    result = list_anakod(limit=limit)
    return JsonResponse(
        {
            'items': result.items,
            'count': len(result.items),
            'degraded': result.degraded,
        }
    )


def buluntu_list(request):
    limit = _parse_limit(request.GET.get('limit', '50'))

    result = list_buluntu(limit=limit)
    return JsonResponse(
        {
            'items': result.items,
            'count': len(result.items),
            'degraded': result.degraded,
        }
    )


def evrak_list(request):
    limit = _parse_limit(request.GET.get('limit', '50'))

    result = list_evrak(limit=limit)
    return JsonResponse(
        {
            'items': result.items,
            'count': len(result.items),
            'degraded': result.degraded,
        }
    )
