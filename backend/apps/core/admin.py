from django.contrib import admin

from .models import LegacyUser


@admin.register(LegacyUser)
class LegacyUserAdmin(admin.ModelAdmin):
    list_display = ('ID', 'adsoyad', 'kullanici', 'yetki', 'durum')
    search_fields = ('adsoyad', 'kullanici', 'yetki')
    list_filter = ('durum',)
