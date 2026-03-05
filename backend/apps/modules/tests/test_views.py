from unittest.mock import patch

from django.test import SimpleTestCase
from django.test.client import RequestFactory

from apps.modules.views import anakod_list


class AnakodListViewTests(SimpleTestCase):
    def setUp(self):
        self.factory = RequestFactory()

    @patch('apps.modules.views.list_anakod')
    def test_anakod_list_with_invalid_limit_uses_default(self, list_anakod_mock):
        list_anakod_mock.return_value.items = []
        list_anakod_mock.return_value.degraded = False

        request = self.factory.get('/api/modules/anakod?limit=abc')
        response = anakod_list(request)

        self.assertEqual(response.status_code, 200)
        list_anakod_mock.assert_called_once_with(limit=50)
