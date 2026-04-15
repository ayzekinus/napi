from django.db import models


class Anakod(models.Model):
    anakod_id = models.IntegerField(primary_key=True)
    anakod = models.CharField(max_length=255)

    class Meta:
        managed = False
        db_table = 'anakod'
        verbose_name = 'Anakod'
        verbose_name_plural = 'Anakod'

    def __str__(self) -> str:
        return self.anakod


class BuluntuKarti(models.Model):
    bk_id = models.IntegerField(primary_key=True)
    bk_anakod_id = models.IntegerField()
    buluntu_no = models.IntegerField(null=True, blank=True)
    envanterlik = models.BooleanField(default=False)

    class Meta:
        managed = False
        db_table = 'buluntu_karti'
        verbose_name = 'Buluntu Kartı'
        verbose_name_plural = 'Buluntu Kartları'


class EvrakYonetimi(models.Model):
    evrak_id = models.IntegerField(primary_key=True)
    evrak_tipi = models.CharField(max_length=255)
    evrak_no = models.CharField(max_length=255)
    evrak_tarihi = models.CharField(max_length=64, null=True, blank=True)

    class Meta:
        managed = False
        db_table = 'evrak_yonetimi'
        verbose_name = 'Evrak'
        verbose_name_plural = 'Evraklar'


class AcmaRapor(models.Model):
    acma_rapor_id = models.IntegerField(primary_key=True)
    acma_rapor_no = models.CharField(max_length=255)
    sezon = models.CharField(max_length=64)

    class Meta:
        managed = False
        db_table = 'acma_rapor'
        verbose_name = 'Açma Raporu'
        verbose_name_plural = 'Açma Raporları'


class DemirbasListesi(models.Model):
    dl_id = models.IntegerField(primary_key=True)
    buluntu_id = models.IntegerField()
    envanter_no = models.CharField(max_length=255)
    durum = models.IntegerField(default=1)

    class Meta:
        managed = False
        db_table = 'demirbas_listesi'
        verbose_name = 'Demirbaş'
        verbose_name_plural = 'Demirbaşlar'
