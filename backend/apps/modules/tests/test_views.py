from unittest.mock import patch

from django.test import SimpleTestCase
from django.test.client import RequestFactory

from apps.modules.views import acma_rapor_list, anakod_list, buluntu_list, evrak_list


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


class BuluntuListViewTests(SimpleTestCase):
    def setUp(self):
        self.factory = RequestFactory()

    @patch('apps.modules.views.list_buluntu')
    def test_buluntu_list_with_invalid_limit_uses_default(self, list_buluntu_mock):
        list_buluntu_mock.return_value.items = []
        list_buluntu_mock.return_value.degraded = False

        request = self.factory.get('/api/modules/buluntu?limit=abc')
        response = buluntu_list(request)

        self.assertEqual(response.status_code, 200)
        list_buluntu_mock.assert_called_once_with(limit=50)


class EvrakListViewTests(SimpleTestCase):
    def setUp(self):
        self.factory = RequestFactory()

    @patch('apps.modules.views.list_evrak')
    def test_evrak_list_with_invalid_limit_uses_default(self, list_evrak_mock):
        list_evrak_mock.return_value.items = []
        list_evrak_mock.return_value.degraded = False

        request = self.factory.get('/api/modules/evrak?limit=abc')
        response = evrak_list(request)

        self.assertEqual(response.status_code, 200)
        list_evrak_mock.assert_called_once_with(limit=50)


class AcmaRaporListViewTests(SimpleTestCase):
    def setUp(self):
        self.factory = RequestFactory()

    @patch('apps.modules.views.list_acma_rapor')
    def test_acma_rapor_list_with_invalid_limit_uses_default(self, list_acma_rapor_mock):
        list_acma_rapor_mock.return_value.items = []
        list_acma_rapor_mock.return_value.degraded = False

        request = self.factory.get('/api/modules/acma-rapor?limit=abc')
        response = acma_rapor_list(request)

        self.assertEqual(response.status_code, 200)
        list_acma_rapor_mock.assert_called_once_with(limit=50)
