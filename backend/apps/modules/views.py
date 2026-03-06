from django.http import JsonResponse

from .services import get_dashboard_summary, list_acma_rapor, list_anakod, list_buluntu, list_demirbas, list_evrak, list_kullanicilar


LEGACY_MODULES = [
    {'key': 'anakod', 'status': 'in_progress'},
    {'key': 'buluntu', 'status': 'in_progress'},
    {'key': 'acma_rapor', 'status': 'in_progress'},
    {'key': 'evrak_yonetimi', 'status': 'in_progress'},
    {'key': 'demirbas', 'status': 'in_progress'},
    {'key': 'kullanicilar', 'status': 'in_progress'},
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


def acma_rapor_list(request):
    limit = _parse_limit(request.GET.get('limit', '50'))

    result = list_acma_rapor(limit=limit)
    return JsonResponse(
        {
            'items': result.items,
            'count': len(result.items),
            'degraded': result.degraded,
        }
    )



def demirbas_list(request):
    limit = _parse_limit(request.GET.get('limit', '50'))

    result = list_demirbas(limit=limit)
    return JsonResponse(
        {
            'items': result.items,
            'count': len(result.items),
            'degraded': result.degraded,
        }
    )



def kullanicilar_list(request):
    limit = _parse_limit(request.GET.get('limit', '50'))

    result = list_kullanicilar(limit=limit)
    return JsonResponse(
        {
            'items': result.items,
            'count': len(result.items),
            'degraded': result.degraded,
        }
    )



def dashboard_summary(_request):
    result = get_dashboard_summary()
    return JsonResponse(
        {
            'summary': result.data,
            'degraded': result.degraded,
        }
    )



def dashboard_bootstrap(_request):
    summary = get_dashboard_summary()
    return JsonResponse(
        {
            'modules': LEGACY_MODULES,
            'summary': summary.data,
            'degraded': summary.degraded,
        }
    )



def dashboard_bootstrap_full(request):
    limit = _parse_limit(request.GET.get('limit', '10'), default=10)

    summary = get_dashboard_summary()
    anakod = list_anakod(limit=limit)
    buluntu = list_buluntu(limit=limit)
    demirbas = list_demirbas(limit=limit)
    evrak = list_evrak(limit=limit)
    acma_rapor = list_acma_rapor(limit=limit)
    kullanicilar = list_kullanicilar(limit=limit)

    degraded_map = {
        'summary': summary.degraded,
        'anakod': anakod.degraded,
        'buluntu': buluntu.degraded,
        'demirbas': demirbas.degraded,
        'evrak': evrak.degraded,
        'acma_rapor': acma_rapor.degraded,
        'kullanicilar': kullanicilar.degraded,
    }

    degraded = any(degraded_map.values())

    return JsonResponse(
        {
            'modules': LEGACY_MODULES,
            'summary': summary.data,
            'degraded': degraded,
            'degraded_map': degraded_map,
            'data': {
                'anakod': anakod.items,
                'buluntu': buluntu.items,
                'demirbas': demirbas.items,
                'evrak': evrak.items,
                'acma_rapor': acma_rapor.items,
                'kullanicilar': kullanicilar.items,
            },
        }
    )
