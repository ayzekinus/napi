import json
from unittest.mock import patch

from django.test import SimpleTestCase
from django.test.client import RequestFactory

from apps.core.views import auth_login, auth_logout


class AuthLoginViewTests(SimpleTestCase):
    def setUp(self):
        self.factory = RequestFactory()

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


class AuthLogoutViewTests(SimpleTestCase):
    def setUp(self):
        self.factory = RequestFactory()

    def test_logout_requires_post(self):
        request = self.factory.get('/api/auth/logout')
        request.session = {}
        response = auth_logout(request)
        self.assertEqual(response.status_code, 405)

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
        self.assertTrue(request.session.flushed)
