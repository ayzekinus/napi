from django.urls import path

from .views import anakod_list, buluntu_list, evrak_list, module_inventory

urlpatterns = [
    path('inventory', module_inventory, name='module-inventory'),
    path('anakod', anakod_list, name='anakod-list'),
    path('buluntu', buluntu_list, name='buluntu-list'),
    path('evrak', evrak_list, name='evrak-list'),
]
