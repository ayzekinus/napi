import json

from django.http import JsonResponse
from django.views.decorators.csrf import csrf_exempt
from django.views.decorators.http import require_GET

from .services import parse_legacy_permissions, verify_legacy_credentials


_SUPERVISOR_PERMISSIONS = {
    'anakod_list': True,
    'anakod_write': True,
    'buluntu_list': True,
    'buluntu_write': True,
    'acma_rapor_list': True,
    'acma_rapor_write': True,
    'evrak_list': True,
    'evrak_write': True,
    'demirbas_list': True,
    'demirbas_write': True,
    'kullanicilar_list': True,
    'kullanicilar_write': True,
}


@require_GET
def health(_request):
    return JsonResponse({'ok': True, 'service': 'django-backend'})


def _session_user(request):
    return {
        'ID': request.session.get('ID'),
        'kullanici': request.session.get('kullanici'),
        'adsoyad': request.session.get('adsoyad'),
        'yetki': request.session.get('yetki'),
        'kisitlamalar': request.session.get('kisitlamalar'),
    }


def _session_permissions(request):
    if request.session.get('yetki') == 'S':
        return _SUPERVISOR_PERMISSIONS, True

    return parse_legacy_permissions(request.session.get('kisitlamalar')), False


@csrf_exempt
def auth_login(request):
    if request.method != 'POST':
        return JsonResponse({'success': False, 'reason': 'method_not_allowed'}, status=405)

    try:
        payload = json.loads(request.body or '{}')
    except json.JSONDecodeError:
        payload = {}

    username = str(payload.get('username', '')).strip()
    password = str(payload.get('password', ''))

    result = verify_legacy_credentials(username=username, password=password)

    if not result.success:
        return JsonResponse({'success': False, 'reason': result.reason}, status=401)

    request.session['oturum'] = True
    request.session['ID'] = result.user['ID']
    request.session['kullanici'] = result.user['kullanici']
    request.session['adsoyad'] = result.user['adsoyad']
    request.session['yetki'] = result.user['yetki']
    request.session['kisitlamalar'] = result.user['kisitlamalar']

    return JsonResponse({'success': True, 'user': result.user})


@require_GET
def auth_session(request):
    if not request.session.get('oturum'):
        return JsonResponse({'authenticated': False}, status=401)

    return JsonResponse({'authenticated': True, 'user': _session_user(request)})


@require_GET
def auth_permissions(request):
    if not request.session.get('oturum'):
        return JsonResponse({'authenticated': False}, status=401)

    permissions, is_supervisor = _session_permissions(request)
    return JsonResponse(
        {
            'authenticated': True,
            'is_supervisor': is_supervisor,
            'permissions': permissions,
        }
    )


@require_GET
def auth_bootstrap(request):
    if not request.session.get('oturum'):
        return JsonResponse({'authenticated': False}, status=401)

    permissions, is_supervisor = _session_permissions(request)
    return JsonResponse(
        {
            'authenticated': True,
            'user': _session_user(request),
            'is_supervisor': is_supervisor,
            'permissions': permissions,
        }
    )


@csrf_exempt
def auth_logout(request):
    if request.method != 'POST':
        return JsonResponse({'success': False, 'reason': 'method_not_allowed'}, status=405)

    request.session.flush()
    return JsonResponse({'success': True})
