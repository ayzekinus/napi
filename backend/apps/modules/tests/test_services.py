from datetime import date
from unittest.mock import Mock, patch

from django.db import DatabaseError
from django.test import SimpleTestCase

from apps.modules.services import (
    _safe_limit,
    list_acma_rapor,
    list_anakod,
    list_buluntu,
    get_dashboard_summary,
    list_demirbas,
    list_evrak,
    list_kullanicilar,
)


class SafeLimitTests(SimpleTestCase):
    def test_safe_limit_returns_default_for_non_integer(self):
        self.assertEqual(_safe_limit('abc', default=10), 10)

    def test_safe_limit_clamps_to_minimum(self):
        self.assertEqual(_safe_limit(0), 1)

    def test_safe_limit_clamps_to_maximum(self):
        self.assertEqual(_safe_limit(999999), 500)

    def test_safe_limit_returns_value_when_in_range(self):
        self.assertEqual(_safe_limit(42), 42)



class ListAnakodServiceTests(SimpleTestCase):
    @patch('apps.modules.services.connection')
    def test_list_anakod_returns_rows(self, connection_mock):
        cursor_mock = Mock()
        cursor_mock.fetchall.return_value = [(3, 'AAC'), (2, 'AAB')]

        connection_mock.cursor.return_value.__enter__.return_value = cursor_mock

        result = list_anakod(limit=2)

        self.assertFalse(result.degraded)
        self.assertEqual(
            result.items,
            [
                {'anakod_id': 3, 'anakod': 'AAC'},
                {'anakod_id': 2, 'anakod': 'AAB'},
            ],
        )

    @patch('apps.modules.services.connection')
    def test_list_anakod_handles_db_error(self, connection_mock):
        connection_mock.cursor.side_effect = DatabaseError('db error')

        result = list_anakod(limit=25)

        self.assertTrue(result.degraded)
        self.assertEqual(result.items, [])

    @patch('apps.modules.services.connection')
    def test_list_anakod_clamps_limit_to_maximum(self, connection_mock):
        cursor_mock = Mock()
        cursor_mock.fetchall.return_value = []
        connection_mock.cursor.return_value.__enter__.return_value = cursor_mock

        list_anakod(limit=999999)

        cursor_mock.execute.assert_called_once()
        _, params = cursor_mock.execute.call_args[0]
        self.assertEqual(params, [500])

    @patch('apps.modules.services.connection')
    def test_list_anakod_clamps_limit_to_minimum(self, connection_mock):
        cursor_mock = Mock()
        cursor_mock.fetchall.return_value = []
        connection_mock.cursor.return_value.__enter__.return_value = cursor_mock

        list_anakod(limit=0)

        cursor_mock.execute.assert_called_once()
        _, params = cursor_mock.execute.call_args[0]
        self.assertEqual(params, [1])

    @patch('apps.modules.services.connection')
    def test_list_anakod_uses_default_limit_for_non_integer(self, connection_mock):
        cursor_mock = Mock()
        cursor_mock.fetchall.return_value = []
        connection_mock.cursor.return_value.__enter__.return_value = cursor_mock

        list_anakod(limit='abc')

        cursor_mock.execute.assert_called_once()
        _, params = cursor_mock.execute.call_args[0]
        self.assertEqual(params, [50])


class ListBuluntuServiceTests(SimpleTestCase):
    @patch('apps.modules.services.connection')
    def test_list_buluntu_returns_rows(self, connection_mock):
        cursor_mock = Mock()
        cursor_mock.fetchall.return_value = [(10, 2, 55, 1), (9, 2, None, 0)]

        connection_mock.cursor.return_value.__enter__.return_value = cursor_mock

        result = list_buluntu(limit=2)

        self.assertFalse(result.degraded)
        self.assertEqual(
            result.items,
            [
                {
                    'bk_id': 10,
                    'bk_anakod_id': 2,
                    'buluntu_no': 55,
                    'envanterlik': True,
                },
                {
                    'bk_id': 9,
                    'bk_anakod_id': 2,
                    'buluntu_no': None,
                    'envanterlik': False,
                },
            ],
        )

    @patch('apps.modules.services.connection')
    def test_list_buluntu_handles_db_error(self, connection_mock):
        connection_mock.cursor.side_effect = DatabaseError('db error')

        result = list_buluntu(limit=25)

        self.assertTrue(result.degraded)
        self.assertEqual(result.items, [])


class ListEvrakServiceTests(SimpleTestCase):
    @patch('apps.modules.services.connection')
    def test_list_evrak_returns_rows(self, connection_mock):
        cursor_mock = Mock()
        cursor_mock.fetchall.return_value = [
            (101, 'Gelen', 'EV-55', date(2024, 5, 12)),
            (100, 'Giden', 'EV-54', None),
        ]

        connection_mock.cursor.return_value.__enter__.return_value = cursor_mock

        result = list_evrak(limit=2)

        self.assertFalse(result.degraded)
        self.assertEqual(
            result.items,
            [
                {
                    'evrak_id': 101,
                    'evrak_tipi': 'Gelen',
                    'evrak_no': 'EV-55',
                    'evrak_tarihi': '2024-05-12',
                },
                {
                    'evrak_id': 100,
                    'evrak_tipi': 'Giden',
                    'evrak_no': 'EV-54',
                    'evrak_tarihi': None,
                },
            ],
        )

    @patch('apps.modules.services.connection')
    def test_list_evrak_handles_db_error(self, connection_mock):
        connection_mock.cursor.side_effect = DatabaseError('db error')

        result = list_evrak(limit=25)

        self.assertTrue(result.degraded)
        self.assertEqual(result.items, [])


