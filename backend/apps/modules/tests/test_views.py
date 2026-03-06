from unittest.mock import patch

from django.test import SimpleTestCase
from django.test.client import RequestFactory

from apps.modules.views import acma_rapor_list, anakod_list, buluntu_list, dashboard_bootstrap, dashboard_bootstrap_full, dashboard_summary, demirbas_list, evrak_list, kullanicilar_list


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



class DemirbasListViewTests(SimpleTestCase):
    def setUp(self):
        self.factory = RequestFactory()

    @patch('apps.modules.views.list_demirbas')
    def test_demirbas_list_with_invalid_limit_uses_default(self, list_demirbas_mock):
        list_demirbas_mock.return_value.items = []
        list_demirbas_mock.return_value.degraded = False

        request = self.factory.get('/api/modules/demirbas?limit=abc')
        response = demirbas_list(request)

        self.assertEqual(response.status_code, 200)
        list_demirbas_mock.assert_called_once_with(limit=50)



class KullanicilarListViewTests(SimpleTestCase):
    def setUp(self):
        self.factory = RequestFactory()

    @patch('apps.modules.views.list_kullanicilar')
    def test_kullanicilar_list_with_invalid_limit_uses_default(self, list_kullanicilar_mock):
        list_kullanicilar_mock.return_value.items = []
        list_kullanicilar_mock.return_value.degraded = False

        request = self.factory.get('/api/modules/kullanicilar?limit=abc')
        response = kullanicilar_list(request)

        self.assertEqual(response.status_code, 200)
        list_kullanicilar_mock.assert_called_once_with(limit=50)



class DashboardSummaryViewTests(SimpleTestCase):
    def setUp(self):
        self.factory = RequestFactory()

    @patch('apps.modules.views.get_dashboard_summary')
    def test_dashboard_summary_view_returns_ok(self, summary_mock):
        summary_mock.return_value.data = {'anakod': 1}
        summary_mock.return_value.degraded = False

        request = self.factory.get('/api/modules/dashboard-summary')
        response = dashboard_summary(request)

        self.assertEqual(response.status_code, 200)
        summary_mock.assert_called_once_with()



class DashboardBootstrapViewTests(SimpleTestCase):
    def setUp(self):
        self.factory = RequestFactory()

    @patch('apps.modules.views.get_dashboard_summary')
    def test_dashboard_bootstrap_view_returns_ok(self, summary_mock):
        summary_mock.return_value.data = {'anakod': 1}
        summary_mock.return_value.degraded = False

        request = self.factory.get('/api/modules/bootstrap')
        response = dashboard_bootstrap(request)

        self.assertEqual(response.status_code, 200)
        summary_mock.assert_called_once_with()



class DashboardBootstrapFullViewTests(SimpleTestCase):
    def setUp(self):
        self.factory = RequestFactory()

    @patch('apps.modules.views.list_kullanicilar')
    @patch('apps.modules.views.list_acma_rapor')
    @patch('apps.modules.views.list_evrak')
    @patch('apps.modules.views.list_demirbas')
    @patch('apps.modules.views.list_buluntu')
    @patch('apps.modules.views.list_anakod')
    @patch('apps.modules.views.get_dashboard_summary')
    def test_dashboard_bootstrap_full_returns_ok(
        self,
        summary_mock,
        anakod_mock,
        buluntu_mock,
        demirbas_mock,
        evrak_mock,
        acma_mock,
        user_mock,
    ):
        summary_mock.return_value.data = {'anakod': 1}
        summary_mock.return_value.degraded = False

        for m in [anakod_mock, buluntu_mock, demirbas_mock, evrak_mock, acma_mock, user_mock]:
            m.return_value.items = []
            m.return_value.degraded = False

        request = self.factory.get('/api/modules/bootstrap-full?limit=7')
        response = dashboard_bootstrap_full(request)

        self.assertEqual(response.status_code, 200)
        self.assertIn('degraded_map', response.content.decode('utf-8'))
        anakod_mock.assert_called_once_with(limit=7)
        user_mock.assert_called_once_with(limit=7)
