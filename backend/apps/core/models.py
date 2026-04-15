from django.db import models


class LegacyUser(models.Model):
    ID = models.IntegerField(primary_key=True)
    adsoyad = models.CharField(max_length=255)
    kullanici = models.CharField(max_length=150, db_column='_kullanici')
    yetki = models.TextField(blank=True, default='')
    kisitlamalar = models.TextField(blank=True, default='')
    durum = models.IntegerField(default=1)
    sifre = models.CharField(max_length=255, db_column='_sifre')

    class Meta:
        managed = False
        db_table = '_kullanici'
        verbose_name = 'Legacy Kullanıcı'
        verbose_name_plural = 'Legacy Kullanıcılar'

    def __str__(self) -> str:
        return f'{self.adsoyad} ({self.kullanici})'
