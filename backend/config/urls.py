from django.contrib import admin
from django.http import JsonResponse
from django.urls import include, path


def root_home(_request):
    return JsonResponse(
        {
            'service': 'napi-backend',
            'status': 'ok',
            'endpoints': ['/api/health', '/api/', '/api/modules/'],
        }
    )


urlpatterns = [
    path('', root_home),
    path('admin/', admin.site.urls),
    path('api/', include('apps.core.urls')),
    path('api/modules/', include('apps.modules.urls')),
]
