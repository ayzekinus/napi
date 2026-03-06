import json
from unittest.mock import patch

from django.test import SimpleTestCase
from django.test.client import RequestFactory

from apps.core.views import auth_bootstrap, auth_login, auth_logout, auth_permissions, auth_session, health


class AuthLoginViewTests(SimpleTestCase):
    def setUp(self):
        self.factory = RequestFactory()

    def test_login_requires_post(self):
        request = self.factory.get('/api/auth/login')
        request.session = {}
        response = auth_login(request)

        self.assertEqual(response.status_code, 405)
        payload = json.loads(response.content.decode('utf-8'))
        self.assertEqual(payload['success'], False)
        self.assertEqual(payload['reason'], 'method_not_allowed')


    @patch('apps.core.views.verify_legacy_credentials')
    def test_login_handles_invalid_json_body(self, verify_mock):
        verify_mock.return_value.success = False
        verify_mock.return_value.reason = 'invalid_credentials'

        request = self.factory.post('/api/auth/login', data='{"', content_type='application/json')
        request.session = {}

        response = auth_login(request)

        self.assertEqual(response.status_code, 401)
        payload = json.loads(response.content.decode('utf-8'))
        self.assertEqual(payload['success'], False)
        self.assertEqual(payload['reason'], 'invalid_credentials')
        verify_mock.assert_called_once_with(username='', password='')


    @patch('apps.core.views.verify_legacy_credentials')
    def test_login_trims_username_before_verification(self, verify_mock):
        verify_mock.return_value.success = False
        verify_mock.return_value.reason = 'invalid_credentials'

        request = self.factory.post(
            '/api/auth/login',
            data=json.dumps({'username': '  demo  ', 'password': 'secret'}),
            content_type='application/json',
        )
        request.session = {}

        response = auth_login(request)

        self.assertEqual(response.status_code, 401)
        verify_mock.assert_called_once_with(username='demo', password='secret')

    @patch('apps.core.views.verify_legacy_credentials')
    def test_login_rejects_invalid_credentials(self, verify_mock):
        verify_mock.return_value.success = False
        verify_mock.return_value.reason = 'invalid_password'

        request = self.factory.post(
            '/api/auth/login',
            data=json.dumps({'username': 'u', 'password': 'x'}),
            content_type='application/json',
        )
        request.session = {}

        response = auth_login(request)
        self.assertEqual(response.status_code, 401)
        payload = json.loads(response.content.decode('utf-8'))
        self.assertEqual(payload['success'], False)
        self.assertEqual(payload['reason'], 'invalid_password')


    @patch('apps.core.views.verify_legacy_credentials')
    def test_login_sets_session_on_success(self, verify_mock):
        verify_mock.return_value.success = True
        verify_mock.return_value.user = {
            'ID': 9,
            'kullanici': 'demo',
            'adsoyad': 'Demo User',
            'yetki': 'A',
            'kisitlamalar': 'A0',
        }

        request = self.factory.post(
            '/api/auth/login',
            data=json.dumps({'username': 'demo', 'password': 'secret'}),
            content_type='application/json',
        )
        request.session = {}

        response = auth_login(request)

        self.assertEqual(response.status_code, 200)
        payload = json.loads(response.content.decode('utf-8'))
        self.assertEqual(payload['success'], True)
        self.assertEqual(payload['user']['ID'], 9)
        self.assertEqual(payload['user']['kullanici'], 'demo')

        self.assertEqual(request.session['oturum'], True)
        self.assertEqual(request.session['ID'], 9)
        self.assertEqual(request.session['kullanici'], 'demo')


class HealthViewTests(SimpleTestCase):
    def setUp(self):
        self.factory = RequestFactory()

    def test_health_get_returns_ok(self):
        request = self.factory.get('/api/health')
        response = health(request)

        self.assertEqual(response.status_code, 200)
        payload = json.loads(response.content.decode('utf-8'))
        self.assertEqual(payload['ok'], True)
        self.assertEqual(payload['service'], 'django-backend')

    def test_health_post_returns_405(self):
        request = self.factory.post('/api/health')
        response = health(request)
        self.assertEqual(response.status_code, 405)


class AuthSessionViewTests(SimpleTestCase):
    def setUp(self):
        self.factory = RequestFactory()

    def test_session_post_returns_405(self):
        request = self.factory.post('/api/auth/session')
        request.session = {}
        response = auth_session(request)
        self.assertEqual(response.status_code, 405)

    def test_session_requires_authentication(self):
        request = self.factory.get('/api/auth/session')
        request.session = {}
        response = auth_session(request)

        self.assertEqual(response.status_code, 401)

    def test_session_returns_user_when_authenticated(self):
        request = self.factory.get('/api/auth/session')
        request.session = {
            'oturum': True,
            'ID': 7,
            'kullanici': 'ali',
            'adsoyad': 'Ali Veli',
            'yetki': 'A',
            'kisitlamalar': 'A0',
        }
        response = auth_session(request)

        self.assertEqual(response.status_code, 200)
        payload = json.loads(response.content.decode('utf-8'))
        self.assertEqual(payload['authenticated'], True)
        self.assertEqual(
            payload['user'],
            {
                'ID': 7,
                'kullanici': 'ali',
                'adsoyad': 'Ali Veli',
                'yetki': 'A',
                'kisitlamalar': 'A0',
            },
        )


