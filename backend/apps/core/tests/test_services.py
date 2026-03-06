from unittest.mock import Mock, patch

from django.test import SimpleTestCase, override_settings

from apps.core.services import (
    _legacy_password_hash,
    parse_legacy_permissions,
    verify_legacy_credentials,
)


class LegacyHashTests(SimpleTestCase):
    @override_settings(LEGACY_HASH_SALT='abc-')
    def test_legacy_hash_is_stable(self):
        self.assertEqual(_legacy_password_hash('1234'), '5811c29643220230d3c4ed9c5c5baa2e')


class LegacyPermissionParserTests(SimpleTestCase):
    def test_permission_parser_maps_tokens(self):
        permissions = parse_legacy_permissions('A0,B1,EY0,R2')
        self.assertTrue(permissions['anakod_list'])
        self.assertTrue(permissions['buluntu_write'])
        self.assertTrue(permissions['evrak_list'])
        self.assertTrue(permissions['kullanicilar_write'])
        self.assertFalse(permissions['demirbas_list'])


class VerifyCredentialsTests(SimpleTestCase):
    @patch('apps.core.services.connection')
    @override_settings(LEGACY_HASH_SALT='salt-')
    def test_verify_success(self, connection_mock):
        cursor_mock = Mock()
        cursor_mock.fetchone.return_value = (
            7,
            'Test User',
            'test',
            'A',
            'A0',
            1,
            _legacy_password_hash('pass123'),
        )
        connection_mock.cursor.return_value.__enter__.return_value = cursor_mock

        result = verify_legacy_credentials('test', 'pass123')

        self.assertTrue(result.success)
        self.assertEqual(result.user['ID'], 7)

    @patch('apps.core.services.connection')
    @override_settings(LEGACY_HASH_SALT='salt-')
    def test_verify_invalid_password(self, connection_mock):
        cursor_mock = Mock()
        cursor_mock.fetchone.return_value = (1, 'User', 'u', 'A', 'A0', 1, _legacy_password_hash('pass123'))
        connection_mock.cursor.return_value.__enter__.return_value = cursor_mock

        result = verify_legacy_credentials('u', 'wrong')

        self.assertFalse(result.success)
        self.assertEqual(result.reason, 'invalid_password')
