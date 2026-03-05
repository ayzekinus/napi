from unittest.mock import Mock, patch

from django.db import DatabaseError
from django.test import SimpleTestCase

from apps.modules.services import list_anakod, list_buluntu


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
