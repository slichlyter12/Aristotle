import json
import unittest
from selenium import webdriver

userData = '{"username":"qud", "password":"Hhrhl1504"}'
user = json.loads(userData)

class Login(unittest.TestCase):
    def setUp(self):
        self.driver = webdriver.Chrome()

    def test_search_in_python_org(self):
        driver = self.driver
        driver.get("http://web.engr.oregonstate.edu/~lichlyts/cs561/pages/")
        self.assertIn("Aristotle", driver.title)
        login_home_element = driver.find_element_by_class_name("btn")
        login_home_element.click()

        username_element = driver.find_element_by_id("username")
        username_element.send_keys(user['username'])
        password_element = driver.find_element_by_id("password")
        password_element.send_keys(user['password'])
        login_btn_element = driver.find_element_by_name("_eventId_proceed")
        login_btn_element.click()

        self.assertIn("pages/ta.php", driver.current_url)

        assert "Not Found" not in driver.page_source
        
    def tearDown(self):
        self.driver.quit()


if __name__ == "__main__":
    unittest.main()