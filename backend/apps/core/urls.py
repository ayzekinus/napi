from django.urls import path

from .views import auth_login, auth_logout, auth_session, health

urlpatterns = [
    path('health', health, name='health'),
    path('auth/login', auth_login, name='auth-login'),
    path('auth/session', auth_session, name='auth-session'),
    path('auth/logout', auth_logout, name='auth-logout'),
]
