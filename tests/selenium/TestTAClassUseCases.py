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

    def test_login(self):
        driver = self.driver
        driver.get("http://web.engr.oregonstate.edu/~lichlyts/cs561/pages/")
        self.assertIn("Aristotle", driver.title)
        login_home_btn = driver.find_element_by_class_name("btn")
        self.assertIsNotNone(login_home_btn)
        login_home_btn.click()

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

    def test_ta_tutorial(self):
        driver = self.driver

        close_button = driver.find_element_by_xpath(".//*[@id='jpwClose']")
        self.assertIsNotNone(close_button)
        close_button.click()
        time.sleep(1)

        self.assertIn("pages/ta.php", driver.current_url)


    def test_class_select(self):
        driver = self.driver

        # read selected classes
        classes_list_elements = driver.find_elements_by_xpath(".//*[@class='classes']")
        self.assertIsNotNone(classes_list_elements)
        for i, x in enumerate(classes_list_elements):
            if i == 0:
                x.click()
                time.sleep(1)
        self.assertIn("pages/ta_class.php", driver.current_url)


    def test_class_detail_info(self):
        driver = self.driver

        table_object = driver.find_elements_by_xpath(".//*[@class='u-full-width']")
        self.assertIsNotNone(table_object)

        fake_table_object = driver.find_elements_by_xpath(".//*[@class='u-full-width-error']")
        self.assertEqual(fake_table_object, [])


    @classmethod
    def tearDownClass(self):
        self.driver.quit()


def Suite():
    suiteTest = unittest.TestSuite()
    suiteTest.addTest(Test_TA_Use_Cases("test_login"))
    suiteTest.addTest(Test_TA_Use_Cases("test_ta_tutorial"))
    suiteTest.addTest(Test_TA_Use_Cases("test_class_select"))
    suiteTest.addTest(Test_TA_Use_Cases("test_class_detail_info"))
    return suiteTest


if __name__ == "__main__":
    # unittest.main()
    now = time.strftime("%Y%m%d_%H%M%S",time.localtime(time.time()))
    # windows
    # report_path = ".\\report\\report_student_" + now + ".html"
    # linux or mac
    report_path = "./report/report_ta_class_" + now + ".html"
    fp = open(report_path, 'wb')
    runner = HTMLTestRunner.HTMLTestRunner(stream=fp, title='TA Class Use Cases TestReport', description='Test Class TA Use Cases')
    runner.run(Suite())
    fp.close()
