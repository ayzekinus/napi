from django.urls import path

from .views import auth_bootstrap, auth_login, auth_logout, auth_permissions, auth_session, health

urlpatterns = [
    path('health', health, name='health'),
    path('auth/login', auth_login, name='auth-login'),
    path('auth/session', auth_session, name='auth-session'),
    path('auth/permissions', auth_permissions, name='auth-permissions'),
    path('auth/bootstrap', auth_bootstrap, name='auth-bootstrap'),
    path('auth/logout', auth_logout, name='auth-logout'),
]
