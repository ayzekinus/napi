from django.urls import path
from .views import module_inventory

urlpatterns = [
    path('inventory', module_inventory, name='module-inventory'),
]
