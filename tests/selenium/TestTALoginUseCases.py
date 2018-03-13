import json
import unittest
import HTMLTestRunner
import time
from selenium import webdriver


class Test_TA_Use_Cases(unittest.TestCase):
    @classmethod
    def setUpClass(self):
        self.driver = webdriver.Chrome()
        self.driver.implicitly_wait(2)

    def test_login_error(self):
        driver = self.driver
        driver.get("http://web.engr.oregonstate.edu/~lichlyts/cs561/pages/")
        self.assertIn("Aristotle", driver.title)
        login_home_btn = driver.find_element_by_class_name("btn")
        self.assertIsNotNone(login_home_btn)
        login_home_btn.click()

        time.sleep(1)
        username_element = driver.find_element_by_id("username")
        self.assertIsNotNone(username_element)
        username_element.send_keys('test_username')

        password_element = driver.find_element_by_id("password")
        self.assertIsNotNone(password_element)
        password_element.send_keys('test_password')

        login_btn = driver.find_element_by_name("_eventId_proceed")
        self.assertIsNotNone(login_btn)
        login_btn.click()

        self.assertIn("login.oregonstate.edu", driver.current_url)

    def test_login_right(self):
        driver = self.driver

        # user_pass.json format
        # {
        #   "username":"xxx",
        #   "password":"xxx"
        # }
        f = open('user_pass.json', 'r')
        userData = f.read()
        f.close()
        user = json.loads(userData)

        time.sleep(1)
        username_element = driver.find_element_by_id("username")
        self.assertIsNotNone(username_element)
        username_element.clear()
        username_element.send_keys(user['username'])

        password_element = driver.find_element_by_id("password")
        self.assertIsNotNone(password_element)
        password_element.clear()
        password_element.send_keys(user['password'])

        login_btn = driver.find_element_by_name("_eventId_proceed")
        self.assertIsNotNone(login_btn)
        login_btn.click()

        time.sleep(1)
        # if user is ta, redirect to studentDashboard.php
        self.assertIn("pages/ta.php", driver.current_url)

    @classmethod
    def tearDownClass(self):
        self.driver.quit()


def Suite():
    suiteTest = unittest.TestSuite()
    suiteTest.addTest(Test_TA_Use_Cases("test_login_error"))
    suiteTest.addTest(Test_TA_Use_Cases("test_login_right"))
    return suiteTest


if __name__ == "__main__":
    # unittest.main()
    now = time.strftime("%Y%m%d_%H%M%S",time.localtime(time.time()))
    # windows
    # report_path = ".\\report\\report_student_" + now + ".html"
    # linux or mac
    report_path = "./report/report_ta_login_" + now + ".html"
    fp = open(report_path, 'wb')
    runner = HTMLTestRunner.HTMLTestRunner(stream=fp, title='TA Login Use Cases TestReport', description='Test TA Login Use Cases')
    runner.run(Suite())
    fp.close()
