from django.urls import path

from .views import (
    acma_rapor_list,
    anakod_list,
    buluntu_list,
    evrak_list,
    demirbas_list,
    dashboard_summary,
    dashboard_bootstrap,
    dashboard_bootstrap_full,
    module_inventory,
    kullanicilar_list,
)

urlpatterns = [
    path('inventory', module_inventory, name='module-inventory'),
    path('anakod', anakod_list, name='anakod-list'),
    path('buluntu', buluntu_list, name='buluntu-list'),
    path('evrak', evrak_list, name='evrak-list'),
    path('acma-rapor', acma_rapor_list, name='acma-rapor-list'),
    path('demirbas', demirbas_list, name='demirbas-list'),
    path('kullanicilar', kullanicilar_list, name='kullanicilar-list'),
    path('dashboard-summary', dashboard_summary, name='dashboard-summary'),
    path('bootstrap', dashboard_bootstrap, name='dashboard-bootstrap'),
    path('bootstrap-full', dashboard_bootstrap_full, name='dashboard-bootstrap-full'),
]
