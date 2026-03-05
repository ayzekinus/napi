from django.http import JsonResponse


LEGACY_MODULES = [
    {'key': 'anakod', 'status': 'planned'},
    {'key': 'buluntu', 'status': 'planned'},
    {'key': 'acma_rapor', 'status': 'planned'},
    {'key': 'evrak_yonetimi', 'status': 'planned'},
    {'key': 'demirbas', 'status': 'planned'},
    {'key': 'kullanicilar', 'status': 'planned'},
]


def module_inventory(_request):
    return JsonResponse({'modules': LEGACY_MODULES})