class AuthPermissionsViewTests(SimpleTestCase):
    def setUp(self):
        self.factory = RequestFactory()

    def test_permissions_post_returns_405(self):
        request = self.factory.post('/api/auth/permissions')
        request.session = {}
        response = auth_permissions(request)
        self.assertEqual(response.status_code, 405)

    def test_permissions_requires_session(self):
        request = self.factory.get('/api/auth/permissions')
        request.session = {}
        response = auth_permissions(request)
        self.assertEqual(response.status_code, 401)

    @patch('apps.core.views.parse_legacy_permissions')
    def test_permissions_uses_parser_for_non_supervisor(self, parser_mock):
        parser_mock.return_value = {'anakod_list': True}
        request = self.factory.get('/api/auth/permissions')
        request.session = {'oturum': True, 'yetki': 'A', 'kisitlamalar': 'A0'}
        response = auth_permissions(request)

        self.assertEqual(response.status_code, 200)
        payload = json.loads(response.content.decode('utf-8'))
        self.assertEqual(payload['authenticated'], True)
        self.assertEqual(payload['is_supervisor'], False)
        self.assertEqual(payload['permissions']['anakod_list'], True)
        parser_mock.assert_called_once_with('A0')


    @patch('apps.core.views.parse_legacy_permissions')
    def test_permissions_returns_supervisor_map_without_parser(self, parser_mock):
        request = self.factory.get('/api/auth/permissions')
        request.session = {'oturum': True, 'yetki': 'S', 'kisitlamalar': 'IGNORED'}
        response = auth_permissions(request)

        self.assertEqual(response.status_code, 200)
        payload = json.loads(response.content.decode('utf-8'))
        self.assertEqual(payload['is_supervisor'], True)
        self.assertEqual(payload['permissions']['anakod_write'], True)
        parser_mock.assert_not_called()


class AuthBootstrapViewTests(SimpleTestCase):
    def setUp(self):
        self.factory = RequestFactory()

    def test_bootstrap_post_returns_405(self):
        request = self.factory.post('/api/auth/bootstrap')
        request.session = {}
        response = auth_bootstrap(request)
        self.assertEqual(response.status_code, 405)

    def test_bootstrap_requires_session(self):
        request = self.factory.get('/api/auth/bootstrap')
        request.session = {}
        response = auth_bootstrap(request)
        self.assertEqual(response.status_code, 401)

    @patch('apps.core.views.parse_legacy_permissions')
    def test_bootstrap_returns_user_and_permissions(self, parser_mock):
        parser_mock.return_value = {'anakod_list': True}
        request = self.factory.get('/api/auth/bootstrap')
        request.session = {
            'oturum': True,
            'ID': 5,
            'kullanici': 'demo',
            'adsoyad': 'Demo User',
            'yetki': 'A',
            'kisitlamalar': 'A0',
        }
        response = auth_bootstrap(request)

        self.assertEqual(response.status_code, 200)
        payload = json.loads(response.content.decode('utf-8'))
        self.assertEqual(payload['authenticated'], True)
        self.assertEqual(payload['is_supervisor'], False)
        self.assertEqual(
            payload['user'],
            {
                'ID': 5,
                'kullanici': 'demo',
                'adsoyad': 'Demo User',
                'yetki': 'A',
                'kisitlamalar': 'A0',
            },
        )
        self.assertEqual(payload['permissions']['anakod_list'], True)
        parser_mock.assert_called_once_with('A0')


    @patch('apps.core.views.parse_legacy_permissions')
    def test_bootstrap_supervisor_bypasses_parser(self, parser_mock):
        request = self.factory.get('/api/auth/bootstrap')
        request.session = {
            'oturum': True,
            'ID': 1,
            'kullanici': 'root',
            'adsoyad': 'Supervisor',
            'yetki': 'S',
            'kisitlamalar': '',
        }
        response = auth_bootstrap(request)

        self.assertEqual(response.status_code, 200)
        payload = json.loads(response.content.decode('utf-8'))
        self.assertEqual(payload['is_supervisor'], True)
        self.assertEqual(payload['permissions']['kullanicilar_write'], True)
        parser_mock.assert_not_called()


class AuthLogoutViewTests(SimpleTestCase):
    def setUp(self):
        self.factory = RequestFactory()

    def test_logout_requires_post(self):
        request = self.factory.get('/api/auth/logout')
        request.session = {}
        response = auth_logout(request)

        self.assertEqual(response.status_code, 405)
        payload = json.loads(response.content.decode('utf-8'))
        self.assertEqual(payload['success'], False)
        self.assertEqual(payload['reason'], 'method_not_allowed')

    def test_logout_flushes_session(self):
        request = self.factory.post('/api/auth/logout')

        class DummySession:
            def __init__(self):
                self.flushed = False

            def flush(self):
                self.flushed = True

        request.session = DummySession()
        response = auth_logout(request)

        self.assertEqual(response.status_code, 200)
        payload = json.loads(response.content.decode('utf-8'))
        self.assertEqual(payload['success'], True)
        self.assertTrue(request.session.flushed)
