from django.contrib import admin, messages
from django.db.utils import OperationalError, ProgrammingError
from django.http import HttpResponseRedirect

from .models import AcmaRapor, Anakod, BuluntuKarti, DemirbasListesi, EvrakYonetimi


class SafeLegacyAdminMixin:
    missing_table_message = 'Legacy tablo bu ortamda bulunamadı. Demo ortamında bu modül listesi boş olabilir.'

    def changelist_view(self, request, extra_context=None):
        try:
            return super().changelist_view(request, extra_context=extra_context)
        except (OperationalError, ProgrammingError):
            self.message_user(request, self.missing_table_message, level=messages.WARNING)
            return HttpResponseRedirect('/admin/')


@admin.register(Anakod)
class AnakodAdmin(SafeLegacyAdminMixin, admin.ModelAdmin):
    list_display = ('anakod_id', 'anakod')
    search_fields = ('anakod',)


@admin.register(BuluntuKarti)
class BuluntuKartiAdmin(SafeLegacyAdminMixin, admin.ModelAdmin):
    list_display = ('bk_id', 'bk_anakod_id', 'buluntu_no', 'envanterlik')
    list_filter = ('envanterlik',)


@admin.register(EvrakYonetimi)
class EvrakYonetimiAdmin(SafeLegacyAdminMixin, admin.ModelAdmin):
    list_display = ('evrak_id', 'evrak_tipi', 'evrak_no', 'evrak_tarihi')
    search_fields = ('evrak_tipi', 'evrak_no')


@admin.register(AcmaRapor)
class AcmaRaporAdmin(SafeLegacyAdminMixin, admin.ModelAdmin):
    list_display = ('acma_rapor_id', 'acma_rapor_no', 'sezon')
    search_fields = ('acma_rapor_no', 'sezon')


@admin.register(DemirbasListesi)
class DemirbasListesiAdmin(SafeLegacyAdminMixin, admin.ModelAdmin):
    list_display = ('dl_id', 'buluntu_id', 'envanter_no', 'durum')
    list_filter = ('durum',)
    search_fields = ('envanter_no',)
