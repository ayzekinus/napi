from django.http import JsonResponse

from .services import list_anakod


LEGACY_MODULES = [
    {'key': 'anakod', 'status': 'in_progress'},
    {'key': 'buluntu', 'status': 'planned'},
    {'key': 'acma_rapor', 'status': 'planned'},
    {'key': 'evrak_yonetimi', 'status': 'planned'},
    {'key': 'demirbas', 'status': 'planned'},
    {'key': 'kullanicilar', 'status': 'planned'},
]


def module_inventory(_request):
    return JsonResponse({'modules': LEGACY_MODULES})


def anakod_list(request):
    raw_limit = request.GET.get('limit', '50')
    try:
        limit = int(raw_limit)
    except ValueError:
        limit = 50

    result = list_anakod(limit=limit)
    return JsonResponse(
        {
            'items': result.items,
            'count': len(result.items),
            'degraded': result.degraded,
        }
    )
