from django.urls import path

from .views import anakod_list, module_inventory

urlpatterns = [
    path('inventory', module_inventory, name='module-inventory'),
    path('anakod', anakod_list, name='anakod-list'),
]
