from django.contrib import admin

from .models import AcmaRapor, Anakod, BuluntuKarti, DemirbasListesi, EvrakYonetimi


@admin.register(Anakod)
class AnakodAdmin(admin.ModelAdmin):
    list_display = ('anakod_id', 'anakod')
    search_fields = ('anakod',)


@admin.register(BuluntuKarti)
class BuluntuKartiAdmin(admin.ModelAdmin):
    list_display = ('bk_id', 'bk_anakod_id', 'buluntu_no', 'envanterlik')
    list_filter = ('envanterlik',)


@admin.register(EvrakYonetimi)
class EvrakYonetimiAdmin(admin.ModelAdmin):
    list_display = ('evrak_id', 'evrak_tipi', 'evrak_no', 'evrak_tarihi')
    search_fields = ('evrak_tipi', 'evrak_no')


@admin.register(AcmaRapor)
class AcmaRaporAdmin(admin.ModelAdmin):
    list_display = ('acma_rapor_id', 'acma_rapor_no', 'sezon')
    search_fields = ('acma_rapor_no', 'sezon')


@admin.register(DemirbasListesi)
class DemirbasListesiAdmin(admin.ModelAdmin):
    list_display = ('dl_id', 'buluntu_id', 'envanter_no', 'durum')
    list_filter = ('durum',)
    search_fields = ('envanter_no',)