class ListAcmaRaporServiceTests(SimpleTestCase):
    @patch('apps.modules.services.connection')
    def test_list_acma_rapor_returns_rows(self, connection_mock):
        cursor_mock = Mock()
        cursor_mock.fetchall.return_value = [
            (501, 'AR-2024-10', '2024'),
            (500, 'AR-2024-09', '2024'),
        ]

        connection_mock.cursor.return_value.__enter__.return_value = cursor_mock

        result = list_acma_rapor(limit=2)

        self.assertFalse(result.degraded)
        self.assertEqual(
            result.items,
            [
                {
                    'acma_rapor_id': 501,
                    'acma_rapor_no': 'AR-2024-10',
                    'sezon': '2024',
                },
                {
                    'acma_rapor_id': 500,
                    'acma_rapor_no': 'AR-2024-09',
                    'sezon': '2024',
                },
            ],
        )

    @patch('apps.modules.services.connection')
    def test_list_acma_rapor_handles_db_error(self, connection_mock):
        connection_mock.cursor.side_effect = DatabaseError('db error')

        result = list_acma_rapor(limit=25)

        self.assertTrue(result.degraded)
        self.assertEqual(result.items, [])



class ListDemirbasServiceTests(SimpleTestCase):
    @patch('apps.modules.services.connection')
    def test_list_demirbas_returns_rows(self, connection_mock):
        cursor_mock = Mock()
        cursor_mock.fetchall.return_value = [
            (200, 9, 'D-100', 1),
            (199, 8, 'D-099', 0),
        ]

        connection_mock.cursor.return_value.__enter__.return_value = cursor_mock

        result = list_demirbas(limit=2)

        self.assertFalse(result.degraded)
        self.assertEqual(
            result.items,
            [
                {
                    'dl_id': 200,
                    'buluntu_id': 9,
                    'envanter_no': 'D-100',
                    'durum': 1,
                },
                {
                    'dl_id': 199,
                    'buluntu_id': 8,
                    'envanter_no': 'D-099',
                    'durum': 0,
                },
            ],
        )

    @patch('apps.modules.services.connection')
    def test_list_demirbas_handles_db_error(self, connection_mock):
        connection_mock.cursor.side_effect = DatabaseError('db error')

        result = list_demirbas(limit=25)

        self.assertTrue(result.degraded)
        self.assertEqual(result.items, [])



class ListKullanicilarServiceTests(SimpleTestCase):
    @patch('apps.modules.services.connection')
    def test_list_kullanicilar_returns_rows(self, connection_mock):
        cursor_mock = Mock()
        cursor_mock.fetchall.return_value = [
            (12, 'Ali Veli', 'ali', 'A', 1),
            (11, 'Ayse Test', 'ayse', 'R', 0),
        ]

        connection_mock.cursor.return_value.__enter__.return_value = cursor_mock

        result = list_kullanicilar(limit=2)

        self.assertFalse(result.degraded)
        self.assertEqual(
            result.items,
            [
                {
                    'ID': 12,
                    'adsoyad': 'Ali Veli',
                    'kullanici': 'ali',
                    'yetki': 'A',
                    'durum': 1,
                },
                {
                    'ID': 11,
                    'adsoyad': 'Ayse Test',
                    'kullanici': 'ayse',
                    'yetki': 'R',
                    'durum': 0,
                },
            ],
        )

    @patch('apps.modules.services.connection')
    def test_list_kullanicilar_handles_db_error(self, connection_mock):
        connection_mock.cursor.side_effect = DatabaseError('db error')

        result = list_kullanicilar(limit=25)

        self.assertTrue(result.degraded)
        self.assertEqual(result.items, [])



class DashboardSummaryServiceTests(SimpleTestCase):
    @patch('apps.modules.services.connection')
    def test_dashboard_summary_returns_counts(self, connection_mock):
        cursor_mock = Mock()
        cursor_mock.fetchone.return_value = (3, 12, 4, 7, 2, 9)

        connection_mock.cursor.return_value.__enter__.return_value = cursor_mock

        result = get_dashboard_summary()

        self.assertFalse(result.degraded)
        self.assertEqual(
            result.data,
            {
                'anakod': 3,
                'buluntu': 12,
                'acma_rapor': 4,
                'evrak': 7,
                'demirbas': 2,
                'kullanicilar': 9,
            },
        )

    @patch('apps.modules.services.connection')
    def test_dashboard_summary_handles_db_error(self, connection_mock):
        connection_mock.cursor.side_effect = DatabaseError('db error')

        result = get_dashboard_summary()

        self.assertTrue(result.degraded)
        self.assertEqual(result.data['anakod'], 0)
