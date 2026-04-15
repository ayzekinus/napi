from django.contrib import admin, messages
from django.db.utils import OperationalError, ProgrammingError
from django.http import HttpResponseRedirect

from .models import LegacyUser


class SafeLegacyAdminMixin:
    missing_table_message = 'Legacy tablo bu ortamda bulunamadı. Demo için sadece read-only endpointler kullanılabilir.'

    def changelist_view(self, request, extra_context=None):
        try:
            return super().changelist_view(request, extra_context=extra_context)
        except (OperationalError, ProgrammingError):
            self.message_user(request, self.missing_table_message, level=messages.WARNING)
            return HttpResponseRedirect('/admin/')


@admin.register(LegacyUser)
class LegacyUserAdmin(SafeLegacyAdminMixin, admin.ModelAdmin):
    list_display = ('ID', 'adsoyad', 'kullanici', 'yetki', 'durum')
    search_fields = ('adsoyad', 'kullanici', 'yetki')
    list_filter = ('durum',)
